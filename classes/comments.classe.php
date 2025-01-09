<?php

    class comments {
        protected $connection;
        protected $disconnect;
    
        public function __construct($connection,$deconexion) {
            $this->connection = $connection;
            $this->disconnect = $deconexion;
        } 
        
        public function read_comments(){
            try{ 
                $sql="SELECT comment_id, comment_content, created_at, title, first_name, last_name, image_profile FROM commentairs
                INNER JOIN  users ON users.users_id = commentairs.user_id
                INNER JOIN articles ON articles.articles_id =commentairs.article_id;";
        
                $query = $this->connection->prepare($sql);

                $query->execute();
              
                $comments = $query->fetchAll(PDO::FETCH_ASSOC);
    
                $this->disconnect;
                 
                return $comments;  
            }catch (PDOException $error) {
                die("An error in getting comments: " . $error->getMessage());
            }      
        }
        
    }

?>