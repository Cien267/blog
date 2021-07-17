<?php

namespace App\Exceptions;

use Exception;

class UserException extends Exception
{
    public function report()
    {
        \Log::debug('User not found');
    }

    public function render($request)
    {
        return response()->view('error');

    }
}
