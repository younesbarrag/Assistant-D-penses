# Proposal: Extraction Intelligente de Reçus

## Summary
Permettre aux utilisateurs de soumettre du texte brut de reçus pour une extraction automatique et intelligente des dépenses en utilisant Laravel 13, le SDK Laravel AI et Groq.

## Motivation
Saisir manuellement chaque dépense est fastidieux. L'utilisation de l'IA permet de transformer un texte brut (ex: "coca 12 x 4dh") en enregistrements structurés en base de données de manière asynchrone.

## Proposed Changes
1.  **Modèles & Migrations**: Création des tables `recus` et `depenses`.
2.  **Enums**: `StatutRecu` (`en_attente`, `traite`, `echoue`) et `CategorieDepense`.
3.  **Controller**: `RecuController` pour gérer la soumission via `StoreRecuRequest`.
4.  **Job Asynchrone**: `ExtraireDepensesDuRecu` pour traiter le texte via le SDK Laravel AI + Groq.
5.  **Interface**: Vues Blade pour soumettre et visualiser les résultats extraits.

## Expected Outcome
L'utilisateur soumet un texte, le reçu passe en statut `en_attente`, et après traitement asynchrone, les dépenses sont créées et le statut passe à `traite`.
