<?php

namespace App\Services;

use App\Post;
use App\User;
use App\Exceptions\UserException;

class UserService
{

    public function search($keysearch)
    {
        $data = Post::where('post_title', 'like', '%'. $keysearch . '%')->with('user')->get();
        if (count($data) <= 0) {
            throw new UserException();
        }

        return $data;
    }
}
