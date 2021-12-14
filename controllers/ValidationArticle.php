<?php

class ValidationArticle
{
    static function val_form(&$titre, &$contenu, &$dataVueErreur)
    {
        if (!isset($titre) || $titre == "") {
            $dataVueErreur[] = "Le pseudo doit être renseigné.";
            $titre = "";
        }
        if ($titre != filter_var($titre, FILTER_SANITIZE_STRING)) {
            $dataVueErreur[] = "Tentative d'injection de code.";
            $titre = "";
        }
        if (!isset($contenu) || $contenu == "") {
            $dataVueErreur[] = "Le mot de passe doit être renseigné.";
            $contenu = "";
        }
//        if ($contenu != filter_var($contenu, FILTER_SANITIZE_STRING)) {
//            $dataVueErreur[] = "Tentative d(injection de code.";
//            $contenu = "";
//        }
    }

    static function val_formRecherche(&$titre){
        if (!isset($titre) || $titre == "") {
            $titre = "";
            throw new Exception("Le pseudo doit être renseigné.");
        }
        if ($titre != filter_var($titre, FILTER_SANITIZE_STRING)) {
            $titre = "";
            throw new Exception("Tentative d'injection de code.");

        }
    }
}