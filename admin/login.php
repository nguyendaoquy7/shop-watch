<?php 
    include "../config.php";
    session_start();

    if(isset($_POST["submit"])){
      
    $email =mysqli_real_escape_string($conn,$_POST["email"]) ;
      $password = mysqli_real_escape_string($conn,$_POST["password"]);

      $sql = "SELECT  `email`, `password` FROM `admin_info` WHERE email = '$email' and password = '$password'";
      if ($conn->query($sql) == TRUE) {
        header("Location: index.php");
        $_SESSION['user_id']=$email;
    } else {
        echo "Error updating record: " . $conn->error;
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap1.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</head>
<body>
  <div class="container">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card card-signin my-5">
          <div class="card-body">
            <h5 class="card-title text-center">Admin Login</h5>
            <form class="form-signin" action="" method="POST">
              <div class="form-label-group">
                <input type="email"  name="email" id="inputEmail" class="form-control" placeholder="Email Address">
                <label for="inputEmail">Email address</label>
              </div>

              <div class="form-label-group">
                <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" >
                <label for="inputPassword">Password</label>
              </div>

              <div class="custom-control custom-checkbox mb-3">
                <input type="checkbox" class="custom-control-input" id="customCheck1">
                <label class="custom-control-label" for="customCheck1">Remember password</label>
              </div>
              <button class="btn btn-lg btn-primary btn-block text-uppercase" type="submit" name="submit">Sign in</button>
              <hr class="my-4">
          </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>