<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Routing\Controller;

/**
 * @template T1 of Model
 * @template T2 of Model
 * @template T3 of Model
 */
class Thing {

    /**
     * @var T2
     */
    protected Model $t2;

    /**
     * @var T3
     */
    protected Model $t3;

    /**
     * @return array<int, T1>
     */
    public function getT1() : array {
        return [];
    }

    /**
     * @param T2 $model
     */
    public function setT2(Model $model) : void {
        $this->t2 = $model;
    }

    /**
     * @return T2
     */
    public function getT2() : Model {
        return $this->t2;
    }

    /**
     * @return T3
     */
    public function getT3() : mixed {
        return $this->t3;
    }

}

class GenericsController extends Controller
{
    public function generics3() : void
    {
        // $user = User::first();
        // $post = Post::first();

        $thing = new Thing();
        $thing->getT2()->update();
        $thing->getT3()->update();
    }

}
