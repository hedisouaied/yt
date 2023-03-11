<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Grandcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class GrandcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Grandcategory::orderby('id', 'DESC')->get();

        return view('backend.grandcategory.index', compact('categories'));
    }

    public function Souscategory(Request $request)
    {
        $category = Grandcategory::find($request->id);

        if ($category) {
            $categories = Category::where('grand_cat_id',$category->id)->orderby('id', 'DESC')->get();

            return view('backend.grandcategory.sous', compact(['categories','category']));

        } else {
            return back()->with('error', 'Category not found');
        }

    }

    public function grandcategoryStatus(Request $request)
    {
        if ($request->mode == 'true') {
            DB::table('grandcategories')->where('id', $request->id)->update(['status' => 'active']);
        } else {
            DB::table('grandcategories')->where('id', $request->id)->update(['status' => 'inactive']);
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
        return view('backend.grandcategory.create');
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
            'status' => 'nullable|in:active,inactive'
        ]);

        $data = $request->all();

        $slug = Str::slug($request->input('title'));
        $slug_count = Grandcategory::where('slug', $slug)->count();
        if ($slug_count > 0) {
            $slug = time() . '_' . $slug;
        }
        $data['slug'] = $slug;

        $status = Grandcategory::create($data);
        if ($status) {
            return redirect()->route('grand-category.index')->with('success', 'Grand catégorie crée avec succès');
        } else {
            return back()->with('error', 'quelque chose est mal passé !');
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
        $category = Grandcategory::find($id);

        if ($category) {
            return view('backend.grandcategory.edit', compact(['category']));
        } else {
            return back()->with('error', 'Category not found');
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

        $category = Grandcategory::find($id);
        if ($category) {
            $this->validate($request, [
                'title' => 'string|required',
            ]);
            $data = $request->all();

            $status = $category->fill($data)->save();
            if ($status) {
                return redirect()->route('grand-category.index')->with('success', 'Grand catégorie modifiée avec succès');
            } else {
                return back()->with('error', 'quelque chose est mal passé!');
            }
        } else {
            return back()->with('error', 'Category not found');
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
        $category = Grandcategory::find($id);
        if ($category) {
            $status = $category->delete();
            if ($status) {
                return redirect()->route('grand-category.index')->with('success', 'Grand catégorie supprimée avec succès');
            }
            else {
                return back()->with('error', 'quelque chose est mal passé!');
            }
        } else {
            return back()->with('error', 'Data not found');
        }
    }
}
