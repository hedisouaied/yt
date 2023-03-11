<?php

namespace App\Http\Controllers;

use App\Models\NewsLetter;
use Illuminate\Http\Request;

class newsletterController extends Controller
{
    public function index()
    {
        $news = NewsLetter::orderby('id', 'DESC')->get();

        return view('backend.newsletter.index', compact('news'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $news = NewsLetter::find($id);
        if ($news) {
            $status = $news->delete();
            if ($status) {
                return redirect()->route('newsletter.index')->with('success', 'Email supprimé avec succès');
            } else {
                return back()->with('error', 'Something went wrong!');
            }
        } else {
            return back()->with('error', 'Data not found');
        }
    }
}
