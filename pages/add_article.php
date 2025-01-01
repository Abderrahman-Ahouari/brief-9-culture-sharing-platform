<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Ajouter un Article</title>
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>
  <div class="form-container">
    <h2>Ajouter un Article</h2>
    <form action="#" method="post">
      <label for="title">Titre</label>
      <input type="text" id="title" name="title" placeholder="Saisissez le titre de l'article" required>

      <label for="content">Contenu</label>
      <textarea id="content" name="content" rows="5" placeholder="Saisissez le contenu de l'article" required></textarea>

      <label for="category">Catégorie</label>
      <select id="category" name="category" required>
        <option value="" disabled selected>Choisissez une catégorie</option>
        <option value="technologie">Technologie</option>
        <option value="science">Science</option>
        <option value="art">Art</option>
        <option value="sport">Sport</option>
        <option value="autres">Autres</option>
      </select>

      <button type="submit">Publier</button>
    </form>
  </div>
</body>
</html>
