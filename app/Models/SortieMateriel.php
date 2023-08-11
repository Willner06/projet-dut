<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SortieMateriel extends Model
{
    use HasFactory;

    public function intermediaire()
    {
        return $this->belongsTo(MaterielIntermediaire::class);
    }
}
