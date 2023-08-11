<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SuiviTier extends Model
{
    use HasFactory;

    public function tier()
    {
        return $this->belongsTo(Tier::class);
    }
}
