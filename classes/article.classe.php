<?php

class articl {
    protected $connection;

    public function __construct($connection) {
        $this->connection = $connection;
    }

    public function get_pending_articles() {
        try { 
            $sql = "SELECT title, content, publication_date, articles_id FROM articles
                    WHERE status = 'pending';";

            $query = $this->connection->prepare($sql);
            $query->execute();

            // Fetch all pending articles as an associative array
            $pending_articles = $query->fetchAll(PDO::FETCH_ASSOC);

            return $pending_articles;  
        } catch (PDOException $error) {
            die("An error in getting pending articles: " . $error->getMessage());
        }      
    }
}

?>
