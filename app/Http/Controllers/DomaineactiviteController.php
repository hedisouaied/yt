<?php

namespace App\Http\Controllers;

use App\Models\Domaineactivite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DomaineactiviteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $feedback = Domaineactivite::orderby('id', 'DESC')->get();

        return view('backend.domaineactivite.index', compact('feedback'));
    }


    public function activityStatus(Request $request)
    {
        if ($request->mode == 'true') {
            DB::table('domaineactivites')->where('id', $request->id)->update(['status' => 'active']);
        } else {
            DB::table('domaineactivites')->where('id', $request->id)->update(['status' => 'inactive']);
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
        return view('backend.domaineactivite.create');
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
            'status' => 'nullable|in:active,inactive',
        ]);



        $data = $request->all();
        $slug = Str::slug($request->input('title'));
        $slug_count = Domaineactivite::where('slug', $slug)->count();
        if ($slug_count > 0) {
            $slug = time() . '_' . $slug;
        }
        $data['slug'] = $slug;
        $data['missions'] = implode(',',$request->missions_competences);

        $status = Domaineactivite::create($data);
        if ($status) {
            return redirect()->route('activity.index')->with('success', 'Domaine d\'activité crée avec succès');
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
        $feedback = Domaineactivite::find($id);
        if ($feedback) {
            return view('backend.domaineactivite.edit', compact('feedback'));
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
        $feedback = Domaineactivite::find($id);
        if ($feedback) {

            $this->validate($request, [
                'title' => 'nullable|string',
                'description' => 'string|required',
            ]);
            $data = $request->all();
            $data['missions'] = implode(',',$request->missions_competences);
            $status = $feedback->fill($data)->save();
            if ($status) {
                return redirect()->route('activity.index')->with('success', 'Domaine d\'activité modifiée avec succès');
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
        $feedback = Domaineactivite::find($id);
        if ($feedback) {
            $status = $feedback->delete();
            if ($status) {
                return redirect()->route('activity.index')->with('success', 'Domaine d\'activité supprimé avec succès');
            } else {
                return back()->with('error', 'Something went wrong!');
            }
        } else {
            return back()->with('error', 'Data not found');
        }
    }
}
