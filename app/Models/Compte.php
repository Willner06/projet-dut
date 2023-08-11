<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Compte extends Model
{
    use HasFactory;

    public function cloture()
    {
        return $this->belongsTo(Cloture::class);
    }

    public function decaissements()
    {
        return $this->hasMany(Decaissement::class);
    }

    public function encaissements()
    {
        return $this->hasMany(Encaissement::class);
    }
}
