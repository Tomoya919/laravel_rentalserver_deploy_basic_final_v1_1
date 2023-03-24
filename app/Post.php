<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Post;

class Post extends Model
{
    protected $fillable = ['user_id', 'comment',];
    
    public function user(){
      return $this->belongsTo('App\User');
    }
  
    public function comments(){
      return $this->hasMany('App\Comment');
    }
}