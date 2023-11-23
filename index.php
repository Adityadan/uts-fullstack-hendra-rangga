
<!DOCTYPE html>
<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>LOGIN</title>
  <style>
    body {
      font-family: Arial, Helvetica, sans-serif;
    }

    form {
      border: 3px solid #f1f1f1;
    }

    input[type=text],
    input[type=password] {
      width: 100%;
      padding: 12px 20px;
      margin: 8px 0;
      display: inline-block;
      border: 1px solid #ccc;
      box-sizing: border-box;
    }

    button {
      background-color: yellowgreen;
      color: white;
      padding: 14px 20px;
      width: 100%;
      margin: 8px 0;
      cursor: pointer;
      border: none;
    }

    button:hover {
      opacity: 0.8;
    }

    .cancelbtn {
      width: auto;
      padding: 10px 18px;
      background-color: #f44336;
    }

    .imgcontainer {
      text-align: center;
      margin: 23px 0 13px 0;
    }

    img.avatar {
      width: 220px;
      height: auto;
      border-radius: 50%;
    }

    .container {
      padding: 16px;
    }

    span.psw {
      float: right;
      padding-top: 16px;
    }

    /* Change styles for span and cancel button on extra small screens */
    @media screen and (max-width: 300px) {
      span.psw {
        display: block;
        float: none;
      }

      .cancelbtn {
        width: 100%;
      }
    }
  </style>
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