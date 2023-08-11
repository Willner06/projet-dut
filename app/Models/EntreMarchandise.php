<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EntreMarchandise extends Model
{
    use HasFactory;
    protected $dates = [
        'date_achat',
    ];

    public function marchandise()
    {
        return $this->belongsTo(Marchandise::class);
    }
}
