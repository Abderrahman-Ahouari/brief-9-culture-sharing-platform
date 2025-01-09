<?php
     
     class tags{

        protected $connection;
        protected $disconnect;

        public function __construct($connection, $disconnect) {
            $this->connection = $connection;
            $this->disconnect = $disconnect;
        }
     
        public function read_tags(){
            try{ 
                $sql="SELECT tag_name, tag_id FROM tags;";
        
                $query = $this->connection->prepare($sql);
                
                $query->execute();
              
                $tags = $query->fetchAll(PDO::FETCH_ASSOC);
    
                $this->disconnect;
                 
                return $tags;  
            }catch (PDOException $error) {
                die("An error in getting tags: " . $error->getMessage());
            }      
        }

        public function insert_article_tags($articl_id, $tags){

            try {
                $sql="INSERT INTO Taged_articles(tag_id, article_id) VALUES(:tag_id ,:article_id);";
                        
                $query = $this->connection->prepare($sql);

                $query->bindParam(':tag_id', $tag, PDO::PARAM_INT);
                $query->bindParam(':article_id', $articl_id, PDO::PARAM_INT);

                foreach($tags as $tag){
                $query->execute();
                } 

                $this->disconnect;
            } catch (PDOExeption $error) {
                die("error in setting the tagged articles" . $error);
            }


        }

        
     }
?>