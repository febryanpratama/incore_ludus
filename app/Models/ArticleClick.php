<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleClick extends Model
{
    use HasFactory;
    protected $table    = 'article_clicks';
    protected $guarded  = [];

    public function category()
    {
        return $this->belongsTo(Categories::class, "category_id");
    }
}
