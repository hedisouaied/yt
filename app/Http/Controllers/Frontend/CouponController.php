<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Cookie;



class CouponController extends Controller
{
    public function addcoupon(Request $request)
    {

        $coupon = $request->coupon;

        $check_coupon = Coupon::where('code_coupon',$coupon)->where('status','active')->first();

        if($check_coupon){

            if(strtotime($check_coupon->expiration) > strtotime(date('y-m-d'))){


                setcookie('coupon', $check_coupon->id, strtotime($check_coupon->expiration));

               // return redirect()->route('maselection.status')->with('success', ' Bien ajouté coupon '.$coupon);


                return response()->json(['status' => ' Bien ajouté coupon '.$coupon , 'condition' => 'yes']);


            }else{
                return response()->json(['status' => "Le code coupon '".$coupon."' a été expiré !" , 'condition' => 'no']);

            }

        }
        else{
            return response()->json(['status' => "Le code coupon '".$coupon."' n'existe pas ! vérifiez votre code coupon !" , 'condition' => 'no']);
        }






    }
}
