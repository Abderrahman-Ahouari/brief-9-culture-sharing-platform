<?php
    require('../classes/user_classe.php');
    require('../classes/connection.php');
  
     
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
 
    $user = new users;
    $user_id = $_SESSION['id'];

      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
          $user->Logout();
      }

?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profil de l'Auteur</title>
  <link rel="stylesheet" href="../css/author.css">

 <style>
              body {
              font-family: Arial, sans-serif;
              background-color: #f4f4f4;
              margin: 0;
              padding: 0;
            }

            .container {
              max-width: 1200px;
              margin: 0 auto;
              padding: 20px;
            }

            .profile {
              display: flex;
              align-items: center;
              background-color: white;
              border-radius: 15px;
              padding: 20px;
              box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
              margin-bottom: 20px;
            }

            .profile img {
              width: 100px;
              height: 100px;
              border-radius: 50%;
              margin-right: 20px;
              object-fit: cover;
            }

            .profile-info {
              color: #333;
            }

            .profile-info h2 {
              margin: 0;
              font-size: 24px;
              color: #B87333;
            }

            .profile-info p {
              margin: 5px 0;
              font-size: 16px;
            }

            .articles {
              display: grid;
              grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
              gap: 20px;
            }

            .card {
              background-color: white;
              border-radius: 15px;
              box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
              padding: 20px;
              display: flex;
              flex-direction: column;
              justify-content: space-between;
            }

            .card h3 {
              margin: 0;
              font-size: 20px;
              color: #B87333;
            }

            .card p {
              margin: 10px 0;
              font-size: 14px;
              color: #333;
            }

            .card button {
              align-self: flex-start;
              padding: 10px 15px;
              font-size: 14px;
              color: white;
              background-color: #FF7F50;
              border: none;
              border-radius: 15px;
              cursor: default;
            }

            .filter_bar{
                margin-top: 20px;
                margin-bottom: 20px;
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

            .creat_article{
              align-self: flex-start;
              padding: 10px 15px;
              font-size: 14px;
              color: white;
              background-color: #FF7F50;
              border: none;
              border-radius: 15px;
              cursor: default;
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
    .btn_add{
      padding: 10px 20px;
      background-color: #FF7F50;
      color: white;
      font-size: 14px;
      border: none;
      border-radius: 15px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }
            @media (max-width: 768px) {
              .profile {
                flex-direction: column;
                text-align: center;
              }

              .profile img {
                margin-bottom: 15px;
              }

              .profile-info h2 {
                font-size: 20px;
              }
            }

 </style>
<style>
        /* Table Styles */
    .articles-section {
      margin: 20px auto;
      padding: 20px;
      background-color: white;
      border-radius: 15px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .articles-table {
      width: 100%;
      border-collapse: collapse;
      font-family: Arial, sans-serif;
      font-size: 16px;
      color: #333;
    }

    .articles-table th, .articles-table td {
      padding: 12px 15px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }

    .articles-table tr:nth-child(even) {
      background-color: #f9f9f9;
    }

    .articles-table tr:hover {
      background-color: #f1f1f1;
    }

    .articles-table th {
      background-color: #FF7F50;
      color: white;
      text-transform: uppercase;
      letter-spacing: 1px;
    }

    .articles-table td {
      vertical-align: top;
    }

    .btn-modify, .btn-delete {
      padding: 5px 10px;
      font-size: 14px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    .btn-modify {
      background-color: #FF7F50;
      color: white;
    }

    .btn-delete {
      background-color: #D9534F;
      color: white;
    }

    /* Popup Styles */
    .popup-container {
      display: none;
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.6);
      z-index: 1000;
      justify-content: center;
      align-items: center;
    }

    .popup-content {
      background-color: white;
      padding: 20px;
      border-radius: 10px;
      width: 400px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
      position: relative;
    }

    .popup-content h3 {
      margin-top: 0;
      color: #333;
    }

    .popup-content label {
      display: block;
      margin-bottom: 5px;
      color: #555;
    }

    .popup-content input, .popup-content textarea {
      width: 100%;
      padding: 10px;
      margin-bottom: 15px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    .popup-content .btn-submit {
      background-color: #FF7F50;
      color: white;
      padding: 10px 15px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    .popup-content .close-popup {
      position: absolute;
      top: 10px;
      right: 15px;
      font-size: 20px;
      font-weight: bold;
      cursor: pointer;
      color: #333;
    }

</style>
</head>
<body>
<div class="container_btns">
    <form method="post">
     <button class="btn-logout" name="logout">Logout</button>
    </form>
    

  </div>
  <div class="container">
    <!-- Profile Section -->
     <?php  
       $user_info = $user->get_user_info($user_id);
     ?>
    <div class="profile">
      <img src="<?php echo $user_info['image_profile']; ?>" alt="Photo de l'utilisateur">
      <div class="profile-info">
        <h2><?php echo $user_info['first_name'] . $user_info['last_name']; ?></h2>
        <p>Email: <?php echo $user_info['email']; ?></p>
        <p>Téléphone: <?php echo $user_info['phone']; ?></p>
        <a href="add_article.php"><button class="creat_article">créer un article</button></a>
      </div>

    </div>


  </div>

  <div class="container">
  <table class="articles-table">
    <thead>
      <tr>
        <th>Titre</th>
        <th>Description</th>
        <th>Date de Création</th>
        <th>Statut</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      <!-- Example row, replace with PHP -->
      <tr>
        <td>Exemple Titre</td>
        <td>Exemple de description courte</td>
        <td>2025-01-09</td>
        <td>Publié</td>
        <td>
          <!-- Hidden input for ID -->
          <input type="hidden" class="article-id" value="1">
          <button class="btn-modify" onclick="openPopup(this)">Modifier</button>
          <button class="btn-delete" >Supprimer</button>
        </td>
      </tr>
      <!-- Add more rows dynamically with PHP -->
    </tbody>
  </table>
</div>

<!-- Popup Form for Editing -->
<div class="popup-container" id="popup-form">
  <div class="popup-content">
    <span class="close-popup" onclick="closePopup()">&times;</span>
    <h3>Modifier l'Article</h3>
    <form id="edit-article-form">
      <input type="hidden" name="article-id" id="popup-article-id">
      <div>
        <label for="popup-title">Titre</label>
        <input type="text" id="popup-title" name="title" required>
      </div>
      <div>
        <label for="popup-content">Contenu</label>
        <textarea id="popup-content" name="content" rows="5" required></textarea>
      </div>
      <div>
        <label for="popup-category">Catégorie</label>
        <input type="text" id="popup-category" name="category" required>
      </div>
      <button type="submit" class="btn-submit">Modifier</button>
    </form>
  </div>
</div>

<script>
        function openPopup(button) {
      const row = button.closest('tr');
      const articleId = row.querySelector('.article-id').value;
      const title = row.cells[0].textContent;
      const description = row.cells[1].textContent;
      const category = row.cells[3].textContent;

      document.getElementById('popup-article-id').value = articleId;
      document.getElementById('popup-title').value = title;
      document.getElementById('popup-content').value = description;
      document.getElementById('popup-category').value = category;

      document.getElementById('popup-form').style.display = 'flex';
    }

    function closePopup() {
      document.getElementById('popup-form').style.display = 'none';
    }

    function deleteArticle(button) {
      const row = button.closest('tr');
      const articleId = row.querySelector('.article-id').value;
      if (confirm("Êtes-vous sûr de vouloir supprimer cet article ?")) {
        // Handle the delete logic here (PHP or AJAX call)
        console.log("Suppression de l'article avec ID:", articleId);
        row.remove(); // Remove the row from the table
      }
    }

</script>
</body>
</html>
