<?php

use App\Models\Partenaire;
use App\Models\Product;



if (!function_exists('get_setting')) {
    function get_setting($key)
    {
        return \App\Models\AboutUs::value($key);
    }
}

if (!function_exists('getValuesFromFunctionFile')) {
    function getValuesFromFunctionFile()
    {
        $all_discounted_products = Product::where('discount','!=',0)->where('expiration_discount','!=',NULL)->get();
        return $all_discounted_products;
    }

}


if (!function_exists('getValuesFromFunctionFileMarque')) {
    function getValuesFromFunctionFileMarque()
    {
        $all_discounted_marques = Partenaire::where('discount','!=',0)->where('expiration_discount','!=',NULL)->get();
        return $all_discounted_marques;
    }

}




if (!function_exists('function_update_discount_marque')) {
    function function_update_discount_marque(){

        foreach((getValuesFromFunctionFileMarque()) as $all_discounted_marque){

            if(strtotime($all_discounted_marque->expiration_discount) <= strtotime(date('y-m-d')) ){

                $expired_product = Partenaire::find($all_discounted_marque->id);

                $status = $expired_product->update([
                    'discount' => 0,
                ]);

                return $status;

            }
        }
    }
}



if (!function_exists('function_update_discount')) {
    function function_update_discount(){

        foreach((getValuesFromFunctionFile()) as $all_discounted_product){

            if(strtotime($all_discounted_product->expiration_discount) <= strtotime(date('y-m-d')) ){

                $expired_product = Product::find($all_discounted_product->id);

                $status = $expired_product->update([
                    'discount' => 0,
                ]);

                return $status;

            }
        }
    }
}

//echo '<script>alert("'.count(getValuesFromFunctionFile()).'");</script>';
