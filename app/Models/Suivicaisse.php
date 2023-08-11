<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Suivicaisse extends Model
{
    use HasFactory;

    public function billets()
    {
        return $this->hasOne(Billet::class);
    }

    public function Pieces()
    {
        return $this->hasOne(Piece::class);
    }



}
