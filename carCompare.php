<?php
include 'src/class/ManageBrandCar.php';
include 'src/class/ManageModelCar.php';
include "src/class/ManageCar.php";

$objCar = new ManageCar();
$objBrand = new ManageBrandCar ();
$objModel = new ManageModelCar ();
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

                                            </h3>
                                        </div>
                                        <div class="panel-body">
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
                                                        Honda
                                                    </h2>
                                                    <p>
                                                        รายละเอียด : ผลิตปี 2014 
                                                    </p>
                                                    <p>

                                                    </p>
                                                </div>
                                                <div class="col-md-12 column">
                                                    <img alt="140x140" src="http://lorempixel.com/140/140/" />
                                                    <h2>
                                                        Honda
                                                    </h2>
                                                    <p>
                                                        รายละเอียด : ผลิตปี 2014 
                                                    </p>
                                                    <p>
                                                    </p>

                                                </div>
												                                                <div class="col-md-12 column">
                                                    <img alt="140x140" src="http://lorempixel.com/140/140/" />
                                                    <h2>
                                                        Honda
                                                    </h2>
                                                    <p>
                                                        รายละเอียด : ผลิตปี 2014 
                                                    </p>
                                                    <p>
                                                    </p>

                                                </div>
												                                                    <nav>
                                                        <ul class="pagination">
                                                            <li><a>หน้าที่</a></li>
                                                            <li><a href="#"><span aria-hidden="true">&laquo;</span><span class="sr-only">Previous</span></a></li>
                                                            <li><a href="#">1</a></li>
                                                            <li><a href="#">2</a></li>
                                                            <li><a href="#">3</a></li>
                                                            <li><a href="#">4</a></li>
                                                            <li><a href="#">5</a></li>
                                                            <li><a href="#"><span aria-hidden="true">&raquo;</span><span class="sr-only">Next</span></a></li>
                                                        </ul>
                                                    </nav>
												
												
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
