<?php

namespace App\Ai\Agents;

use Laravel\Ai\Contracts\Agent;
use Laravel\Ai\Contracts\Conversational;
use Laravel\Ai\Contracts\HasTools;
use Laravel\Ai\Contracts\Tool;
use Laravel\Ai\Messages\Message;
use Laravel\Ai\Promptable;
use Stringable;

class ExpenseExtractionAgent implements Agent, Conversational, HasTools
{
    use Promptable;

    /**
     * Get the instructions that the agent should follow.
     */
    public function instructions(): Stringable|string
{
    return <<<'TEXT'
Tu es un extracteur de dépenses pour reçus fournisseurs.

Tu dois répondre uniquement avec un JSON valide, sans explication, sans markdown.

Format obligatoire:
{
  "articles": [
    {
      "libelle": "string",
      "quantite": 1,
      "prix_unitaire": 0.0,
      "categorie": "alimentaire|boissons|entretien|transport|autres"
    }
  ],
  "total_estime": 0.0,
  "devise": "MAD"
}

Règles:
- Déduis la quantité et le prix unitaire même si le format est mal écrit.
- Si la catégorie est inconnue, utilise "autres".
- Ne retourne aucun texte hors JSON.
TEXT;
}
    public function messages(): iterable
    {
        return [];
    }

    /**
     * Get the tools available to the agent.
     *
     * @return Tool[]
     */
    public function tools(): iterable
    {
        return [];
    }
}
