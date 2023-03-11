<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Cours;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;


class CartController extends Controller
{


    public function addtocart(Request $request)
    {

        $prod_id = $request->input('product_id');
        $quantity = $request->input('quantity');

        if (Cookie::get('shopping_cart')) {
            $cookie_data = stripslashes(Cookie::get('shopping_cart'));
            $cart_data = json_decode($cookie_data, true);
        } else {
            $cart_data = array();
        }

        $item_id_list = array_column($cart_data, 'item_id');
        $prod_id_is_there = $prod_id;

        if (in_array($prod_id_is_there, $item_id_list)) {

            $products = Product::find($prod_id);
            $prod_name = $products->title;
            $prod_image = $products->photo;
            $priceval = $products->price;

            foreach ($cart_data as $keys => $values) {
                if ($cart_data[$keys]["item_id"] == $prod_id) {

                    if(($quantity+$cart_data[$keys]["item_quantity"]) > $products->stock){
                        return response()->json(['status' => '"' . $prod_name . '" OUT OF STOCK', 'condition' => 'no']);

                    }else{
                        $cart_data[$keys]["item_quantity"] = $quantity+$cart_data[$keys]["item_quantity"];
                        $item_data = json_encode($cart_data);

                        $minutes = 1440;
                        Cookie::queue(Cookie::make('shopping_cart', $item_data, $minutes));
                        return response()->json(['status' => '"' . $prod_name . '" Bien ajouté à votre panier', 'condition' => 'yes']);
                    }


                }
            }
        } else {

            $products = Product::find($prod_id);
            $prod_name = $products->title;
            $prod_image = $products->photo;
            $priceval = $products->price;

            if ($products) {

                if(($quantity) > $products->stock){
                    return response()->json(['status' => '"' . $prod_name . '" OUT OF STOCK', 'condition' => 'no']);

                }else{
                $item_array = array(
                    'item_id' => $prod_id,
                    'item_quantity' => $quantity,
                    'item_name' => $prod_name,
                    'item_price' => $priceval,
                    'item_image' => $prod_image
                );
                $cart_data[] = $item_array;

                if(count($cart_data) > 10 ){
                    return response()->json(['status' => 'Vous ne pouvez pas ajouter plus que 10 produits au panier', 'condition' => 'no']);
                }else{

                    $item_data = json_encode($cart_data);
                    $minutes = 1440;
                    Cookie::queue(Cookie::make('shopping_cart', $item_data, $minutes));

                    return response()->json(['status' => '"' . $prod_name . '" Bien ajouté à votre panier', 'condition' => 'yes']);

                }
            }

            }
        }
    }




    public function updatetocart(Request $request)
    {
        $prod_id = $request->input('product_id');
        $quantity = $request->input('quantity');

        if(Cookie::get('shopping_cart'))
        {
            $cookie_data = stripslashes(Cookie::get('shopping_cart'));
            $cart_data = json_decode($cookie_data, true);

            $item_id_list = array_column($cart_data, 'item_id');
            $prod_id_is_there = $prod_id;

            if(in_array($prod_id_is_there, $item_id_list))
            {
                foreach($cart_data as $keys => $values)
                {
                    if($cart_data[$keys]["item_id"] == $prod_id)
                    {
                            $products = Product::find($prod_id);
                            $prod_name = $products->title;
                            $prod_image = $products->photo;
                            $priceval = $products->price;

                            if(($quantity) > $products->stock){
                                return response()->json(['status' => '"' . $prod_name . '" OUT OF STOCK', 'condition' => 'no','old_quantityyy'=>($products->stock)]);

                            }else{
                                $cart_data[$keys]["item_quantity"] =  $quantity;
                                $item_data = json_encode($cart_data);
                                $minutes = 60;
                                Cookie::queue(Cookie::make('shopping_cart', $item_data, $minutes));
                                return response()->json(['status'=>'"'.$cart_data[$keys]["item_name"].'" Quantité modifiée', 'condition' => 'yes']);
                            }
                    }
                }
            }
        }
    }


    public function cartloadbyajax()
    {
        if (Cookie::get('shopping_cart')) {
            $cookie_data = stripslashes(Cookie::get('shopping_cart'));
            $cart_data = json_decode($cookie_data, true);
            $totalcart = count($cart_data);

            echo json_encode(array('totalcart' => $totalcart));
            die;
            return;
        } else {
            $totalcart = "0";
            echo json_encode(array('totalcart' => $totalcart));
            die;
            return;
        }
    }

    public function merci()
    {
        return view('frontend.pages.selection.merci');
    }

    public function index()
    {
        $cookie_data = stripslashes(Cookie::get('shopping_cart'));
        $cart_data = json_decode($cookie_data, true);

        if(isset($_COOKIE['coupon'])){
            $array_cookie_coupon = Coupon::where('id',$_COOKIE['coupon'])->where('status','active')->first();
        }
        else{
            $array_cookie_coupon = array();
        }
        return view('frontend.pages.selection.index')->with('cart_data', $cart_data)->with('array_cookie_coupon', $array_cookie_coupon);
    }

    public function index_checkout()
    {
        if ((Auth::user())) {
            $user = User::find(Auth::user()->id);
        }else{
            $user = "";
        }

        if(Cookie::get('shopping_cart')){
            $cookie_data = stripslashes(Cookie::get('shopping_cart'));
            $cart_data = json_decode($cookie_data, true);

            if(isset($cart_data) && !empty($cart_data)){

                if(isset($_COOKIE['coupon'])){
                    $array_cookie_coupon = Coupon::where('id',$_COOKIE['coupon'])->where('status','active')->first();
                }
                else{
                    $array_cookie_coupon = array();
                }

                return view('frontend.pages.selection.indexcheckout')->with('cart_data', $cart_data)->with('user',$user)->with('array_cookie_coupon',$array_cookie_coupon);
            }else{
                return view('errors.404');
            }

        }else{
            return view('errors.404');
        }

    }

    public function deletefromselection(Request $request)
    {
        $prod_id = $request->input('product_id');

        $cookie_data = stripslashes(Cookie::get('shopping_cart'));
        $cart_data = json_decode($cookie_data, true);

        $item_id_list = array_column($cart_data, 'item_id');
        $prod_id_is_there = $prod_id;

        if (in_array($prod_id_is_there, $item_id_list)) {
            $totalprix=0;
            foreach ($cart_data as $keys => $values) {
                if ($cart_data[$keys]["item_id"] == $prod_id) {
                    unset($cart_data[$keys]);
                    $item_data = json_encode($cart_data);
                    $minutes = 1440;
                }else{
                    $cours = Product::where('id', $cart_data[$keys]["item_id"])->first();
                    $totalprix = $totalprix+( ( $cours->price-  (($cours->discount*$cours->price)/100) ) *$cart_data[$keys]['item_quantity']);

                }
            }
            $totalcart = count($cart_data);
            Cookie::queue(Cookie::make('shopping_cart', $item_data, $minutes));
            return response()->json(['status' => 'Item Removed from Cart', 'count' => $totalcart,'total'=>$totalprix]);
        }
    }
}
