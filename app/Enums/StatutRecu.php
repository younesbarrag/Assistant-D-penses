<?php

namespace App\Enums;

enum StatutRecu: string
{
    case EN_ATTENTE = 'en_attente';
    case TRAITE = 'traite';
    case ERREUR = 'erreur';
}