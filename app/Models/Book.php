<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    /**
     * Convert price_huf to EUR using the given rate.
     */
    protected $fillable = [
        'title',
        'author_id',
        'category_id',
        'release_date',
        'price_huf'
    ];

    public function author()
    {
        return $this->belongsTo(Author::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

        public function getPriceEur($eurRate)
    {
        if ($eurRate && $this->price_huf !== null) {
            return round($this->price_huf * $eurRate, 2);
        }
        return null;
    }
}
