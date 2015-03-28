<?php
include 'src/class/ManageBrandCar.php';
include 'src/class/ManageModelCar.php';
include "src/class/ManageCar.php";

$objCar = new ManageCar();
$objBrand = new ManageBrandCar ();
$objModel = new ManageModelCar ();

$pageSize = 8;
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
                                <div class="col-md-6 column">
                                    <?php
                                    if (isset($_SESSION['car1']) && isset($_SESSION['car2'])) {
                                        ?>
                                        <a href="carCompareProfiles.php"><button class="btn btn-success">เปรียบเทียบ</button></a>
                                        <?php
                                    }
                                    ?>
                                </div>
                                <div class="col-md-6 column">
                                    <div class="col-md-offset-10">
<!--                                      
                                        <button type="button" class="glyphicon glyphicon-print btn-primary btn">
                                            พิมพ์
                                        </button> 
                                      
-->       
                                    </div>
                                </div>
                            </div>
                            <p/>
                            <div class="row clearfix">
                                <div class="col-md-6 column">
                                    <div class="panel panel-primary">
                                        <div class="panel-heading">
                                            <h3 class="panel-title">
                                                เลือกรถยนต์
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
                                            <hr/>
                                            <div class="row clearfix">
                                                <?php
                                                $arrCar = $objCar->getSearchCarPaging($brand_id, $model_id, $year, $pageSize, $currentPage);
                                                for ($i = 1; $i <= 4; $i++) {
                                                    ?>
                                                    <div class="row clearfix">
                                                        <?php
                                                        for ($j = 1; $j <= 2; $j++) {
                                                            $row = $arrCar->current();
                                                            if (isset($row)) {
                                                                ?>
                                                                <div class="col-md-6 column">
                                                                    <div class="row clearfix">
                                                                        <?php
                                                                        if (!isset($_SESSION['car1'])) {
                                                                            $action = 'choosecar1';
                                                                        } else {
                                                                            $action = 'choosecar2';
                                                                        }
                                                                        ?>
                                                                        <a href="actionsMember.php?action=<?php echo $action; ?>&carid=<?php echo $row->id ?>">
                                                                        <!-- <a href="carProfile.php?car_id=<?php //echo $row->id         ?>&brandid=<?php //echo $brand_id         ?>&modelid=<?php //echo $model_id         ?>&year=<?php //echo $year         ?>"> -->
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
                                                                                <!-- <a href="actionsNonMember.php?action=<?php //echo $action;         ?>&carid=<?php //echo $row->id         ?>"><button class="btn">เลือก</button></a> -->
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
                                        </div>
                                        <div class="panel-footer">
                                            <div class="row clearfix">
                                                <div class="col-md-offset-4">
                                                    <nav>
                                                        <?php $objCar->getPaging("carCompare", $currentPage); ?>
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
                                    <?php if (isset($_SESSION['car1'])) { ?>
                                        <div class="panel panel-primary">
                                            <div class="panel-heading">
                                                <h3 class="panel-title">

                                                </h3>
                                            </div>
                                            <div class="panel-body">
                                                <form class="form-horizontal" role="form"
                                                      action="actionsMember.php?action=choosecarbynewcar" method="post"  enctype="multipart/form-data">

                                                    <div class="form-group">
                                                        <label for="pic1" class="col-sm-3 control-label">รูปภาพที่ 1</label>
                                                        <div class="col-md-8">
                                                            <input class="form-control" id="pic1" type="file" name="files[]" />

                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="pic2" class="col-sm-3 control-label">รูปภาพที่ 2</label>
                                                        <div class="col-md-8">
                                                            <input class="form-control" id="pic2" type="file" name="files[]" />

                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="pic3" class="col-sm-3 control-label">รูปภาพที่ 3</label>
                                                        <div class="col-md-8">
                                                            <input class="form-control" id="pic3" type="file" name="files[]" />

                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="pic4" class="col-sm-3 control-label">รูปภาพที่ 4</label>
                                                        <div class="col-md-8">
                                                            <input class="form-control" id="pic4" type="file" name="files[]" />

                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="pic5" class="col-sm-3 control-label">รูปภาพที่ 5</label>
                                                        <div class="col-md-8">
                                                            <input class="form-control" id="pic5" type="file" name="files[]" />

                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="pic6" class="col-sm-3 control-label">รูปภาพที่ 6</label>
                                                        <div class="col-md-8">
                                                            <input class="form-control" id="pic6" type="file" name="files[]" />

                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="pic7" class="col-sm-3 control-label">รูปภาพที่ 7</label>
                                                        <div class="col-md-8">
                                                            <input class="form-control" id="pic7" type="file" name="files[]" />

                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="pic8" class="col-sm-3 control-label">รูปภาพที่ 8</label>
                                                        <div class="col-md-8">
                                                            <input class="form-control" id="pic8" type="file" name="files[]" />

                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="pic9" class="col-sm-3 control-label">รูปภาพที่ 9</label>
                                                        <div class="col-md-8">
                                                            <input class="form-control" id="pic9" type="file" name="files[]" />

                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="pic10" class="col-sm-3 control-label">รูปภาพที่ 10</label>
                                                        <div class="col-md-8">
                                                            <input class="form-control" id="pic10" type="file" name="files[]" />

                                                        </div>
                                                    </div>

                                                    <hr/>
                                                    <div class="form-group">
                                                        <label for="inputEmail3" class="col-sm-3 control-label">ยี่ห้อรถ</label>
                                                        <div class="col-md-8">
                                                            <select class="form-control" id="brandAdd" name="brandid" required>
                                                                <option >-เลือก-</option>
                                                                <?php
                                                                $rsBrand = $objBrand->getBrandAll();
                                                                foreach ($rsBrand as $row) {
                                                                    ?>
                                                                    <option value="<?php echo $row->id; ?>"><?php echo $row->name; ?></option>
                                                                <?php } ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="inputEmail3" class="col-sm-3 control-label">รุ่น</label>

                                                        <div class="col-md-8">
                                                            <select class="form-control" name="modelid" id="modelAdd" style="visibility: hidden;" required>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="inputEmail3" class="col-sm-3 control-label">ประเภทรถยนต์</label>
                                                        <div class="col-md-8">

                                                            <select class="form-control" name="typecar" required="required">
                                                                <option value="0">-เลือก-</option>
                                                                <option value="1">รถเก๋ง</option>
                                                                <option value="2">รถกระบะ</option>

                                                            </select>
                                                        </div>

                                                    </div>
                                                    <div class="form-group">
                                                        <label for="inputEmail3" class="col-sm-3 control-label">ปีที่ผลิต</label>
                                                        <div class="col-sm-8">
                                                            <input class="form-control" id="inputEmail3" type="text"
                                                                   name="caryear" required="required"/>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="inputPassword3" class="col-sm-3 control-label">เลขตัวถัง</label>
                                                        <div class="col-sm-8">
                                                            <input class="form-control" id="inputPassword3"
                                                                   type="text" name="bodynumber" required="required"/>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="inputPassword3" class="col-sm-3 control-label">ปริมาตรกระบอกสูบ
                                                            (CC)</label>
                                                        <div class="col-sm-8">
                                                            <input class="form-control" id="inputPassword3"
                                                                   type="text" name="cylinder" required="required"/>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="inputPassword3" class="col-sm-3 control-label">ความจุถังน้ำมัน</label>
                                                        <div class="col-sm-8">
                                                            <input class="form-control" id="inputPassword3"
                                                                   type="text" name="fueltank" required="required"/>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                       
                                                        <div class="col-sm-8 col-md-offset-3">
                                                            <input type="submit" class="btn btn-primary" value="เพิ่ม">
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            <div class="panel-footer">

                                            </div>
                                        </div>
                                    <?php } ?>
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

<script type="text/javascript">
    $(function () {
        $('#brandAdd').change(function () {
            var brandid = $('#brandAdd').val();
            $('#modelAdd').css('visibility', 'visible');
            $.post('json/listModel.php', {id: brandid}, function (data) {
                $('#modelAdd').html(data);
            });
        });
    });
</script>
