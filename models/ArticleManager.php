<?php

class ArticleManager extends GatewayArticle
{
    /**
     * Méthode permettant de retourner un article si un id est renseigné, sinon, tous les articles.
     * @param  $id
     * @return array
     * @throws Exception
     */
    public function getArticle($id = NULL): array
    {
        if ($id != NULL) {
            return $this->getOneArticle($id);
        } else {
            return $this->getAllArticles();
        }
    }

    /**
     * Méthode permettant de midifier un article.
     * @param $id
     * @param $titre
     * @param $contenu
     */
    public function modifArticle($id, $titre, $contenu)
    {
        $this->modifierOneArticle($id, $titre, $contenu);
    }

    /**
     * Méthode permettant de supprimer un article par id.
     * @param $id
     */
    public function suppArticle($id)
    {
        $this->supprimerOneArticle($id);
    }

    /**
     * Méthode permettant d'ajouter un article.
     * @param $id
     * @param $titre
     * @param $contenu
     */
    public function addOneArticle($id, $titre, $contenu)
    {
        $this->insertOneArticle($id, $titre, $contenu);
    }

    /**
     * Méthode permettant de rechercher un article par titre
     * @param $titre
     * @return array
     */
    public function rechercheArticle($titre): array
    {
        return $this->searchArticles($titre);
    }
}