<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Gallery;

class MyGalleriesController extends Controller
{
    public function show($id){
      return Gallery::where('user_id' , '=' , $id)->get();
    }
}
