<?php

class ValidationModifUser
{
    static function val_formPseudo(&$nom, &$dataVueErreur)
    {
        if (!isset($nom) || $nom == "") {
            $dataVueErreur[] = "Le pseudo doit être renseigné.";
            $nom = "";
        }
        if ($nom != filter_var($nom, FILTER_SANITIZE_STRING)) {
            $dataVueErreur[] = "Tentative d'injection de code.";
            $nom = "";
        }
    }

    static function val_formMdp(&$mdp, &$dataVueErreur)
    {
        if (!isset($mdp) || $mdp == "") {
            $dataVueErreur[] = "Le mot de passe doit être renseigné.";
            $mdp = "";
        }
        if ($mdp != filter_var($mdp, FILTER_SANITIZE_STRING)) {
            $dataVueErreur[] = "Tentative d(injection de code.";
            $mdp = "";
        }
    }
}