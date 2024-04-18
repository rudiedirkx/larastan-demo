<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Routing\Controller;

class MigrationController extends Controller
{
    public function migration()
    {
        $user = User::find(123);

        var_dump($user->email); // exists
        // var_dump($user->name); // old
        var_dump($user->fullname); // new
    }

}
