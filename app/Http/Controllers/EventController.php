<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $feedback = Event::orderby('id', 'DESC')->get();

        return view('backend.event.index', compact('feedback'));
    }
    public function eventStatus(Request $request)
    {
        if ($request->mode == 'true') {
            DB::table('events')->where('id', $request->id)->update(['status' => 'active']);
        } else {
            DB::table('events')->where('id', $request->id)->update(['status' => 'inactive']);
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
        return view('backend.event.create');
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
            'pays' => 'nullable|string',
            'date_debut' => 'date|string',
            'date_fin' => 'date|string',
            'status' => 'nullable|in:active,inactive',
        ]);



        $data = $request->all();
        $slug = Str::slug($request->input('title'));
        $slug_count = Event::where('slug', $slug)->count();
        if ($slug_count > 0) {
            $slug = time() . '_' . $slug;
        }
        $data['slug'] = $slug;

        $status = Event::create($data);
        if ($status) {
            return redirect()->route('event.index')->with('success', 'Evénement crée avec succès');
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
        $feedback = Event::find($id);
        if ($feedback) {
            return view('backend.event.edit', compact('feedback'));
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
        $feedback = Event::find($id);
        if ($feedback) {

            $this->validate($request, [
                'title' => 'nullable|string',
                'pays' => 'nullable|string',
                'date_debut' => 'date|string',
                'date_fin' => 'date|string',
            ]);
            $data = $request->all();

            $status = $feedback->fill($data)->save();

            if ($status) {
                return redirect()->route('event.index')->with('success', 'Evénement modifiée avec succès');
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
        $feedback = Event::find($id);
        if ($feedback) {
            $status = $feedback->delete();
            if ($status) {
                return redirect()->route('event.index')->with('success', 'Evénement supprimé avec succès');
            } else {
                return back()->with('error', 'Something went wrong!');
            }
        } else {
            return back()->with('error', 'Data not found');
        }
    }
}
