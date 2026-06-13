<?php

namespace App\Jobs;

use App\Ai\Agents\ExpenseExtractionAgent;
use App\Enums\StatutRecu;
use App\Models\Recu;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\DB;
use Throwable;

class ExtraireDepensesDuRecu implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public Recu $recu
    ) {}

    public function handle(ExpenseExtractionAgent $agent): void
    {
        try {
            $response = $agent->prompt(
                prompt: $this->recu->texte_source,
                provider: 'groq',
                model: 'llama-3.3-70b-versatile'
            );

            $data = json_decode($response->text, true);

            if (json_last_error() !== JSON_ERROR_NONE) {
                throw new \Exception("JSON invalide reçu de l'IA.");
            }

            if (!isset($data['articles']) || !is_array($data['articles']) || !isset($data['total_estime']) || !isset($data['devise'])) {
                throw new \Exception("Données manquantes dans la réponse IA (articles, total_estime ou devise).");
            }

            DB::transaction(function () use ($data) {
                // Nettoyage des anciennes dépenses pour éviter les doublons
                $this->recu->depenses()->delete();

                // Création des dépenses extraites
                foreach ($data['articles'] as $article) {
                    $this->recu->depenses()->create([
                        'libelle'       => $article['libelle'] ?? 'Inconnu',
                        'quantite'      => $article['quantite'] ?? 1,
                        'prix_unitaire' => $article['prix_unitaire'] ?? 0,
                        'categorie'     => $article['categorie'] ?? null,
                    ]);
                }

                // Mise à jour finale du reçu
                $this->recu->update([
                    'payload_ia'     => $data,
                    'statut'         => StatutRecu::TRAITE,
                    'total_estime'   => $data['total_estime'],
                    'devise'         => $data['devise'] ?: 'MAD',
                    'message_erreur' => null,
                ]);
            });

            logger()->info("Extraction complétée avec succès pour le reçu #{$this->recu->id}");
        } catch (Throwable $e) {
            $this->recu->update([
                'statut'         => StatutRecu::ERREUR,
                'message_erreur' => $e->getMessage(),
            ]);

            logger()->error("Échec de l'extraction pour le reçu #{$this->recu->id}: " . $e->getMessage());
        }
    }
}
