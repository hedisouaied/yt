<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class blogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blog = Blog::orderby('id', 'DESC')->get();

        return view('backend.blog.index', compact('blog'));
    }

    public function actualiteStatus(Request $request)
    {
        if ($request->mode == 'true') {
            DB::table('blogs')->where('id', $request->id)->update(['status' => 'active']);
        } else {
            DB::table('blogs')->where('id', $request->id)->update(['status' => 'inactive']);
        }
        return response()->json(['msg' => 'Seccessfully updated', 'status' => true]);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.blog.create');
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
            'description' => 'string|required',
            'status' => 'nullable|in:active,inactive',
        ]);
        $data = $request->all();

        if ($request->hasFile('photo')) {

            $request->validate([
                'image' => 'mimes:jpeg,bmp,png' // Only allow .jpg, .bmp and .png file types.
            ]);

            // Save the file locally in the storage/public/ folder under a new folder named /product
            $request->photo->store('photos/1/blogs', 'public');

            $data['photo'] = '/files/photos/1/blogs/' . $request->photo->hashName();
        }


        $slug = Str::slug($request->input('title'));
        $slug_count = Blog::where('slug', $slug)->count();
        if ($slug_count > 0) {
            $slug = time() . '_' . $slug;
        }
        $data['slug'] = $slug;

        $status = Blog::create($data);
        if ($status) {
            return redirect()->route('actualite.index')->with('success', 'Article crée avec succès');
        } else {
            return back()->with('error', 'Something went wrong!!');
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
        $blog = Blog::find($id);
        if ($blog) {
            return view('backend.blog.edit', compact('blog'));
        } else {
            return back()->with('error', 'Data not found');
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
        $blog = Blog::find($id);
        if ($blog) {

            $this->validate($request, [
                'title' => 'string|required',
                'description' => 'string|required',
            ]);
            $data = $request->all();


            if ($request->hasFile('photo')) {

                $request->validate([
                    'image' => 'mimes:jpeg,bmp,png' // Only allow .jpg, .bmp and .png file types.
                ]);

                // Save the file locally in the storage/public/ folder under a new folder named /product
                $request->photo->store('photos/1/blogs', 'public');

                $data['photo'] = '/files/photos/1/blogs/' . $request->photo->hashName();
            }


            $status = $blog->fill($data)->save();
            if ($status) {
                return redirect()->route('actualite.index')->with('success', 'Article modifié avec succès');
            } else {
                return back()->with('error', 'something went wrong!');
            }
        } else {
            return back()->with('error', 'Data not found');
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
        $blog = Blog::find($id);
        if ($blog) {
            $status = $blog->delete();
            if ($status) {
                return redirect()->route('actualite.index')->with('success', 'Article supprimée avec succès');
            } else {
                return back()->with('error', 'Something went wrong!');
            }
        } else {
            return back()->with('error', 'Data not found');
        }
    }
}
