<?php
require_once "./config.php";

session_start();

// if (empty($_SESSION['login'] && $_SESSION['login'] !== true)) {
//  header("location:login.php");
// }

if(empty($_SESSION['id'])){
  header("Location:login.php");
}

if (isset($_POST['submit'])) {
  $list = $_POST['todoList'];
  $user_id = $_SESSION['id'];

  $insert = "INSERT INTO todo(list,user_id)VALUES('$list','$user_id')";

  if (mysqli_query($link, $insert)) {
    echo "todo added successfully";
  } else {
    echo "todo not added";
  }
}

if (isset($_GET['delete'])) {
  $id = $_GET['id'];

  $delete = "DELETE FROM todo WHERE id = '$id' ";

  if (mysqli_query($link, $delete)) {
    header("Location: index.php");
  } else {
    echo "data not deleted";
  }
}


?>

<!doctype html>
<html lang="en">

<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Bootstrap demo</title>
<?php include("./includes/header.php") ?>
</head>

<body>

<!-- navbar -->
<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
 
      <form class="d-flex justify-content-end w-100" role="search">
        <button class="btn btn-outline-success mx-3" type="submit">Logout</button>
        <button class="btn btn-outline-info mx-3" type="submit">Log in</button>
      </form>
  </div>
</nav>

  <div class="container mt-3">
    <div class="row d-flex justify-content-center align-items-center">
      <div class="col-sm-12 col-md-4">
        <div class="card">
          <div class="card-body">
            <form class="d-flex align-items-center justify-content-between" action="" method="post">
              <div class="form-floating mb-3">
                <input type="text" class="form-control" name="todoList" id="floatingInput" placeholder="name@example.com">
                <label for="floatingInput">Todo</label>
              </div>
              <button type="submit" name="submit" value="submit" class="btn btn-warning">Add</button>
            </form>

            <div>

              <ol>

                <?php
                $uid =   $user_id = $_SESSION['id'];
                $select = "SELECT * FROM todo WHERE user_id = $uid";

                if ($result = mysqli_query($link, $select)) {
                  if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_array($result)) { ?>

                      <div class="d-flex align-items-center justify-content-between my-2">
                        <li><?php echo $row['list'] ?></li>
                        <form action="" method="get">
                          <input type="text" name="id" value="<?php echo $row['id'] ?>" style="display: none;">
                          <button type="submit" name="delete" class="btn btn-danger" onclick="return confirm('Are you sure to delete this' )">Delete</button>

                        </form>
                      </div>


                <?php
                    }
                    mysqli_free_result($result);
                  } else {
                    echo "no data found";
                  }
                }



                ?>

              </ol>


            </div>
          </div>
        </div>
      </div>
    </div>
  </div>












  <?php include("./includes/footer.php") ?>

</body>

</html>