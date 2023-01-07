<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class ImageController extends BaseController
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
        if($request->o_type == 'user'){
            $user = User::find($request->o_id);
            if ($user) {
                $image = Image::create([
                    'path' => $request->path,
                    'description' => $request->description,
                    'o_id' => $request->o_id,
                    'o_type' => 'user',
                ]);
                return $this->sendResponse($image, "success");      
            }
            return $this->sendError("the user not found!", "error");      
        }
        if($request->o_type == 'product') {
            $product = Product::find($request->o_id);
            if ($product) {
               $image = Image::create([
                    'path' => $request->path,
                    'description' => $request->description,
                    'o_id' => $request->o_id,
                    'o_type' => 'product',
                ]);
                return $this->sendResponse($image, "success");      
            }
            return $this->sendError("the product not found!", "error");      
        }

        return $this->sendError("error", "error");      
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function show(Image $image)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function edit(Image $image)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Image $image)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function destroy(Image $image)
    {
        //
    }
}
