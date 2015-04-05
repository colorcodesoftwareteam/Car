<?php
session_start();
include 'src/class/ManageBrandCar.php';
include 'src/class/ManageModelCar.php';
include "src/class/ManageCar.php";

$objCar = new ManageCar();
$objBrand = new ManageBrandCar ();
$objModel = new ManageModelCar ();
$pageSize = 9;
$currentPage = 1;
$brand_id = "";
$model_id = "";
$year = "";
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
                <div class="col-md-5 col-sm-6 col-xs-10 col-md-offset-3 col-sm-offset-3 col-xs-offset-1" >
                    <div class="row clearfix panel panel-default ">
                        <div class="col-md-11 col-sm-11 col-xs-12 col-md-offset-1">
                            <div class="row clearfix"><p></div>
                            <form class="form-horizontal" role="form" action="index.php" method="get">
                                <div class="row">
                                    <label class="col-md-2 col-sm-3 col-xs-3 control-label">ยี่ห้อ</label> 
                                    <div class="col-md-7 col-sm-7 col-xs-7">
                                        <select class="form-control" id="brand" name="brandid">
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
                                </div>
                                <div class="row" style="margin-top:5px;">
                                    <label class="col-md-2 col-sm-3 col-xs-3 control-label">รุ่น</label> 
                                    <div class="col-md-7 col-sm-7 col-xs-7">
                                        <select class="form-control" name="modelid" id="model">
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
                                    <div class="col-md-3 col-sm-1 col-xs-2">
                                        <button type="submit" class="btn btn-primary ">ค้นหา</button>
                                    </div>
                                </div>
                                <div class="row" style="margin-top:5px;">
                                    <label class="col-md-2 col-sm-3 col-xs-3 control-label">ปีผลิต</label>
                                    <div class="col-md-7 col-sm-7 col-xs-7">
                                        <select class="form-control" name="year" id="model">
                                            <option value="">-เลือก-</option>
                                            <?php
                                            $arrYear = $objCar->getCarYearAll();
                                            foreach ($arrYear as $row) {
                                                ?>
                                                <option value="<?php echo $row->car_year; ?>" 
                                                        <?php echo ($row->car_year == $year) ? 'selected' : ''; ?>>
                                                    <?php echo $row->car_year; ?></option>
                                                <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row clearfix"><p></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row clearfix">
                <div class="col-md-12 column">
                    <div class=" panel panel-default">
                        <div class="panel-heading">
                            <h4><?php echo $brand_id != "" || $model_id != "" || $year != "" ? "ค้นหารถยนต์" : "รถยนต์มาใหม่"; ?></h4>
                        </div>
                        <div class="panel-body">
                            <?php
                            $arrCar = $objCar->getSearchCarPaging($brand_id, $model_id, $year, $pageSize, $currentPage);
                            for ($i = 1; $i <= 3; $i++) {
                                ?>
                                <div class="row clearfix">
                                    <?php
                                    for ($j = 1; $j <= 3; $j++) {
                                        $row = $arrCar->current();
                                        if (isset($row)) {
                                            ?>
                                            <div class="col-lg-4 col-md-4 col-xs-12">
                                                <div class="row clearfix" style="height:110px;">
                                                    <a href="carProfile.php?car_id=<?= $row->id ?>&brandid=<?= $brand_id ?>&modelid=<?= $model_id ?>&year=<?= $year ?>">
                                                        <div class="col-lg-5 col-lg-offset-1 col-md-6 col-xs-6">
                                                            <?php
                                                            $arrImgs = $objCar->getCarImagesWithNoImage($row->id);
                                                            if ($arrImgs->count() > 0) {
                                                                ?>
                                                                <img width="140px" hight="140px" src="<?= $arrImgs->current()->path ?>">
                                                                <?php
                                                            } else {
                                                                ?>
                                                                <img width="140px" hight="140px" src="img/no_img.jpg">
                                                                <?php
                                                            }
                                                            ?>
                                                        </div>
                                                        <div class="col-lg-5 col-md-6 col-xs-6">
                                                            <strong><?php echo $row->brand_name; ?></strong><br> <?php echo $row->model_name; ?> ปี : <?php echo $row->car_year . ' <br/> กระบอกสูบ : ' . $row->cylinder . ' <br/> รายละเอียด : ' . $row->detail; ?><br>
                                                        </div>
                                                    </a>
                                                </div>
                                            </div> 
                                            <?php
                                        }
                                        $arrCar->next();
                                    }
                                    ?>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                        <div class="panel-footer">
                            <div class="row clearfix">
                                <div class="col-md-offset-4">
                                    <nav>
                                        <?php $objCar->getPaging("index", $currentPage); ?>
                                    </nav>
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
        </div>
        <?php include 'footer.php'; ?>
    </body>
</html>

<script type="text/javascript">
    $(function () {
        $('#brand').change(function () {
            var brandid = $('#brand').val();
            $.post('json/listModel.php', {id: brandid}, function (data) {
                $('#model').html(data);
            });
        });
    });
</script>
