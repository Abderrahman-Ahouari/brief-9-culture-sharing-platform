<?php

class Categorie {
    protected $connection;
    protected $disconnect;

    public function __construct($connection, $disconnect) {
        $this->connection = $connection;
        $this->disconnect = $disconnect;
    }
 
 
    public function read_categorie() {
        try { 
            $sql = "SELECT name, categories_id FROM categories;";
            $query = $this->connection->prepare($sql);
            $query->execute();
            
            // Fetch all categories as an associative array
            $categories = $query->fetchAll(PDO::FETCH_ASSOC);
            $this->disconnect;
            return $categories;  
        } catch (PDOException $error) {
            die("An error in getting categories: " . $error->getMessage());
        }      
    }
}

?>
