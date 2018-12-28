<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class AuthorController extends Controller
{
    public function show($id){
      return User::with(['galleries'])->find($id);
    }
}
