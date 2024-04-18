<?php

namespace App\Http\Controllers;

use App\Base\ModelCollection as CustomCollection;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Routing\Controller;

class MapController extends Controller
{
    public function withEloquentCollection()
    {
        $models = Post::query()->get();
        \PHPStan\dumpType($models);
        $users = $models->map(function(Post $model) : User {
            return $model->created_by_user;
        });
        \PHPStan\dumpType($users);
    }

    public function withCustomCollection()
    {
        $models = User::query()->get();
        \PHPStan\dumpType($models);
        $users = $models->map(function(User $model) : User {
            return $model->created_by_user;
        });
        \PHPStan\dumpType($users);
    }

}
