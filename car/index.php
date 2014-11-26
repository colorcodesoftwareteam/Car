<?php
include 'src/class/ManageBrandCar.php';
include 'src/class/ManageModelCar.php';
include "src/class/ManageCar.php";

$objCar = new ManageCar();
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
                                                        $objBrand = new ManageBrandCar ();
                                                        $rsBrand = $objBrand->getBrandAll();
                                                        while ($rowBrand = mysql_fetch_object($rsBrand)) {
                                                            ?>
                                                            <option value="<?php echo $rowBrand->id; ?>"
                                                                    <?php echo ($rowBrand->id == $brand_id) ? 'selected' : '' ?>>
                                                                <?php echo $rowBrand->name; ?></option>
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
                                                        $objModel = new ManageModelCar ();
                                                        $rsModel = $objModel->getModelAll();
                                                        while ($rowModel = mysql_fetch_object($rsModel)) {
                                                            ?>
                                                            <option value="<?php echo $rowModel->id; ?>"
                                                                    <?php echo ($rowModel->id == $model_id) ? 'selected' : ''; ?>>
                                                                <?php echo $rowModel->name; ?></option>
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
                                                        foreach ($arrCar as $rowCar) {
                                                            ?>
                                                            <option value="<?php echo $rowCar->car_year; ?>" 
                                                                    <?php echo ($rowCar->car_year == $year) ? 'selected' : ''; ?>>
                                                                <?php echo $rowCar->car_year; ?></option>
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
                                        $rowCar = $arrCar->current();
                                        if (isset($rowCar)) {
                                            ?>
                                            <div class="col-md-4 column">
                                                <div class="row clearfix">
                                                    <a href="carProfile.html?car_id=<?= $rowCar->id ?>">
                                                        <div class="col-md-6 column">
                                                            <img alt="140x140" src="http://lorempixel.com/140/140/">
                                                        </div>
                                                        <div class="col-md-6 column">
                                                            <strong><?php echo $rowCar->brand_name; ?></strong><br> <?php echo $rowCar->model_name; ?><br> ปี <?php echo $rowCar->car_year . '  เลขตัวถัง ' . $rowCar->body_number . '  กระบอกสูบ ' . $rowCar->cylinder . '  ความจุถังน้ำมัน  ' . $rowCar->fuel_tank . ' สี ' . $rowCar->color . '  รายละเอียด ' . $rowCar->detail; ?><br>
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
                            <div class="row clearfix">
                                <div class="col-md-offset-4">
                                    <nav>
                                        <ul class="pagination">
                                            <li><a>หน้าที่</a></li>
                                            <?php $pages = $objCar->getPageing($pageSize); ?>
                                            <li><a href="index.php?page=<?= ($currentPage - 1) < 1 ? 1 : ($currentPage - 1) ?>&brandid=<?= $brand_id ?>&modelid=<?= $model_id ?>&year=<?= $year ?>"><span aria-hidden="true">&laquo;</span><span class="sr-only">Previous</span></a></li>
                                            <?php
                                            for ($i = 1; $i <= $pages; $i++) {
                                                ?>
                                                <li><a href="index.php?page=<?= $i ?>&brandid=<?= $brand_id ?>&modelid=<?= $model_id ?>&year=<?= $year ?>"><?= $i ?></a></li>
                                                <?php
                                            }
                                            ?>
                                            <li><a href="index.php?page=<?= ($currentPage + 1) > $pages ? $currentPage : ($currentPage + 1) ?>&brandid=<?= $brand_id ?>&modelid=<?= $model_id ?>&year=<?= $year ?>"><span aria-hidden="true">&raquo;</span><span class="sr-only">Next</span></a></li>
                                        </ul>
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
