<?php

class Database_connection {
    private $host = 'localhost'; 
    private $dbname = 'culture_sharing_platform'; 
    private $username = 'root'; 
    private $password = ''; 
    private $connection; 

    
    public function connect() {
        try {
            if ($this->connection == null) {
                $connection_string = "mysql:host={$this->host};dbname={$this->dbname};charset=utf8";
                $this->connection = new PDO($connection_string, $this->username, $this->password);
                $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            return $this->connection;
        } catch (PDOException $error) {
            die('connection failed: ' . $error->getMessage());
        }
    }

    public function disconnect() {
        $this->connection = null;
    }
}

?> 
