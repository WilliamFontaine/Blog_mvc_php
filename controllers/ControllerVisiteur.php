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
                case "formulaireInscription":
                    $this->formulaireInscription();
                    return;
                case "validationFormulaireConnexionPseudo":
                    $this->formulaireConnexionPseudo();
                    return;
            }
        }
        if (isset($_GET['id'])) {
            $this->pageArticlePrecis(Nettoyage::CleanChaineCarar($_GET['id']));
            return;
        }
        if (isset($url[0])) {
            switch ($url[0]) {
                case "register":
                    $this->pageRegister();
                    return;
                case "connexion":
                    $this->pageConnexion();
                    return;
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
            throw new Exception($dVueErreur[0]);
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

    /**
     * Méthode qui permet de valider le formulaire d'inscription.
     */
    private function formulaireInscription()
    {
        $dVueErreur = [];
        $pseudo = $_POST['txtNom'];
        $email = $_POST['txtEmail'];
        $mdp = $_POST['txtMdp'];
        $mdpConfirm = $_POST['txtMdpConfirm'];
        $this->_manager = new UserManager();
        if ($mdp == $mdpConfirm) {
            ValidationRegister::val_form($pseudo, $email, $mdp, $dVueErreur);
            if (!empty($dVueErreur)) {
                $this->pageRegister($dVueErreur);
            } elseif ($this->_manager->exist("email", $email)) {
                $dVueErreur = "Un utilisateur possède déjà cette email.";
                $this->pageRegister($dVueErreur);
            } elseif ($this->_manager->exist("pseudo", $pseudo)) {
                $dVueErreur = "Un utilisateur possède déjà ce pseudo.";
                $this->pageRegister($dVueErreur);

            } else {
                $this->_manager->insertOneUser($pseudo, $mdp, $email);
                $dVueSuccess = ["Inscription réussi, veuillez maintenant vous connecter."];
                $this->connexionAfterSuccesRegister($dVueSuccess);
            }
        } else {
            $dVueErreur = "Les deux mots de passes ne correspondent pas";
            $this->pageRegister($dVueErreur);
        }
    }

    /**
     * Méthode permettant d'instancier une page d'inscription.
     */
    private function pageRegister($dVueErreur = NULL)
    {
        $this->_view = new View('Register');
        if ($dVueErreur == NULL)
            $this->_view->generateEmpty(['dVueErreur' => NULL]);
        else
            $this->_view->generateEmpty(['dVueErreur' => $dVueErreur]);
    }

    /**
     * Méthode permettant d'instancier une page de connexion avec un pessage de succès après le bon enregistrement d'un utilisateur.
     * @param $dVueSuccess
     */
    private function connexionAfterSuccesRegister($dVueSuccess)
    {
        $this->_view = new View('Login');
        $this->_view->generateEmpty(['dVueSuccess' => $dVueSuccess]);
    }

    /**
     * Méthode permettant de vérifier le formulaire de connexion d'un utilisateur.
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
            $this->pageConnexion($dVueErreur);
        } else if ($this->_manager->trouverUserParPseudo($nom, $mdp)) {
            $user = $this->_manager->getOneUser("pseudo", $nom);
            $_SESSION['username'] = $user[0]->getPseudo();
            $_SESSION['type'] = $user[0]->getType();
            $_SESSION['userId'] = $user[0]->getId();
            header("Location: index.php");
        } else {
            $dVueErreur = "Le mot de passe de le pseudo ne correspondent pas !";
            $this->pageConnexion($dVueErreur);
        }
    }

    /**
     * Méthode permettant d'instancier une page de connexion d'utilisateur.
     * @param null $dVueErreur
     */
    private function pageConnexion($dVueErreur = NULL)
    {
        $this->_view = new View('Login');
        if ($dVueErreur == NULL) {
            $this->_view->generateEmpty(['dVueErreur' => NULL]);
        } else {
            $this->_view->generateEmpty(['dVueErreur' => $dVueErreur]);
        }
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
}