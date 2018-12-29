<?php

namespace App\Http\Controllers;
use App\Comment;

use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function store(Request $request, $content){

      $userId = auth()->user()->id;

      $comment = Comment::create([
        'content' => $request->content,
        'user_id' => $userId,
        'gallery_id' => $request->id

      ]);

      return $comment;
    }

    public function destroy($id)
    {
      $comment = Comment::find($id);
       $comment->delete();
       return response()->json([
           'message' => 'Comment deleted'
       ]);
    }
}
