<?php
	include 'session.php';

	$id = $_GET['id'];
    
	$sql = "delete from cart where id = $id";

	if ($conn->query($sql) === TRUE) {
        header("Location: cart.php");
    } else {
        echo "Error updating record: " . $conn->error;
	}

?>