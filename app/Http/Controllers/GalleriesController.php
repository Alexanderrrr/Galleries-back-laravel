<?php

namespace App\Http\Controllers;

use App\Gallery;
use App\Image;
use Illuminate\Http\Request;
use App\Http\Requests\GalleryRequest;

class GalleriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Gallery::latest()->paginate(10);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $gallery = Gallery::create([
          "name" => $request->name,
          "description" => $request->description,
          "user_id" => $request->user_id
        ]);
        $imagesRequest = $request->input('images');
        $images = [];

        foreach($imagesRequest as $image){
          $newImage = new Image($image);
          $images[] = $newImage;
        }
        $gallery->images()->saveMany($images);
        return $gallery;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function show(Gallery $gallery)
    {
        return $gallery;
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Gallery $gallery)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gallery $gallery)
    {
        $gallery->delete();
        return $gallery;

    }
}
