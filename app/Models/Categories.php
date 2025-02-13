<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    protected $table    = 'categories';
    protected $guarded  = [];

    public function articles()
    {
        return $this->hasMany(Article::class, "id");
    }
}
