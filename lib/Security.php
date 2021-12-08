<?php

class Security
{
    private static $seed = 'MdpDeGamerz:';
    public static function hacher($texte_en_clair) {
        //assaisonnement du mdp
        $texte_hache = hash('sha256', ''.static::$seed.$texte_en_clair);
        return $texte_hache;
    }

}