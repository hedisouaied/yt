<?php

namespace App\Http\Controllers;

use App\Models\SolideEx;
use Illuminate\Http\Request;

class SolideExController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.solide.create');
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
            'title' => 'nullable|string'
        ]);
        $data = $request->all();
        $status = SolideEx::create($data);
        if ($status) {
            return redirect()->route('about.index')->with('success', 'Solide expertise crée avec succès');
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
        $mission = SolideEx::find($id);
        if ($mission) {
            return view('backend.solide.edit', compact('mission'));
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
        $mission = SolideEx::find($id);
        if ($mission) {

            $this->validate($request, [
                'title' => 'nullable|string'
            ]);
            $data = $request->all();
            $status = $mission->fill($data)->save();
            if ($status) {
                return redirect()->route('about.index')->with('success', 'Solide expertise modifiée avec succès');
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
        $mission = SolideEx::find($id);
        if ($mission) {
            $status = $mission->delete();
            if ($status) {
                return redirect()->route('about.index')->with('success', 'Solide expertise supprimée avec succès');
            } else {
                return back()->with('error', 'Something went wrong!');
            }
        } else {
            return back()->with('error', 'Data not found');
        }
    }
}
