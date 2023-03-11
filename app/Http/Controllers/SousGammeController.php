<?php

namespace App\Http\Controllers;

use App\Models\SousGamme;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SousGammeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = SousGamme::orderby('id', 'DESC')->get();

        return view('backend.sousgamme.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.sousgamme.create');
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
            'cat_id' => 'required|exists:categories,id',
            'child_cat_id' => 'nullable|exists:categories,id',

        ]);

        $data = $request->all();
        // return $data;
        $slug = Str::slug($request->input('title'));
        $slug_count = SousGamme::where('slug', $slug)->count();
        if ($slug_count > 0) {
            $slug = time() . '_' . $slug;
        }
        $data['slug'] = $slug;


        $status = SousGamme::create($data);
        if ($status) {
            return redirect()->route('sous_gamme.index')->with('success', 'Sous Gamme crée avec succès');
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
        $product = SousGamme::find($id);
        if ($product) {
            return view('backend.sousgamme.edit', compact(['product']));
        } else {
            return back()->with('error', 'Product not found');
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
        $product = SousGamme::find($id);
        if ($product) {
            $this->validate($request, [
                'title' => 'string|required',
                'cat_id' => 'required|exists:categories,id',
                'child_cat_id' => 'nullable|exists:categories,id',

            ]);
            $data = $request->all();

            $status = $product->fill($data)->save();
            if ($status) {
                return redirect()->route('sous_gamme.index')->with('success', 'Sous Gamme modifiée avec succès');
            } else {
                return back()->with('error', 'something went wrong!');
            }
        } else {
            return back()->with('error', 'Sous Gamme not found');
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
        $product = SousGamme::find($id);
        if ($product) {
            $status = $product->delete();
            if ($status) {
                return redirect()->route('sous_gamme.index')->with('success', 'Sous Gamme supprimée avec succès');
            } else {
                return back()->with('error', 'Something went wrong!');
            }
        } else {
            return back()->with('error', 'Data not found');
        }
    }
}
