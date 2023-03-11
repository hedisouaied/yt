<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Partenaire;
use App\Models\Product;
use App\Models\Souscategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index()
    {

        $products = Product::orderby('id', 'DESC')->get();

        return view('backend.product.index', compact('products'));
    }


    public function index_in_stock()
    {

        $products = Product::where('stock','!=',0)->orderby('id', 'DESC')->get();

        return view('backend.product.index', compact('products'));
    }


    public function index_out_stock()
    {

        $products = Product::where('stock',0)->orderby('id', 'DESC')->get();

        return view('backend.product.index', compact('products'));
    }

    public function productStatus(Request $request)
    {
        if ($request->mode == 'true') {
            DB::table('products')->where('id', $request->id)->update(['status' => 'active']);
        } else {
            DB::table('products')->where('id', $request->id)->update(['status' => 'inactive']);
        }
        return response()->json(['msg' => 'Successfully updated', 'status' => true]);
    }

    public function productOffre(Request $request)
    {
        if ($request->mode == 'true') {
            DB::table('products')->where('id', $request->id)->update(['offre' => 'active']);
        } else {
            DB::table('products')->where('id', $request->id)->update(['offre' => 'inactive']);
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
        return view('backend.product.create');
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
            'cat_id' => 'required|exists:categories,id',
            'child_cat_id' => 'nullable|exists:souscategories,id',
            'grand_cat_id' => 'nullable|exists:grandcategories,id',
            'status' => 'nullable|in:active,inactive',

        ]);

        $data = $request->all();
        $allname = "";

        if ($request->hasFile('photo')) {

            $request->validate([
                'image' => 'mimes:jpeg,bmp,png' // Only allow .jpg, .bmp and .png file types.
            ]);

            $allname = "";
            foreach ($request->file('photo') as $image) {
                 $image->store('products', 'public');
                $allname = $allname . '/files/products/' . $image->hashName() . ',';
            }
            // Save the file locally in the storage/public/ folder under a new folder named /product
            $allname = substr_replace($allname, "", -1);
            $data['photo'] = $allname;

        }



        if(isset($request->marque_id) && ($request->marque_id != '0')){
            $marque =Partenaire::find($request->marque_id);
            if($marque->discount !== 0){
                $data['expiration_discount'] = $marque->expiration_discount;
                $data['discount'] = ($request->price*$marque->discount)/100;
            }
        }


        $slug = Str::slug($request->input('title'));
        $slug_count = Product::where('slug', $slug)->count();
        if ($slug_count > 0) {
            $slug = time() . '_' . $slug;
        }
        $data['slug'] = $slug;



       $status = Product::create($data);


        if ($status) {
            return redirect()->route('product.index')->with('success', 'Produit crée avec succès');
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

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::find($id);
        if ($product) {
            return view('backend.product.edit', compact(['product']));
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

        $product = Product::find($id);
        if ($product) {
            $this->validate($request, [
                'title' => 'string|required',
                'description' => 'string|nullable',
                'cat_id' => 'required|exists:categories,id',
                'child_cat_id' => 'nullable|exists:souscategories,id',
                'grand_cat_id' => 'nullable|exists:grandcategories,id',

            ]);
            $data = $request->all();

            $allname = "";

            if ($request->hasFile('newphoto')) {

                $request->validate([
                    'image' => 'mimes:jpeg,bmp,png' // Only allow .jpg, .bmp and .png file types.
                ]);

                $allname = "";
                foreach ($request->file('newphoto') as $image) {
                     $image->store('products', 'public');
                    $allname = $allname . '/files/products/' . $image->hashName() . ',';
                }
                // Save the file locally in the storage/public/ folder under a new folder named /product
                $allname = substr_replace($allname, "", -1);
                $data['photo'] = $allname;

            }


            $status = $product->fill($data)->save();

            if ($status) {
                return redirect()->route('product.index')->with('success', 'Produit modifié avec succès');
            } else {
                return back()->with('error', 'something went wrong!');
            }

        } else {
            return back()->with('error', 'Product not found');
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
        $product = Product::find($id);
        if ($product) {
            $status = $product->delete();
            if ($status) {
                return redirect()->route('product.index')->with('success', 'Produit supprimé avec succès');
            } else {
                return back()->with('error', 'Something went wrong!');
            }
        } else {
            return back()->with('error', 'Data not found');
        }
    }




    public function getChildByParentID(Request $request, $id)
    {
        $category = Category::find($request->id);
        if ($category) {
            $child_id = Souscategory::where('sous_cat_id',$request->id)->pluck('title', 'id');
            if (count($child_id) <= 0) {
                return response()->json(['status' => false, 'data' => null, 'msg' => '']);
            }
            return response()->json(['status' => true, 'data' => $child_id, 'msg' => '']);
        } else {
            return response()->json(['status' => false, 'data' => null, 'msg' => 'Category not found']);
        }
    }




}
