<?php

namespace App\Http\Controllers;

use App\Base\ModelCollection as CustomCollection;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection as LaravelCollection;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function migration()
    {
        $user = User::find(123);

        var_dump($user->email); // exists
        // var_dump($user->name); // old
        var_dump($user->fullname); // new
    }

    public function collection()
    {
        $query = User::query()
            ->where('id', '>', 100);
        $query->chunk(1000, function(CustomCollection $users) {
            \PHPStan\dumpType($users);
            foreach ($users as $user) {
                var_dump($user->fullname);
            }
        });

        $users = $query->get();
        \PHPStan\dumpType($users);
        foreach ($users as $user) {
            \PHPStan\dumpType($user);
            var_dump($user->fullname);
        }
    }
}
