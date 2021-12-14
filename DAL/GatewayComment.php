<?php

class GatewayComment extends Gateway
{
    private Connexion $con;

    /**
     * Constructeur d'une gateway d'utilisateur
     */
    public function __construct()
    {
        global $base, $user, $password;
        $this->con = new Connexion($base, $user, $password);
        if ($this->con == false) {
            die("ERREUR: Impossible de se connecter à la base de données. ");
        }
    }

    /**
     * Méthode permettant de récupérer tous les commentaires d'un article.
     * @param $id
     * @return array|void
     */
    public function getComment($id)
    {
        $req = $this->getBdd()->prepare("SELECT * FROM comments WHERE idArticle = ?");
        $req->execute([$id]);
        while ($data = $req->fetch(PDO::FETCH_ASSOC)) {
            $var[] = new Commentaire($data);
        }
        $req->closeCursor();
        if (isset($var))
            return $var;
    }

    /**
     * Méthode permettant d'ajouter un commentaire à un article.
     * @param string $pseudo
     * @param $typeAuteur
     * @param int $idArticle
     * @param string $comment
     */
    protected function insertOneComment(string $pseudo, $typeAuteur, int $idArticle, string $comment)
    {
        if (isset($typeAuteur)) {
            $req = $this->getBdd()->prepare("INSERT INTO comments(pseudoAuteur,typeAuteur,idArticle,comment) VALUES (?,?,?,?)");
            $req->execute([$pseudo, $typeAuteur, $idArticle, $comment]);
        } else {
            $req = $this->getBdd()->prepare("INSERT INTO comments(pseudoAuteur,typeAuteur,idArticle,comment) VALUES (?,?,?,?)");
            $req->execute([$pseudo,"visiteur", $idArticle, $comment]);

        }
    }

    /**
     * Méthode permettant de connaître le nombre de commentires total sur le site.
     * @return array|void
     */
    protected function getNbComms($type, $username)
    {
        if ($type == NULL and $username == NULL) {
            $req = $this->getBdd()->prepare("SELECT COUNT(*) FROM comments");
            $req->execute();
            while ($data = $req->fetch(PDO::FETCH_ASSOC)) {
                $var[] = $data;
            }
            $req->closeCursor();
        } else {
            $req = $this->getBdd()->prepare("SELECT COUNT(*) FROM comments WHERE pseudoAuteur = ? AND typeAuteur = ?");
            $req->execute([$username, $type]);
            while ($data = $req->fetch(PDO::FETCH_ASSOC)) {
                $var[] = $data;
            }
            $req->closeCursor();
        }
        if (isset($var))
            return $var;
    }

    /**
     * Méthode permettant de récupérer un commentaire précis par id.
     * @param $id
     * @return array
     * @throws Exception
     */
    protected function getOneComment($id): array
    {
        return $this->getOne("comments", "Commentaire", $id);
    }


    /**
     * Méthode permettant de supprimer un commentaire précis par id.
     * @param $id
     */
    protected function supprimerComment($id)
    {
        $req = $this->getBdd()->prepare("DELETE FROM comments WHERE id = ?");
        $req->execute([$id]);
    }
}