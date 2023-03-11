<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PointsController extends Controller
{
    public function addpoints(Request $request)
    {

        $points = $request->points;
        $user = User::find(Auth::user()->id);

        $points_existant = $user->points;

        if($points_existant >= $points){

            $points_convertie = $user->points_convertie + $points;
            $points_existant = $points_existant - $points;

            $status = $user->update([
                'points_convertie' => $points_convertie,
                'points' => $points_existant,
            ]);

            if($status){
                return response()->json(['status' => 'Points fidélité bien convertis' , 'condition' => 'yes']);
            }

        }
        else{
            return response()->json(['status' => "Vous n'avez pas des points fidélité suffisants !" , 'condition' => 'no']);
        }






    }
}
