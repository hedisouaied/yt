<?php

namespace App\Http\Controllers;

use App\Models\Reference;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ReferenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Reference::orderby('id', 'DESC')->get();

        return view('backend.reference.index', compact('products'));
    }

    public function referenceStatus(Request $request)
    {
        if ($request->mode == 'true') {
            DB::table('references')->where('id', $request->id)->update(['status' => 'active']);
        } else {
            DB::table('references')->where('id', $request->id)->update(['status' => 'inactive']);
        }
        return response()->json(['msg' => 'Seccessfully updated', 'status' => true]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.reference.create');
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
            'description' => 'string|nullable',
            'photo' => 'required',
            'domaine_id' => 'required|exists:domaineactivites,id',
            'status' => 'nullable|in:active,inactive',

        ]);

        $data = $request->all();
        // return $data;
        $slug = Str::slug($request->input('title'));
        $slug_count = Reference::where('slug', $slug)->count();
        if ($slug_count > 0) {
            $slug = time() . '_' . $slug;
        }
        $data['slug'] = $slug;


        $status = Reference::create($data);
        if ($status) {
            return redirect()->route('reference.index')->with('success', 'reference crée avec succès');
        } else {
            return back()->with('error', 'something went wrong!');
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
        $product = Reference::find($id);
        if ($product) {
            return view('backend.reference.edit', compact(['product']));
        } else {
            return back()->with('error', 'data not found');
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
        $product = Reference::find($id);
        if ($product) {
            $this->validate($request, [
                'title' => 'string|required',
                'description' => 'string|nullable',
                'photo' => 'required',
                'domaine_id' => 'required|exists:domaineactivites,id',

            ]);
            $data = $request->all();

            $status = $product->fill($data)->save();
            if ($status) {
                return redirect()->route('reference.index')->with('success', 'Reference modifiée avec succès');
            } else {
                return back()->with('error', 'something went wrong!');
            }
        } else {
            return back()->with('error', 'data not found');
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
        $product = Reference::find($id);
        if ($product) {
            $status = $product->delete();
            if ($status) {
                return redirect()->route('reference.index')->with('success', 'Reference supprimée avec succès');
            } else {
                return back()->with('error', 'Something went wrong!');
            }
        } else {
            return back()->with('error', 'Data not found');
        }
    }
}
