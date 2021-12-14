<?php

class Article
{
    private $_id;
    private $_titre;
    private $_idAuteur;
    private $_contenu;
    private $_date;

    /**
     * Constructeur d'un Article
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
            $method = 'set' . ucfirst($key);
            if (method_exists($this, $method))
                $this->$method($value);
        }
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
    public function getTitre()
    {
        return $this->_titre;
    }

    /**
     * @param mixed $titre
     */
    public function setTitre($titre): void
    {
        $this->_titre = $titre;
    }

    /**
     * @return mixed
     */
    public function getIdAuteur()
    {
        return $this->_idAuteur;
    }

    /**
     * @param mixed $idAuteur
     */
    public function setIdAuteur($idAuteur): void
    {
        $this->_idAuteur = $idAuteur;
    }

    /**
     * @return mixed
     */
    public function getContenu()
    {
        return $this->_contenu;
    }

    /**
     * @param mixed $contenu
     */
    public function setContenu($contenu): void
    {
        $this->_contenu = $contenu;
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


    /**
     * Méthode permettant de récupérer le pseudo de l'auteur d'un article
     * @return mixed
     * @throws Exception
     */
    public function getPseudoAuteur()
    {
        return ((new UserManager())->getOneUser("id", $this->_idAuteur)[0]->getPseudo());

    }

}