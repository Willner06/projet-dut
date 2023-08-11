<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Materiel extends Model
{
    use HasFactory;
    // protected $dates = ['date_acquisition','date_session','date_mise_au_rebut'];
    // protected $casts = [ 'date_acquisition'=>'date'];

    protected $fillable = [
        'code_inventaire',
        'designation',
        'date_acquisition',
        'prix_achat',
        'autres_frais',
        'cout_acquisitionTtc',
        'tva',
        'etat',
        'fournisseur',
        'qr_code',
        'base_ammortisable',
        'mode_ammortissement',
        'duree_ammortissement',
        'date_mise_au_rebut',
        'date_session',
        'valeur_net_comptable',
        'prix_vente_valeur_reprise',
        'plus_value_globale',
        'dont_court_terme',
        'dont_long_terme',
        'categorie_id'
    ];

    public function categorie()
    {
        return $this->belongsTo(CategorieMateriel::class);
    }
}
