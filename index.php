
<!DOCTYPE html>
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>LOGIN</title>
	<link rel="stylesheet" href="css/index_css.css">
</head>

<body>

  <h2>Login Form</h2>

  <form action="index_proses.php" method="post">
    <div class="imgcontainer">
      <img src="img/img_avatar2.png" alt="Avatar" class="avatar">
    </div>

    <div class="container">
      <p><label>User ID</label> <input type="text" name="userid"></p>
      <p><label>Password</label> <input type="password" name="password"></p>
      <p><button type="submit" name="login" value="login">Login</button></p>


    </div>
    <a href="register.php">regis</a>

  </form>

</body>

</html>