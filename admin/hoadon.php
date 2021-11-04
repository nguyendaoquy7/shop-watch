
<?php
    include 'session.php';
    $num_per_page = 05;
    //echo $num_per_page. ' ' . $start_from;

include "sidenav.php";
include "topheader.php";
?>
      <!-- End Navbar -->
      <div class="content">
        <div class="container-fluid">
        
          <div class="row">
          
                
         <div class="col">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">Order Browsing</h4>
                </div>
                <div class="page-wrapper">
                                    <!-- Page-body start -->
                                    <div class="page-body">
                                        <div class="row result">
                                        <div class="col-sm-12">
                                        <?php
                                        include '../config.php';
                                        $mysqli = new mysqli('localhost', 'root', '', 'shopwatch');
                                        if (isset($_GET['page'])) {
                                            $page = $_GET['page'];
                                        }else{
                                            $page = 1;
                                        }

                                        $start_from = ($page - 1) * 05;

                                        if (isset($_GET['submit'])) {
                                            $sql = "SELECT order_chitiet.id as id, CONCAT(order_chitiet.fname, ' ', order_chitiet.lname) as nameuser,order_chitiet.mobile as mobile, order_chitiet.address as address, product.nameproduct as nameproduct,  count(order_sanpham.id) as soluong, order_chitiet.tongtien as tongtien, datetimea, trangthai
                                            FROM user_info, order_chitiet, order_sanpham, product
                                            WHERE user_info.id = order_chitiet.user_id 
                                   			and product.id = order_sanpham.id_product
                                    		and order_chitiet.id = order_sanpham.id_order 
                                            GROUP BY  order_chitiet.id
                                            ORDER BY order_chitiet.id DESC";
                                        }
                                        else{
                                            $sql = "SELECT order_chitiet.id as id, order_sanpham.id_order, order_sanpham.id_product, CONCAT(order_chitiet.fname, ' ', order_chitiet.lname) as nameuser,order_chitiet.mobile as mobile, order_chitiet.address as address, product.nameproduct as nameproduct,  count(order_sanpham.id) as soluong, order_chitiet.tongtien as tongtien, datetimea, trangthai
                                            FROM user_info, order_chitiet, order_sanpham, product
                                            WHERE user_info.id = order_chitiet.user_id 
                                   			and product.id = order_sanpham.id_product
                                    		and order_chitiet.id = order_sanpham.id_order
                                            GROUP BY  order_chitiet.id
                                            ORDER BY order_chitiet.id DESC LIMIT $num_per_page";
                                        }
                                    
                                        
                                        $query = mysqli_query($conn, $sql);
                                        if (mysqli_num_rows($query) > 0) {
                                            echo ' <table class="table">
                                                    <tr>
                                                        <th>T.Tin Khách Hàng</th>
                                                        <th>T.Tin Đơn Đặt Hàng</th>
                                                        <th>Tổng Tiền</th>
                                                        <th>Ngày Thanh Toán</th>
                                                        <th>Trạng Thái</th>
                                                    </tr>';
                                            while($row = $query->fetch_assoc()){
                                                $formattotal = number_format($row['tongtien']);
                                                ?>
                                        <tr>
                                            <td>
                                                <?php echo ($row['nameuser']) ?><br>
                                                <?php echo ($row['mobile']) ?><br>
                                                <?php echo ($row['address']) ?>
                                            </td>
                                            <td>
                                            <?php
                                            $id=$row['id'];   
                                            $mysql = "Select * from product, order_sanpham where product.id=order_sanpham.id_product and id_order = $id";
                                            $sqlquery = $mysqli->query($mysql);
                                            if($sqlquery->num_rows > 0){
                                                while($row1 = $sqlquery->fetch_assoc()){
                                                    ?>
                                                        <?php echo($row1['nameproduct']) ?><br>
                                                        <?php echo($row1['price']) ?><br>
                                                        <?php echo($row1['soluong']) ?><br>
                                                    <?php
                                                }
                                            }
                                            ?>
                                            </td>
                                            <td>
                                                <?php echo($row['tongtien']) ?>
                                            </td>
                                            <td>
                                                <?php echo($row['datetimea']) ?>
                                            </td>
                                            <td>
                                                <?php
                                                    if($row['trangthai'] == 'NO'){
                                                        echo '<a href="print.php?id_product='.$row['id_product'].'&id_order='.$row['id_order'].'" class="btn btn-danger">Duyệt ĐH</a>';
                                                    
                                                    }else{
                                                        echo '<td><button class="btn btn-success">Đã Duyệt</button></td>';
                                                    }

                                                    echo '</td>
                                                        </tr>
                                                            ';
                                            
                                                    }   
                                                    }else{
                                                    echo "<h5>Không có kết quả</h5>";
                                                    }   
                                                ?>
                                            </td>
                                        </tr>
                                                <?php

 

                                        echo "</table>";
                                            
                                        ?>

                                            </div>
                                        </div>
                                    </div>
                </div>
            </div>
        </div>    
        </div>
      </div>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/TableExport/3.3.5/js/tableexport.min.js"></script>
    <script type="text/javascript">
        function Export() {
            $("#tblCustomers").table2excel({
                filename: "ChiTietHoaDon.xls"
            });
        }
    </script>
      <?php
include "footer.php";

?>


