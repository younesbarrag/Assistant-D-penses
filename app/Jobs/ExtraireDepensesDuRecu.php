<?php

namespace App\Jobs;

use App\Ai\Agents\ExpenseExtractionAgent;
use App\Enums\StatutRecu;
use App\Models\Recu;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
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

            $this->recu->update([
                'payload_ia' => [
                    'raw' => $response->text,
                ],
                'statut' => StatutRecu::TRAITE,
            ]);

            logger()->info("Réponse IA enregistrée pour le reçu #{$this->recu->id}");
        } catch (Throwable $e) {
            $this->recu->update([
                'statut' => StatutRecu::ERREUR,
                'message_erreur' => $e->getMessage(),
            ]);

            logger()->error("Échec de l'extraction pour le reçu #{$this->recu->id}: " . $e->getMessage());
        }
    }
}