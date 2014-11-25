<?php
include 'src/class/ManageCar.php';
$objcar = new ManageCar();
if (@$_GET['delete'] == 'true') {
    $id = $_GET['id'];
    if ($objcar->delete($id))
        echo '<meta http-equiv=REFRESH CONTENT=0;url=ManageCarProfile.php>';
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>ระบบจัดแสดงรถยนต์</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="">
        <meta name="author" content="">
        <?php include 'includes.php' ?>
    </head>

    <body>
        <!-- Header -->
        <?php include 'header.php'; ?>

        <div class="container">
            <div class="row clearfix">
                <div class="col-md-12 column">
                    <div class=" panel panel-default">
                        <div class="panel-heading">
                            <h4>รายการรถยนต์</h4>
                            <small></small>
                        </div>

                        <div class="panel-body">
                            <div class="row clearfix">
                                <div class="col-md-12 column">
                                    <a href="addCarProfile.php"><button type="button"
                                                                        class="btn btn-primary btn-lg">เพิ่มรถยนต์</button></a>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>จัดการ</th>
                                                <th>ยี่ห้อ</th>
                                                <th>รุ่น</th>
                                                <!-- <th>ประเภทรถยนต์</th> -->
                                                <th>ปีที่ผลิต</th>
                                                <th>เลขตัวถัง</th>
                                                <th>ประมาตรกระบอกสูบ (CC)</th>
                                                <th>ความจุถังน้ำมัน (ลิตร)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $rsCar = $objcar->getCarAllPaging();
                                            while ($rowCar = mysql_fetch_object($rsCar)) {
                                                ?>
                                                <tr>
                                                    <td>
                                                        <a href="editCarProfile.php?id=<?php echo $rowCar->id; ?>"<button type="button" class="btn btn-warning btn-lg">แก้ไข&nbsp;</button></a>
                                                        <a href="ManageCarProfile.php?delete=true&id=<?php echo $rowCar->id; ?>"><button type="button" class="btn btn-danger btn-lg">&nbsp;&nbsp;&nbsp;ลบ&nbsp;&nbsp;</button></a>
                                                    </td>
                                                    <td><?php echo $rowCar->brand_name ?></td>
                                                    <td><?php echo $rowCar->model_name ?></td>
                                                    <!-- <td><?php //echo $rowCar->xxx  ?></td> -->
                                                    <td><?php echo $rowCar->car_year ?></td>
                                                    <td><?php echo $rowCar->body_number ?></td>
                                                    <td><?php echo $rowCar->cylinder ?></td>
                                                    <td><?php echo $rowCar->fuel_tank ?></td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <nav>
                                <ul class="pagination">
                                    <li><a>หน้าที่</a></li>
                                    <li><a href="#"><span aria-hidden="true">&laquo;</span><span
                                                class="sr-only">Previous</span></a></li>
                                    <li><a href="#">1</a></li>
                                    <li><a href="#">2</a></li>
                                    <li><a href="#">3</a></li>
                                    <li><a href="#">4</a></li>
                                    <li><a href="#">5</a></li>
                                    <li><a href="#"><span aria-hidden="true">&raquo;</span><span
                                                class="sr-only">Next</span></a></li>
                                </ul>
                            </nav>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-md-12 column"></div>
        </div>
        <!-- Footer -->
        <?php include 'footer.php'; ?>
    </body>
</html>
