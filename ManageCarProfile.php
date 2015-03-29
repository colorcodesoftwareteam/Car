<?php
session_start();
include 'src/class/ManageCar.php';

$objCar = new ManageCar();

$pageSize = 10;
$currentPage = 1;
if (isset($_GET['page'])) {
    $currentPage = $_GET['page'];
}
if (isset($_GET['delete'])) {
    $id = $_GET['id'];
    if ($objCar->delete($id)) {
        echo '<meta http-equiv=REFRESH CONTENT=0;url=ManageCarProfile.php>';
    }
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
                                    <a href="addCarProfile.php"><button type="button" class="btn btn-primary">เพิ่มรถยนต์</button></a>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <?php if (isset($_SESSION['memberId'])) { ?>
                                                <th></th>
                                                <?php } ?>
                                                <th>ยี่ห้อ</th>
                                                <th>รุ่น</th>
                                                <th>ปีที่ผลิต</th>
                                                <th>เลขตัวถัง</th>
                                                <th>ประมาตรกระบอกสูบ (CC)</th>
                                                <th>ความจุถังน้ำมัน (ลิตร)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $arrCar = $objCar->getCarAllPaging($pageSize, $currentPage);
                                            foreach ($arrCar as $row) {
                                                ?>
                                                <tr>
                                                    <?php if (isset($_SESSION['memberId'])) { ?>
                                                    <td>
                                                        <a href="editCarProfile.php?id=<?php echo $row->id; ?>"<button type="button" class="btn btn-warning">แก้ไข&nbsp;</button></a>
                                                        <a href="ManageCarProfile.php?delete=true&id=<?php echo $row->id; ?>"><button type="button" class="btn btn-danger">&nbsp;&nbsp;&nbsp;ลบ&nbsp;&nbsp;</button></a>
                                                    </td>
                                                    <?php } ?>
                                                    <td><?php echo $row->brand_name ?></td>
                                                    <td><?php echo $row->model_name ?></td>
                                                    <td><?php echo $row->car_year ?></td>
                                                    <td><?php echo $row->body_number ?></td>
                                                    <td><?php echo $row->cylinder ?></td>
                                                    <td><?php echo $row->fuel_tank ?></td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="panel-footer">
                            <div class="row clearfix">
                                <div class="col-md-offset-4">
                                    <nav>
                                        <?php $objCar->getPaging("ManageCarProfile", $currentPage); ?>
                                    </nav>
                                </div>
                            </div>
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
