<?php

class ControllerEcrivain
{
    private $_manager;
    private $_view;

    /**
     * Constructeur d'un controller d'écrivain
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
                case "formulaireModifArticle":
                    $this->formulaireModifierArticle();
                    return;
                case "formulaireSuppArticle":
                    $this->formulaireSuppArticle();
                    return;
                case "formulaireAddArticle":
                    $this->formulaireAddArticle();
                    return;
                case "validationFormulaireConnexionPseudo":
                    $this->formulaireConnexionPseudo();
                    return;
            }
        }
        if (isset($url[0])) {
            switch ($url[0]) {
                case "addArticle":
                    $this->pageAddArticle();
                    return;
                case "modifierArticle":
                    $this->pageModifierArticle();
                    return;
                case "deleteArticle":
                    $this->pageDeleteArticle();
                    return;
                case "connexionEcrivain":
                    $this->pageConnexionEcrivain();
            }
        }
    }

    /**
     * Méthode qui permet de modifier un article
     * @throws Exception
     */
    private function formulaireModifierArticle()
    {
        $dVueErreur = [];
        $titre = $_POST['txtTitre'];
        $contenu = $_POST['txtCotenu'];
        $this->_manager = new ArticleManager;
        ValidationArticle::val_form($this, $contenu, $dVueErreur);
        if (!empty($dVueErreur)) {
            $this->pageModifierArticle($dVueErreur[0]);
        } else {
            $this->_manager->modifArticle(Nettoyage::CleanChaineCarar($_GET['id']), $titre, $contenu);
            $dVueSuccess = ['Article modifié avec succès.'];
            $this->pageModifierArticleSuccess($dVueSuccess);
        }
    }

    /**
     * Méthode permettant d'instancier un page qui permet de modifier un article.
     * La vue étant coder de la manière suivante: un article ne peut être modifié que par son auteur.
     * @param null $dVueErreur
     * @throws Exception
     */
    private function pageModifierArticle($dVueErreur = NULL)
    {
        $this->_manager = new ArticleManager;
        $article = $this->_manager->getArticle(Nettoyage::CleanChaineCarar($_GET['id']));
        $this->_view = new View("ModifArticle");
        if ($dVueErreur == NULL)
            $this->_view->generate(['article' => $article]);
        else {
            $this->_view->generate(['article' => $article, 'dVueErreur' => $dVueErreur]);
        }

    }

    /**
     * Méthode permettant d'instancier la page de modification d'un article avec un message de succès à la suite de la modification d'un article.
     * Elle est appelée uniquement en cas de réussite de la modification d'un article.
     * @param null $dVueSuccess
     * @throws Exception
     */
    private function pageModifierArticleSuccess($dVueSuccess = NULL)
    {
        $this->_manager = new ArticleManager;
        $article = $this->_manager->getArticle(Nettoyage::CleanChaineCarar($_GET['id']));
        $this->_view = new View("ModifArticle");
        if ($dVueSuccess == NULL)
            $this->_view->generate(['article' => $article]);
        else {
            $this->_view->generate(['article' => $article, 'dVueSuccess' => $dVueSuccess]);
        }

    }

    /**
     * Méthode permettant de supprimer un article.
     * Un article peut être supprimé par son auteur ou bien par un utilisateur ayant le rôle admin ou super-admin.
     */
    private function formulaireSuppArticle()
    {
        $this->_manager = new ArticleManager;
        $this->_manager->suppArticle(Nettoyage::CleanChaineCarar($_GET['id']));
        header("Location: index.php");
    }

    /**
     * Méthode permettant d'ajouter un article sur la base de données.
     * Pour écrire un article, il faut avoir un des rôles suivants: ecrivain, admin ou super-admin.
     */
    private function formulaireAddArticle()
    {
        $titre = $_POST['txtTitre'];
        $contenu = $_POST['txtCotenu'];
        $this->_manager = new ArticleManager;
        $this->_manager->addOneArticle(Nettoyage::CleanChaineCarar($_SESSION['userId']), $titre, $contenu);
        header("Location: index.php");
    }

    /**
     * Méthode qui créé une page d'ajout un article.
     * @throws Exception
     */
    private function pageAddArticle()
    {
        $dVueErreur = [];
        $this->_view = new View('AddArticle');
        $this->_view->generate(['dVueErreur' => $dVueErreur]);
    }

    /**
     * Méthode qui créé une page de suppression d'un article.
     * @throws Exception
     */
    private function pageDeleteArticle()
    {
        $this->_manager = new ArticleManager;
        $article = $this->_manager->getArticle(Nettoyage::CleanChaineCarar($_GET['id']));
        $this->_view = new View("SuppArticle");

        $this->_view->generate(['article' => $article]);
    }

    /**
     * Méthode qui créé un page de connexion d'écrivain.
     * @param null $dVueErreur
     */
    private function pageConnexionEcrivain($dVueErreur = NULL)
    {
        $this->_view = new View('Login');
        if ($dVueErreur == NULL) {
            $this->_view->generateEmpty(['dVueErreur' => NULL]);
        } else {
            $this->_view->generateEmpty(['dVueErreur' => $dVueErreur]);
        }
    }

    /**
     * Méthode qui vérifie le formulaire de connexion de la page de connexion d'un écrivain.
     * Il faut au moins avoir le rôle écrivain pour que cette méthode ne renvoie pas d'exception.
     * Un utilisateur normal ne peut donc pas se connecter en tant qu'écrivain.
     * Les admiinistrateurs et super-admins essayant de se connecter avec cette page verront leur rôle passer à ecrivain temporairement,
     * ils pourront toujours se connecter en tant qu'admin et super-admin ultérieurement.
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
            $this->pageConnexionEcrivain($dVueErreur);
        } else if ($this->_manager->trouverUserParPseudo($nom, $mdp)) {
            $user = $this->_manager->getOneUser("pseudo", $nom);
            if($user[0]->getType() == "user"){
                throw new Exception("Vous n'avez pas les permissions nécéssaires pour effectuer cette action !");
            }
            $_SESSION['username'] = $user[0]->getPseudo();
            $_SESSION['type'] = 'ecrivain';
            $_SESSION['userId'] = $user[0]->getId();
            header("Location: index.php");
        } else {
            $dVueErreur = "Le mot de passe de le pseudo ne correspondent pas !";
            $this->pageConnexionEcrivain($dVueErreur);
        }
    }
}