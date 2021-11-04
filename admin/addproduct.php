  <?php
include("session.php");


if(isset($_POST["btn_save"]))
{
$product_name=$_POST["product_name"];
$price=$_POST['price'];

//picture coding
$picture_name=$_FILES['picture']['name'];
$picture_type=$_FILES['picture']['type'];
$picture_tmp_name=$_FILES['picture']['tmp_name'];
$picture_size=$_FILES['picture']['size'];

if($picture_type=="img/jpeg" || $picture_type=="img/jpg" || $picture_type=="img/png" || $picture_type=="img/gif")
{
  $picture_name=time()."_".$picture_name;
  move_uploaded_file($picture_tmp_name,"../images/".$picture_name);
	
		

}
$sql = "insert into product(nameproduct, price, img) values ('$product_name',$price,'$picture_name')";
if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

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
                <h4 class="card-title">Add Product</h4>
              </div>
              <div class="card-body">
                
                  <div class="row">
                    
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Product Title</label>
                        <input type="text" id="product_name" required name="product_name" class="form-control">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="">
                        <label for="">Add Image</label>
                        <input type="file" name="picture" required class="btn btn-fill btn-success" id="picture" >
                      </div>
                    </div>
                  
                    <div class="col-md-12">
                      <div class="form-group">
                        <label>Pricing</label>
                        <input type="text" id="price" name="price" required class="form-control" >
                      </div>
                    </div>
                  </div>
                
                <div class="card-footer">
                  <button type="submit" id="btn_save" name="btn_save"  class="btn btn-fill btn-primary">Update Product</button>
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