<?php
include_once('../config.php');
if(isset($_REQUEST['id']) and $_REQUEST['id']!=""){
$product_id=$_GET['id'];
$sql = "DELETE FROM product WHERE id='$product_id'";
if ($conn->query($sql) === TRUE) {
echo "Xoá thành công!";
	header("location: productlist.php");
} else {
echo "Error updating record: " . $conn->error;
}
 
$conn->close();
}
?>