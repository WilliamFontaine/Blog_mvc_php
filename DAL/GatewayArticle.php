<?php

class GatewayArticle extends Gateway
{
    private Connexion $con;

    /**
     * Constructeur d'une gateway d'Article.
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
     * Méthode qui retourne tous les articles.
     * @return array
     */
    protected function getAllArticles(): array
    {
        return $this->getAll('articles', 'Article');
    }


    /**
     * Méthode qui retourne un article précis.
     * @param $id
     * @return array
     * @throws Exception
     */
    protected function getOneArticle($id): array
    {
        return $this->getOne('articles', 'Article', $id);
    }

    /**
     * Méthode permettant de modifier un article par id.
     * @param $id
     * @param $titre
     * @param $contenu
     */
    protected function modifierOneArticle($id, $titre, $contenu)
    {
        $req = $this->getBdd()->prepare("UPDATE articles SET titre = ?, contenu = ? WHERE id = ?");
        $req->execute([$titre, $contenu, $id]);
    }

    /**
     * Méthode permettant de supprimer un article par id.
     * @param $id
     */
    protected function supprimerOneArticle($id): void
    {
        $req = $this->getBdd()->prepare("DELETE FROM articles WHERE articles.id = ?");
        $req->execute([$id]);
    }

    /**
     * Méthode permettant d'insérer un article.
     * @param $idAuteur
     * @param $titre
     * @param $contenu
     */
    protected function insertOneArticle($idAuteur, $titre, $contenu): void
    {
        $req = $this->getBdd()->prepare("INSERT INTO articles(idAuteur,titre,contenu) VALUES(?,?,?)");
        $req->execute([$idAuteur, $titre, $contenu]);
    }

    /**
     * Méthode de permettant de faire une recherche par nom dans les articles.
     * @param $titre
     * @return array
     */
    protected function searchArticles($titre)
    {
        $var = [];
        $req = $this->getBdd()->prepare("SELECT * FROM articles WHERE titre LIKE ?");
        $req->execute(["%" . $titre . "%"]);
        while ($data = $req->fetch(PDO::FETCH_ASSOC)) {
            $var[] = new Article($data);
        }
        $req->closeCursor();
        return $var;
    }
}

