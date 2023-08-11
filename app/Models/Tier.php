<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tier extends Model
{
    use HasFactory;


    public function suivitiers()
    {
        return $this->hasMany(SuiviTier::class, 'tiers_id');
    }
}
