<?php
require_once "./config.php";

session_start();

if(!empty($_SESSION['id'])){
  header("Location:index.php");
}

if (isset($_POST["submit"])) {
  $username = $_POST["username"];
  $password = $_POST["password"];
  $result = mysqli_query($link, "SELECT * FROM users WHERE  username ='$username' OR email='$username' ");
  $row = mysqli_fetch_assoc($result);
  if (mysqli_num_rows($result) > 0) {
    if (password_verify($password, $row['password'])) {
      $_SESSION["login"] = true;
      $_SESSION["id"] = $row["id"];
      $_SESSION["username"] = $row["username"];
      header("Location: index.php");
    } else {
      echo
      "<script> alert('Wrong Password'); </script>";
    }
  } else {
    echo
    "<script> alert('User Not Registered'); </script>";
  }
}












?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  </head>
  <body>
    
    <div class="container mt-4">
        <div class="row">
            <div class="col-sm-12 col-md-4 d-block mx-auto">
              <form action="" method="post">
              <div class="card login-card p-4">
                    <!-- username -->
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" name="username"  id="floatingInput" placeholder="name@example.com">
                        <label for="floatingInput">Email address</label>
                      </div>
                      <!-- password -->
                      <div class="form-floating">
                        <input type="password" class="form-control" name="password" id="floatingPassword" placeholder="Password">
                        <label for="floatingPassword">Password</label>
                      </div>

                      <button type="submit" name="submit" class="btn btn-warning text-warning-emphasis mt-4">Login</button>
                      
                      <div class="d-flex justify-content-between mt-4">
                        <a href="./register.php" class="nav-link">Sign Up</a>
                        <a href="" class="nav-link">Forgotten Password</a>
                      </div>
                </div>
              </form>
            </div>
        </div>
    </div>

    

























    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>