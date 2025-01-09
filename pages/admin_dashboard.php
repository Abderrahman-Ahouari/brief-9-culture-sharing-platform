<?php
      require('../classes/connection.php');
      require('../classes/user_classe.php');
      require('../classes/categorie.classe.php');
      require('../classes/admin.classe.php');
      require('../classes/article.classe.php');
      require('../classes/tags.classe.php');
      require('../classes/comments.classe.php');



   
   session_start(); 
   if($_SESSION['role'] === "user"){
     header("location: home.php");
   }
   elseif($_SESSION['role'] === "author"){
     header("location: author.php");
   }
   elseif(!$_SESSION['role']){
    header("location: signup.php");
  }

  $db_connect = new Database_connection;
  $connection = $db_connect->connect();
  $disconnect = $db_connect->disconnect();

   $categorie = new categorie($connection,$disconnect);
   $admin = new admin($connection,$disconnect);
   $articles = new articl($connection);
   $user = new users;
   $tags = new tags($connection,$disconnect);
   $comments = new comments($connection,$disconnect);
    

   if($_SERVER['REQUEST_METHOD'] === 'POST'){
    if (isset($_POST['btn_delete'])) {
       $categorie_id = $_POST['catgeorie_id'];
       $admin->delete_categorie($categorie_id);
    } 
    
    elseif (isset($_POST['btn_add'])) {
       $name= $_POST['add_categorie'];
       $admin->add_categorie($name);
    } 
    
    elseif (isset($_POST['btn_modify'])) {
      $new_name = $_POST['new_name'];
      $categorie_id = $_POST['catgeorie_id'];
      $admin->modify_categorie($new_name, $categorie_id);
    } 
    
    elseif (isset($_POST['accept'])) {
      $article_id = $_POST['article_id'];
      $admin->accept_articl($article_id);
    } 
      
    elseif (isset($_POST['reject'])) {
      $article_id = $_POST['article_id'];
      $admin->reject_articl($article_id);
    }

    elseif(isset($_POST['logout'])){
       $user->logout();
    }

    elseif (isset($_POST['btn_delete_tag'])) {
      $tag_id = $_POST['catgeorie_id'];
      $admin->delete_tag($tag_id);
   } 

   elseif (isset($_POST['btn_modify_tag'])) {
     $new_name = $_POST['new_name'];
     $tag_id = $_POST['catgeorie_id'];
     $admin->modify_tag($new_name, $tag_id);
   } 

   elseif (isset($_POST['btn_add_tag'])) {
    $name= $_POST['add_categorie'];
    $admin->add_tag($name);
  } 

  elseif (isset($_POST['ban-button'])) {
     $id = $_POST['catgeorie_id'];
     $admin->user_bann($id);
  }
    
  elseif(isset($_POST['delete_comment_btn'])){
    $id = $_POST['catgeorie_id'];
    $admin->comment_delete($id);
  }
      
   }


?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tableau de Bord Admin</title>
  <style>
    
    .id{
       display: none;
    }
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      margin: 0;
      padding: 0;
    }

    .container {
      max-width: 1200px;
      margin: 20px auto;
      padding: 20px;
      background-color: white;
      border-radius: 15px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      position: relative;
    }

    h2 {
      text-align: center;
      color: #B87333;
      margin-bottom: 20px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 20px;
    }

    table th, table td {
      padding: 10px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }

    table th {
      background-color: #FF7F50;
      color: white;
    }

    table td {
      color: #333;
    }

    table button {
      padding: 5px 10px;
      border: none;
      border-radius: 15px;
      cursor: pointer;
      font-size: 14px;
      font-weight: bold;
      color: white;
    }

    .btn-delete {
      background-color: #e74c3c;
    }

    .btn-update {
      background-color: #3498db;
    }

    .btn-delete:hover {
      background-color: #c0392b;
    }

    .btn-update:hover {
      background-color: #2980b9;
    }

    /* Add Button Styling */
    .btn-add {

      padding: 10px 20px;
      background-color: #FF7F50;
      color: white;
      font-size: 14px;
      border: none;
      border-radius: 15px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .btn-add:hover {
      background-color: #B87333;
    }

    /* Hidden Forms Styling */
    .hidden-form {
      display: none;
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      background-color: white;
      border-radius: 15px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
      padding: 20px;
      width: 400px;
      z-index: 1000;
    }

    .hidden-form.add-form {
      border: 2px solid #FF7F50;
    }

    .hidden-form.modify-form {
      border: 2px solid #3498db;
    }

    .hidden-form h3 {
      text-align: center;
      margin-bottom: 20px;
    }

    .hidden-form input {
      width: 100%;
      padding: 10px;
      margin-bottom: 15px;
      border: 1px solid #ccc;
      border-radius: 15px;
      font-size: 14px;
    }

    .hidden-form button {
      padding: 10px 15px;
      background-color: #FF7F50;
      color: white;
      font-size: 16px;
      font-weight: bold;
      border: none;
      border-radius: 15px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .hidden-form button:hover {
      background-color: #B87333;
    }

    .hidden-form .btn-exit {
      position: absolute;
      top: 10px; 
      right: 10px;
      background: none;
      color: #333;
      font-size: 20px;
      font-weight: bold;
      border: none;
      cursor: pointer;
    }

    .overlay {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.5);
      z-index: 999;
    }
    .container_btns{
        display: flex;
        justify-content : space-between;
        max-width: 1200px;
      margin: 20px auto;
      padding: 20px;
      background-color: white;
      border-radius: 15px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      position: relative;
    }
    .btn-logout{
      padding: 10px 20px;
      background-color: #FF7F50;
      color: white;
      font-size: 14px;
      border: none;
      border-radius: 15px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }
  </style>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      margin: 0;
      padding: 0;
    }

    .container {
      max-width: 1200px;
      margin: 20px auto;
      padding: 20px;
      background-color: white;
      border-radius: 15px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      position: relative;
    }

    h2 {
      text-align: center;
      color: #B87333;
      margin-bottom: 20px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 20px;
    }

    table th, table td {
      padding: 10px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }

    table th {
      background-color: #FF7F50;
      color: white;
    }

    table td {
      color: #333;
    }

    table button {
      padding: 5px 10px;
      border: none;
      border-radius: 15px;
      cursor: pointer;
      font-size: 14px;
      font-weight: bold;
      color: white;
    }

    .btn-accept {
      background-color: #2ecc71;
    }

    .btn-reject {
      background-color: #e74c3c;
    }

    .btn-accept:hover {
      background-color: #27ae60;
    }

    .btn-reject:hover {
      background-color: #c0392b;
    }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1200px;
            margin: 50px auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table th, table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }

        table th {
            background-color: #f8f8f8;
            color: #333;
        }

        .rounded-image {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }

        .ban-button {
            background-color: red;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            cursor: pointer;
        }

        .ban-button:hover {
            background-color: darkred;
        }
  </style>
  <style> 
        body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
    }

    .container {
        max-width: 1200px;
        margin: 50px auto;
        background: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    h1 {
        text-align: center;
        color: #333;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    table th, table td {
        border: 1px solid #ddd;
        padding: 10px;
        text-align: center;
    }

    table th {
        background-color: #f8f8f8;
        color: #333;
    }

    .rounded-image {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        object-fit: cover;
    }

    .ban-button {
        background-color: red;
        color: white;
        border: none;
        padding: 5px 10px;
        border-radius: 5px;
        cursor: pointer;
    }

    .ban-button:hover {
        background-color: darkred;
    }

  </style>
</head>
<body>
  <div class="container_btns">
    <button class="btn-add" onclick="showAddForm()">Ajouter une Catégorie</button>
    <form method="post">
     <button class="btn-logout" name="logout">Logout</button>
    </form>
    

  </div>
  <div class="container">
    <h2>Tableau de Bord Admin</h2>
    <table>

      <thead>
        <tr>
          <th>Nom de la Catégorie</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>

        <?php 
        $list = $categorie->read_categorie();
        foreach($list as $categorie_list){ ?>
        <tr>
          <td><?php echo $categorie_list['name'] ?></td>
          <td>
          <form action="" method="post">
          <input type="text" class="new_name" name="new_name">
          <button class="btn-update" name="btn_modify" onclick="showModifyForm()">Modifier</button>
          <input type="text" class="id" name="catgeorie_id" value="<?php echo $categorie_list['categories_id'] ?>">
          </form>
          <form action="" method="post">
          <button class="btn-delete" name="btn_delete"  value="delete">Supprimer</button>
          <input type="text" class="id" name="catgeorie_id" value="<?php echo $categorie_list['categories_id'] ?>">
          </form>
          
          
          </td>
        </tr>
        <?php } ?>
      </tbody>
    </table>


  </div>

  <!-- Add Form -->
  <div class="overlay" onclick="hideForms()"></div>
  <div class="hidden-form add-form" id="addForm">
    <button class="btn-exit" onclick="hideForms()">X</button>
    <h3>Ajouter une Catégorie</h3>
    <form method="post">
      <input type="text" placeholder="Nom de la Catégorie" name="add_categorie" required>
      <button type="submit" name="btn_add">Enregistrer</button>
    </form>
  </div>
    <!-- Add Form -->
    <div class="overlay" onclick="hideForms2()"></div>
  <div class="hidden-form add-form" id="addForm2">
    <button class="btn-exit" onclick="hideForms2()">X</button>
    <h3>Ajouter une tag</h3>
    <form method="post">
      <input type="text" placeholder="Nom de la Catégorie" name="add_categorie" required>
      <button type="submit" name="btn_add_tag">Enregistrer</button>
    </form>
  </div>






  <div class="container">
    <h3>Articles</h3>
    <table>
      <thead>
        <tr>
          <th>titre de l'Article</th>
          <th>Contenu</th>
          <th>Date de Publication</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php 
        $pending_articls = $articles->get_pending_articles();

        foreach( $pending_articls as $articl){ ?>
        <tr>
          <td><?php echo $articl['title']; ?></td>
          <td><?php echo $articl['content']; ?></td>
          <td><?php echo $articl['publication_date']; ?></td>
          <td>
            <form method="POST"  style="display:inline;">
              <input type="hidden" name="article_id" value="<?php echo $articl['articles_id']; ?>">
              <button type="submit" name="accept" class="btn-accept">Accepter</button>
            </form>
            <form method="POST" style="display:inline;">
              <input type="hidden" name="article_id" value="<?php echo $articl['articles_id']; ?>">
              <button type="submit" name="reject" class="btn-reject">Rejeter</button>
            </form>
          </td>
        </tr> 
        <?php } ?>
      </tbody>
    </table>
  </div>

  <div class="container_btns">
    <button class="btn-add" onclick="showAddForm2()">Ajouter une tag</button>

    

  </div>

  <div class="container">
    <h2>Tableau de Bord Admin</h2>
    <table>

      <thead>
        <tr>
          <th>Nom de la Tag</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>

        <?php 
        $Tag_list = $tags->read_tags();
        foreach($Tag_list as $tag_list){ ?>
        <tr>
          <td><?php echo $tag_list['tag_name'] ?></td>
          <td>
          <form action="" method="post">
          <input type="text" class="new_name" name="new_name">
          <button class="btn-update" name="btn_modify_tag" onclick="">Modifier</button>
          <input type="text" class="id" name="catgeorie_id" value="<?php echo $tag_list['tag_id'] ?>">
          </form>
          <form action="" method="post">
          <button class="btn-delete" name="btn_delete_tag"  value="delete">Supprimer</button>
          <input type="text" class="id" name="catgeorie_id" value="<?php echo $tag_list['tag_id'] ?>">
          </form>
          
          
          </td>
        </tr>
        <?php } ?>
      </tbody>
    </table>


  </div>



  <div class="container">
        <h1>Users Management</h1>
        <table>
            <thead>
                <tr>
                    <th>Profile</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Role</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
    <?php 
      $users_list = $user->get_all_users();
      foreach($users_list as $user_list){
    ?>
                  <tr>
                      <td><img src="<?php echo $user_list['image_profile'] ?>" alt="Profile" class="rounded-image"></td>
                      <td><?php echo $user_list['first_name'] ?></td>
                      <td><?php echo $user_list['last_name'] ?></td>
                      <td><?php echo $user_list['email'] ?></td>
                      <td><?php echo $user_list['phone'] ?></td>
                      <td><?php echo $user_list['role'] ?></td>
                      <td><form action="" method="post"><button class="ban-button" name="ban-button">Ban</button>
                      <input type="text" class="id" name="catgeorie_id" value="<?php echo $user_list['users_id'] ; ?>">
                    </form></td>
                  </tr>
                <?php } ?>
              </tbody>
        </table>
  </div>

  <div class="container">
        <h1>Users Management</h1>
        <table>
            <thead>
                <tr>
                    <th>Profile</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>comment</th>
                    <th>article</th>
                    <th>date de création</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
    <?php 
      $comments_list = $comments->read_comments();
      foreach($comments_list as $comment_list){
    ?>
                  <tr>
                      <td><img src="<?php echo $comment_list['image_profile'] ?>" alt="Profile" class="rounded-image"></td>
                      <td><?php echo $comment_list['first_name'] ?></td>
                      <td><?php echo $comment_list['last_name'] ?></td>
                      <td><?php echo $comment_list['comment_content'] ?></td>
                      <td><?php echo $comment_list['title'] ?></td>
                      <td><?php echo $comment_list['created_at'] ?></td>
                      <td><form action="" method="post"><button class="ban-button" name="delete_comment_btn">delete</button>
                      <input type="text" class="id" name="catgeorie_id" value="<?php echo $comment_list['comment_id'] ; ?>">
                    </form></td>
                  </tr>
                <?php } ?>
              </tbody>
        </table>
  </div>

  <script>
    function showAddForm() {
      document.getElementById('addForm').style.display = 'block';
      document.querySelector('.overlay').style.display = 'block';
    }

    function hideForms() {
      document.getElementById('addForm').style.display = 'none';
      document.querySelector('.overlay').style.display = 'none';
    }

    function showAddForm2() {
      document.getElementById('addForm2').style.display = 'block';
      document.querySelector('.overlay').style.display = 'block';
    }

    function hideForms2() {
      document.getElementById('addForm2').style.display = 'none';
      document.querySelector('.overlay').style.display = 'none';
    }
  </script>
</body>
</html>
      