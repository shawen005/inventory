<?php

namespace App\Http\Controllers\api;

use App\Brand;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Access\Response;
use Illuminate\Http\Request;

class BrandControllers extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = \App\Brand::with('products')->orderBy('updated_at','desc')->get();
        return response()->json([
            'data' => $brands
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $name = $request->input('name');

        $brands = \App\Brand::create([ 'name' => $name]);
        return response()->json([
            'message' => 'brands ' .$name . 'has been created', 'data' => $brands
        ]);
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
        $data = \App\Brand::where('id' , $id)->first();
        return response()->json([
            'data' => $data
        ]);
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
        \App\Brand::where('id', $id)->update(
            [
                'name' => $request->input('name')
            ]
        );
        return response()->json([
            'message' => 'Tech Item ' . $request->input('name') . ' has updated'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = \App\Brand::where('id', $id)->first();
        $data->delete();
    }

    public function history(Request $brands)
    {
        return \App\Product::with('brand')->where('brand_id', $brands)->orderBy('updated_at', 'desc')->get();
    }
}
