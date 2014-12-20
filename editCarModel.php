<?php
include 'src/class/ManageBrandCar.php';
include 'src/class/ManageModelCar.php';

$objBrandCar = new ManageBrandCar ();
$objModelCar = new ManageModelCar ();
$id = $_GET ['id'];

if (@$_GET ['submit'] == 'true') {

    $brandid = $_POST ['brand'];
    $model = $_POST ['model'];

    if ($objModelCar->edit($id, $brandid, $model))
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
                            <h4>แก้ไขรุ่นรถยนต์</h4>
                        </div>

                        <div class="panel-body">

                            <form class="form-horizontal" action="editCarModel.php?submit=true&id=<?php echo $id ?>"
                                  method="post">
                                <fieldset>

                                    <!-- Form Name -->
                                    <?php
                                    $arrModel = $objModelCar->getModelById($id);
                                    ?>

                                    <div class="form-group">
                                        <label class="col-sm-2 control-label " for="brand">ยี่ห้อ</label>
                                        <div class="col-sm-4">
                                            <select class="form-control" id="brand" name="brand">
                                                <option>-เลือก-</option>
                                                <?php
                                                $arrBrand = $objBrandCar->getBrandAll();
                                                foreach ($arrBrand as $row) {
                                                    ?>
                                                    <option value="<?php echo $row->id; ?>"
                                                            <?php echo ($arrModel->current()->brand_id == $row->id) ? 'selected' : ''; ?>><?php echo $row->name; ?></option>

                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- Text input-->
                                    <div class="form-group">
                                        <label  class="col-sm-2 control-label " for="model">รุ่น</label>
                                        <div class="col-sm-4">
                                            <input class="form-control" id="model" name="model" placeholder=""
                                                   value="<?php echo $arrModel->current()->name; ?>" type="text">
                                        </div>
                                    </div>
                                    <!-- Button (Double) -->
                                    <button type="submit" id="add" name="add" class="btn btn-success">แก้ไข</button>
                                    <!-- <button id="clear" name="clear" class="btn btn-danger">ล้างข้อมูล</button>-->
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
