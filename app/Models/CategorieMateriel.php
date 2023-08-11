<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CategorieMateriel extends Model
{
    use HasFactory;

    public function materiels()
    {
        return $this->hasMany(Materiel::class, 'categorie_id');
    }
}
