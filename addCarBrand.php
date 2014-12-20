<?php
include 'src/class/ManageBrandCar.php';



if (@$_GET ['submit'] == 'true') {

    $name = $_POST ['brand'];
    $obj = new ManageBrandCar();

    if ($obj->add($name))
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
                            <h4>เพิ่มยี่ห้อรถยนต์</h4>
                        </div>

                        <div class="panel-body">

                            <form class="form-horizontal" action="addCarBrand.php?submit=true" method="post">
                                <!-- Text input-->
                                <div class="form-group">
                                    <label class="col-sm-2 control-label" for="brand">ยี่ห้อ </label>
                                    <div class="col-sm-4">
                                        <input class="form-control" id="brand" name="brand" placeholder="" type="text">
                                    </div>
                                </div>
                                
                                <button type="reset" id="clear" name="clear" class="btn btn-primary">&nbsp;&nbsp;ล้างข้อมูล&nbsp;&nbsp;</button>
                                <button type="submit" id="add" name="add" class="btn btn-success">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;เพิ่ม&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Footer -->
        <?php include 'footer.php'; ?>
    </body>
</html>
