<?php
    include ("config.php");
    session_start();
    
    
    
    if(isset($_POST['signup_button'])){
        $f_name = $_POST['f_name'];
        $l_name = $_POST['l_name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $mobile = $_POST['mobile'];
        $address1 = $_POST['address1'];
        $address2 = $_POST['address2'];
        
        $sql="INSERT INTO `user_info`( `first_name`, `last_name`, `email`, `password`, `mobile`, `address1`, `address2`) VALUES ('$f_name','$l_name','$email','$password','$mobile','$address1','$address2')";
        if ($conn->query($sql) === TRUE) {
            header("location: index.php");
          } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
          }
    }

    
        if(isset($_POST['signin_button'])){

            $email =mysqli_real_escape_string($conn,$_POST['email']) ;
            $password = mysqli_real_escape_string($conn,$_POST['password']);

            $sql = "SELECT  `email`, `password` FROM `user_info` WHERE email = '$email' and password = '$password'";
            $result = mysqli_query($conn,$sql);
        //$row = mysqli_fetch_array($result,MYSQLI_ASSOC);
        
        $count = mysqli_num_rows($result);
        
        // If result matched $myusername and $mypassword, table row must be 1 row
            
        if($count == 1) {
            $_SESSION['login_user'] = $email;
            
            header("location: index.php");
            
        }else{echo "User hoặc password không đúng !";}
        }

?>