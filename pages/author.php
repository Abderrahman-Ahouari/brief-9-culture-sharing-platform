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
      <img src="<?php echo $user_info['image']; ?>" alt="Photo de l'utilisateur">
      <div class="profile-info">
        <h2><?php echo $user_info['first_name'] . $user_info['last_name']; ?></h2>
        <p>Email: <?php echo $user_info['email']; ?></p>
        <p>Téléphone: <?php echo $user_info['phone']; ?></p>
        <a href="add_article.php"><button class="creat_article">créer un article</button></a>
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
