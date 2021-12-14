<?php

class GatewayUser extends Gateway
{
    private Connexion $con;

    /**
     * Constructeur d'une gateway d'utilisateur.
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
     * Méthode permettant de chercher un utilisateur dans la de données.
     * @param string $nomColonne
     * @param string $valeurColonne
     * @param string $mdp
     * @return bool
     */
    protected function chercherUser(string $nomColonne, string $valeurColonne, string $mdp): bool
    {
        $var = [];
        switch ($nomColonne) {
            case($nomColonne == "email"):
                $req = $this->getBdd()->prepare("SELECT * FROM users WHERE email = ?");
                $req->execute(array($valeurColonne));
                while ($data = $req->fetch(PDO::FETCH_ASSOC)) {
                    $var[] = new User($data);
                }
                if (!$req->rowCount() == 1) {
                    return false;
                }
                $req->closeCursor();
                return password_verify($mdp, $var[0]->getMotDePasse());
            case ($nomColonne == "pseudo"):
                $req = $this->getBdd()->prepare("SELECT * FROM users WHERE pseudo = ?");
                $req->execute(array($valeurColonne));
                while ($data = $req->fetch(PDO::FETCH_ASSOC)) {
                    $var[] = new User($data);
                }
                if (!$req->rowCount() == 1) {
                    return false;
                }
                $req->closeCursor();
                return password_verify($mdp, $var[0]->getMotDePasse());
            default:
                return false;
        }
    }

    /**
     * Méthode permettant de sélectionner un utiliateur dans la de données.
     * @param string $nomColonne
     * @param string $param
     * @return array|false
     * @throws Exception
     */
    protected function getUser(string $nomColonne, string $param)
    {
        $var = [];
        switch ($nomColonne) {
            case "id":
                $req = $this->getBdd()->prepare("SELECT * FROM users WHERE id = ?");
                $req->execute(array($param));
                while ($data = $req->fetch(PDO::FETCH_ASSOC)) {
                    $var[] = new User($data);
                }
                if (!$req->rowCount() == 1) {
                    return false;
                }
                $req->closeCursor();
                return $var;
            case "pseudo":
                $req = $this->getBdd()->prepare("SELECT * FROM users WHERE pseudo = ?");
                $req->execute(array($param));
                while ($data = $req->fetch(PDO::FETCH_ASSOC)) {
                    $var[] = new User($data);
                }
                if (!$req->rowCount() == 1) {
                    return false;
                }
                $req->closeCursor();
                return $var;
            case "email":
                $req = $this->getBdd()->prepare("SELECT * FROM users WHERE email = ?");
                $req->execute(array($param));
                while ($data = $req->fetch(PDO::FETCH_ASSOC)) {
                    $var[] = new User($data);
                }
                if (!$req->rowCount() == 1) {
                    return false;
                }
                $req->closeCursor();
                return $var;
            default:
                throw new Exception("Erreur lors du chargement des données.");
        }
    }

    /**
     * Méthode permettant d'insérer un utilisateur dans la base données.
     * @param string $pseudo
     * @param string $mdp
     * @param string $email
     * @param string $type
     */
    protected function insertOneUsr(string $pseudo, string $mdp, string $email, string $type)
    {
        if ($type == NULL) {
            $req = $this->getBdd()->prepare("INSERT INTO users(pseudo,email,motDePasse) VALUES (?,?,?)");
            $req->execute(array($pseudo, $email, password_hash($mdp, PASSWORD_DEFAULT)));
        } else {
            $req = $this->getBdd()->prepare("INSERT INTO users(pseudo,email,motDePasse,type) VALUES (?,?,?,?)");
            $req->execute(array($pseudo, $email, password_hash($mdp, PASSWORD_DEFAULT), $type));
        }

    }

    /**
     * Méthode permettant de modifier le pseudo d'un utilisateur.
     * @param $oldNom
     * @param $newNom
     * @throws Exception
     */
    protected function modifParamPseudo($oldNom, $newNom)
    {
        if ($this->userExist("pseudo", $newNom))
            throw new Exception("Un utilisateur possède déjà ce pseudo !");
        $req = $this->getBdd()->prepare("UPDATE users SET pseudo = ? WHERE pseudo = ?");
        $req->execute([$newNom, $oldNom]);
    }

    /**
     * Méthode retournant un booléen, stipulant si un utilisateur existe dans la base de données ou non.
     * @param string $nomColonne
     * @param string $param
     * @return bool
     */
    protected function userExist(string $nomColonne, string $param): bool
    {
        $var = [];
        switch ($nomColonne) {
            case "pseudo":
                $req = $this->getBdd()->prepare("SELECT * FROM users WHERE pseudo = ?");
                $req->execute(array($param));
                while ($data = $req->fetch(PDO::FETCH_ASSOC)) {
                    $var[] = new User($data);
                }
                if (!empty($var))
                    return true;
                else
                    return false;
            case "email":
                $req = $this->getBdd()->prepare("SELECT * FROM users WHERE email = ?");
                $req->execute(array($param));
                while ($data = $req->fetch(PDO::FETCH_ASSOC)) {
                    $var[] = new User($data);
                }
                if (!empty($var))
                    return true;
                else
                    return false;
            default:
                return false;
        }
    }

    /**
     * Métohde permettant de modifier le mot de passe d'un utilisateur.
     * @param $nom
     * @param $mdp
     */
    protected function modifParamMdp($nom, $mdp)
    {
        $req = $this->getBdd()->prepare("UPDATE users SET motDePasse = ? WHERE pseudo = ?");
        $req->execute([password_hash($mdp, PASSWORD_DEFAULT), $nom]);
    }


    /**
     * Méthode permettant de supprimer un utilisateur pas id.
     * @param $id
     */
    protected function SuppOneCompte($id)
    {
        $req = $this->getBdd()->prepare("DELETE FROM users WHERE id = ?");
        $req->execute([$id]);
    }
}