<?php 
  include 'session.php' ;

  include "register_form.php";
  include "login_form.php";

  $sql0 = "select * from user_info where email =  '$user_id'";
	$query0 = $conn->query($sql0);
	$row0 = mysqli_fetch_array($query0, MYSQLI_ASSOC);
	$userid = $row0['id'];

     $sql = "SELECT count(*) as id, quantity * price as total from cart, product WHERE cart.id_sanpham = product.id and user_id = $userid";
     $result = $conn->query($sql);  
     $row1 = mysqli_fetch_array($result,MYSQLI_ASSOC);
       
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Home</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
</head>
<body>
<div class="container">
		<?php include 'menu.php' ?>
<main>
    <div class="container wow fadeIn">

      <!-- Heading -->
      <h2 class="my-2 h2 text-center">Checkout form</h2>

      <!--Grid row-->
      <div class="row">
      <div class="col-md-4 mb-4">
       
       <!-- Heading -->
       <h4 class="d-flex justify-content-between align-items-center mb-3">
         <span class="text-muted">Your cart</span>
         <span class="badge badge-secondary badge-pill"></span>
       </h4>
       <ul class="list-group mb-3 z-depth-1">
       
       <?php
   $totalAll = 0;
         $sql = "SELECT cart.id as id, cart.id_sanpham as id_sanpham, img, nameproduct, price, quantity, quantity * price as total FROM cart, product WHERE cart.id_sanpham = product.id and user_id = $userid";
         $result = $conn->query($sql);

         if ($result->num_rows > 0) {
             while($row = $result->fetch_assoc()) {
                 echo '
                 <li class="list-group-item d-flex justify-content-between lh-condensed">
              <img src="./images/'.$row['img'].'" alt="" width="100px" height="100px">
                     <div>
                         <h6 class="my-0">'.$row["nameproduct"].'</h6>
                         <small class="text-muted">'.$row["price"].'</small>
                     </div>
                     <span class="text-muted">'.$row["total"].'</span>
                 </li>
                 ';
                 $totalAll = $totalAll + $row["total"].' $';
             }
         }
       ?>
         <li class="list-group-item d-flex justify-content-between">
           <span>Total (USD)</span>
           <strong><?php echo $totalAll;?></strong>
         </li>
       </ul>

     </div>
        <!--Grid column-->
        <div class="col-md-8 mb-4">

          <!--Card-->
          <div class="card">
            <form action="checkout_process.php" class="card-body" method="POST">
              <div class="row">
                <input type="hidden" id="" name="tongsanpham" class="form-control" placeholder="" value="<?php echo $row1['id']; ?>">
                <input type="hidden" id="" name="tongtien" class="form-control" placeholder="" value="<?php echo $totalAll; ?>">
                <?php  
                $i = 1;
                 $sql = "SELECT cart.id as id, cart.id_sanpham as id_sanpham, img, nameproduct, price, quantity, quantity * price as total FROM cart, product WHERE cart.id_sanpham = product.id and user_id = $userid";
                 $result = $conn->query($sql);
        
                 if ($result->num_rows > 0) {
                     while($row = $result->fetch_assoc()) {
                    
                    echo "
                    <input type='hidden' name='id_prod_$i' value='".$row['id_sanpham']."'>
                    <input type='hidden' name='qty_prod_$i' value='".$row['quantity']."'>
                    <input type='hidden' name='price_prod_$i' value='".$row['price']."'>
                    ";
                    $i++;
                     }
                  }

                ?>
                <!--Grid column-->
                <div class="col-md-6 mb-2">

                  <!--firstName-->
                  <div class="md-form ">
                    <input type="text" id="firstName" name="fname" class="form-control" placeholder="First Name">
                  </div>

                </div>
                <!--Grid column-->

                <!--Grid column-->
                <div class="col-md-6 mb-2">

                  <!--lastName-->
                  <div class="md-form">
                    <input type="text" id="lastName" name="lname" class="form-control"  placeholder="Last Name">
                  </div>

                </div>
                <!--Grid column-->

              </div>
              <!--Grid row-->

              <!--Username-->
              <div class="md-form input-group pl-0 mb-5">
                <input type="text" class="form-control py-0" name="username" placeholder="Username" aria-describedby="basic-addon1">
              </div>

              <!--email-->
              <div class="md-form mb-5">
                <input type="text" id="email" class="form-control" name="mobile" placeholder="phone-012345678">
              </div>

              <!--address-->
              <div class="md-form mb-5">
                <input type="text" id="address" class="form-control" name="address" placeholder="Hòa Quý - Ngũ Hành Sơn - Đà Nẵng">
              </div>
             
              <hr class="mb-4">
              <button class="btn btn-primary btn-lg btn-block" type="submit" name="submit">Checkout</button>

            </form>

          </div>
          <!--/.Card-->

        </div>
        <!--Grid column-->

        <!--Grid column-->
 
        <!--Grid column-->

      </div>
      <!--Grid row-->

    </div>
  </main>
  <?php include 'footer.php' ?>
  </div>
  <script src="./js/"></script>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>