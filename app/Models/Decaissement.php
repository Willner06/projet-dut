<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Motif;
use Illuminate\Database\Eloquent\SoftDeletes;

class Decaissement extends Model
{
    use HasFactory;

    public function motif()
    {
        return $this->hasOne(Motif::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function compte()
    {
        return $this->belongsTo(Compte::class);
    }

    public function employes()
    {
        return $this->belongsToMany(Employe::class);
    }
}
