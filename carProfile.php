<?php
session_start();
include 'src/class/ManageBrandCar.php';
include 'src/class/ManageModelCar.php';
include "src/class/ManageCar.php";
include "src/class/ImageHelper.php";

$objCar = new ManageCar();
$objBrand = new ManageBrandCar ();
$objModel = new ManageModelCar ();
$objImgHlp = new ImageHelper ();

$brand_id = "";
$model_id = "";
$year = "";
$car_id = "";

if (isset($_GET['page'])) {
    $currentPage = $_GET['page'];
}
if (isset($_GET['brandid'])) {
    $brand_id = $_GET['brandid'];
}
if (isset($_GET['modelid'])) {
    $model_id = $_GET['modelid'];
}
if (isset($_GET['year'])) {
    $year = $_GET['year'];
}
if (isset($_GET['car_id'])) {
    $car_id = $_GET['car_id'];
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
            <div class="row clearfix hidden-print">
                <div class="col-md-8 col-md-offset-2 " >
                    <div class="row clearfix panel panel-default ">
                        <div class="col-md-10">
                            <div class="row clearfix"><p></div>
                            <form class="form-horizontal" role="form" action="index.php" method="get">
                                <table class="table table-no-border">
                                    <tbody>
                                        <tr>

                                            <td>
                                                <div align="right">
                                                    <select class="form-control-combobox" id="brand" name="brandid">
                                                        <option value="">-เลือก-</option>
                                                        <?php
                                                        $arrBrand = $objBrand->getBrandAll();
                                                        foreach ($arrBrand as $row) {
                                                            ?>
                                                            <option value="<?php echo $row->id; ?>"
                                                                    <?php echo ($row->id == $brand_id) ? 'selected' : '' ?>>
                                                                <?php echo $row->name; ?></option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </td>

                                            <td>&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div align="right">
                                                    <select class="form-control-combobox" name="modelid" id="model">
                                                        <option value="">-เลือก-</option>
                                                        <?php
                                                        $arrModel = $objModel->getModelAll();
                                                        foreach ($arrModel as $row) {
                                                            ?>
                                                            <option value="<?php echo $row->model_id; ?>"
                                                                    <?php echo ($row->model_id == $model_id) ? 'selected' : ''; ?>>
                                                                <?php echo $row->model_name; ?></option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </td>
                                            <td class="col-md-3 col-md-offset-2"><button type="submit" class="btn btn-primary ">ค้นหา</button></td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div align="right">
                                                    <select class="form-control-combobox" name="year" id="model">
                                                        <option value="">-เลือก-</option>
                                                        <?php
                                                        $arrCar = $objCar->getCarYearAll();
                                                        foreach ($arrCar as $row) {
                                                            ?>
                                                            <option value="<?php echo $row->car_year; ?>" 
                                                                    <?php echo ($row->car_year == $year) ? 'selected' : ''; ?>>
                                                                <?php echo $row->car_year; ?></option>
                                                            <?php
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>&nbsp;</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </form>
                            <div class="row clearfix"><p></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row clearfix">
                <div class="col-md-12 column">
                    <div class=" panel panel-default">
                        <div class="panel-heading">
                            <h4>
                                รายละเอียดรถยนต์
                            </h4><small></small>
                        </div>

                        <div class="panel-body">
                            <div class="row clearfix">
                                <div class=" col-md-offset-11">
                                    <div class="row " >
                                        <button type="button" class="glyphicon glyphicon-print btn-primary btn  hidden-print" onclick="window.print();">
                                            พิมพ์
                                        </button>
                                        <p></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-md-6">
                                    <div class="row clearfix">
                                        <div class="col-md-12 col-md-offset-1">
                                            <?php
                                            $arrCar = $objCar->getCarById($car_id);
                                            $imgCars = $objCar->getCarImages($car_id);
                                            
                                            if ($imgCars->count() > 0) {
                                                $objImgHlp->slideShow("carProfileSlideShow", $imgCars);
                                            } else {
                                            ?>
                                                <img width="450px" hight="300px" src="img/no_img.jpg">
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5 col-md-offset-1 form-group">
                                    <div class="input-group">
                                        <span><strong>ยี่ห้อรถยนต์ : </strong><?= $arrCar->current()->brand_name ?></span>
                                    </div>
                                    <p></p>
                                    <div class="input-group">
                                        <span><strong>รุ่น : </strong><?= $arrCar->current()->model_name ?></span>
                                    </div>
                                    <p></p>
                                    <div class="input-group">
                                        <span><strong>ปี : </strong><?= $arrCar->current()->car_year ?></span>
                                    </div>
                                    <p></p>
                                    <div class="input-group">
                                        <span><strong>เลขตัวถัง : </strong><?= $arrCar->current()->body_number ?></span>
                                    </div>
                                    <p></p>
                                    <div class="input-group">
                                        <span><strong>ปริมาตรกระบอกสูบ (CC) : </strong><?= $arrCar->current()->cylinder ?></span>
                                    </div>
                                    <p></p>
                                    <div class="input-group">
                                        <span><strong>ความจุถังน้ำมัน (ลิตร) : </strong><?= $arrCar->current()->fuel_tank ?></span>
                                    </div>
                                    <p></p>
                                    <div class="input-group">
                                        <span><strong>รายละเอียด : </strong><?= $arrCar->current()->detail ?></span>
                                    </div>
                                    <p></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-md-12 column">
            </div>
        </div>
        <!-- Footer -->
        <?php include 'footer.php'; ?>
    </body>
</html>
