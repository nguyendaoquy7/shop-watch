
<?php
include("session.php");
function build_calendar($month, $year) {

    $firstDayOfMonth = mktime(0,0,0,$month,1,$year);

    $dateComponents = getdate($firstDayOfMonth);


    $monthName = $dateComponents['month'];

    $datetoday = date('Y-m-d');
    $calendar = "<table class='table table-bordered'>";
    $calendar .= "<center><h2>$monthName $year</h2>";
    $calendar.= "<a class='btn btn-xs btn-primary' href='?month=".date('m', mktime(0, 0, 0, $month-1, 1, $year))."&year=".date('Y', mktime(0, 0, 0, $month-1, 1, $year))."'>Previous Month</a> ";
    
    $calendar.= " <a href='chitiethoadon.php' class='btn btn-xs btn-primary' data-month='".date('m')."' data-year='".date('Y')."'>Current Month</a> ";
    
    $calendar.= "<a href='?month=".date('m', mktime(0, 0, 0, $month+1, 1, $year))."&year=".date('Y', mktime(0, 0, 0, $month+1, 1, $year))."' class='btn btn-xs btn-primary'>Next Month</a></center><br>";
    
    $calendar .= "</table>";

    echo $calendar;
}
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
                    <h4 class="card-title">Statistical</h4>
                </div>
                    <div class="card-body">
                    
                        <div class="row">
                        <div class="col-sm-12">
                        <div class="row justify-content-center">
                            <div class="col-sm-6">
                                <?php 
                                    $dateComponents = getdate();
                                    if(isset($_GET['month']) && isset($_GET['year'])){
                                        $month = $_GET['month'];                 
                                        $year = $_GET['year'];
                                    }else{
                                        $month = $dateComponents['mon'];                 
                                        $year = $dateComponents['year'];
                                    }
                                    echo build_calendar($month,$year);

                                    $mysqli = new mysqli('localhost', 'root', '', 'shopwatch');
                                    $sqlprice = "select order_chitiet.id as id, CONCAT(order_chitiet.fname, ' ', order_chitiet.lname) as nameuser, user_info.mobile as mobile, order_chitiet.address as address, count(order_sanpham.id) as soluong, order_chitiet.tongtien as tongtien, datetimea
                                    from order_chitiet, user_info, product, order_sanpham 
                                    WHERE user_info.id = order_chitiet.user_id 
                                    and product.id = order_sanpham.id_product
                                    and order_chitiet.id = order_sanpham.id_order
                                    AND Month(datetimea) = $month 
                                    and year(datetimea) = $year
                                    GROUP BY  order_chitiet.id";                                           
                                                           
                                ?>
                            </div>
                        </div>
                    </div>
                                        
                                            <!-- task, page, download counter  start -->
                    <div class="col-sm-12">
                        <table class="table" id="tblCustomers">
                            <tr>
                                <th>Khách Hàng</th>
                                <th>Sản Phẩm </th>
                                <th>Tổng Tiền</th>
                                <th>Ngày Thanh Toán</th>
                                <th></th>
                            </tr>
                            <?php
                                $queryprice = $mysqli->query($sqlprice);
                                if($queryprice->num_rows > 0){
                                    while ($row = $queryprice->fetch_assoc()) {
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
                                                        <?php echo($row1['price']).' $' ?><br>
                                                        <?php echo($row1['soluong']) ?><br>
                                                    <?php
                                                }
                                            }
                                            ?>
                                            </td>
                                            <td>
                                                <?php echo($row['tongtien']).' $' ?>
                                            </td>
                                            <td>
                                                <?php echo($row['datetimea']) ?>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                }
                            ?>
                                                
                                <td colspan="2"><b class="text-danger">Tổng : </b></td>
                                <td>
                                    <b class="text-danger">
                                        <?php 
                                            $sqlprice = "SELECT YEAR(datetimea), MONTH(datetimea) as month, SUM(tongtien) as total FROM `order_chitiet`
                                            where MONTH(datetimea) = $month
                                            AND YEAR(datetimea) = $year
                                            GROUP BY YEAR(datetimea), MONTH(datetimea)";

                                            $queryprice = $mysqli->query($sqlprice);
                                            $rowprice = mysqli_fetch_assoc($queryprice);
                                            $total =  isset($rowprice['total']) ? $rowprice['total'] : 0;
                                            echo number_format($total).' $';
                                        ?>
                                    </b>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
          
        </div>
      </div>
      <?php
include "footer.php";

?>


