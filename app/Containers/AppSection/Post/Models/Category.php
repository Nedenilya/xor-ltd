<?php

namespace App\Containers\AppSection\Post\Models;

use App\Ship\Parents\Models\Model as ParentModel;
use Illuminate\Database\Eloquent\Relations\HasMany;

final class Category extends ParentModel
{
    protected $fillable = [
        'name',
    ];

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }
} 