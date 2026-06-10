<?php

namespace App\Models;

use App\Enums\StatutRecu;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Recu extends Model
{
    protected $fillable = [
        'user_id',
        'texte_source',
        'statut',
        'payload_ia',
        'total_estime',
        'devise',
        'message_erreur',
    ];

    protected $casts = [
        'statut' => StatutRecu::class,
        'payload_ia' => 'array',

    ];

    public function user() : Belongsto
    {
         return $this ->belongsto(User::class);
    }

    public function depenses() : Hasmany
    {
        return $this ->hasmany(Depense::class);
    }
}
