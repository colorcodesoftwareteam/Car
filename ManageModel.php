<?php
include 'src/class/ManageModelCar.php';

$objModelCar = new ManageModelCar();
$pageSize = 10;
$currentPage = 1;
if (isset($_GET['page'])) {
    $currentPage = $_GET['page'];
}
if (@$_GET ['delete'] == 'true') {
    if ($objModelCar->delete($_GET['brand_id'], $_GET['model_id']))
        echo '<meta http-equiv=REFRESH CONTENT=0;url=ManageModel.php>';
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
                            <h4>รายการรุ่นรถยนต์</h4>
                        </div>

                        <div class="panel-body">
                            <a href="addCarModel.php"><button type="button" class="btn btn-primary">เพิ่มรุ่นรถยนต์</button></a>

                            <table class="table .table-bordered">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>ยี่ห้อ</th>
                                        <th>รุ่น<th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $arrModel = $objModelCar->getModelAllPaging($pageSize, $currentPage);
                                    foreach ($arrModel as $row) {
                                        ?>
                                        <!-- insert some code  -->
                                        <tr>
                                            <td>
                                                <a href="editCarModel.php?model_id=<?php echo $row->model_id; ?>&brand_id=<?php echo $row->brand_id; ?>"<button type="button" class="btn btn-warning">แก้ไข&nbsp;</button></a>
                                                <a href="?delete=true&model_id=<?php echo $row->model_id; ?>&brand_id=<?php echo $row->brand_id; ?>"><button type="button" class="btn btn-danger">&nbsp;&nbsp;&nbsp;ลบ&nbsp;&nbsp;</button></a>
                                            </td>
                                            <td><?php echo $row->brand_name; ?></td>
                                            <td><?php echo $row->model_name; ?></td>
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
                                        <?php $objModelCar->getPaging("ManageModel", $currentPage); ?>
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
