<?php

namespace App\Http\Controllers;

use App\Models\Gamme;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class GammeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Gamme::orderby('id', 'DESC')->get();

        return view('backend.gamme.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.gamme.create');
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
        $slug_count = Gamme::where('slug', $slug)->count();
        if ($slug_count > 0) {
            $slug = time() . '_' . $slug;
        }
        $data['slug'] = $slug;


        $status = Gamme::create($data);
        if ($status) {
            return redirect()->route('gamme.index')->with('success', 'Gamme crée avec succès');
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
        $product = Gamme::find($id);
        if ($product) {
            return view('backend.gamme.edit', compact(['product']));
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
        $product = Gamme::find($id);
        if ($product) {
            $this->validate($request, [
                'title' => 'string|required',
                'cat_id' => 'required|exists:categories,id',
                'child_cat_id' => 'nullable|exists:categories,id',

            ]);
            $data = $request->all();

            $status = $product->fill($data)->save();
            if ($status) {
                return redirect()->route('gamme.index')->with('success', 'Gamme modifiée avec succès');
            } else {
                return back()->with('error', 'something went wrong!');
            }
        } else {
            return back()->with('error', 'Gamme not found');
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
        $product = Gamme::find($id);
        if ($product) {
            $status = $product->delete();
            if ($status) {
                return redirect()->route('gamme.index')->with('success', 'Gamme supprimée avec succès');
            } else {
                return back()->with('error', 'Something went wrong!');
            }
        } else {
            return back()->with('error', 'Data not found');
        }
    }
}
