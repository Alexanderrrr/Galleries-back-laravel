<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gallery;

class AuthorGalleriesController extends Controller
{
    public function index(Request $request, $id){

      $term = $request->query('term');
      
      if ($term) {
        return Gallery::search($term)
        ->where('user_id' , '=' , $id)
        ->with([
          'images' => function($query){
            $query->latest();
          },
          'user'
        ])->latest()->paginate(10);
      }
      return Gallery::where('user_id' , '=' , $id)
          ->with(['images','user'])
          ->latest()
          ->paginate(10);
    }


}
