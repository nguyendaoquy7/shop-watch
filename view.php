<?php

	include 'session.php';


	$id = $_GET['id'];

	$sql0 = "select * from user_info where email =  '$user_id'";
	$query0 = $conn->query($sql0);
	$row0 = mysqli_fetch_array($query0, MYSQLI_ASSOC);
	$iduser = $row0['id'];


	//echo $iduser;
	

	$sql1 = mysqli_query( $conn ,"select * from cart where id_sanpham = $id ");
	$row1 = mysqli_fetch_array($sql1,MYSQLI_ASSOC);
	//echo $row1['id_sanpham'];

	if(isset($_POST['submit'])){
		$id_sanpham = $row1['id_sanpham'];

		if($id_sanpham == $id && $iduser == $row1['user_id'])
		{
			$quantity = $_POST['quantity'];
			$sql = "update cart set quantity = quantity + '$quantity' where id_sanpham = $id and user_id = $iduser";
	
			if ($conn->query($sql) === TRUE) 
			{
			   header("Location: cart.php");
			  // echo $id_sanpham;
		   	} 
			else 
			{
			   echo "Error updating 1 record: " . $conn->error;
		   	}
		}
		else
		{
			$quantity = $_POST['quantity'];
			$sql = "insert into cart(user_id, id_sanpham, quantity) values('$iduser' ,'$id' , '$quantity')";
	
			if ($conn->query($sql) === TRUE)
			{
				header("Location: cart.php");
				//echo $quantity;
			} 
			else 
			{
				echo "Error updating 2 record: " . $conn->error;
			}
		}
		
	}

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
		<div class="row">
			<div class="col-sm-9">
				<div class="row">
					<div class="col-12 col-lg-6">
						<?php 
						$sql = mysqli_query( $conn ,"select * from product where id = $id ");
						$row = mysqli_fetch_array($sql,MYSQLI_ASSOC);
						
						echo '<img src="./images/'.$row['img'].'" alt='.$row["nameproduct"].' width=300>'; ?>
					</div>
					<div class="col-12 col-lg-6">
						<div class="flex flex-column">
							<h2 class="text-success">  <?php echo $row["nameproduct"];  ?> </h2>
							<h5 class="flex text-danger">  <?php echo $row["price"];  ?> $</h5>
							<form action="" method="POST">
								<div class="form-group">
									<label for="">Số Lượng</label>
									<input type="number" name="quantity" value="1" min="1" max="23" placeholder="Quantity" required="">
								</div>
								<div class="form-group mt-2">
									<button type="submit" class="btn btn-outline-primary" name="submit">Add To Cart</button>
								</div>
							</form>
						</div>						
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-sm-12">
				<h1 class="text-center"><a href="">Nổi Bật </a></h1>
			</div>
		</div>
		<div class="row">
			<?php  include 'showproduct.php' ?>
		</div>
		<?php include 'footer.php' ?>
	</div>
	<?php  
	include "register_form.php";
	include "login_form.php";
	?>
	<script src="./js/"></script>
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>