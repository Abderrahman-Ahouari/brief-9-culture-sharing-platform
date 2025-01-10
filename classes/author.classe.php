<?php


 class author extends users{ 
  protected $connection;
  protected $disconnect;

  public function __construct($connection,$disconnect) {
    $this->connection = $connection;
    $this->disconnect = $disconnect;
}


    public function add_article($title, $content, $categorie_id, $author_id){

        try{ 
          
          $upload_folder = "../Uploads/";
          $file_name = basename($_FILES['image']['name']);
          $image_path = $upload_folder . $file_name;

        if(!move_uploaded_file($_FILES['image']['tmp_name'], $image_path)){
              echo "error in uploading the folder";
        }      

            $sql = "INSERT INTO articles (title, content, author_id, category_id, image) VALUES(:title, :content, :author_id, :categorie_id, :image);";
    
            $query = $this->connection->prepare($sql);
    
            $query->bindParam(':title', $title, PDO::PARAM_STR);
            $query->bindParam(':content', $content, PDO::PARAM_STR);
            $query->bindParam(':author_id', $author_id, PDO::PARAM_INT);
            $query->bindParam(':categorie_id', $categorie_id, PDO::PARAM_INT);
            $query->bindParam(':image', $image_path, PDO::PARAM_STR);

            
            $query->execute(); 
            $article_id = $this->connection->lastInsertId();
            $this->disconnect;
               return $article_id;
        }catch(PDOException $error){
          die("an error while adding an article" . $error->getMessage());
        }  
    }



    public function delete_article($article_id){

      try {

        $sql = "DELETE FROM articles WHERE articles_id = :article_id ;";

        $query = $this->connection->prepare($sql);
  
        $query->bindParam(':article_id', $article_id, PDO::PARAM_INT);
  
        $query->execute();
  
        $this->disconnect;

      } catch (PDOExeption $error) {
        die("error while deleting article" . $error->getMessage());
      }


    } 
     
    // public function($article_id){
    //   try {
    //       $this->connection->prepare("")
    //   } catch (\Throwable $th) {
    //     //throw $th;
    //   }
    // }





    
 }





?>