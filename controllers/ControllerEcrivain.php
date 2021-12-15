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
            }
        }
        throw new Exception("L'action requise est inconnue ou la page recherchée n'existe pas.");
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
        ValidationArticle::val_form($titre, $contenu, $dVueErreur);
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
}