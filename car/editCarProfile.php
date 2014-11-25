<?php
include 'src/class/ManageBrandCar.php';
include 'src/class/ManageModelCar.php';
include 'src/class/ManageCar.php';

$id = $_GET ['id'];
$objcar = new ManageCar ();
if (@$_GET ['submit'] == 'true') {
    $brandid = $_POST ['brandid'];
    $modelid = $_POST ['modelid'];
    $caryear = $_POST ['caryear'];
    $bodynumber = $_POST ['bodynumber'];
    $cylinder = $_POST ['cylinder'];
    $fueltank = $_POST ['fueltank'];

    if ($objcar->edit($id, $brandid, $modelid, $caryear, $bodynumber, $cylinder, $fueltank))
        echo '<meta http-equiv=REFRESH CONTENT=0;url=ManageCarProfile.php>';
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
                            <h4>เพิ่มรถยนต์</h4>
                            <small></small>
                        </div>

                        <div class="panel-body">
                            <div class="row clearfix">
                                <div class="col-md-12 column">


                                    <div class="row clearfix">
                                        <div class="col-md-12 column">
                                            <div class="panel panel-default">

                                                <div class="panel-body">
                                                    <form class="form-horizontal" role="form"
                                                          action="editCarProfile.php?submit=true&id=<?php echo $id ?>"
                                                          method="post">

                                                        <div class="form-group">
                                                            <label for="inputEmail3" class="col-sm-2 control-label">ยี่ห้อรถ</label>
                                                            <div class="col-md-4">
                                                                <select class="form-control" id="brand" name="brandid">
                                                                    <option>-เลือก-</option>
                                                                    <?php
                                                                    $rsCar = $objcar->getCarById($id);
                                                                    $rowCar = mysql_fetch_object($rsCar);

                                                                    $objBrand = new ManageBrandCar ();
                                                                    $rsBrand = $objBrand->getBrandAll();
                                                                    while ($rowBrand = mysql_fetch_object($rsBrand)) {
                                                                        ?>
                                                                        <option value="<?php echo $rowBrand->id; ?>"
                                                                                <?php echo ($rowBrand->id == $rowCar->brand_id) ? 'selected' : '' ?>>
                                                                            <?php echo $rowBrand->name; ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="inputEmail3" class="col-sm-2 control-label">รุ่น</label>

                                                            <div class="col-md-4">
                                                                <select class="form-control" name="modelid" id="model">
                                                                    <?php
                                                                    $objModel = new ManageModelCar ();
                                                                    $rsModel = $objModel->getModelAll();

                                                                    while ($rowModel = mysql_fetch_object($rsModel)) {
                                                                        ?>
                                                                        <option value="<?php echo $rowModel->id; ?>"
                                                                                <?php echo ($rowModel->id == $rowCar->brand_id) ? 'selected' : ''; ?>><?php echo $rowModel->name; ?></option>
                                                                            <?php } ?>
                                                                </select>

                                                            </div>
                                                        </div>
                                                        <!-- 
                                                        <div class="form-group">
                                                                <label for="inputEmail3" class="col-sm-2 control-label">ประเภทรถยนต์</label>
                                                                <div class="col-md-4">

                                                                        <select class="form-control" name="typecar">
                                                                                <option value="0">-เลือก-</option>
                                                                                <option value="1">รถเก๋ง</option>
                                                                                <option value="2">รถกระบะ</option>

                                                                        </select>
                                                                </div>

                                                        </div>
                                                        -->
                                                        <div class="form-group">
                                                            <label for="inputEmail3" class="col-sm-2 control-label">ปีที่ผลิต</label>
                                                            <div class="col-sm-10">
                                                                <input class="form-control" id="inputEmail3" type="text"
                                                                       name="caryear" value="<?php echo $rowCar->car_year; ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="inputPassword3" class="col-sm-2 control-label">เลขตัวถัง</label>
                                                            <div class="col-sm-10">
                                                                <input class="form-control" id="inputPassword3"
                                                                       type="text" name="bodynumber"
                                                                       value="<?php echo $rowCar->body_number; ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="inputPassword3" class="col-sm-2 control-label">ปริมาตรกระบอกสูบ
                                                                (CC)</label>
                                                            <div class="col-sm-10">
                                                                <input class="form-control" id="inputPassword3"
                                                                       type="text" name="cylinder"
                                                                       value="<?php echo $rowCar->cylinder; ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="inputPassword3" class="col-sm-2 control-label">ความจุถังน้ำมัน</label>
                                                            <div class="col-sm-10">
                                                                <input class="form-control" id="inputPassword3"
                                                                       type="text" name="fueltank"
                                                                       value="<?php echo $rowCar->fuel_tank; ?>" />
                                                            </div>
                                                        </div>
                                                        <button type="button" class="btn btn-success btn-lg">&nbsp;&nbsp;ล้างข้อมูล&nbsp;&nbsp;</button>
                                                        <button type="submit" class="btn btn-primary btn-lg">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;แก้ไข&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>
                                                    </form>
                                                </div>
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
