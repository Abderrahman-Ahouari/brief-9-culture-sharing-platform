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



        
     }
?>