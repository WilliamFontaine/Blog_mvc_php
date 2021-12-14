<?php

class Nettoyage
{
    /**
     * Méthode permettant de nettoyer une chaine de caractère
     * @param $chaine
     * @return mixed
     */
    public static function CleanChaineCarar($chaine){
        return filter_var($chaine, FILTER_SANITIZE_STRING);
    }
}