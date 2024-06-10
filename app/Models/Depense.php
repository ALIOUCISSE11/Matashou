<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Depense extends Model
{
    use HasFactory;

    protected $fillable = ['nom_produit', 'quantité', 'prix_unitaire'];

    protected static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            $model->prix_total = $model->quantité * $model->prix_unitaire;
        });
    }
}
