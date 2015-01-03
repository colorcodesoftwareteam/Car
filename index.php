<?php
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
                                            <div class="col-md-4 column">
                                                <div class="row clearfix">
                                                    <a href="carProfile.php?car_id=<?= $row->id ?>&brandid=<?= $brand_id ?>&modelid=<?= $model_id ?>&year=<?= $year ?>">
                                                        <div class="col-md-6 column">
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
                                                        <div class="col-md-6 column">
                                                            <strong><?php echo $row->brand_name; ?></strong><br> <?php echo $row->model_name; ?> ปี : <?php echo $row->car_year . '<br/>  เลขตัวถัง : ' . $row->body_number . ' <br/> กระบอกสูบ : ' . $row->cylinder . ' <br/> ความจุถังน้ำมัน : ' . $row->fuel_tank . ' <br/> สี : ' . $row->color . ' <br/> รายละเอียด : ' . $row->detail; ?><br>
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
