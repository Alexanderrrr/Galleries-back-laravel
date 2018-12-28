<?php

namespace App\Http\Controllers;

use App\Gallery;
use App\Image;
use Illuminate\Http\Request;
use App\Http\Requests\GalleryRequest;
use Illuminate\Support\Facades\Auth;

class GalleriesController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth:api', ['except' => ['index', 'show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $byName = $request->input('term');
        if (!empty($byName)) {
            return Gallery::search($byName);
        }

        return Gallery::with([
          'images' => function($query){
            $query->latest();
          },
          'user'
        ])
        ->latest()->paginate(10);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(GalleryRequest $request)
    {
        $gallery = Gallery::create([
          "name" => $request->name,
          "description" => $request->description,
          "user_id" => Auth::user()->id
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
    public function show($id)
    {
        $gallery = Gallery::with(['user', 'images'])->find($id);
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
