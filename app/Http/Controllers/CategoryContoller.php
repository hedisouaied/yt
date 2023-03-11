<?php

namespace App\Http\Controllers;


use App\Models\Category;
use App\Models\Gamme;
use App\Models\Grandcategory;
use App\Models\Souscategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategoryContoller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::orderby('id', 'DESC')->get();

        return view('backend.category.index', compact('categories'));
    }

    public function categoryStatus(Request $request)
    {
        if ($request->mode == 'true') {
            DB::table('categories')->where('id', $request->id)->update(['status' => 'active']);
        } else {
            DB::table('categories')->where('id', $request->id)->update(['status' => 'inactive']);
        }
        return response()->json(['msg' => 'Successfully updated', 'status' => true]);
    }


    public function Souscategory(Request $request)
    {
        $category = Category::find($request->id);

        if ($category) {
            $categories = Souscategory::where('sous_cat_id',$category->id)->orderby('id', 'DESC')->get();

            return view('backend.category.sous', compact(['categories','category']));

        } else {
            return back()->with('error', 'Category not found');
        }

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parent_cats = Grandcategory::orderBy('title', 'ASC')->get();
        return view('backend.category.create', compact('parent_cats'));
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
            'status' => 'nullable|in:active,inactive'
        ]);
        $data = $request->all();

        $slug = Str::slug($request->input('title'));
        $slug_count = Category::where('slug', $slug)->count();
        if ($slug_count > 0) {
            $slug = time() . '_' . $slug;
        }
        $data['slug'] = $slug;

        $status = Category::create($data);
        if ($status) {
            return redirect()->route('category.index')->with('success', 'Sous-catégorie crée avec succès');
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
        $category = Category::find($id);
        $parent_cats = Grandcategory::orderBy('title', 'ASC')->get();
        if ($category) {
            return view('backend.category.edit', compact(['category', 'parent_cats']));
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

        $category = Category::find($id);
        if ($category) {
            $this->validate($request, [
                'title' => 'string|required',
                'grand_cat_id' => 'nullable|exists:grandcategories,id'
            ]);
            $data = $request->all();

            $status = $category->fill($data)->save();
            if ($status) {
                return redirect()->route('category.index')->with('success', 'Sous catégorie modifiée avec succès');
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
        $category = Category::find($id);

        if ($category) {
            $status = $category->delete();
            if ($status) {

                return redirect()->route('category.index')->with('success', 'Sous catégorie supprimée avec succès');
            } else {
                return back()->with('error', 'quelque chose est mal passé!');
            }
        } else {
            return back()->with('error', 'Data not found');
        }
    }

    public function getChildByParentID(Request $request, $id)
    {
        $category = Category::find($request->id);
        if ($category) {
            $child_id = Category::getChildByParentID($request->id);
            if (count($child_id) <= 0) {
                return response()->json(['status' => false, 'data' => null, 'msg' => '']);
            }
            return response()->json(['status' => true, 'data' => $child_id, 'msg' => '']);
        } else {
            return response()->json(['status' => false, 'data' => null, 'msg' => 'Category not found']);
        }
    }

    public function getGammeByParentID(Request $request, $id)
    {
        $category = Category::find($request->id);
        if ($category) {
            $child_id = Category::getGammeByParentID($request->id);
            if (count($child_id) <= 0) {
                return response()->json(['status' => false, 'data' => null, 'msg' => '']);
            }
            return response()->json(['status' => true, 'data' => $child_id, 'msg' => '']);
        } else {
            return response()->json(['status' => false, 'data' => null, 'msg' => 'Category not found']);
        }
    }


    public function getSousGammeByParentID(Request $request, $id)
    {
        $category = Gamme::find($request->id);
        if ($category) {
            $child_id = Category::getSousGammeByParentID($request->id);
            if (count($child_id) <= 0) {
                return response()->json(['status' => false, 'data' => null, 'msg' => '']);
            }
            return response()->json(['status' => true, 'data' => $child_id, 'msg' => '']);
        } else {
            return response()->json(['status' => false, 'data' => null, 'msg' => 'Gamme not found']);
        }
    }

    public function getChildByParentSlug(Request $request, $slug)
    {
        $category = Category::where('slug', $slug)->first();
        if ($category) {
            $child_id = Category::getChildByParentSlug($category->id);
            if (count($child_id) <= 0) {
                return response()->json(['status' => false, 'data' => null, 'msg' => '']);
            }
            return response()->json(['status' => true, 'data' => $child_id, 'msg' => '']);
        } else {
            return response()->json(['status' => false, 'data' => null, 'msg' => 'Category not found']);
        }
    }
}
