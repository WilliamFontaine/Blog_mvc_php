<?php

class ValidationRegister
{
    static function val_form(&$nom, &$email, &$mdp, &$dataVueErreur)
    {
        if (!isset($nom) || $nom == "") {
            $dataVueErreur[] = "Le pseudo doit être renseigné.";
            $nom = "";
        }
        if ($nom != filter_var($nom, FILTER_SANITIZE_STRING)) {
            $dataVueErreur[] = "Tentative d'injection de code.";
            $nom = "";
        }
        if (!isset($email) || $email == "") {
            $dataVueErreur[] = "Le pseudo doit être renseigné.";
            $email = "";
        }
        if ($email != filter_var(filter_var($email, FILTER_SANITIZE_STRING), FILTER_VALIDATE_EMAIL)) {
            $dataVueErreur[] = "Tentative d'injection de code.";
            $email = "";
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