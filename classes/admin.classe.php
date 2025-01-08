<?php

class admin extends users {
    protected $connection;
    protected $deconexion;

    public function __construct($connection) {
        $this->connection = $connection;
    }

    public function accept_article($id) {
        try {
            $sql = "UPDATE articles SET status = 'published' WHERE articles_id = :id;";
            $query = $this->connection->prepare($sql);
            $query->bindParam(':id', $id, PDO::PARAM_INT);
            $query->execute();
        } catch (PDOException $error) {
            die("An error in accepting article: " . $error->getMessage());
        }
    }

    public function reject_article($id) {
        try {
            $sql = "UPDATE articles SET status = 'rejected' WHERE articles_id = :id;";
            $query = $this->connection->prepare($sql);
            $query->bindParam(':id', $id, PDO::PARAM_INT);
            $query->execute();
        } catch (PDOException $error) {
            die("An error in rejecting article: " . $error->getMessage());
        }
    }

    public function add_category($category_name) {
        try {
            $sql = "INSERT INTO categories(name) VALUES(:category);";
            $query = $this->connection->prepare($sql);
            $query->bindParam(':category', $category_name, PDO::PARAM_STR);
            $query->execute();
        } catch (PDOException $error) {
            die("An error in adding category: " . $error->getMessage());
        }
    }

    public function modify_category($category_name, $id) {
        try {
            $sql = "UPDATE categories SET name = :category_name WHERE categories_id = :id;";
            $query = $this->connection->prepare($sql);
            $query->bindParam(':category_name', $category_name, PDO::PARAM_STR);
            $query->bindParam(':id', $id, PDO::PARAM_INT);
            $query->execute();
        } catch (PDOException $error) {
            die("An error in modifying category: " . $error->getMessage());
        }
    }

    public function delete_category($id) {
        try {
            $sql = "DELETE FROM categories WHERE categories_id = :id;";
            $query = $this->connection->prepare($sql);
            $query->bindParam(':id', $id, PDO::PARAM_INT);
            $query->execute();
        } catch (PDOException $error) {
            die("An error in deleting category: " . $error->getMessage());
        }
    }



    public function add_tag($tag_name) {
        try {
            $sql = "INSERT INTO tags(tag_name) VALUES(:tag);";
            $query = $this->connection->prepare($sql);
            $query->bindParam(':tag', $tag_name, PDO::PARAM_STR);
            $query->execute();
        } catch (PDOException $error) {
            die("An error in adding tag: " . $error->getMessage());
        }
    }

    public function modify_tag($tag_name, $id) {
        try {
            $sql = "UPDATE tags SET tag_name = :tag_name WHERE tag_id = :id;";
            $query = $this->connection->prepare($sql);
            $query->bindParam(':tag_name', $tag_name, PDO::PARAM_STR);
            $query->bindParam(':id', $id, PDO::PARAM_INT);
            $query->execute();
        } catch (PDOException $error) {
            die("An error in modifying tag: " . $error->getMessage());
        }
    }

    public function delete_tag($id) {
        try {
            $sql = "DELETE FROM tags WHERE tag_id = :id;";
            $query = $this->connection->prepare($sql);
            $query->bindParam(':id', $id, PDO::PARAM_INT);
            $query->execute();
        } catch (PDOException $error) {
            die("An error in deleting tag: " . $error->getMessage());
        }
    }
}

?>
