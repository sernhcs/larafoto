<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = 'images';
    //relación one to many
    public function comments(){
        return $this->hasMany('App\Comment')->OrderBy('id','desc');
    }
    //Relación One t many likes
    public function likes(){
        return $this->hasMany('App\Like');
    }
    //Relación many to one images
    public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }
}
