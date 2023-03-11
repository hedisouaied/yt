<?php

namespace App\Http\Controllers;

use App\Models\Partenaire;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PartenaireController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $feedback = Partenaire::orderby('id', 'DESC')->get();

        return view('backend.partenaire.index', compact('feedback'));
    }


    public function partenaireStatus(Request $request)
    {
        if ($request->mode == 'true') {
            DB::table('partenaires')->where('id', $request->id)->update(['status' => 'active']);
        } else {
            DB::table('partenaires')->where('id', $request->id)->update(['status' => 'inactive']);
        }
        return response()->json(['msg' => 'Successfully updated', 'status' => true]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.partenaire.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'string|required',
            'status' => 'nullable|in:active,inactive',
        ]);
        $data = $request->all();

        if ($request->hasFile('photo')) {

            $request->validate([
                'image' => 'mimes:jpeg,bmp,png' // Only allow .jpg, .bmp and .png file types.
            ]);

            // Save the file locally in the storage/public/ folder under a new folder named /product
            $request->photo->store('photos/1/partenaire', 'public');

            $data['photo'] = '/files/photos/1/partenaire/' . $request->photo->hashName();
        }


        $slug = Str::slug($request->input('title'));
        $slug_count = Partenaire::where('slug', $slug)->count();
        if ($slug_count > 0) {
            $slug = time() . '_' . $slug;
        }
        $data['slug'] = $slug;

        $status = Partenaire::create($data);

        if ($status) {
            return redirect()->route('partenaire.index')->with('success', 'Marque crée avec succès');
        } else {
            return back()->with('error', 'Something went wrong!!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $blog = Partenaire::find($id);
        if ($blog) {
            return view('backend.partenaire.edit', compact('blog'));
        } else {
            return back()->with('error', 'Data not found');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $blog = Partenaire::find($id);
        if ($blog) {

            $this->validate($request, [
                'title' => 'string|required',
            ]);
            $data = $request->all();


            if ($request->hasFile('photo')) {

                $request->validate([
                    'image' => 'mimes:jpeg,bmp,png' // Only allow .jpg, .bmp and .png file types.
                ]);

                // Save the file locally in the storage/public/ folder under a new folder named /product
                $request->photo->store('photos/1/partenaire', 'public');

                $data['photo'] = '/files/photos/1/partenaire/' . $request->photo->hashName();
            }


            if($data['discount'] !== "0" ){

                $products = Product::where('marque_id',$blog->id)->get();
                foreach($products as $prod){
                    $s_prod = Product::find($prod->id);

                    $new_discount = ($s_prod->price*$data['discount'])/100;

                    $status_prod = $s_prod->update([
                        'discount' => $new_discount,
                        'expiration_discount'=>$data['expiration_discount']
                    ]);
                    if($status_prod){
                        //i'm happy
                    }
                }
            }

            $status = $blog->fill($data)->save();

            if ($status) {


                return redirect()->route('partenaire.index')->with('success', 'Marque modifié avec succès');
            } else {
                return back()->with('error', 'something went wrong!');
            }
        } else {
            return back()->with('error', 'Data not found');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $feedback = Partenaire::find($id);
        if ($feedback) {
            $status = $feedback->delete();
            if ($status) {
                return redirect()->route('partenaire.index')->with('success', 'Marque supprimée avec succès');
            } else {
                return back()->with('error', 'Something went wrong!');
            }
        } else {
            return back()->with('error', 'Data not found');
        }
    }
}
