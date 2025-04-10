<?php
require_once "./config.php";


if (isset($_POST['submit'])) {

  // data from user
  $username =  $_POST['username'];
  $email = $_POST['email'];
  $password = $_POST['password'];
  $reEnterPassword = $_POST['re-enterpassword'];
  $encryptedPassword = password_hash($password,PASSWORD_DEFAULT);
  $checkUser = mysqli_query($link, "SELECT * FROM users WHERE email = '$email'");

  // used to check the user exists 
  if (mysqli_num_rows(($checkUser)) > 0) {
    echo "<script>alert('Email Already Registered')</script>";
  }else{
    // password validation
    if($password === $reEnterPassword){
      $query = "INSERT INTO users(username, email,password) VALUES('$username','$email','$encryptedPassword')";
      
      // used to insert the data and redirect
      if(mysqli_query($link, $query)){
        echo "<script>alert('Registered Successfully')</script>";
        header("refresh:4; url=login.php");
      }else{
        echo "<script>alert('Failed to register')</script>";
      }
    }else{
      echo "<script>alert('Password doesnt match')</script>";
    }
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
        <div class="card login-card p-4">
          <form action="" method="post">
            <!-- username -->
            <div class="form-floating mb-3">
              <input type="text" class="form-control" id="floatingInput" name="username" placeholder="name">
              <label for="floatingInput">Enter your name</label>
            </div>
            <!-- username -->
            <div class="form-floating mb-3">
              <input type="email" class="form-control" id="floatingInput" name="email" placeholder="name@example.com">
              <label for="floatingInput">Email address</label>
            </div>
            <!-- password -->
            <div class="form-floating mb-3">
              <input type="password" class="form-control" id="floatingPassword" name="password" placeholder="Password">
              <label for="floatingPassword">Password</label>
            </div>

            <!-- re-password -->
            <div class="form-floating mb-3">
              <input type="password" class="form-control" id="floatingPassword" name="re-enterpassword" placeholder="Re-Password">
              <label for="floatingPassword">Re-Password</label>
            </div>
            <button type="submit" name="submit" value="submit" class="btn btn-warning text-warning-emphasis mt-4">Register</button>
          </form>
          <div class="d-flex justify-content-between mt-4">
            <a href="" class="nav-link">Login</a>

          </div>
        </div>
      </div>
    </div>
  </div>




























  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>