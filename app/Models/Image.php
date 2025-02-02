<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    protected $table = "images";
    protected $fillable = [
        'sale_id',
        'ruta',
    ];

    /**
     * Get the sale that owns the Image
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function sale(): BelongsTo
    {
        return $this->belongsTo(Sale::class);
    }

    /**
     * Event to unset the url of the img in the storage
     */
    protected static function booted()
    {
        static::deleted(function ($image) {
            // Eliminar el archivo de la carpeta de almacenamiento
            if (Storage::exists($image->ruta)) {
                Storage::delete($image->ruta);
            }
        });
    }

}
