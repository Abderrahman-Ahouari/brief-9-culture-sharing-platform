<?php
      require('../classes/connection.php');
      require('../classes/categorie.classe.php');
      require('../classes/user_classe.php');
      require('../classes/author.classe.php');
      require('../classes/tags.classe.php');
   

      session_start();
    if($_SESSION['role'] === "admin"){
      header("location: admin_dashboard.php");
    }
    elseif($_SESSION['role'] === "user"){
      header("location: home.php");
    }
    elseif(!$_SESSION){
    header("location: signup.php");
    }

    $db_connect = new Database_connection;
    $connection = $db_connect->connect();
    $disconnect = $db_connect->disconnect();

  $categories = new categorie($connection,$disconnect);
  $article = new author($connection,$disconnect);
  $tags = new tags($connection,$disconnect);


  $author_id = $_SESSION['id'];

   if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $title = $_POST['title'];
      $content = $_POST['content'];
      $category_id = $_POST['category'];
      $article_id = $article->add_article($title , $content , $category_id , $author_id );
      $tags_list = $_POST['tags'];
      $tags->insert_article_tags($article_id, $tags_list);
      
  }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ajouter un Article</title>
  <link rel="stylesheet" href="../css/style.css">
<style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      margin: 0;
      padding: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .form-container {
      background-color: white;
      border-radius: 15px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      padding: 20px;
      width: 400px;
    }

    .form-container h2 {
      text-align: center;
      color: #B87333;
      margin-bottom: 20px;
    }

    .form-container form {
      display: flex;
      flex-direction: column;
    }

    .form-container label {
      margin-bottom: 5px;
      font-weight: bold;
      color: #333;
    }

    .form-container input, .form-container textarea, .form-container select {
      padding: 10px;
      margin-bottom: 15px;
      border: 1px solid #ccc;
      border-radius: 15px;
      font-size: 14px;
      color: #333;
    }

    .form-container textarea {
      resize: vertical;
    }

    .form-container button {
      padding: 10px;
      background-color: #FF7F50;
      color: white;
      font-size: 16px;
      font-weight: bold;
      border: none;
      border-radius: 15px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .form-container button:hover {
      background-color: #B87333;
    }

    .form-container input:focus, .form-container textarea:focus, .form-container select:focus {
      outline: none;
      border-color: #FF7F50;
    }
</style>
</head>
<body>
  <div class="form-container">
    <h2>Ajouter un Article</h2>
    <form action="" method="post" enctype="multipart/form-data">
      <label for="title">Titre</label>
      <input type="text" id="title" name="title" placeholder="Saisissez le titre de l'article" required>

      <label for="image">image(obligatoire)</label>
      <input type="file" id="image" name="image" placeholder="enter your image" required>     

      <label for="content">Contenu</label>
      <textarea id="content" name="content" rows="5" placeholder="Saisissez le contenu de l'article" required></textarea>

      <label for="category">Catégorie</label>
      <select id="category" name="category" required>
        <?php
        $categories_list = $categories->read_categorie();
        foreach($categories_list as $categorie ){?>
        <option value="<?php echo $categorie['categories_id']; ?>" ><?php echo $categorie['name']; ?></option>
      <?php } ?>
      </select>
      <select name="tags[]" multiple id="tags" >
      <?php
        $tags_list = $tags->read_tags();
        foreach($tags_list as $tag ){?>
        <option value="<?php echo $tag['tag_id']; ?>" ><?php echo $tag['tag_name']; ?></option>
      <?php } ?>
      </select>

      <button type="submit">Publier</button>
    </form>
  </div>
</body>
</html>
