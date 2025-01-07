<?php

    class categorie{
        public function read_categorie(){
            try{ 
                $db_connect = new Database_connection;
                $connection = $db_connect->connect();
                
                $sql="SELECT name, categories_id FROM categories;";
        
                $query = $connection->prepare($sql);
                
                $query->execute();
              
                $categories = $query->fetchAll(PDO::FETCH_ASSOC);
    
                $db_connect->disconnect();
                 
                return $categories;  
            }catch (PDOException $error) {
                die("An error in getting categories: " . $error->getMessage());
            }      
        }
    
         
        }

?>