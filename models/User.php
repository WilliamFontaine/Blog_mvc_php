<?php

class User
{
    private $_id;
    private $_pseudo;
    private $_email;
    private $_motDePasse;
    private $_type;
    private $_inscription;

    /**
     * Constructeur d'un utilisateur
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
            $metode = 'set' . ucfirst($key);
            if (method_exists($this, $metode))
                $this->$metode($value);
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
     * @param $id
     */
    public function setId($id)
    {
        $this->_id = $id;
    }

    /**
     * @return mixed
     */
    public function getPseudo()
    {
        return $this->_pseudo;
    }

    /**
     * @param $pseudo
     */
    public function setPseudo($pseudo)
    {
        if (is_string($pseudo))
            $this->_pseudo = $pseudo;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->_email;
    }

    /**
     * @param $email
     */
    public function setEmail($email)
    {
        if (is_string($email))
            $this->_email = $email;
    }

    /**
     * @return mixed
     */
    public function getMotDePasse()
    {
        return $this->_motDePasse;
    }

    /**
     * @param $mdp
     */
    public function setMotDePasse($mdp)
    {
        if (is_string($mdp))
            $this->_motDePasse = $mdp;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->_type;
    }

    /**
     * @param $type
     */
    public function setType($type)
    {
        if (is_string($type))
            $this->_type = $type;
    }

    /**
     * @return mixed
     */
    public function getInscription()
    {
        return $this->_inscription;
    }

    /**
     * @param $inscription
     */
    public function setInscription($inscription)
    {
        $this->_inscription = $inscription;
    }
}