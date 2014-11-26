<?php
include 'src/class/ManageBrandCar.php';

$objBrandCar = new ManageBrandCar ();
$id = $_GET ['id'];

if (@$_GET ['submit'] == 'true') {

    $newname = $_POST ['brand'];
    if ($obj->edit($id, $newname))
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

                            <form class="form-horizontal"
                                  action="editCarBrand.php?submit=true&id=<?php echo $id ?>"
                                  method="post">
                                <fieldset>

                                    <!-- Form Name -->

                                    <?php
                                    $arrBrand = $objBrandCar->getBrandById($id);
                                    ?>
                                    <!-- Text input-->
                                    <div class="form-group">
                                        <div class="control-group col-md-7">
                                            <label class="control-label " for="brand">ยี่ห้อ :</label>
                                            <div class="controls">
                                                <input id="brand" name="brand"
                                                       value="<?php echo $arrBrand->current()->name; ?>" placeholder="กรอก....."
                                                       class="input-xlarge" type="text">

                                            </div>
                                        </div>
                                    </div>
                                    <!-- Button (Double) -->

                                    <div class="form-group">
                                        <div class="control-group ">
                                            <label class="control-label " for="add"></label>
                                            <div class="controls col-md-3">
                                                <button id="add" name="add" class="btn btn-primary ">แก้ไข</button>
                                                <button id="clear" name="clear" class="btn btn-danger">ล้างข้อมูล</button>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
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
