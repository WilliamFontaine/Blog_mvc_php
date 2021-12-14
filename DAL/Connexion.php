<?php

class Connexion extends PDO
{

    /**
     * Constructeur de la connexion à la base de données
     * @param string $dsn
     * @param string $username
     * @param string $password
     */
    public function __construct(string $dsn, string $username, string $password)
    {
        parent::__construct($dsn, $username, $password);
        $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

//    public function executeQuery(string $query, array $parameters = []): bool
//    {
//        $this->stmt = parent::prepare($query);
//        foreach ($parameters as $name => $value) {
//            $this->stmt->bindValue($name, $value[0]);
//        }
//        return $this->stmt->execute();
//    }
//
//    public function getResults(): array
//    {
//        return $this->stmt->fetchall(PDO::FETCH_ASSOC);
//
//    }
}