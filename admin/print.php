<?php  
    $id_chitiet=$_REQUEST['id_order'];
    include "../config.php";
    $sql0= "UPDATE `order_chitiet` SET `trangthai`='YES' WHERE id='$id_chitiet'";
    
    if ($conn->query($sql0) === TRUE) {
      } else {
        echo "Error updating record: " . $conn->error;
      }
      
?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>HÓA ĐƠN</title>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script type="text/javascript">
        $("#btnPrint").live("click", function () {
            var divContents = $("#dvContainer").html();
            var printWindow = window.open('', '', 'height=400,width=800');
            printWindow.document.write('<html><head><title>HandTime-Shop</title>');
            printWindow.document.write('</head><body >');
            printWindow.document.write(divContents);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
        });
    </script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
</head>
<body>
    <form id="form1">
        <div class="row justify-content-center">
            <div id="dvContainer" class="col-sm-9">
                <div class="text-center">
                    <h2>HÓA ĐƠN THANH TOÁN</h2>
                <br/>
                -------oOo-------
                </div>
                <div class="col-sm-12" >
                    <?php 
                        $id_sanpham=$_REQUEST['id_product'];
                        $id_chitiet=$_REQUEST['id_order'];
                        $mysqli = new mysqli('localhost', 'root', '', 'shopwatch');
                        $sqlprice = "select order_chitiet.id as id, CONCAT(user_info.first_name, ' ', user_info.last_name) as nameuser,user_info.mobile as mobile, order_chitiet.address as address, product.nameproduct as nameproduct, count(order_sanpham.id) as soluong, order_chitiet.tongtien as tongtien
                        from order_chitiet, user_info, product, order_sanpham 
                        WHERE user_info.id = order_chitiet.user_id 
                        and product.id = order_sanpham.id_product
                        and order_chitiet.id = order_sanpham.id_order
                        and id_order='$id_chitiet'
                        and id_product='$id_sanpham'
                        GROUP BY  order_chitiet.id";                                                                                                      
                    ?>
                </div>

                <table class="table" id="tblCustomers" border="1">
                <tr>
                    <th>Tên Khách Hàng</th>
                    <th>Số Điện Thoại</th>
                    <th>Địa Chỉ</th>
                    <th>Sản Phẩm </th>
                    <th>Giá Tiền</th>
                    <th>Số Lượng</th>
                    <th>Tổng Tiền</th>
                </tr>
                    <?php
                        $queryprice = $mysqli->query($sqlprice);
                            if($queryprice->num_rows > 0){
                            while ($row = $queryprice->fetch_assoc()) {
                    ?>
                <tr>
                    <td><?php echo ($row['nameuser']) ?></td>
                    <td><?php echo ($row['mobile']) ?></td>
                    <td><?php echo ($row['address']) ?></td>
                    <td>
                    <?php
                        $id=$row['id'];   
                        $mysql = "Select * from product, order_sanpham where product.id=order_sanpham.id_product and id_order = $id";
                        $sqlquery = $mysqli->query($mysql);
                        if($sqlquery->num_rows > 0){
                        while($row1 = $sqlquery->fetch_assoc()){
                    ?>
                    <?php echo($row1['nameproduct']) ?><br>
                    <?php
                            }
                        }
                    ?>
                    </td>
                    <td>
                    <?php
                        $id=$row['id'];   
                        $mysql = "Select * from product, order_sanpham where product.id=order_sanpham.id_product and id_order = $id";
                        $sqlquery = $mysqli->query($mysql);
                        if($sqlquery->num_rows > 0){
                        while($row1 = $sqlquery->fetch_assoc()){
                    ?>
                    <?php echo($row1['price']).' $' ?><br>
                    <?php
                            }
                        }
                   ?>
                    </td>
                    <td>
                    <?php
                        $id=$row['id'];   
                        $mysql = "Select * from product, order_sanpham where product.id=order_sanpham.id_product and id_order = $id";
                        $sqlquery = $mysqli->query($mysql);
                        if($sqlquery->num_rows > 0){
                            while($row1 = $sqlquery->fetch_assoc()){
                    ?>
                    <?php echo($row1['soluong']) ?><br>
                    <?php
                            }
                        }
                    ?>
                    </td>
                    <td>
                        <?php echo($row['tongtien']).' $' ?>
                    </td>
                    </tr>       
                       <?php
                                }
                            }
                        ?>                       
                    <td colspan="6"><b class="text-danger">Tổng Cộng : </b></td>
                    <td>
                        <b class="text-danger">
                            <?php 
                                $id_chitiet=$_REQUEST['id_order'];
                                $sqlprice = "SELECT  tongtien as total FROM `order_chitiet` where id='$id_chitiet'";
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
            <div class="row">
                <div class="col-sm-6">
                     <input type="button" value="Print Bills" id="btnPrint" />
                </div>
            </div>
    </div>
    </form>
</body>
</html>

