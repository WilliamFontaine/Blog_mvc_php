<?php

class ControllerUser
{
    private $_manager;
    private $_view;

    /**
     * Constructeur d'un controlleur pour les utilisateurs
     * @param $url
     * @throws Exception
     */
    public function __construct($url)
    {
        if (isset($url) && count(array($url)) > 1) {
            throw new Exception('Page introuvable');
        }
        $action = (array_key_exists('action', $_REQUEST) ? $_REQUEST['action'] : "");
        if ($action != "") {
            switch ($action) {
                case "formulaireModifPseudo":
                    $this->formulaireModifPseudo();
                    return;
                case "formulaireModifMdp";
                    $this->formulaireModifMdp();
                    return;
                case "formulaireSuppCommentaire":
                    $this->formulaireSuppCommentaire();
                    return;
                case "formulaireSuppCompte":
                    $this->formulaireSuppCompte();
                    return;

            }
        }
        switch ($url[0]) {
            case "deconnexion":
                $this->deconnexion();
                return;
            case "pageUser":
                $this->pageUser();
                return;
            case "deleteComment":
                $this->pageCommentaire();
                return;
        }
        throw new Exception("L'action requise est inconnue ou la page recherchée n'existe pas.");
    }

    /**
     * Méthode qui vérifie le formulaire pour modifier le pseudo.
     * @throws Exception
     */
    private function formulaireModifPseudo()
    {
        $dVueErreur = [];
        $nom = $_POST['txtNom'];
        $this->_manager = new UserManager;
        ValidationModifUser::val_formPseudo($nom, $dVueErreur);
        if (!empty($dVueErreur)) {
            $this->pageUser($dVueErreur);
        } else {
            $this->_manager->modifPSeudo($_SESSION['username'], $nom);
            $dVueSuccess = ["Pseudo modifié avec succès !"];
            $_SESSION['username'] = $nom;
            $this->pageUserSuccess($dVueSuccess);
        }
    }

    /**
     * Méthode qui génère une page d'utilisateur.
     * @param null $dVueErreur
     * @throws Exception
     */
    private function pageUser($dVueErreur = NULL)
    {
        $this->_manager = new UserManager;
        $this->_view = new View("User");
        if ($dVueErreur == NULL)
            $this->_view->generate(['dVueErreur' => NULL]);
        else
            $this->_view->generate(['dVueErreur' => $dVueErreur]);
    }


    /**
     * Méthode qui créé un page d'utilisateur avec un message de succès.
     * @param null $dVueSuccess
     * @throws Exception
     */
    private function pageUserSuccess($dVueSuccess = NULL)
    {
        $this->_view = new View("User");
        if ($dVueSuccess == NULL)
            $this->_view->generate(['dVueSuccess' => NULL]);
        else
            $this->_view->generate(['dVueSuccess' => $dVueSuccess]);
    }

    /**
     * Méthode qui vérifie le formulaire pour modifier le mot de passe.
     * @throws Exception
     */
    private function formulaireModifMdp()
    {
        $dVueErreur = [];
        $mdp = $_POST['txtMdp'];
        $mdpConfirm = $_POST['txtMdpConfirm'];
        $this->_manager = new UserManager;
        if ($mdp == $mdpConfirm) {
            ValidationModifUser::val_formMdp($mdp, $dVueErreur);
            if (!empty($dVueErreur)) {
                $this->pageUser($dVueErreur);
            } else {
                $this->_manager->modifMdp(Nettoyage::CleanChaineCarar($_SESSION['username']), $mdp);
                $dVueSuccess = ["Mot de passe modifié avec succès !"];
                $this->pageUserSuccess($dVueSuccess);
            }
        } else {
            $dVueErreur = "Les deux mots de passes ne correspondent pas";
            $this->pageUser($dVueErreur);
        }

    }

    /**
     * Méthode qui execute le formulaire permetant de supprimer son compte.
     */
    private function formulaireSuppCommentaire()
    {
        $this->_manager = new CommentaireManager;
        $this->_manager->SuppOneComment(Nettoyage::CleanChaineCarar($_GET['id']));
        header("Location: index.php");
    }

    /**
     * Méthode permettant de vérifier le formulaire de suppression d'un compte et de faire le travail demandé.
     */
    private function formulaireSuppCompte()
    {
        $this->_manager = new UserManager;
        $this->deconnexion();
        $this->_manager->SupprimerCompte(Nettoyage::CleanChaineCarar($_SESSION['userId']));
    }

    /**
     * Méthode de déconnexion d'un utilisateur, quel que soit son rôle.
     */
    private function deconnexion()
    {
        session_unset();
        session_destroy();
        $_SESSION = array();
        header("Location: index.php");
    }

    /**
     * Méthode qui permet d'instancier une page de commentaire.
     * Elle est utilisée lorsqu'un utilisateur veut supprimer son commentaire.
     * @throws Exception
     */
    private function pageCommentaire()
    {
        $this->_manager = new CommentaireManager;
        $comm = $this->_manager->getCommId(Nettoyage::CleanChaineCarar($_GET['id']));
        $this->_view = new View("SuppComment");
        $this->_view->generate(['comm' => $comm]);
    }
}