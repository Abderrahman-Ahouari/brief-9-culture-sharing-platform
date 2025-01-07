<?php
 require('user_classe.php');

 class author extends users{

    public function add_article($title, $content, $categorie_id, $author_id){

        try{ 

            $db_connect = new Database_connection;
            $connection = $db_connect->connect();


            $upload_folder = "../Uploads/";
            $file_name = basename($_FILES['image'] ['name']);
            $image_path = $upload_folder . $file_name;

            if(!move_uploaded_file($_FILES['image'] ['tmp_name'], $image_path)){
                echo "error in uploading file"; 
          } 
            

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