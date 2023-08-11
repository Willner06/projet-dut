<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Motif;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reglement extends Model
{
    use HasFactory;

    public function motif()
    {
        return $this->belongsTo(Motif::class);
    }
}
