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
                case "validationFormulaireConnexionPseudo":
                    $this->formulaireConnexionPseudo();
                    return;
            }
        }
        if (isset($url[0])) {
            switch ($url[0]) {
                case "pageAdmin":
                    $this->pageAdmin();
                    return;
                case "connexionAdmin":
                    $this->pageConnexionAdmin();
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

    /**
     * Méthode permettant d'instancier une page de connexion d'administrateur
     * @param null $dVueErreur
     */
    private function pageConnexionAdmin($dVueErreur = NULL)
    {
        $this->_view = new View('Login');
        if ($dVueErreur == NULL) {
            $this->_view->generateEmpty(['dVueErreur' => NULL]);
        } else {
            $this->_view->generateEmpty(['dVueErreur' => $dVueErreur]);
        }
    }

    /**
     * Méthode qui permet de vérifier le formulaire de connexion.
     * Il vérifie si l'utilisateur qui essaie de se connecter à bien le rôle admin ou super-admin, dans le cas inverse, il renvoie une erreur.
     * @throws Exception
     */
    private function formulaireConnexionPseudo()
    {
        $dVueErreur = [];
        $nom = $_POST['txtNom'];
        $mdp = $_POST['txtMdp'];
        $this->_manager = new UserManager;
        ValidationLogin::val_form($nom, $mdp, $dVueErreur);
        if (!empty($dVueErreur)) {
            $this->pageConnexionAdmin($dVueErreur);
        } else if ($this->_manager->trouverUserParPseudo($nom, $mdp)) {
            $user = $this->_manager->getOneUser("pseudo", $nom);
            if ($user[0]->getType() != "admin" and $user[0]->getType() != "super-admin") {
                throw new Exception("Vous n'avez pas les permissions nécéssaires pour effectuer cette action !");
            }
            $_SESSION['username'] = $user[0]->getPseudo();
            $_SESSION['type'] = $user[0]->getType();
            $_SESSION['userId'] = $user[0]->getId();
            header("Location: index.php");
        } else {
            $dVueErreur = "Le mot de passe de le pseudo ne correspondent pas !";
            $this->pageConnexionAdmin($dVueErreur);
        }
    }
}