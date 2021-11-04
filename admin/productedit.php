

<?php
include("session.php");

$product_id=$_GET['id'];
$result=mysqli_query($conn,"select id,nameproduct,price,img from product where id='$product_id'");
list($product_id,$product_name,$price,$img)=mysqli_fetch_array($result);

if(isset($_POST['btn_text'])) 
{

$product_name=$_POST['nameproduct'];
$price=$_POST['price'];
mysqli_query($conn,"update product set nameproduct='$product_name', price='$price' where id='$product_id'");
header("location: productlist.php");
mysqli_close($conn);
}


if(isset($_POST['btn_file'])) 
{
$img=$_POST['img'];
mysqli_query($conn,"update product set img='$img' where id='$product_id'");
header("location: productlist.php");
mysqli_close($conn);
}
include "sidenav.php";
include "topheader.php";
?>
      <!-- End Navbar -->
      <div class="content">
        <div class="container-fluid">
          <form action="" method="post"  enctype="multipart/form-data">
          <div class="row">
          
                
         <div class="col-md-7">
            <div class="card">
              <div class="card-header card-header-primary">
                <h5 class="title">Edit Product</h5>
              </div>
              <div class="card-body">
                
                  <div class="row">
                    
                  <div class="container-fluid">
          <form action="" method="post"  enctype="multipart/form-data">
          <div class="col-md-12">
            <div class="">
                <div class="d-flex justify-content-between align-items-center">
                </div>
                <div class="row ">
                    <div class="col-md-12"><label class="labels">ProductName</label><input type="text" class="form-control" placeholder="nameproduct " value="<?php echo $product_name?>" name="nameproduct"></div>
                    <div class="col-md-12"><label class="labels">Price</label><input type="text" class="form-control" placeholder="price " value= "<?php echo $price?>" name="price"></div>
                </div>
                <div class=" text-center"><button class="btn btn-primary profile-button" type="submit" name="btn_text">Update</button></div>
            </div>
        </div>
              </div>
              </div>
              
            </div>
          </div>
        </div>
         </form>
        </div>
        <div class="container-fluid">
          <form action="" method="post"  enctype="multipart/form-data">
          <div class="row">
          
                
         <div class="col-md-7">
            <div class="card">
              <div class="card-header card-header-primary">
                <h5 class="title">Edit Product</h5>
              </div>
              <div class="card-body">
                
                  <div class="row">
                    
                  <div class="container-fluid">
          <form action="" method="post"  enctype="multipart/form-data">
          <div class="col-md-12">
            <div class="">
                <div class="d-flex justify-content-between align-items-center">
                </div>
                <div class="row ">
                    <div class="col-md-12"><label class="labels">Image</label><input type="file" class="form-control" placeholder="image " value="'$img'" name="img"></div>
                </div>
                <div class=" text-center"><button class="btn btn-primary profile-button" type="submit" name="btn_file">Update</button></div>
            </div>
        </div>
              </div>
              </div>
              
            </div>
          </div>
        </div>
         </form>
          
        </div>
      </div>
      <?php
include "footer.php";
?>