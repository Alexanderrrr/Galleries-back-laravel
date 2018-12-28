<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    protected $fillable = [
      'name', 'description', 'user_id'
    ];

    public function images(){
      return $this->hasMany(Image::class);
    }

    public function user(){
      return $this->belongsTo(User::class);
    }

    public function comments(){
      return $this->hasMany(Comment::class);
    }

    public static function search($term){
      $galleries = Gallery::where('name', 'like', '%'.$term.'%')->paginate(10);
      return $galleries;

    }
}
