<?php

namespace App\Http\Controllers;

use App\Models\AboutUs;
use App\Models\Feedback;
use App\Models\Mission;
use App\Models\SolideEx;
use Illuminate\Http\Request;

class AboutusController extends Controller
{
    public function index()
    {
        $about = AboutUs::first();
        return view('backend.about.index', compact(['about']));
    }
    public function aboutUpdate(Request $request)
    {
        $about = AboutUs::first();
        $image=$about->image;

        if ($request->hasFile('image')) {

            $request->validate([
                'image' => 'mimes:jpeg,bmp,png' // Only allow .jpg, .bmp and .png file types.
            ]);

            // Save the file locally in the storage/public/ folder under a new folder named /product
            $request->image->store('photos/1/aboutus', 'public');

            $image = '/files/photos/1/aboutus/' . $request->image->hashName();
        }


        $status = $about->update([
            'heading' => $request->heading,
            'content' => $request->content,
            'prix_livraison' => $request->prix_livraison,
            'image' => $image,
            'video' => $request->video,
            'address' => $request->address,
            'phone' => $request->phone,
            'email' => $request->email,
            'facebook' => $request->facebook,
            'instagram' => $request->instagram,
            'linkedin' => $request->linkedin,
            'twitter' => $request->twitter,
            'youtube' => $request->youtube,
            'content1' => $request->content1,
            'image1' => $request->image1,
            'content2' => $request->content2,
            'image2' => $request->image2,
            'content3' => $request->content3,
            'image3' => $request->image3,
            'content4' => $request->content4,
            'image4' => $request->image4,
        ]);

        if ($status) {
            return redirect()->back()->with('success', 'Modifié avec succès');
        } else {
            return back()->with('error', 'something went wrong!');
        }
    }



}
