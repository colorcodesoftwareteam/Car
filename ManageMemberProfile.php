<?php
include 'src/class/ManageCar.php';

$objCar = new ManageCar();

$pageSize = 10;
$currentPage = 1;
if (isset($_GET['page'])) {
    $currentPage = $_GET['page'];
}
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
                            <h4>รายการสมาชิก</h4>
                            <small></small>
                        </div>

                        <div class="panel-body">
                            <div class="row clearfix">
                                <div class="col-md-12 column">
                                    <a href="addCarProfile.php"><button type="button" class="btn btn-primary">เพิ่มสมาชิก</button></a>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>ชื่อ</th>
                                                <th>นามสกุล</th>
                                                <th>เพศ</th>
                                                <th>วันเกิด</th>
                                                <th>ทึ่อยู่</th>
                                                <th>เบอร์โทรศัพท์</th>
                                                <th>อีเมลล์</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $arrCar = $objCar->getCarAllPaging($pageSize, $currentPage);
                                            foreach ($arrCar as $row) {
                                                ?>
                                                <tr>
                                                    <td>
                                                        <a href="editCarProfile.php?id=<?php echo $row->id; ?>"<button type="button" class="btn btn-warning">แก้ไข&nbsp;</button></a>
                                                        <a href="ManageCarProfile.php?delete=true&id=<?php echo $row->id; ?>"><button type="button" class="btn btn-danger">&nbsp;&nbsp;&nbsp;ลบ&nbsp;&nbsp;</button></a>
                                                    </td>
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

                            <nav>
                                <ul class="pagination">
                                    <li><a>หน้าที่</a></li>
                                    <?php $pages = $objCar->getPageing(); ?>
                                    <li><a href="ManageCarProfile.php?page=<?= ($currentPage - 1) < 1 ? 1 : ($currentPage - 1) ?>"><span aria-hidden="true">&laquo;</span><span class="sr-only">Previous</span></a></li>
                                    <?php
                                    for ($i = 1; $i <= $pages; $i++) {
                                        ?>
                                        <li><a href="ManageCarProfile.php?page=<?= $i ?>"><?= $i ?></a></li>
                                        <?php
                                    }
                                    ?>
                                    <li><a href="ManageCarProfile.php?page=<?= ($currentPage + 1) > $pages ? $currentPage : ($currentPage + 1) ?>"><span aria-hidden="true">&raquo;</span><span class="sr-only">Next</span></a></li>
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
