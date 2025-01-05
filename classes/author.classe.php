<?php
 require('user_classe.php');

class admin extends users{
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
            die("An error in adding categorie: " . $error->getMessage());
        }
    }


    public function modify_categorie($cate_name,$id){
        try{
            $db_connect = new Database_connection;
            $connection = $db_connect->connect();
            
            $sql="UPDATE categories set name= :cate_name WHERE categories_id = :id ;";
    
            $query = $connection->prepare($sql);
    
            $query->bindParam(':cate_name', $cate_name, PDO::PARAM_STR);
            $query->bindParam(':id', $id, PDO::PARAM_INT);
    
            $query->execute();
      
            $db_connect->disconnect();

        }catch (PDOException $error) {
            die("An error in modifying categorie: " . $error->getMessage());
        }
    }


    public function delete_categorie($id){
        try{
            $db_connect = new Database_connection;
            $connection = $db_connect->connect();
    
            $sql="DELETE FROM categories WHERE categories_id = :id ;";
    
            $query = $connection->prepare($sql);
    
            $query->bindParam(':id', $id, PDO::PARAM_INT);
    
            $query->execute();
    
            $db_connect->disconnect();

        }catch (PDOException $error) {
            die("An error in deleting categorie: " . $error->getMessage());
        }
    }

}

class articl {
    public function get_pending_articles(){
        try{ 
            $db_connect = new Database_connection;
            $connection = $db_connect->connect();
            
            $sql="SELECT title, content, publication_date, articles_id FROM articles
                  WHERE status='pending';";
    
            $query = $connection->prepare($sql);
            
            $query->execute();
            
            $pending_articles = $query->fetchAll(PDO::FETCH_ASSOC);

            $db_connect->disconnect();
             
            return $pending_articles;  
        }catch (PDOException $error) {
            die("An error in getting categories: " . $error->getMessage());
        }      
    }


    public function accept_articl($id){
        try{
            $db_connect = new Database_connection;
            $connection = $db_connect->connect();
    
            $sql="UPDATE articles set status = 'published' where articles_id = :id;";
    
            $query = $connection->prepare($sql);
    
            $query->bindParam(':id', $id, PDO::PARAM_INT);
    
            $query->execute();
    
            $db_connect->disconnect();

        }catch (PDOException $error) {
            die("An error in accepting article: " . $error->getMessage());
        }
    }


    public function reject_articl($id){
        try{
            $db_connect = new Database_connection;
            $connection = $db_connect->connect();
    
            $sql="UPDATE articles set status = 'rejected' where articles_id =:id;";
    
            $query = $connection->prepare($sql);
    
            $query->bindParam(':id', $id, PDO::PARAM_INT);
    
            $query->execute();
    
            $db_connect->disconnect();

        }catch (PDOException $error) {
            die("An error in rejecting article: " . $error->getMessage());
        }
    }



    public function add_article($title, $content, $categorie_id, $author_id){

        try{ 

            $db_connect = new Database_connection;
            $connection = $db_connect->connect();
    
            $sql = "INSERT INTO articles (title, content, author_id, category_id) VALUES(:title, :content, :author_id, :categorie_id);";
    
            $query = $connection->prepare($sql);
    
            $query->bindParam(':title', $title, PDO::PARAM_STR);
            $query->bindParam(':content', $content, PDO::PARAM_STR);
            $query->bindParam(':author_id', $author_id, PDO::PARAM_INT);
            $query->bindParam(':categorie_id', $categorie_id, PDO::PARAM_INT);

            
            $query->execute(); 
            $db_connect->disconnect(); 

        }catch(PDOException $error){
          die("an error while adding an article" . $error->getMessage());
        }  
    }
    } 




?>