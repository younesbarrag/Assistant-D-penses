# Expense Extraction

## ADDED Requirements

### Requirement: Extract structured expenses

The system SHALL transform valid AI structured output into typed `Depense` records.

#### Scenario: Categorized expense item

Given AI structured output containing an article with libelle "coca", quantite 12, prix_unitaire 4.00, and categorie "boissons"
When the extraction result is persisted
Then the system SHALL create a `Depense` record linked to the `Recu`
And the `Depense` libelle SHALL be "coca"
And the `Depense` quantite SHALL be 12
And the `Depense` prix_unitaire SHALL be 4.00
And the `Depense` categorie SHALL be "boissons"

#### Scenario: Receipt total estimation

Given multiple `Depense` records are created from a receipt
When extraction is completed
Then the `Recu` total_estime SHALL equal the sum of each `Depense` quantite multiplied by prix_unitaire
And the `Recu` devise SHALL be "MAD"
