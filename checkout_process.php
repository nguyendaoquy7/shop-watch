<?php
	include 'session.php';
    $sql0 = "select * from user_info where email =  '$user_id'";
	$query0 = $conn->query($sql0);
	$row0 = mysqli_fetch_array($query0, MYSQLI_ASSOC);
	$userid = $row0['id'];

    if(isset($_POST['submit'])){
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $username = $_POST['username'];
        $email = $_POST['mobile'];
        $address = $_POST['address'];
        $total = $_POST['tongsanpham'];
        $tongtien = $_POST['tongtien'];

       $sql0 = "SELECT id from order_chitiet";
       $query1 = mysqli_query($conn, $sql0);
       if(mysqli_num_rows($query1) == 0){
           echo(mysqli_error($conn));
           $id = 1;
       }else if(mysqli_num_rows($query1) > 0){
           $sql1 = "SELECT MAX(id) AS max_val from order_chitiet";
           $query2 = mysqli_query($conn, $sql1);
           $row = mysqli_fetch_array($query2);
           $id = $row['max_val'];
           $id = $id + 1;
           echo(mysqli_error($conn));
       }

        $sql = "insert into order_chitiet(id, user_id, fname, lname, mobile, address, total_product, tongtien,trangthai) VALUES 
        ('$id', '$userid', '$fname', '$lname', '$email', '$address', '$total', ' $tongtien','NO') ";

        if ($conn->query($sql) === TRUE) {
            $i = 1;
            $id_prod = 0;
            $qty_prod = 0;
            $price_prod = 0;
            while($i <= $total){
                $str = (string)$i;
                
                $id_prod_+$str = $_POST['id_prod_'.$i];
                $id_prod = $id_prod_+$str;

                $qty_prod_+$str = $_POST['qty_prod_'.$i];
                $qty_prod = $qty_prod_+$str;

                $price_prod_+$str = $_POST['price_prod_'.$i];
                $price_prod = $price_prod_+$str;
                //echo $id_prod . ' ' . $qty_prod . ' ' . $price_prod;
                $sql1 = "INSERT INTO `order_sanpham`( `id_order`, `id_product`, `soluong`, `tongtien`) VALUES ('$id','$id_prod','$qty_prod','$price_prod')";
                if ($conn->query($sql1) === TRUE) 
                {
                    $sql2 = "delete from cart where user_id = $userid";
                    if ($conn->query($sql2) === TRUE) {
                       header("Location: index.php");
                       
                    }
                    else {
                        echo "Error updating 1 record: " . $conn->error;
                    }
                }
               
                else 
                {
                   echo "Error updating  2 record: " . $conn->error;
                }
                $i++;
            }
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
      mysqli_close($conn);
?>