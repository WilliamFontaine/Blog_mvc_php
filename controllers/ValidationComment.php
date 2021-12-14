<?php

class ValidationComment
{
    static function val_form(&$nom, &$commentaire, &$dataVueErreur)
    {
        if (!isset($nom) || $nom == "") {
            $dataVueErreur[] = "Le pseudo doit être renseigné.";
            $nom = "";
        }
        if ($nom != filter_var($nom, FILTER_SANITIZE_STRING)) {
            $dataVueErreur[] = "Tentative d'injection de code.";
            $nom = "";
        }
        if (!isset($commentaire) || $commentaire == "") {
            $dataVueErreur[] = "Le pseudo doit être renseigné.";
            $commentaire = "";
        }
        if ($commentaire != filter_var($commentaire, FILTER_SANITIZE_STRING)) {
            $dataVueErreur[] = "Tentative d'injection de code.";
            $commentaire = "";
        }
    }
}