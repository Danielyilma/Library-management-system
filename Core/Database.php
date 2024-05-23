<?php

class Database {
    private $conn;
    private $stmt;

    public function __construct($config) {
        $dsn = 'mysql:' . http_build_query($config, "", ';');

        $this->conn = new PDO($dsn, $config['username'], $config['password'], [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
    }

    public function query($query, $params){
        $this->stmt = $this->conn->prepare($query);

        $this->stmt->execute($params);
        
        return $this;
    }

    public function fetch(){
        return $this->stmt->fetch();
    }


}