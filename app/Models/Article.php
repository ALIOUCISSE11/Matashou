<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'image',
        'category_id',
        'content',
    ];

    // Relation avec la catégorie
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
