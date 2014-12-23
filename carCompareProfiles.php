<?php
include_once 'src/class/ManageBrandCar.php';
include_once 'src/class/ManageModelCar.php';
include_once "src/class/ManageCar.php";

$objCar = new ManageCar();
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
                                <div class=" col-md-offset-9">
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

                                                    <div class="col-md-6 ">
                                                        <?php
                                                        $imgCar = $objCar->getCarImages($_SESSION['car1'][0]->id);
                                                        ?>

                                                        <div id="carousel-example-generic" class="carousel slide col-md-10" data-ride="carousel">
                                                            <!-- Indicators -->
                                                            <ol class="carousel-indicators">
                                                                <?php
                                                                $i = 0;
                                                                foreach ($imgCar as $row) {
                                                                    ?>
                                                                    <li data-target="#carousel-example-generic" data-slide-to="<?php echo $i++; ?>" ></li>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </ol>

                                                            <!-- Wrapper for slides -->
                                                            <div class="carousel-inner" role="listbox">
                                                                <?php
                                                                $i = 0;
                                                                if ($imgCar->count() > 0) {
                                                                    foreach ($imgCar as $row) {
                                                                        if ($i == 0) {
                                                                            ?>
                                                                            <div class="item active">
                                                                                <?php
                                                                            } else {
                                                                                ?>
                                                                                <div class="item ">
                                                                                    <?php
                                                                                }
                                                                                ?>
                                                                                <img src="<?php echo $row->path; ?>" alt="..." >
                                                                                <div class="carousel-caption">
                                                                                    <?php
                                                                                    $i++;
                                                                                    ?>
                                                                                </div>
                                                                            </div>

                                                                            <?php
                                                                        }
                                                                        ?>
                                                                    <?php
                                                                } else {
                                                                    ?>
                                                                    <div class="active">
                                                                        <img src="img/no_img.jpg" alt="..." >
                                                                    </div>
                                                                    <?php
                                                                }
                                                                ?>
                                                                <!-- Controls -->
                                                                <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                                                                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                                                    <span class="sr-only">Previous</span>
                                                                </a>
                                                                <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                                                                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                                                    <span class="sr-only">Next</span>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="col-md-8">
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <label class="sr-only" for="exampleInputEmail2">ยี่ห้อรถยนต์</label>
                                                                <input type="email" class="form-control" id="text1" placeholder="ยี่ห้อรถยนต์" value="<?php echo $_SESSION['car1'][0]->brand_name; ?>">
                                                            </div>
                                                            <p></p>
                                                            <div class="input-group">
                                                                <label class="sr-only" for="exampleInputEma">รุ่น</label>
                                                                <input type="email" class="form-control" id="text2" placeholder="รุ่น" value="<?php echo $_SESSION['car1'][0]->model_name; ?>">
                                                            </div>
                                                            <p></p>
                                                            <!--
                                                            <div class="input-group">
                                                                <label class="sr-only" for="exampleInputEmail2">ประเภทรถยนต์</label>
                                                                <input type="email" class="form-control" id="text3" placeholder="ประเภทรถยนต์" value="<?php echo $_SESSION['car1'][0]->brand_name; ?>">
                                                            </div> 
                                                            -->
                                                            <p></p>
                                                            <div class="input-group">
                                                                <label class="sr-only" for="exampleInputEmail2">ปีที่ผลิต</label>
                                                                <input type="email" class="form-control" id="text4" placeholder="ปีที่ผลิต" value="<?php echo $_SESSION['car1'][0]->car_year; ?>">
                                                            </div>
                                                            <p></p>
                                                            <div class="input-group">
                                                                <label class="sr-only" for="exampleInputEmail2">เลขตัวถัง</label>
                                                                <input type="email" class="form-control" id="text5" placeholder="เลขตัวถัง" value="<?php echo $_SESSION['car1'][0]->body_number; ?>">
                                                            </div>
                                                            <p></p>
                                                            <div class="input-group">
                                                                <label class="sr-only" for="exampleInputEmail2">ปริมาตรกระบอกสูบ(CC)</label>
                                                                <input type="email" class="form-control" id="text6" placeholder="ปริมาตรกระบอกสูบ" value="<?php echo $_SESSION['car1'][0]->cylinder; ?>">
                                                            </div>
                                                            <p></p>
                                                            <div class="input-group">
                                                                <label class="sr-only" for="exampleInputEmail2">ความจุถังน้ำมัน</label>
                                                                <input type="email" class="form-control" id="text7" placeholder="ความจุถังน้ำมัน" value="<?php echo $_SESSION['car1'][0]->fuel_tank; ?>">
                                                            </div>
                                                            <p></p>
                                                            <div class="input-group">
                                                                <label class="sr-only" for="exampleInputEmail2">รายละเอียดอื่นๆ</label>
                                                                <input type="email" class="form-control" id="text8" placeholder="รายละเอียดอื่นๆ" value="<?php echo $_SESSION['car1'][0]->detail; ?>">
                                                            </div>
                                                        </div>
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

                                                    <div class="col-md-6">
                                                        <?php
                                                        $imgCar = $objCar->getCarImages($_SESSION['car2'][0]->id);
                                                        ?>
                                                        <div id="carousel-example-generic" class="carousel slide col-md-10" data-ride="carousel">
                                                            <!-- Indicators -->
                                                            <ol class="carousel-indicators">
                                                                <?php
                                                                $i = 0;
                                                                foreach ($imgCar as $row) {
                                                                    ?>
                                                                    <li data-target="#carousel-example-generic" data-slide-to="<?php echo $i++; ?>" ></li>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </ol>

                                                            <!-- Wrapper for slides -->
                                                            <div class="carousel-inner" role="listbox">
                                                                <?php
                                                                $i = 0;
                                                                if ($imgCar->count() > 0) {
                                                                    foreach ($imgCar as $row) {
                                                                        if ($i == 0) {
                                                                            ?>
                                                                            <div class="item active">
                                                                                <?php
                                                                            } else {
                                                                                ?>
                                                                                <div class="item ">
                                                                                    <?php
                                                                                }
                                                                                ?>
                                                                                <img src="<?php echo $row->path; ?>" alt="..." >
                                                                                <div class="carousel-caption">
                                                                                    <?php
                                                                                    $i++;
                                                                                    ?>
                                                                                </div>
                                                                            </div>

                                                                            <?php
                                                                        }
                                                                        ?>
                                                                    <?php
                                                                } else {
                                                                    ?>
                                                                    <div class="active">
                                                                        <img src="img/no_img.jpg" alt="..." >
                                                                    </div>
                                                                    <?php
                                                                }
                                                                ?>
                                                                <!-- Controls -->
                                                                <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                                                                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                                                    <span class="sr-only">Previous</span>
                                                                </a>
                                                                <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                                                                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                                                    <span class="sr-only">Next</span>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    <div class="col-md-8">
                                                        <div class="form-group">
                                                            <div class="input-group">
                                                                <label class="sr-only" for="exampleInputEmail2">ยี่ห้อรถยนต์</label>
                                                                <input type="email" class="form-control" id="text1" placeholder="ยี่ห้อรถยนต์" value="<?php echo $_SESSION['car2'][0]->brand_name; ?>">
                                                            </div>
                                                            <p></p>
                                                            <div class="input-group">
                                                                <label class="sr-only" for="exampleInputEma">รุ่น</label>
                                                                <input type="email" class="form-control" id="text2" placeholder="รุ่น" value="<?php echo $_SESSION['car2'][0]->model_name; ?>">
                                                            </div>
                                                            <p></p>
                                                            <!--
                                                            <div class="input-group">
                                                                <label class="sr-only" for="exampleInputEmail2">ประเภทรถยนต์</label>
                                                                <input type="email" class="form-control" id="text3" placeholder="ประเภทรถยนต์" value="<?php echo $_SESSION['car2'][0]->brand_name; ?>">
                                                            </div>
                                                            -->
                                                            <p></p>
                                                            <div class="input-group">
                                                                <label class="sr-only" for="exampleInputEmail2">ปีที่ผลิต</label>
                                                                <input type="email" class="form-control" id="text4" placeholder="ปีที่ผลิต" value="<?php echo $_SESSION['car2'][0]->car_year; ?>">
                                                            </div>
                                                            <p></p>
                                                            <div class="input-group">
                                                                <label class="sr-only" for="exampleInputEmail2">เลขตัวถัง</label>
                                                                <input type="email" class="form-control" id="text5" placeholder="เลขตัวถัง" value="<?php echo $_SESSION['car2'][0]->body_number; ?>">
                                                            </div>
                                                            <p></p>
                                                            <div class="input-group">
                                                                <label class="sr-only" for="exampleInputEmail2">ปริมาตรกระบอกสูบ(CC)</label>
                                                                <input type="email" class="form-control" id="text6" placeholder="ปริมาตรกระบอกสูบ" value="<?php echo $_SESSION['car2'][0]->cylinder; ?>">
                                                            </div>
                                                            <p></p>
                                                            <div class="input-group">
                                                                <label class="sr-only" for="exampleInputEmail2">ความจุถังน้ำมัน</label>
                                                                <input type="email" class="form-control" id="text7" placeholder="ความจุถังน้ำมัน" value="<?php echo $_SESSION['car2'][0]->fuel_tank; ?>">
                                                            </div>
                                                            <p></p>
                                                            <div class="input-group">
                                                                <label class="sr-only" for="exampleInputEmail2">รายละเอียดอื่นๆ</label>
                                                                <input type="email" class="form-control" id="text8" placeholder="รายละเอียดอื่นๆ" value="<?php echo $_SESSION['car2'][0]->detail; ?>">
                                                            </div>
                                                        </div>
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
