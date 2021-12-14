<?php

class Commentaire
{
    private $_id;
    private $_pseudoAuteur;
    private $_typeAuteur;
    private $_idArticle;
    private $_comment;
    private $_date;

    /**
     * Constructeur d'un commentaire
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->hydrate($data);
    }

    /**
     * @param array $data
     */
    public function hydrate(array $data)
    {
        foreach ($data as $key => $value) {
            $methode = 'set' . ucfirst($key);
            if (method_exists($this, $methode))
                $this->$methode($value);
        }
    }

    /**
     * Méthode permettant de retourner le nombre de commentaires total sur le site
     * @return array|void
     */
    public static function getNbComm($type = NULL, $username = NULL)
    {
        if ($type == NULL and $username == NULL)
            return ((new CommentaireManager())->getNbCommentaires(NULL, NULL));
        else
            return ((new CommentaireManager())->getNbCommentaires($type, $username));
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->_id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->_id = $id;
    }

    /**
     * @return mixed
     */
    public function getPseudoAuteur()
    {
        return $this->_pseudoAuteur;
    }

    /**
     * @param mixed $pseudoAuteur
     */
    public function setPseudoAuteur($pseudoAuteur): void
    {
        $this->_pseudoAuteur = $pseudoAuteur;
    }

    /**
     * @return mixed
     */
    public function getTypeAuteur()
    {
        return $this->_typeAuteur;
    }

    /**
     * @param mixed $typeAuteur
     */
    public function setTypeAuteur($typeAuteur): void
    {
        $this->_typeAuteur = $typeAuteur;
    }

    /**
     * @return mixed
     */
    public function getIdArticle()
    {
        return $this->_idArticle;
    }

    /**
     * @param mixed $idArticle
     */
    public function setIdArticle($idArticle): void
    {
        $this->_idArticle = $idArticle;
    }

    /**
     * @return mixed
     */
    public function getComment()
    {
        return $this->_comment;
    }

    /**
     * @param mixed $comment
     */
    public function setComment($comment): void
    {
        $this->_comment = $comment;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->_date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date): void
    {
        $this->_date = $date;
    }

}