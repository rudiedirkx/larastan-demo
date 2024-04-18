<?php

namespace App\Models;

use App\Base\ModelCollection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{

    public function created_by_user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
