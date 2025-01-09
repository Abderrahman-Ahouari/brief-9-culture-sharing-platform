<?php

class articl {

    protected $connection;
    protected $disconnect;

    public function __construct($connection, $disconnect) {
        $this->connection = $connection;
        $this->disconnect = $disconnect;
    }
 
    public function get_pending_articles() {
        try { 
            $sql = "SELECT title, content, publication_date, articles_id FROM articles
                    WHERE status = 'pending';";

            $query = $this->connection->prepare($sql);
            $query->execute();

            $pending_articles = $query->fetchAll(PDO::FETCH_ASSOC);
            $this->disconnect;
            return $pending_articles;  
        } catch (PDOException $error) {
            die("An error in getting pending articles: " . $error->getMessage());
        }      
    }

    public function get_author_articles($author_id) {
        try { 
            $sql = "SELECT title, content, publication_date, status FROM articles WHERE author_id= :author_id  ;";

            $query = $this->connection->prepare($sql);
            $query->bindParam(':author_id', $author_id, PDO::PARAM_INT);

            $query->execute();

            $author_articles = $query->fetchAll(PDO::FETCH_ASSOC);
            $this->disconnect;
            return $author_articles;  
        } catch (PDOException $error) {
            die("An error in getting author articles: " . $error->getMessage());
        }      
    }

}

?>
