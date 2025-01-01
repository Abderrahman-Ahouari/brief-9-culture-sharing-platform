<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SignIn</title>
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>
  <div class="form-container">
    <h2>Sign In</h2>
    <form action="#" method="post">
      <label for="first_name">First Name</label>
      <input type="text" id="first_name" name="first_name" placeholder="Enter your first name" required>

      <label for="last_name">Last Name</label>
      <input type="text" id="last_name" name="last_name" placeholder="Enter your last name" required>

      <label for="email">Email</label>
      <input type="email" id="email" name="email" placeholder="Enter your email" required>

      <label for="phone">Phone</label>
      <input type="tel" id="phone" name="phone" placeholder="Enter your phone number" required>

      <label for="password">Password</label>
      <input type="password" id="password" name="password" placeholder="Enter your password" required>

      <label for="role">Role</label>
      <select id="role" name="role" required>
        <option value="" disabled selected>Select your role</option>
        <option value="member">member</option>
        <option value="auteur">auteur</option>
      </select>

      <button type="submit">Sign In</button>
    </form>
    <div class="signup-link">
      <p>already have an account? <a href="#">Login</a></p>
    </div>
  </div>
</body>
</html>
