<?php

namespace App\Http\Controllers;

use App\Models\Cours;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CoursController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $feedback = Cours::orderby('id', 'DESC')->get();

        return view('backend.cours.index', compact('feedback'));
    }
    public function coursStatus(Request $request)
    {
        if ($request->mode == 'true') {
            DB::table('cours')->where('id', $request->id)->update(['status' => 'active']);
        } else {
            DB::table('cours')->where('id', $request->id)->update(['status' => 'inactive']);
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
        return view('backend.cours.create');
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
            'title' => 'nullable|string',
            'description' => 'string|required',
            'date_debut' => 'date|required',
            'status' => 'nullable|in:active,inactive',
        ]);



        $data = $request->all();
        $slug = Str::slug($request->input('title'));
        $slug_count = Cours::where('slug', $slug)->count();
        if ($slug_count > 0) {
            $slug = time() . '_' . $slug;
        }
        $data['slug'] = $slug;

        $status = Cours::create($data);
        if ($status) {
            return redirect()->route('cours.index')->with('success', 'cours crée avec succès');
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
        $feedback = Cours::find($id);
        if ($feedback) {
            return view('backend.cours.edit', compact('feedback'));
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
        $feedback = Cours::find($id);
        if ($feedback) {

            $this->validate($request, [
                'title' => 'nullable|string',
                'description' => 'string|required',
                'date_debut' => 'date|required',
            ]);
            $data = $request->all();

            $status = $feedback->fill($data)->save();
            if ($status) {
                return redirect()->route('cours.index')->with('success', 'cours modifiée avec succès');
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
        $feedback = Cours::find($id);
        if ($feedback) {
            $status = $feedback->delete();
            if ($status) {
                return redirect()->route('cours.index')->with('success', 'cours supprimé avec succès');
            } else {
                return back()->with('error', 'Something went wrong!');
            }
        } else {
            return back()->with('error', 'Data not found');
        }
    }
}
