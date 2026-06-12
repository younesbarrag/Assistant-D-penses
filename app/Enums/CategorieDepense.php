<?php

namespace App\Enums;

enum CategorieDepense: string
{
    case ALIMENTAIRE = 'alimentaire';
    case BOISSONS = 'boissons';
    case ENTRETIEN = 'entretien';
    case TRANSPORT = 'transport';
    case AUTRES = 'autres';
}