<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Model\Relations\HasMany;

class Category extends Model
{
    protected $filliable = ['name'];

    public function books():HasMany{
        return $this->hasMany(Book::class);
    }
}
