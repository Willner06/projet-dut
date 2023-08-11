<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Decaissement;
use App\Models\Reglement;
use Illuminate\Database\Eloquent\SoftDeletes;

class Motif extends Model
{
    use HasFactory;

    public function decaissement()
    {
        return $this->belongsTo(Decaissement::class);
    }

    public function reglement()
    {
        return $this->hasOne(Reglement::class);
    }
}
