<?php
include_once 'src/class/ManageBrandCar.php';
include_once 'src/class/ManageModelCar.php';
include_once "src/class/ManageCar.php";
include_once "src/class/ImageHelper.php";

$objCar = new ManageCar();
$objImgHlp = new ImageHelper ();
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
                            </h4>
                        </div>

                        <div class="panel-body">
                            <div class="row clearfix">
                                <div class="col-md-3">
                                    <a href="actionsMember.php?action=choosecaragain"><button type="button" class="glyphicon glyphicon-arrow-left btn-primary btn ">
                                            เลือกอีกครั้ง
                                        </button> 
                                    </a>
                                </div>
                                <div class=" col-md-offset-11">
                                    <div class="row clearfix" >
                                        <button type="button" class="glyphicon glyphicon-print btn-primary btn " onclick="window.print();">
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
                                        <div class="panel-body"></div>
                                        <div class="panel-footer">
                                            <div class="row clearfix">
                                                <div class="col-md-12 col-md-offset-1">
                                                    <div class="col-md-10">
                                                        <div class="row clearfix">
                                                            <div class="col-md-12 col-md-offset-1">
                                                                <?php
                                                                $imgCar = $objCar->getCarImages($_SESSION['car1'][0]->id);

                                                                $objImgHlp->slideShow("carProfileSlideShow", $imgCar);
                                                                ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-md-offset-2" style="margin-top:15px;">
                                                        <div class="input-group">
                                                            <span><strong>ยี่ห้อรถยนต์ : </strong><?php echo $_SESSION['car1'][0]->brand_name; ?></span>
                                                        </div>
                                                        <p></p>
                                                        <div class="input-group">
                                                            <span><strong>รุ่น : </strong><?php echo $_SESSION['car1'][0]->model_name; ?></span>
                                                        </div>
                                                        <p></p>
                                                        <div class="input-group">
                                                            <span><strong>ปี : </strong><?php echo $_SESSION['car1'][0]->car_year; ?></span>
                                                        </div>
                                                        <p></p>
                                                        <div class="input-group">
                                                            <span><strong>เลขตัวถัง : </strong><?php echo $_SESSION['car1'][0]->body_number; ?></span>
                                                        </div>
                                                        <p></p>
                                                        <div class="input-group">
                                                            <span><strong>ปริมาตรกระบอกสูบ (CC) : </strong><?php echo $_SESSION['car1'][0]->cylinder; ?></span>
                                                        </div>
                                                        <p></p>
                                                        <div class="input-group">
                                                            <span><strong>ความจุถังน้ำมัน (ลิตร) : </strong><?php echo $_SESSION['car1'][0]->fuel_tank; ?></span>
                                                        </div>
                                                        <p></p>
                                                    </div>
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
                                        <div class="panel-body"></div>
                                        <div class="panel-footer">
                                            <div class="row clearfix">
                                                <div class="col-md-12 col-md-offset-1">
                                                    <div class="col-md-10">
                                                        <div class="row clearfix">
                                                            <div class="col-md-12 col-md-offset-1">
                                                                <?php
                                                                $imgCar = $objCar->getCarImages($_SESSION['car2'][0]->id);
                                                                $objImgHlp->slideShow("carProfileSlideShow", $imgCar);
                                                                ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6 col-md-offset-2" style="margin-top:15px;">
                                                        <div class="input-group">
                                                            <span><strong>ยี่ห้อรถยนต์ : </strong><?php echo $_SESSION['car2'][0]->brand_name; ?></span>
                                                        </div>
                                                        <p></p>
                                                        <div class="input-group">
                                                            <span><strong>รุ่น : </strong><?php echo $_SESSION['car2'][0]->model_name; ?></span>
                                                        </div>
                                                        <p></p>
                                                        <div class="input-group">
                                                            <span><strong>ปี : </strong><?php echo $_SESSION['car2'][0]->car_year; ?></span>
                                                        </div>
                                                        <p></p>
                                                        <div class="input-group">
                                                            <span><strong>เลขตัวถัง : </strong><?php echo $_SESSION['car2'][0]->body_number; ?></span>
                                                        </div>
                                                        <p></p>
                                                        <div class="input-group">
                                                            <span><strong>ปริมาตรกระบอกสูบ (CC) : </strong><?php echo $_SESSION['car2'][0]->cylinder; ?></span>
                                                        </div>
                                                        <p></p>
                                                        <div class="input-group">
                                                            <span><strong>ความจุถังน้ำมัน (ลิตร) : </strong><?php echo $_SESSION['car2'][0]->fuel_tank; ?></span>
                                                        </div>
                                                        <p></p>
                                                    </div>
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
        <!-- Footer -->
        <?php include 'footer.php'; ?>
    </body>
</html>
