<?php

class UserManager extends GatewayUser
{

    /**
     * Méthode permettant de trouver un utilisateur avec son pseudo.
     * @param string $pseudo
     * @param string $mdp
     * @return bool
     */
    public function trouverUserParPseudo(string $pseudo, string $mdp): bool
    {
        return $this->chercherUser("pseudo", $pseudo, $mdp);
    }

    /**
     * Méthode permettant de trouver un utilisateur avec son email.
     * @param string $email
     * @param string $mdp
     * @return bool
     */
    public function trouverUserParEmail(string $email, string $mdp): bool
    {
        return $this->chercherUser("email", $email, $mdp);
    }

    /**
     * Fonction permettant de trouver un utilisateur.
     * @param string $nomColonne
     * @param string $param
     * @return array|false
     * @throws Exception
     */
    public function getOneUser(string $nomColonne, string $param)
    {
        return $this->getUser($nomColonne, $param);
    }

    /**
     * Méthode retournant un booléen en fonction de l'existance d'un utilisateur.
     * @param string $nomColonne
     * @param string $param
     * @return bool
     */
    public function exist(string $nomColonne, string $param): bool
    {
        return $this->userExist($nomColonne, $param);
    }

    /**
     * Méthode permettant d'insérer un utilisateur.
     * @param string $pseudo
     * @param string $mdp
     * @param string $email
     * @param $type
     */
    public function insertOneUser(string $pseudo, string $mdp, string $email, $type = NULL)
    {
        $this->insertOneUsr($pseudo, $mdp, $email, $type);
    }

    /**
     * Méthode permettant de modifier le pseudo d'un utilisateur.
     * @param $oldNom
     * @param $newNom
     * @throws Exception
     */
    public function modifPSeudo($oldNom, $newNom)
    {
        $this->modifParamPseudo($oldNom, $newNom);
    }

    /**
     * Méthode permettant de modifier le mot de passe d'un utilisateur.
     * @param $nom
     * @param $mdp
     */
    public function modifMdp($nom, $mdp)
    {
        $this->modifParamMdp($nom, $mdp);
    }

    /**
     * Méthode permettant de supprimer un utilisateur par id.
     * @param $id
     */
    public function SupprimerCompte($id)
    {
        $this->SuppOneCompte($id);
    }
}