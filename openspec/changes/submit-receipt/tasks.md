# Tasks: Submit Receipt & AI Extraction

## Phase 1: Database & Models
- [ ] Créer la migration pour la table `recus` (`user_id`, `texte_brut`, `status`, `total_estime`, `devise`)
- [ ] Créer la migration pour la table `depenses` (`recu_id`, `libelle`, `quantite`, `prix_unitaire`, `categorie`)
- [ ] Créer l'Enum `StatutRecu` (`en_attente`, `traite`, `echoue`)
- [ ] Créer l'Enum `CategorieDepense` (`alimentaire`, `boissons`, `hygiene`, `entretien`, `autre`)
- [ ] Configurer le modèle `Recu` (Relations, Casts pour l'Enum)
- [ ] Configurer le modèle `Depense` (Relations, Casts pour l'Enum)

## Phase 2: Logique & Intégration
- [ ] Installer et configurer le SDK Laravel AI
- [ ] Configurer les identifiants de l'API Groq dans le `.env`
- [ ] Créer `StoreRecuRequest` pour la validation de l'entrée
- [ ] Créer le Job `ExtraireDepensesDuRecu` avec la logique du SDK AI
- [ ] Implémenter `RecuController@store` pour gérer la soumission et le dispatch
- [ ] Implémenter `RecuController@show` avec eager loading des dépenses

## Phase 3: Auth & Sécurité
- [ ] Créer `RecuPolicy` pour autoriser `view` et `create`
- [ ] Enregistrer la Policy dans `AppServiceProvider`
- [ ] Ajouter le middleware `auth` aux routes des reçus

## Phase 4: UI & Routes
- [ ] Définir les routes dans `routes/web.php`
- [ ] Créer la vue Blade pour le formulaire de soumission de reçu
- [ ] Créer la vue Blade pour les détails du reçu (affichage du statut et des dépenses extraites)
- [ ] Ajouter une vue liste "Mes Reçus"

## Phase 5: Tests & Validation
- [ ] Créer `Feature/ReceiptSubmissionTest` (valide le controller et le dispatch du job)
- [ ] Créer `Unit/ExtraireDepensesDuRecuTest` (mock du SDK AI et validation des mises à jour DB)
- [ ] Vérifier Zero N+1 sur la liste des reçus via Laravel Telescope ou Clockwork
- [ ] Effectuer un test de bout en bout avec un appel réel à l'API Groq
