<?php

	include 'session.php';

    $id = $_GET['id'];

     $sql0 = "select * from user_info where email =  '$user_id'";
	$query0 = $conn->query($sql0);
	$row0 = mysqli_fetch_array($query0, MYSQLI_ASSOC);
	$iduser = $row0['id'];
    
    //echo $id;
	if(isset($_POST['submit'])){
		$quantity = $_POST['quantity'];
		$sql = "update cart set quantity = '$quantity' where id_sanpham = $id and user_id = $iduser";

		if ($conn->query($sql) === TRUE) {
            header("Location: cart.php");
        } else {
            echo "Error updating record: " . $conn->error;
        }
		echo  $quantity.$user_id.$iduser;
	}
?>
