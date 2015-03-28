<?php
session_start();
include 'src/class/ManageBrandCar.php';

$objManageBrandCar = new ManageBrandCar ();
$pageSize = 9;
$currentPage = 1;
if (isset($_GET['page'])) {
    $currentPage = $_GET['page'];
}
if (@$_GET ['delete'] == 'true') {
    $objManageBrandCar = new ManageBrandCar();

    if ($objManageBrandCar->delete($_GET['id']))
        echo '<meta http-equiv=REFRESH CONTENT=0;url=ManageBrand.php>';
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>ระบบจัดการแสดงรถยนต์</title>
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
                            <h4>รายการยี่ห้อรถยนต์</h4>
                        </div>

                        <div class="panel-body">
                            <a href="addCarBrand.php"><button type="button" class="btn btn-primary">เพิ่มยี่ห้อรถยนต์</button></a>
                            <table class="table .table-bordered">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>ยี่ห้อ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $arrBrand = $objManageBrandCar->getBrandAllPaging($pageSize, $currentPage);
                                    foreach ($arrBrand as $row) {
                                        ?>
                                        <!-- insert some code  -->
                                        <tr>
                                            <td>
                                                <a href="editCarBrand.php?id=<?php echo $row->id; ?>"<button type="button" class="btn btn-warning">แก้ไข&nbsp;</button></a>
                                                <a href="?delete=true&id=<?php echo $row->id; ?>"><button type="button" class="btn btn-danger">&nbsp;&nbsp;&nbsp;ลบ&nbsp;&nbsp;</button></a>
                                            </td>
                                            <td><?php echo $row->name; ?></td>
                                        </tr>
                                    <?php } ?>
                                    <!-- insert some code  -->
                                </tbody>
                            </table>
                        </div>
                        <div class="panel-footer">
                            <div class="row clearfix">
                                <div class="col-md-offset-4">
                                    <nav>
                                        <?php $objManageBrandCar->getPaging("ManageBrand", $currentPage); ?>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer -->
        <?php include 'footer.php'; ?>
    </body>
</html>
