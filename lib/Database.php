<?php

class Database {
    // Variables
    private $host = DB_HOST;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $dbname = DB_NAME;
    private $dbh;
    private $error;
    private $stmt;

    // Constructeur
    public function __construct(){
        // DSN
        $dsn = 'mysql:host='. $this->host .';dbname='. $this->dbname;

        // Options
        $options = array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        );
        
        // Instanciation PDO
        try {
            $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
        } catch(PDOException $e) {
            $this->error= $e->getMessage();
        }
    }

    // Methode query
    public function query($query) {
        $this->stmt = $this->dbh->prepare($query);
    }

    // Binder
    public function bind($param, $value, $type = null) {
        if(is_null($type)){
            switch(true){
                case is_int ($value):
                    $type = PDO::PARAM_INT;
                    break;
                case is_bool ($value):
                    $type = PDO::PARAM_BOOL;
                    break;
                case is_null ($value):
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
                    break;    
            }
        }
        $this->stmt->bindValue($param, $value, $type);
    }

    // Execute
    public function execute(){
        return $this->stmt->execute();
    }

    // set resultat
    public function resultSet(){
        $this->execute();
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }

    // récuperer 1 value
    public function single(){
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }

}