<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['sender_id', 'receiver_id', 'content'];

    public function user(){
        return $this->belongsTo('App\User');
    }
}


