<?php
require('user_classe.php');

class author extends users{
    public function add_categorie(){
        try{ 
            $db_connect = new Database_connection;
            $connection = $db_connect->connect();
            
            $sql="SELECT name, categories_id FROM categories;";
    
            $query = $connection->prepare($sql);
            
            $query->execute();
          
            $db_connect->disconnect();

        }catch (PDOException $error) {
            die("An error in login: " . $error->getMessage());
        }
    }

     
    public function add_categorie($cate_name){
        try{
            $db_connect = new Database_connection;
            $connection = $db_connect->connect();
            
            $sql="INSERT INTO categories(name) VALUES(:categorie);";
    
            $query = $connection->prepare($sql);
    
            $query->bindParam(':categorie', $cate_name, PDO::PARAM_STR);
    
            $query->execute();
      
            $db_connect->disconnect();

        }catch (PDOException $error) {
            die("An error in login: " . $error->getMessage());
        }
    }


}


?>