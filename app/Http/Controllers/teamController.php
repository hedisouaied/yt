<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class teamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $team = Team::orderby('id', 'DESC')->get();

        return view('backend.team.index', compact('team'));
    }

    public function equipeStatus(Request $request)
    {
        if ($request->mode == 'true') {
            DB::table('teams')->where('id', $request->id)->update(['status' => 'active']);
        } else {
            DB::table('teams')->where('id', $request->id)->update(['status' => 'inactive']);
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
        return view('backend.team.create');
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
            'post' => 'string|required',
            'photo' => 'nullable|string',
            'email' => 'nullable|string',
            'phone' => 'nullable|string',
            'fb' => 'nullable|string',
            'status' => 'nullable|in:active,inactive',
        ]);
        $data = $request->all();
        $slug = Str::slug($request->input('title'));
        $slug_count = Team::where('slug', $slug)->count();
        if ($slug_count > 0) {
            $slug = time() . '_' . $slug;
        }
        $data['slug'] = $slug;
        $status = Team::create($data);
        if ($status) {
            return redirect()->route('equipe.index')->with('success', 'Membre crée avec succès');
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
        $team = Team::find($id);
        if ($team) {
            return view('backend.team.edit', compact('team'));
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
        $team = Team::find($id);
        if ($team) {

            $this->validate($request, [
                'title' => 'nullable|string',
                'post' => 'string|required',
                'photo' => 'nullable|string',
                'email' => 'nullable|string',
                'phone' => 'nullable|string',
                'fb' => 'nullable|string'
            ]);
            $data = $request->all();
            $status = $team->fill($data)->save();
            if ($status) {
                return redirect()->route('equipe.index')->with('success', 'Membre modifiée avec succès');
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
        $team = Team::find($id);
        if ($team) {
            $status = $team->delete();
            if ($status) {
                return redirect()->route('equipe.index')->with('success', 'Membre supprimée avec succès');
            } else {
                return back()->with('error', 'Something went wrong!');
            }
        } else {
            return back()->with('error', 'Data not found');
        }
    }
}
