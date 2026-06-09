# Async AI Processing

## ADDED Requirements

### Requirement: Process receipt text asynchronously

The system SHALL process raw receipt text in the background using a queue job and Laravel AI SDK with Groq.

#### Scenario: Successful AI extraction

Given a `Recu` record with status `en_attente`
When the `ExtraireDepensesDuRecu` job runs
Then the job SHALL call Laravel AI SDK using Groq
And the job SHALL receive structured output matching the defined contract
And the job SHALL create related `Depense` records
And the job SHALL update the `Recu` status to `traite`

#### Scenario: AI API failure

Given a `Recu` record with status `en_attente`
When the `ExtraireDepensesDuRecu` job fails after all attempts
Then the system SHALL update the `Recu` status to `echoue`
And the system SHALL store or log the failure reason for debugging
