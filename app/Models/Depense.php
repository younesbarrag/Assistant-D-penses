<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Enums\CategorieDepense;


class Depense extends Model
{
    protected $fillable = [
        'recu_id',
        'libelle',
        'quantite',
        'prix_unitaire',
        'categorie',
    ];
    protected $casts = [
        'categorie' => CategorieDepense::class,
    ];

    public function recu() : Belongsto
    {
        return $this ->belongsToMany(Recu::class);
    }
}
