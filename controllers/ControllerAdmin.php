<?php

class ControllerAdmin
{
    private $_manager;
    private $_view;

    /**
     * Constructeur d'un controller d'administrateur
     * @param $url
     * @throws Exception
     */
    public function __construct($url)
    {
        if (isset($url) && count([$url]) > 1) {
            throw new Exception('Page introuvable');
        }
        $action = (array_key_exists('action', $_REQUEST) ? $_REQUEST['action'] : "");
        if ($action != "") {
            switch ($action) {
                case "formulaireCreerUser":
                    $this->formulaireCreerUser();
                    return;
            }
        }
        if (isset($url[0])) {
            switch ($url[0]) {
                case "pageAdmin":
                    $this->pageAdmin();
                    return;
            }
        }
        throw new Exception("L'action requise est inconnue ou la page recherchée n'existe pas.");

    }

    /**
     * Méthode vérifiant le formulaire qui permet à un administrateur de créer un utilisateur, un écrivain ou un administrateur.
     * Elle permet aussi de céer des super-admin en plus pour les utilisateurs ayant le rôle super-admin.
     * @throws Exception
     */
    private function formulaireCreerUser()
    {
        $dVueErreur = [];
        $pseudo = $_POST['txtNom'];
        $email = $_POST['txtEmail'];
        $mdp = $_POST['txtMdp'];
        $mdpConfirm = $_POST['txtMdpConfirm'];
        $type = $_POST['type'];
        $this->_manager = new UserManager();
        if ($mdp == $mdpConfirm) {
            ValidationRegister::val_form($pseudo, $email, $mdp, $dVueErreur);
            if (!empty($dVueErreur)) {
                $this->pageAdmin($dVueErreur);
            } elseif ($this->_manager->exist("email", $email)) {
                $dVueErreur = "Un utilisateur possède déjà cette email.";
                $this->pageAdmin($dVueErreur);
            } elseif ($this->_manager->exist("pseudo", $pseudo)) {
                $dVueErreur = "Un utilisateur possède déjà ce pseudo.";
                $this->pageAdmin($dVueErreur);
            } else {
                $this->_manager->insertOneUser($pseudo, $mdp, $email, $type);
                $dVueSuccess = ["Utilisateur ajouté avec succès !"];
                $this->pageAdminSuccess($dVueSuccess);
            }
        } else {
            $dVueErreur = "Les deux mots de passes ne correspondent pas";
            $this->pageAdmin($dVueErreur);
        }
    }

    /**
     * Méthode permettant d'instancier une page d'administrateur
     * @throws Exception
     */
    private function pageAdmin($dVueErreur = NULL)
    {
        $this->_view = new View("Admin");
        if ($dVueErreur == NULL)
            $this->_view->generate(['dVueErreur' => NULL]);
        else
            $this->_view->generate(['dVueErreur' => $dVueErreur]);
    }

    /**
     * Méthode qui renvoie sur la page de connexion avec un essage de succès suite à une inscription qui s'est bien passée.
     * @param null $dVueSuccess
     * @throws Exception
     */
    private function pageAdminSuccess($dVueSuccess = NULL)
    {
        $this->_view = new View("Admin");
        if ($dVueSuccess == NULL)
            $this->_view->generate(['dVueSuccess' => NULL]);
        else
            $this->_view->generate(['dVueSuccess' => $dVueSuccess]);
    }
}