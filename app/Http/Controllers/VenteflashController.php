<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Venteflash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VenteflashController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $flashs = Venteflash::orderby('id', 'DESC')->get();

        return view('backend.venteflash.index', compact('flashs'));
    }


    public function venteflashStatus(Request $request)
    {
        if ($request->mode == 'true') {
            DB::table('venteflashes')->where('id', $request->id)->update(['status' => 'active']);
        } else {
            DB::table('venteflashes')->where('id', $request->id)->update(['status' => 'inactive']);
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
        $products = Product::orderBy('title','ASC')->get();
        return view('backend.venteflash.create',compact(['products']));
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
            'product_id' => 'required|exists:products,id',
            'status' => 'nullable|in:active,inactive',
            'quantity_max' => 'min:1',
            'time_debut' => 'required|date_format:Y-m-d\TH:i',
            'time_fin' => 'required|date_format:Y-m-d\TH:i|after:start_datetime',
        ]);
        $data = $request->all();


       $status = Venteflash::create($data);


       if ($status) {
           return redirect()->route('vente-flash.index')->with('success', 'Vente flash crée avec succès');
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
        $flash = Venteflash::find($id);
        $products = Product::orderBy('title','ASC')->get();

        if ($flash) {
            return view('backend.venteflash.edit', compact(['flash','products']));
        } else {
            return back()->with('error', 'vente flash not found');
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

        $flash = Venteflash::find($id);
        if ($flash) {

            $this->validate($request, [
                'product_id' => 'required|exists:products,id',
                'quantity_max' => 'min:1',
                'time_debut' => 'required|date_format:Y-m-d\TH:i',
                'time_fin' => 'required|date_format:Y-m-d\TH:i|after:start_datetime',
            ]);

            $data = $request->all();

            $status = $flash->fill($data)->save();

            if ($status) {
                return redirect()->route('vente-flash.index')->with('success', 'Vente flash modifié avec succès');
            } else {
                return back()->with('error', 'quelque chose est mal passé!');
            }
        } else {
            return back()->with('error', 'Vente flash not found');
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
        $category = Venteflash::find($id);

        if ($category) {
            $status = $category->delete();
            if ($status) {

                return redirect()->route('vente-flash.index')->with('success', 'Vente flash supprimé avec succès');
            } else {
                return back()->with('error', 'quelque chose est mal passé!');
            }
        } else {
            return back()->with('error', 'Data not found');
        }
    }
}
