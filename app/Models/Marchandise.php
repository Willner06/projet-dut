<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Marchandise extends Model
{
    use HasFactory;

    public function categorie()
    {
        return $this->belongsTo(CategorieMarchandise::class);
    }

    public function entres()
    {
        return $this->hasMany(EntreMarchandise::class, 'marchandise_id');
    }


    public function sorties()
    {
        return $this->hasMany(SortieMarchandise::class, 'marchandise_id');
    }

    public function stock()
    {
        return $this->hasOne(StockMarchandise::class, 'marchandise_id');
    }
}
