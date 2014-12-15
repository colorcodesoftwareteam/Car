<?php
include 'src/class/ManageBrandCar.php';
include 'src/class/ManageModelCar.php';
include "src/class/ManageCar.php";

$objCar = new ManageCar();
$objBrand = new ManageBrandCar ();
$objModel = new ManageModelCar ();
$pageSize = 3;
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
        <title>เปรียบเทียบรายละเอียดรถยนต์</title>
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
                            <h4>
                                เปรียบเทียบรายละเอียดรถยนต์
                            </h4><small></small>
                        </div>

                        <div class="panel-body">
                            <div class="row clearfix">
                                <div class=" col-md-offset-11">
                                    <div class="row clearfix" >
                                        <button type="button" class="glyphicon glyphicon-print btn-primary btn btn-lg ">
                                            พิมพ์
                                        </button> 
                                        <p></p>
                                    </div>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-md-6 column">
                                    <div class="panel panel-primary">
                                        <div class="panel-heading">
                                            <h3 class="panel-title">
                                                <?php if (!isset($_SESSION['car1'])) { ?>
                                                    เลือกรถคันที่ 1
                                                <?php } else { ?>
                                                    เลือกรถคันที่ 2
                                                <?php } ?>
                                            </h3>

                                        </div>
                                        <div class="panel-body">
                                            <?php if (isset($_SESSION['car1'])) { ?>
                                                <div class="alert alert-success" role="alert">
                                                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                                    รถคันที่ 1 [เลือกแล้ว]
                                                </div>
                                            <?php } ?>
                                            <?php if (isset($_SESSION['car2'])) { ?>
                                                <div class="alert alert-success" role="alert">
                                                    <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                                    รถคันที่ 2 [เลือกแล้ว]
                                                </div>
                                            <?php } ?>
                                            <?php
                                            if (isset($_SESSION['car1']) && isset($_SESSION['car2'])) {
                                                ?>
                                            <button class="btn btn-success">Compare</button>
                                                <?php
                                            }
                                            ?>
                                            <form class="form-horizontal" role="form" action="carCompare.php" method="get">
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
                                                                            <option value="<?php echo $row->id; ?>"
                                                                                    <?php echo ($row->id == $model_id) ? 'selected' : ''; ?>>
                                                                                <?php echo $row->name; ?></option>
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


                                            <div class="row clearfix">
                                                <?php
                                                $arrCar = $objCar->getSearchCarPaging($brand_id, $model_id, $year, $pageSize, $currentPage);
                                                for ($j = 1; $j <= 3; $j++) {
                                                    $row = $arrCar->current();
                                                    if (isset($row)) {
                                                        ?>

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
                                                                    <strong><?php echo $row->brand_name; ?></strong><br> <?php echo $row->model_name; ?> ปี : <?php echo $row->car_year; ?><br>
                                                                </div>
                                                            </a>
                                                            <?php
                                                            if (!isset($_SESSION['car1'])) {
                                                                $action = 'choosecar1';
                                                            } else {
                                                                $action = 'choosecar2';
                                                            }
                                                            ?>

                                                            <a href="actionsNonMember.php?action=<?php echo $action; ?>&carid=<?= $row->id ?>"><button class="btn">เลือก</button></a>
                                                        </div>

                                                        <?php
                                                    }
                                                    $arrCar->next();
                                                }
                                                ?>

                                            </div>   
                                        </div>
                                        <div class="panel-footer">



                                            <div class="row clearfix">
                                                <div class="col-md-offset-4">
                                                    <nav>
                                                        <ul class="pagination">
                                                            <li><a>หน้าที่</a></li>
                                                            <?php $pages = $objCar->getPageing(); ?>
                                                            <li><a href="carCompare.php?page=<?= ($currentPage - 1) < 1 ? 1 : ($currentPage - 1) ?>&brandid=<?= $brand_id ?>&modelid=<?= $model_id ?>&year=<?= $year ?>"><span aria-hidden="true">&laquo;</span><span class="sr-only">Previous</span></a></li>
                                                            <?php
                                                            for ($i = 1; $i <= $pages; $i++) {
                                                                ?>
                                                                <li><a href="carCompare.php?page=<?= $i ?>&brandid=<?= $brand_id ?>&modelid=<?= $model_id ?>&year=<?= $year ?>"><?= $i ?></a></li>
                                                                <?php
                                                            }
                                                            ?>
                                                            <li><a href="carCompare.php?page=<?= ($currentPage + 1) > $pages ? $currentPage : ($currentPage + 1) ?>&brandid=<?= $brand_id ?>&modelid=<?= $model_id ?>&year=<?= $year ?>"><span aria-hidden="true">&raquo;</span><span class="sr-only">Next</span></a></li>
                                                        </ul>
                                                    </nav>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel panel-primary hidden">
                                        <div class="panel-heading disabled">
                                            <h3 class="panel-title">
                                                Panel title
                                            </h3>
                                        </div>
                                        <div class="panel-body">
                                            Panel Content
                                        </div>
                                        <div class="panel-footer">
                                            Panel footer
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 column">
                                    <div class="panel panel-primary">
                                        <div class="panel-heading">
                                            <h3 class="panel-title">

                                            </h3>
                                        </div>
                                        <div class="panel-body">
                                            <form class="form-horizontal" role="form" action="carCompare.php" method="get">
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
                                                                            <option value="<?php echo $row->id; ?>"
                                                                                    <?php echo ($row->id == $model_id) ? 'selected' : ''; ?>>
                                                                                <?php echo $row->name; ?></option>
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
                                        </div>
                                        <div class="panel-footer">
                                            <div class="row clearfix">
                                                <div class="col-md-12 column">
                                                    <img alt="140x140" src="http://lorempixel.com/140/140/" />
                                                    <h2>

                                                    </h2>
                                                    <p>
                                                        <button type="button" class="btn btn-primary btn-lg">ภาพถ่ายจากกล้อง</button>
                                                    </p>
                                                    <p>
                                                    </p>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panel panel-primary hidden">
                                        <div class="panel-heading">
                                            <h3 class="panel-title">
                                                Panel title
                                            </h3>
                                        </div>
                                        <div class="panel-body">
                                            Panel content
                                        </div>
                                        <div class="panel-footer">
                                            Panel footer
                                        </div>
                                    </div>
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
        <div class="row clearfix"><p></p></div>
        <!-- Footer -->
        <?php include 'footer.php'; ?>
    </body>
</html>
