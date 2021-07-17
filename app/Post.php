<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    protected $table = 'posts';
    protected $primaryKey = 'post_id';
    protected $fillable = ['user_id', 'post_title', 'post_content'];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function comments(){
        return $this->hasMany('App\Comment', 'post_id');
    }

    public function tags(){
        return $this->belongsToMany('App\Tag', 'post_tag', 'post_id',  'tag_id');
    }
}
