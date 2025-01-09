<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Détails de l'Article</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      margin: 0;
      padding: 0;
    }

    .container {
      max-width: 800px;
      margin: 20px auto;
      padding: 20px;
      background-color: white;
      border-radius: 15px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    h1 {
      text-align: center;
      color: #B87333;
      margin-bottom: 20px;
    }

    .article-image {
      display: block;
      margin: 0 auto 20px;
      width: 100%;
      max-width: 600px;
      border-radius: 15px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .article-text {
      font-size: 16px;
      line-height: 1.6;
      color: #333;
      margin-bottom: 20px;
      text-align: justify;
    }

    .category {
      font-size: 14px;
      font-weight: bold;
      color: #FF7F50;
      text-align: center;
      margin-bottom: 30px;
      padding: 5px 10px;
      background-color: #FFF2E5;
      border-radius: 15px;
      display: inline-block;
    }

    .like-button {
      display: inline-block;
      margin-top: 10px;
      padding: 5px 15px;
      font-size: 14px;
      font-weight: bold;
      color: white;
      background-color: #3498db;
      border: none;
      border-radius: 15px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    .like-button:hover {
      background-color: #2980b9;
    }

    .comments-section {
      margin-top: 30px;
    }

    .comments-section h2 {
      font-size: 18px;
      color: #B87333;
      margin-bottom: 20px;
    }

    .comment-form {
      display: flex;
      flex-direction: column;
      gap: 10px;
      margin-bottom: 30px;
    }

    .comment-form textarea {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 15px;
      font-size: 14px;
    }

    .comment-form button {
      align-self: flex-start;
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

    .comment-form button:hover {
      background-color: #B87333;
    }

    .comment {
      margin-bottom: 20px;
      padding: 15px;
      background-color: #f9f9f9;
      border-radius: 15px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      display: flex;
      flex-direction: column;
    }

    .comment-header {
      display: flex;
      align-items: center;
      margin-bottom: 10px;
    }

    .comment-header img {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      margin-right: 10px;
    }

    .comment-header .username {
      font-weight: bold;
      color: #333;
    }

    .comment-text {
      font-size: 14px;
      line-height: 1.5;
      color: #333;
      margin-bottom: 10px;
    }

    .comment-date {
      font-size: 12px;
      color: #999;
      text-align: right;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Titre de l'Article</h1>
    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQIHapIeCiwS7x6LmNiUMsGcyA3R8dgs-nSdQ&s" alt="Image de l'article" class="article-image">
    <div class="article-text">
      Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam vel enim nec urna congue accumsan. 
      Curabitur vel purus nec justo tempor mollis. Praesent vel magna quis turpis dignissim consectetur.
      Lorem ipsum dolor sit amet consectetur adipisicing elit. Doloremque dicta similique accusamus magni voluptates laboriosam adipisci eum ipsam quia blanditiis? Laborum explicabo vitae blanditiis ad, ratione nihil alias ducimus aut?
      Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime autem illum provident error magni ut cupiditate quae delectus dignissimos, hic, ipsam odio sapiente facere voluptates? Debitis quod eaque necessitatibus modi.    
    </div>
    <div class="category">Technologie</div>
    <button class="like-button">J'aime</button>

    <div class="comments-section">
      <h2>Commentaires</h2>
      <form class="comment-form">
        <textarea rows="4" placeholder="Écrivez un commentaire..." required></textarea>
        <button type="submit">Soumettre</button>
      </form>

      <div class="comment">
        <div class="comment-header">
          <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQIHapIeCiwS7x6LmNiUMsGcyA3R8dgs-nSdQ&s" alt="Profil">
          <span class="username">Utilisateur 1</span>
        </div>
        <div class="comment-text">Très bon article, merci pour ces informations!</div>
        <div class="comment-date">Publié le : 31 décembre 2024</div>
      </div>

      <div class="comment">
        <div class="comment-header">
          <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQIHapIeCiwS7x6LmNiUMsGcyA3R8dgs-nSdQ&s" alt="Profil">
          <span class="username">Utilisateur 2</span>
        </div>
        <div class="comment-text">J'ai appris beaucoup de nouvelles choses grâce à cet article.</div>
        <div class="comment-date">Publié le : 30 décembre 2024</div>
      </div>
    </div>
  </div>
</body>
</html>
