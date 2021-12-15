<?php

class ValidationLogin
{
    static function val_form(&$nom, &$mdp, &$dataVueErreur)
    {
        if (!isset($nom) || $nom == "") {
            $dataVueErreur[] = "Le pseudo doit être renseigné.";
            $nom = "";
        }
        if ($nom != filter_var($nom, FILTER_SANITIZE_STRING)) {
            $dataVueErreur[] = "Tentative d'injection de code.";
            $nom = "";
        }
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