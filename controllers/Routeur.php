<?php

class Router
{
    private $_ctrl;

    /**
     * @throws Exception
     */
    public function routeReq()
    {
        $listeAction = ["Visiteur" => ["accueil", "article", "connexion", "register"],
            "User" => ["deconnexion", "deleteComment", "pageUser"],
            "Ecrivain" => ["addArticle", "deleteArticle", "modifierArticle"],
            "Admin" => ["pageAdmin"]];

        try {

            //Le controlleur est inclus selon l'action de l'utilisateur
            if (isset($_GET['url'])) {
                $url = explode('/', filter_var($_GET['url'], FILTER_SANITIZE_URL));
                if (in_array($url[0], $listeAction["Visiteur"])) {
                    $controller = "Visiteur";
                }
                else if (in_array($url[0], $listeAction["User"])) {
                    $controller = "User";
                }
                else if (in_array($url[0], $listeAction["Ecrivain"])) {
                    $controller = "Ecrivain";
                }
                else if (in_array($url[0], $listeAction["Admin"])) {
                    $controller = "Admin";
                }
                else{
                    throw new Exception("L'action requise est inconnue !");
                }

                if ($controller != "Visiteur") {
                    if (!isset($_SESSION['type'])) {
                        if ($url[0] != "register")
                            $url[0] = "connexion";
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