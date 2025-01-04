<?php
      require('../classes/author.classe.php');
      require('../classes/connection.php');
      require('../classes/user_classe.php');
   
   session_start();
   if($_SESSION['role'] === "user"){
     header("location: home.php");
   }elseif($_SESSION['role'] === "author"){
     header("location: author.php");
   }
   echo $_SESSION['role'];    
   echo $_SESSION['id'];

   $categorie = new author;

   if($_SERVER['REQUEST_METHOD'] === 'POST'){
     if(isset($_POST['btn_add'])){
        $cate_name = $_POST['add_categorie'];
        $categorie->add_categorie($cate_name);
     }elseif(isset($_POST['btn_modify'])){
        
    }
    $categorie_list = $categorie->read_categorie();
    
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
      /* visibility: hidden; */
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
      position: absolute;
      top: 20px;
      right: 20px;
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
  </style>
</head>
<body>
  <div class="container">
    <h2>Tableau de Bord Admin</h2>
    <button class="btn-add" onclick="showAddForm()">Ajouter une Catégorie</button>
    <table>
      <thead>
        <tr>
          <th>Nom de la Catégorie</th>
          <th>Actions</th>
        </tr>
      </thead>
      <tbody>
        <?php while($categorie_list){ ?>
        <tr>
          <td><?php echo $categorie_list['name'] ?></td>
          <td class="id"><?php echo $categorie_list['id'] ?></td>
          <td>
            <button class="btn-update" onclick="showModifyForm()">Modifier</button>
            <button class="btn-delete">Supprimer</button>
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

  <!-- Modify Form -->
  <div class="hidden-form modify-form" id="modifyForm">
    <button class="btn-exit" onclick="hideForms()">X</button>
    <h3>Modifier une Catégorie</h3>
    <form method="post">
      <input type="text" placeholder="Nom de la Catégorie" required>
      <button type="submit" name="btn_modify">Modifier</button>
    </form>
  </div>

  <script>
    function showAddForm() {
      document.getElementById('addForm').style.display = 'block';
      document.querySelector('.overlay').style.display = 'block';
    }

    function showModifyForm() {
      document.getElementById('modifyForm').style.display = 'block';
      document.querySelector('.overlay').style.display = 'block';
    }

    function hideForms() {
      document.getElementById('addForm').style.display = 'none';
      document.getElementById('modifyForm').style.display = 'none';
      document.querySelector('.overlay').style.display = 'none';
    }
  </script>
</body>
</html>
      