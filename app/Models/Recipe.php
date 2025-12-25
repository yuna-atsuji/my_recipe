<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    # $recipe->user とかが使えるようになるfunction
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    
}
