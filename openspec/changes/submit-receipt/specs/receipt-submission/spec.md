# Receipt Submission

## ADDED Requirements

### Requirement: Submit receipt text

The system SHALL allow an authenticated user to submit raw receipt text and start asynchronous extraction.

#### Scenario: Successful receipt submission

Given an authenticated user
When the user submits a valid receipt text to `/recus`
Then the system SHALL create a `Recu` record
And the `Recu` status SHALL be `en_attente`
And the system SHALL dispatch the `ExtraireDepensesDuRecu` job
And the user SHALL be redirected to the receipt details page with a success message

#### Scenario: Validation failure

Given an authenticated user
When the user submits an empty receipt text to `/recus`
Then the system SHALL redirect the user with validation errors
And no `Recu` record SHALL be created
