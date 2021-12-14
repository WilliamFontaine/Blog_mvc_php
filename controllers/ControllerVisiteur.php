<?php

class ControllerVisiteur
{
    private $_manager;
    private $_view;

    /**
     * Constructeur du controlleur d'un visiteur
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
                case "formulaireCommentaire":
                    $this->formulaireCommentaire();
                    return;
                case "formulaireRechercheArticle":
                    $this->pageArticleRecherchee();
                    return;
            }
        }
        if (isset($_GET['id'])) {
            $this->pageArticlePrecis(Nettoyage::CleanChaineCarar($_GET['id']));
            return;
        }
        if (isset($url[0])) {
            switch ($url[0]) {
                default:
                    $this->pageAccueil();
                    return;
            }
        } else {
            $this->pageAccueil();
        }
    }


    /**
     * Méthode qui vérifie le formulaire de commentaire.
     * @throws Exception
     */
    private function formulaireCommentaire()
    {
        $dVueErreur = [];
        $nom = $_POST['txtNom'];
        $comment = $_POST['txtComm'];
        $this->_manager = new CommentaireManager;
        if (isset($_SESSION['type'])) {
            $type = Nettoyage::CleanChaineCarar($_SESSION['type']);
        }
        if (isset($_GET['id'])) {
            $idArticle = Nettoyage::CleanChaineCarar($_GET['id']);
        } else {
            throw new Exception("Erreur lors de la récupération de l'id de l'article !");
        }
        ValidationComment::val_form($nom, $comment, $dVueErreur);
        if (!empty($dVueErreur)) {
            throw new Exception("$dVueErreur");
        }
        if (isset($type))
            $this->_manager->insertOne($nom, $type, $idArticle, $comment);
        else
            $this->_manager->insertOne($nom, NULL, $idArticle, $comment);
        $this->pageArticlePrecis(Nettoyage::CleanChaineCarar($_GET['id']));
    }

    /**
     * Méthode permettant d'instancier la page d'un article précis.
     * @param $id
     * @throws Exception
     */
    private function pageArticlePrecis($id)
    {
        $this->_manager = new ArticleManager;
        $article = $this->_manager->getArticle($id);
        $this->_view = new View('Article');
        $this->_view->generate(['article' => $article]);

    }

    /**
     * Méthode permettant d'instancier la page d'accueil avec tous les articles de la base de données.
     * @throws Exception
     */
    private function pageAccueil()
    {
        $this->_manager = new ArticleManager;
        $articles = $this->_manager->getArticle();
        $this->_view = new View('Accueil');
        $this->_view->generate(['articles' => $articles]);
    }

    /**
     * Méthode permettant d'instancier une page avec les articles correspondants à la recherche.
     * @throws Exception
     */
    private function pageArticleRecherchee()
    {
        $titre = $_POST['txtTitre'];
        $this->_manager = new ArticleManager;
        ValidationArticle::val_formRecherche($titre);
        $articles = $this->_manager->rechercheArticle($titre);
        $this->_view = new View('Accueil');
        $this->_view->generate(['articles' => $articles]);
    }
}