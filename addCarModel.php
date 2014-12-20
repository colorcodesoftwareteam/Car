<?php
include 'src/class/ManageBrandCar.php';
include 'src/class/ManageModelCar.php';

$objBrandCar = new ManageBrandCar ();
$objModelCar = new ManageModelCar();

if (@$_GET ['submit'] == 'true') {

    $brandid = $_POST ['brand'];
    $model = $_POST ['model'];

    if ($objModelCar->add($brandid, $model))
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
                            <h4>เพิ่มรุ่นรถยนต์</h4>
                        </div>

                        <div class="panel-body">
                            <form class="form-horizontal" action="addCarModel.php?submit=true"
                                  method="post">
                                <fieldset>

                                    <!-- Form Name -->
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label " for="brand">ยี่ห้อ</label> 
                                        <div class="col-sm-4">
                                            <select class="form-control" id="brand" name="brand">
                                                <option selectd>-เลือก-</option>
                                                <?php
                                                $arrBrand = $objBrandCar->getBrandAll();
                                                foreach ($arrBrand as $row) {
                                                    ?>
                                                    <option value="<?php echo $row->id; ?>"><?php echo $row->name; ?></option>

                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- Text input-->
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label " for="model">รุ่น</label>
                                        <div class="col-sm-4">
                                            <input class="form-control" id="model" name="model" placeholder="" type="text">
                                        </div>
                                    </div>
                                    <!-- Button (Double) -->
                                    <button type="reset" id="clear" name="clear" class="btn btn-danger">ล้างข้อมูล</button>
                                    <button type="submit" id="add" name="add" class="btn btn-primary ">เพิ่ม</button>
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
