<?php

namespace App\Http\Controllers;

use App\Base\ModelCollection as CustomCollection;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection as LaravelCollection;
use Illuminate\Routing\Controller;

class CollectionController extends Controller
{
    public function collection()
    {
        $query = User::query()
            ->where('id', '>', 100);
        \PHPStan\dumpType($query);
        $query->chunk(1000, function(LaravelCollection $users) {
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

    public function collection2()
    {
        $posts = Post::query()->get();
        \PHPStan\dumpType($posts);

        $chunks = $posts->chunk(10);
        \PHPStan\dumpType($chunks);

        foreach ($chunks as $chunk) {
            \PHPStan\dumpType($chunk);
            var_dump($chunk->modelKeys());
        }
    }

}
