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
                $conn_string = "mysql:host={$this->host};dbname={$this->dbname};charset=utf8";
                $this->connection = new PDO($conn_string, $this->username, $this->password);
                $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            return $this->connection;
        } catch (PDOException $e) {
            die('connection failed: ' . $e->getMessage());
        }
    }

    public function disconnect() {
        $this->connection = null;
    }
}
?> 
