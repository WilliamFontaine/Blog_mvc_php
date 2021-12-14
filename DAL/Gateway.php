<?php

abstract class Gateway
{
    private static $_bdd;

    /**
     * Fonction permettant de sélectionner un seul objet d'une table
     * @param $table
     * @param $obj
     * @param $id
     * @return array
     * @throws Exception
     */
    protected function getOne($table, $obj, $id): array
    {
        $var = [];
        $req = $this->getBdd()->prepare("SELECT * FROM " . $table . " WHERE id = ?");
        $req->execute(array($id));
        while ($data = $req->fetch(PDO::FETCH_ASSOC)) {
            $var[] = new $obj($data);
        }
        if (!$req->rowCount() == 1) {
            throw new Exception("Erreur lors du chargement des données");
        }
        $req->closeCursor();
        return $var;
    }

    /**
     * Fonction permettant de récupérer la base de données
     * @return mixed
     */
    protected function getBdd()
    {
        if (self::$_bdd == null) {
            self::setBdd();
        }
        return self::$_bdd;
    }

    /**
     * Fonction appelant la Connexion
     */
    private static function setBdd()
    {
        global $base, $user, $password;
        self::$_bdd = new Connexion($base, $user, $password);
        self::$_bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    }


    /**
     * Fonction permettatnt de retourner touts les objets d'une table
     * @param $table
     * @param $obj
     * @return array
     */
    protected function getAll($table, $obj): array
    {
        $var = [];
        $req = $this->getBdd()->prepare('SELECT * FROM ' . $table . ' ORDER BY id desc');
        $req->execute();
        while ($data = $req->fetch(PDO::FETCH_ASSOC)) {
            $var[] = new $obj($data);
        }
        $req->closeCursor();
        return $var;
    }
}