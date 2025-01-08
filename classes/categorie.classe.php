<?php

class Categorie {
    protected $connection;

    public function __construct($connection) {
        $this->connection = $connection;
    }
 
    public function read_categorie() {
        try { 
            $sql = "SELECT name, categories_id FROM categories;";
            $query = $this->connection->prepare($sql);
            $query->execute();
            
            // Fetch all categories as an associative array
            $categories = $query->fetchAll(PDO::FETCH_ASSOC);
            
            return $categories;  
        } catch (PDOException $error) {
            die("An error in getting categories: " . $error->getMessage());
        }      
    }
}

?>
