<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Grandcategory;
use App\Models\Souscategory;
use App\Models\SousGamme;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SouscategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Souscategory::orderby('id', 'DESC')->get();

        return view('backend.souscategory.index', compact('categories'));
    }
    public function souscategoryStatus(Request $request)
    {
        if ($request->mode == 'true') {
            DB::table('souscategories')->where('id', $request->id)->update(['status' => 'active']);
        } else {
            DB::table('souscategories')->where('id', $request->id)->update(['status' => 'inactive']);
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
        $parent_cats = Grandcategory::orderBy('title', 'ASC')->get();
        return view('backend.souscategory.create', compact('parent_cats'));
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
            'grand_cat_id' => 'nullable|exists:grandcategories,id',
            'sous_cat_id' => 'nullable|exists:categories,id',
            'status' => 'nullable|in:active,inactive'
        ]);
        $data = $request->all();

        $slug = Str::slug($request->input('title'));
        $slug_count = Souscategory::where('slug', $slug)->count();
        if ($slug_count > 0) {
            $slug = time() . '_' . $slug;
        }
        $data['slug'] = $slug;

        $status = Souscategory::create($data);
        if ($status) {
            return redirect()->route('souscategory.index')->with('success', 'Sous sous-catégorie crée avec succès');
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
        $category = Souscategory::find($id);
        $parent_cats = Grandcategory::orderBy('title', 'ASC')->get();
        if ($category) {
            return view('backend.souscategory.edit', compact(['category', 'parent_cats']));
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
        $category = Souscategory::find($id);
        if ($category) {
            $this->validate($request, [
                'title' => 'string|required',
                'grand_cat_id' => 'nullable|exists:grandcategories,id',
                'sous_cat_id' => 'nullable|exists:categories,id',
            ]);
            $data = $request->all();

            $status = $category->fill($data)->save();
            if ($status) {
                return redirect()->route('souscategory.index')->with('success', 'Sous sous-catégorie modifiée avec succès');
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
        $category = Souscategory::find($id);

        if ($category) {
            $status = $category->delete();
            if ($status) {

                return redirect()->route('souscategory.index')->with('success', 'Sous sous-catégorie supprimée avec succès');
            } else {
                return back()->with('error', 'quelque chose est mal passé!');
            }
        } else {
            return back()->with('error', 'Data not found');
        }
    }

    public function getChildByParentID(Request $request, $id)
    {
        $category = Grandcategory::find($request->id);
        if ($category) {
            $child_id = Category::where('grand_cat_id',$request->id)->pluck('title', 'id');
            if (count($child_id) <= 0) {
                return response()->json(['status' => false, 'data' => null, 'msg' => '']);
            }
            return response()->json(['status' => true, 'data' => $child_id, 'msg' => '']);
        } else {
            return response()->json(['status' => false, 'data' => null, 'msg' => 'Category not found']);
        }
    }






}
