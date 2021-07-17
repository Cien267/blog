<?php

namespace App\Services;

use App\Exceptions\UserException;
use App\User;

class UserService
{

    public function search($id)
    {
        $data = User::where('name', 'like', '%'. $id . '%')->get();
        if (count($data) <= 0) {
            throw new UserException();
        }

        return $data;
    }
}
