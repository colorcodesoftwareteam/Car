<?php
include 'src/class/ManageBrandCar.php';
if (@$_GET ['delete'] == 'true') {
    $obj = new ManageBrandCar();

    if ($obj->delete($_GET['id']))
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
                            <a href="addCarBrand.php"><button type="button"
                                                              class="btn btn-primary btn-lg">เพิ่มยี่ห้อรถยนต์</button></a>

                            <table class="table .table-bordered">
                                <thead>
                                    <tr>
                                        <th>จัดการ</th>
                                        <th>รายการ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include_once 'src/class/ManageBrandCar.php';
                                    $obj = new ManageBrandCar ();
                                    $rs = $obj->getBrandAll();
                                    while ($row = mysql_fetch_object($rs)) {
                                        ?>
                                        <!-- insert some code  -->
                                        <tr>
                                            <td>
                                                <a href="editCarBrand.php?id=<?php echo $row->id; ?>"<button type="button" class="btn btn-warning btn-lg">แก้ไข&nbsp;</button></a>
                                                <a href="?delete=true&id=<?php echo $row->id; ?>"><button type="button" class="btn btn-danger btn-lg">&nbsp;&nbsp;&nbsp;ลบ&nbsp;&nbsp;</button></a>
                                            </td>
                                            <td><?php echo $row->name; ?></td>
                                        </tr>
                                    <?php } ?>
                                    <!-- insert some code  -->
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer -->
        <?php include 'footer.php'; ?>
    </body>
</html>
