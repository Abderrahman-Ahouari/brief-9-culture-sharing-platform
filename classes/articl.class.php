<?php
    require('connection.php');

    class articl{
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
                 
                return $categories;  
            }catch (PDOException $error) {
                die("An error in getting categories: " . $error->getMessage());
            }      
        }

        }    
    
?>