<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cloture extends Model
{
    use HasFactory;
    protected $casts = [ 'date_controle'=>'date'];


    public function compte()
    {
        return $this->hasOne(Compte::class);
    }
}
