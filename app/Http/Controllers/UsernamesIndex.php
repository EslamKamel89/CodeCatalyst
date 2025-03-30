<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UsernamesIndex extends Controller {

    public function __invoke(Request $request) {
        $usernames =   User::select('username')->get();
        $userArr = [];
        $usernames->each(
            function ($e) use (&$userArr) {
                $userArr[] = $e->username;
            }
        );
        return $userArr;
    }
}
