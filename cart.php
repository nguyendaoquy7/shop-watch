<?php
	include 'session.php';

	include "register_form.php";
	include "login_form.php";

	$sql0 = "select * from user_info where email =  '$user_id'";
	$query0 = $conn->query($sql0);
	$row0 = mysqli_fetch_array($query0, MYSQLI_ASSOC);
	$userid = $row0['id'];

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
</head>
<body>
	<div class="container">
	<?php include 'menu.php' ?>
	<br>
		<div class="row">
			<div class="col-sm-6">
				<h4>Giỏ hàng</h4>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-9">
			
					<?php
					 
						$totalAll = 0;
						$sql = "SELECT cart.id as id, cart.id_sanpham as id_sanpham, img, nameproduct, price, quantity, quantity * price as total FROM cart, product WHERE cart.id_sanpham = product.id and user_id = $userid";
						$result = $conn->query($sql);

						if ($result->num_rows > 0) {
						  // output data of each row
						  while($row = $result->fetch_assoc()) {
						    echo '
						    	<div class="row mb-4">
						            <div class="col-md-5 col-lg-3 col-xl-3">
						              <div class="view zoom overlay z-depth-1 rounded mb-3 mb-md-0">
						                <a href="view.php?id='.$row['id_sanpham'].' ">
						                  <div class="mask waves-effect waves-light">
						                    <img class="img-fluid w-100" src="./images/'.$row["img"].'"">
						                    <div class="mask rgba-black-slight waves-effect waves-light"></div>
						                  </div>
						                </a>
						            </div>
					            </div>
					            <div class="col-md-7 col-lg-9 col-xl-9">
					              	<div>
					                	<div class="d-flex justify-content-between">
					                  		<div>
											  	<a href="view.php?id='.$row['id_sanpham'].' ">
							                    	<h5>'.$row["nameproduct"].'</h5>
												</a>
							                    <p class="mb-3 text-muted text-uppercase small">Giá : '.$row["price"].' $</p>
							                    <p class="mb-3 text-muted text-uppercase small">Số lượng : '.$row["quantity"].'</p>
							                </div>
											<div>
											<div class="def-number-input number-input safari_only mb-0 w-100">
												<form action="update.php?id='.$row['id_sanpham'].' " method="post">
													<input class="mr-2" min="0" name="quantity" value="'.$row["quantity"].'" type="number">
													<button class="btn btn-primary float-right" name="submit">Cập nhật</button>
												</form>
											</div>
											<small id="passwordHelpBlock" class="form-text text-muted text-center">(Lưu ý 1 sản phẩm)</small>
										</div>
							        </div>
							        <div class="d-flex justify-content-between align-items-center">
							            <div>
								            <a href="delete.php?id='.$row['id'].'" type="button" class="card-link-secondary small text-uppercase mr-3"><i class="fas fa-trash-alt mr-1"></i> Remove item </a>
								        </div>
					                  	<p class="mb-0"><span><strong>Tổng : '.$row["total"].' $</strong></span></p>
					                </div>
									
					              	</div>
					            </div>
					          </div>
								<hr class="mb-4">
						    ';
							
							$totalAll = $totalAll + $row["total"];
							
						  }
						 
						} else {
						  echo "0 results";
						}

						
					echo '<div class="row mb-4">
									<div class="col sm-6">
										<h5>Tổng tất cả : </h5>
									</div>
									<div class="col-sm-6">
										<h5 class="float-right">'.$totalAll.'</h5>
									</div>
								</div>
								<form action="checkout.php" method="post">';
								$result1 = $conn->query($sql);

								if ($result1->num_rows > 0) {
								  // output data of each row
								  while($row = $result1->fetch_assoc()) {
							echo'
							<input type="hidden" name="total_count" value="10">
							<input type="hidden" name="item_name" value="10">

						';
						}
					}
					echo '
					<button type="submit" class="btn btn-primary float-right" name="submit">Thanh Toán</button>
								</form>
					';
				
										
				$conn->close();
					?>
			</div>
		</div>
		<br>
		<?php include 'footer.php' ?>
	</div>
</body>
</html>