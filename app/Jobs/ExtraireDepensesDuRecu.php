<?php

namespace App\Jobs;

use App\Enums\CategorieDepense;
use App\Enums\StatutRecu;
use App\Models\Recu;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;


class ExtraireDepensesDuRecu implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public Recu $recu
    ) {}

    public function handle(): void
    {
        $this->recu->depenses()->createMany([
            [
                'libelle' => 'Coca Cola',
                'quantite' => 12,
                'prix_unitaire' => 4.00,
                'categorie' => CategorieDepense::BOISSONS,
            ],
            [
                'libelle' => 'Javel',
                'quantite' => 2,
                'prix_unitaire' => 18.00,
                'categorie' => CategorieDepense::ENTRETIEN,
            ],
            [
                'libelle' => 'Lait Centrale',
                'quantite' => 6,
                'prix_unitaire' => 8.50,
               'categorie' => CategorieDepense::ALIMENTAIRE,
            ],
        ]);

        $this->recu->update([
            'statut' => StatutRecu::TRAITE,
            'total_estime' => 135.00,
            'devise' => 'MAD',
        ]);
    }
}