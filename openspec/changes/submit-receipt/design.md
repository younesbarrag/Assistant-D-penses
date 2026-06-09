# Design: Submit Receipt & AI Extraction

## Architecture
Le système suit une architecture Laravel 13 standard enrichie par un traitement asynchrone pour l'intégration de l'IA.

- **Couche Stockage**: Modèles Eloquent avec typage strict et Enums pour la gestion d'état.
- **Couche Validation**: Form Request (`StoreRecuRequest`) pour la validation de l'entrée du texte brut.
- **Couche Traitement**: Laravel Queue gère l'interaction avec le SDK AI via le Job `ExtraireDepensesDuRecu`.
- **Intégration IA**: SDK Laravel AI utilisant l'adaptateur Groq pour un traitement LLM haute performance.

## Composants
- `RecuController`: Gère le cycle de vie HTTP pour la soumission des reçus.
- `ExtraireDepensesDuRecu`: Unité de travail autonome pour l'extraction par l'IA.
- Modèle `Recu`: Entité principale pour le suivi de l'état de soumission.
- Modèle `Depense`: Détail des articles extraits.
- `StatutRecu`: PHP Enum pour `en_attente`, `traite`, `echoue`.
- `CategorieDepense`: PHP Enum pour la catégorisation des articles.

## Responsabilités
- **Utilisateur**: Fournit le texte brut et consulte les résultats.
- **Controller**: Valide l'entrée, crée l'enregistrement `Recu` initial, et dépêche le Job.
- **Job**: Communique avec Groq via le SDK AI, analyse le JSON structuré, et crée les enregistrements `Depense`.
- **Policies**: Garantit que les utilisateurs n'accèdent qu'à leurs propres reçus et dépenses.

## Flux de Données
1. **POST /recus**: L'utilisateur soumet le texte brut.
2. **Validation**: `StoreRecuRequest` vérifie la présence du texte.
3. **Persistance**: `Recu` créé avec le statut `en_attente`.
4. **File d'attente**: `ExtraireDepensesDuRecu` est dispatché avec l'ID du `Recu`.
5. **Extraction IA**: Le Job appelle `Ai::generate()` avec un schéma structuré.
6. **Persistance**: Le Job crée les enregistrements `Depense` dans une transaction.
7. **Finalisation**: Le statut du `Recu` passe à `traite`.

## Gestion des Erreurs
- **Erreurs de Validation**: Réponse 422 standard Laravel.
- **Échecs IA**: Tentatives de réexécution du Job (3 fois). En cas d'échec final, le statut du `Recu` passe à `echoue`.
- **Erreurs d'Analyse**: Si la sortie de l'IA ne correspond pas au contrat, le job log l'erreur et marque le reçu comme échoué.

## Sécurité
- **Authentification**: Requise pour toutes les actions liées aux reçus (Laravel Breeze).
- **Autorisation**: `RecuPolicy` et `DepensePolicy` appliquent la propriété via les clés étrangères `user_id`.
- **Assainissement**: Le texte brut est traité comme non fiable; le SDK AI gère la sécurité des prompts.

## Considérations de Performance
- **Asynchronisme**: Tous les appels IA sont déportés vers des workers en arrière-plan.
- **Base de données**: Eager loading (`with(['depenses'])`) utilisé pour éviter les problèmes N+1.
- **Indexation**: Index sur les colonnes `user_id` et `status`.
