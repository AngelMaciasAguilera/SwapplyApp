<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sale extends Model
{
    const EXCERPT_LENGTH = 100;
    protected $table = 'sales';

    protected $fillable = [
        'category_id',
        'user_id',
        'product',
        'description',
        'price',
        'isSold',
        'img'
    ];


    /**
     * Get the user that owns the Sale
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the category that owns the Sale
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get the images for the sale.
     */
    public function images(): HasMany
    {
        return $this->hasMany(Image::class);
    }
}
