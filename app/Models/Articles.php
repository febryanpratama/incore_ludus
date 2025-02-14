<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Articles extends Model
{
    protected $table    = 'artikels';
    protected $guarded  = ['id'];

    public function category()
    {
        return $this->belongsTo(Category::class, "category_id");
    }

}
