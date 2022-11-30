<?php

namespace App\Config;

class ValidationMessage
{
    public const VALEUR = "Vous devez renseigner une valeur pour {{ label }}";
    public const VALEUR_TECH = "ERREUR TECHNIQUE : une valeur nécessaire n'est pas renseignée. Détails : {{ label }}";
    public const KW_NOMBRE = "Vous devez renseigner un nombre entier positif";
    public const PRIX_NOMBRE = "Vous devez renseigner un nombre positif";
    public const STRING_TAILLE_MAX = "Vous devez renseigner une valeur ne dépassant pas {{ limit }} caractère(s)";
    public const STRING_TAILLE_MIN = "Vous devez renseigner une valeur supérieure ou égale à {{ limit }} caractère(s)";
    public const DATE_RENSEIGNEE = "Vous devez renseigner une date";
}