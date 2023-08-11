<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MaterielIntermediaire extends Model
{
    use HasFactory;

    public function entres()
    {
        return $this->hasMany(EntreMateriel::class, 'materiel_id');
    }


    public function sorties()
    {
        return $this->hasMany(EntreMateriel::class, 'materiel_id');
    }
}
