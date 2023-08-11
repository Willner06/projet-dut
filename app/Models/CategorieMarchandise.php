<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategorieMarchandise extends Model
{
    use HasFactory;

    public function marchandises()
    {
        return $this->hasMany(Marchandise::class, 'categorie_id');
    }
}
