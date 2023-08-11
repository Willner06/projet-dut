<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StockMarchandise extends Model
{
    use HasFactory;

    public function marchandise()
    {
        return $this->belongsTo(marchandise::class);
    }
}
