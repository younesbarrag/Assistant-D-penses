<?php

namespace App\Enums;

enum CategorieDepense: string
{
    case ALTIMENTAIRE = 'alimentaire';
    case TRANSPORT = 'transport';
    case LOGEMENT = 'logement';
    case LOISIRS = 'loisirs';
    case AUTRES = 'autres';

}