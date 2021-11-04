<!DOCTYPE html>
<html>

<head>
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <link rel="icon" href="images/fevicon/fevicon.png" type="image/gif" />
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />

  <title>HandTime</title>


  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="css/bootstrap1.css" />

  <!-- fonts style -->
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">

  <!-- font awesome style -->
  <link href="css/font-awesome.min.css" rel="stylesheet" />

  <!-- Custom styles for this template -->
  <link href="css/style1.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="css/responsive.css" rel="stylesheet" />

</head>

<body>

  <div class="hero_area">
    <!-- header section strats -->
    <header class="header_section">
      <div class="container-fluid">
        <nav class="navbar navbar-expand-lg custom_nav-container ">
          <a class="navbar-brand" href="index.php">
            <span>
              HandTime
            </span>
          </a>

          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class=""> </span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav  ">
              <li class="nav-item active">
                <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="about.php"> About</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="product.php">Products</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="testimonial.php">Testimonial</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="contact.php">Contact Us</a>
              </li>
            </ul>
            <?php
              $sql = "select CONCAT(first_name, ' ', last_name) as hoten from user_info where email =  '$user_id'";
              $query = $conn->query($sql);
              $row = mysqli_fetch_array($query, MYSQLI_ASSOC);
                  if(!isset($_SESSION['login_user'])){
                echo '<div class="user_optio_box dropdown show">
                <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fa fa-user" aria-hidden="true"></i>
                  My Account
                  
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                  <a class="dropdown-item" href="login_form.php" data-toggle="modal" data-target="#exampleModalLong1">Login</a>
                  <a class="dropdown-item" href="register_form.php" data-toggle="modal" data-target="#exampleModalLong">Register</a>
                </div>
                <a href="cart.php">
                  <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                </a>

                </div>';
                    }else{
                      echo '<div class="user_optio_box dropdown show">
                <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="fa fa-user" aria-hidden="true"></i>   Hi
                '.$row['hoten'].'
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                  <a class="dropdown-item" href="login_form.php" data-toggle="modal" data-target="#exampleModalLong1">Login</a>
                  <a class="dropdown-item" href="logout.php">Logout</a>
                </div>
                <a href="cart.php">
                  <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                </a>

                </div>';
                    }

                ?>
            
          </div>
        </nav>
      </div>
    </header>