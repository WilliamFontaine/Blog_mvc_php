<?php

class CommentaireManager extends GatewayComment
{

    /**
     * Méthode permettant d'ajouter un commentaire
     * @param string $pseudo
     * @param string|null $typeAuteur
     * @param int $idArticle
     * @param string $comment
     */
    public function insertOne(string $pseudo, string $typeAuteur = NULL, int $idArticle, string $comment)
    {
        $this->insertOneComment($pseudo, $typeAuteur, $idArticle, $comment);
    }

    /**
     * Méthode appelant la gateway pour connaître le nombre de commentaire total ou le nombre de commentaire d'un utilisateur précis en fonction des paramètres.
     * @return array|void
     */
    public function getNbCommentaires($type, $username)
    {
        return $this->getNbComms($type, $username);
    }

    /**
     * Méthode permettant de récupérer un commentaire par id.
     * @param $id
     * @return array
     * @throws Exception
     */
    public function getCommId($id): array
    {
        return $this->getOneComment($id);
    }

    /**
     * Méthode permettant de supprimer un commentaire par id.
     * @param $id
     */
    public function SuppOneComment($id)
    {
        $this->supprimerComment($id);
    }
}