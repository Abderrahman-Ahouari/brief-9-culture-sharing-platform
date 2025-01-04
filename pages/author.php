<?php

session_start();
if($_SESSION['role'] === "admin"){
  header("location: admin_dashboard.php");
}
elseif($_SESSION['role'] === "user"){
  header("location: home.php");
}
elseif(!$_SESSION['role']){
 header("location: signup.php");
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profil de l'Auteur</title>
  <link rel="stylesheet" href="../css/author.css">

</head>
<body>
  <div class="container">
    <!-- Profile Section -->
    <div class="profile">
      <img src="user-photo.jpg" alt="Photo de l'utilisateur">
      <div class="profile-info">
        <h2>Prénom Nom</h2>
        <p>Email: utilisateur@example.com</p>
        <p>Téléphone: 0123456789</p>
      </div>
    </div>

    <!-- Articles Section -->
    <div class="articles">
      <div class="card">
        <h3>Titre de l'Article 1</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vel eros ut urna.</p>
        <button>Catégorie</button>
      </div>
      <div class="card">
        <h3>Titre de l'Article 2</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vel eros ut urna.</p>
        <button>Catégorie</button>
      </div>
      <div class="card">
        <h3>Titre de l'Article 3</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vel eros ut urna.</p>
        <button>Catégorie</button>
      </div>
      <div class="card">
        <h3>Titre de l'Article 3</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vel eros ut urna.</p>
        <button>Catégorie</button>
      </div>  
      <div class="card">
        <h3>Titre de l'Article 3</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vel eros ut urna.</p>
        <button>Catégorie</button>
      </div>
      <div class="card">
        <h3>Titre de l'Article 3</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vel eros ut urna.</p>
        <button>Catégorie</button>
      </div>
      <div class="card">
        <h3>Titre de l'Article 3</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vel eros ut urna.</p>
        <button>Catégorie</button>
      </div>
      <div class="card">
        <h3>Titre de l'Article 3</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vel eros ut urna.</p>
        <button>Catégorie</button>
      </div>
      <div class="card">
        <h3>Titre de l'Article 3</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vel eros ut urna.</p>
        <button>Catégorie</button>
      </div>
      <div class="card">
        <h3>Titre de l'Article 3</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vel eros ut urna.</p>
        <button>Catégorie</button>
      </div>
      <div class="card">
        <h3>Titre de l'Article 3</h3>
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur vel eros ut urna.</p>
        <button>Catégorie</button>
      </div>

      <!-- Add more cards as needed -->
    </div>
  </div>
</body>
</html>
