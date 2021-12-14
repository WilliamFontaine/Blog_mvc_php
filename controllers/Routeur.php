<?php

class Router
{
    private $_ctrl;

    /**
     * @throws Exception
     */
    public function routeReq()
    {
        $listeAction = ["Visiteur" => ["accueil", "article"],
            "User" => ["deconnexion", "deleteComment", "pageUser", "connexionUser", "register"],
            "Ecrivain" => ["addArticle", "deleteArticle", "modifierArticle", "connexionEcrivain"],
            "Admin" => ["pageAdmin", "connexionAdmin"]];

        try {

            //Le controlleur est inclus selon l'action de l'utilisateur
            if (isset($_GET['url'])) {
                $url = explode('/', filter_var($_GET['url'], FILTER_SANITIZE_URL));
                if (in_array($url[0], $listeAction["Visiteur"])) {
                    $controller = "Visiteur";
                }
                if (in_array($url[0], $listeAction["User"])) {
                    $controller = "User";
                }
                if (in_array($url[0], $listeAction["Ecrivain"])) {
                    $controller = "Ecrivain";
                }
                if (in_array($url[0], $listeAction["Admin"])) {
                    $controller = "Admin";
                }
                if (!isset($controller)) {
                    throw new Exception("L'action requise est inconnue !");
                }
                if ($controller == "User") {
                    if (!isset($_SESSION['type'])) {
                        if($url[0] != "register")
                            $url[0] = "connexionUser";
                    }
                }
                if ($controller == "Ecrivain") {
                    if (!isset($_SESSION['type']) or $_SESSION["type"] != ("admin" and "ecrivain" and "super-admin")) {
                        $url[0] = "connexionEcrivain";
                    }
                }
                if ($controller == "Admin") {
                    if (!isset($_SESSION['type']) or $_SESSION["type"] != ("admin" and "super-admin")) {
                        $url[0] = "connexionAdmin";
                    }
                }
                $controllerClass = "Controller" . $controller;
                $controllerFile = "controllers/" . $controllerClass . ".php";
                if (file_exists($controllerFile)) {
                    $this->_ctrl = new $controllerClass($url);
                } else {
                    throw new Exception("La page que vous recherchez n'existe plus ou est introuvable. Veuillez retourner à l'accueil du site!");
                }
            } else {
                $this->_ctrl = new ControllerVisiteur("");
            }
        } catch (Exception $e) {
            $errorMsg = $e->getMessage();
            $_view = new View("Erreur");
            $_view->generate(array('errorMsg' => $errorMsg));
        }
    }
}