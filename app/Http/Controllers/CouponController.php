<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banners = Coupon::orderby('id', 'DESC')->get();

        return view('backend.coupon.index', compact('banners'));
    }

    public function couponStatus(Request $request)
    {
        if ($request->mode == 'true') {
            DB::table('coupons')->where('id', $request->id)->update(['status' => 'active']);
        } else {
            DB::table('coupons')->where('id', $request->id)->update(['status' => 'inactive']);
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
        return view('backend.coupon.create');
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
            'code_coupon' => 'string|required|unique:coupons,code_coupon',
            'expiration' => 'date|required',
            'discount' => 'numeric|required',
            'status' => 'nullable|in:active,inactive',
        ]);

        $data = $request->all();



        // return $data;

        $status = Coupon::create($data);
        if ($status) {
            return redirect()->route('coupon.index')->with('success', 'successfully created coupon');
        } else {
            return back()->with('error', 'something went wrong!');
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $banner = Coupon::find($id);
        if ($banner) {
            $status = $banner->delete();
            if ($status) {
                return redirect()->route('coupon.index')->with('success', 'Coupon code successfuly deleted');
            } else {
                return back()->with('error', 'Something went wrong!');
            }
        } else {
            return back()->with('error', 'Data not found');
        }
    }
}
