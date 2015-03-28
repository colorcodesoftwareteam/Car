<?php
session_start();
include 'src/class/ManageBrandCar.php';
include 'src/class/ManageModelCar.php';
include 'src/class/ManageCar.php';

$objCar = new ManageCar ();

if (@$_GET ['submit'] == 'true') {
    $brandid = $_POST ['brandid'];
    $modelid = $_POST ['modelid'];
    $caryear = $_POST ['caryear'];
    $bodynumber = $_POST ['bodynumber'];
    $cylinder = $_POST ['cylinder'];
    $fueltank = $_POST ['fueltank'];
    $files = $_FILES['files'];

    if ($objCar->add($brandid, $modelid, $caryear, $bodynumber, $cylinder, $fueltank)) {
        $lastRow = $objCar->getLastCar();

        for ($i = 0; $i < 10; $i++) {
            if ($files['name'][$i] == '') {
                continue;
            }
            $folder = 'img/upload/';
            $name = $files['name'][$i];
            $ext = explode('.', $name);
            $newname = $ext[0] . '_' . date('YmdHis') . '.' . $ext[1];
            $path = $folder . $newname;

            move_uploaded_file($files['tmp_name'][$i], $path);

            $objCar->addImage($lastRow->id, $name, $path);
        }
        echo '<meta http-equiv=REFRESH CONTENT=0;url=ManageCarProfile.php>';
    }
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

                                    <br></br>
                                    <div class="row clearfix">


                                        <div class="col-md-12 column">

                                            <div class="panel panel-default">

                                                <div class="panel-body">

                                                    <form class="form-horizontal" role="form"
                                                          action="addCarProfile.php?submit=true" method="post"  enctype="multipart/form-data">

                                                        <div class="form-group">
                                                            <label for="pic1" class="col-sm-2 control-label">รูปภาพที่ 1</label>
                                                            <div class="col-md-4">
                                                                <input class="form-control" id="pic1" type="file" name="files[]" />

                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="pic2" class="col-sm-2 control-label">รูปภาพที่ 2</label>
                                                            <div class="col-md-4">
                                                                <input class="form-control" id="pic2" type="file" name="files[]" />

                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="pic3" class="col-sm-2 control-label">รูปภาพที่ 3</label>
                                                            <div class="col-md-4">
                                                                <input class="form-control" id="pic3" type="file" name="files[]" />

                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="pic4" class="col-sm-2 control-label">รูปภาพที่ 4</label>
                                                            <div class="col-md-4">
                                                                <input class="form-control" id="pic4" type="file" name="files[]" />

                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="pic5" class="col-sm-2 control-label">รูปภาพที่ 5</label>
                                                            <div class="col-md-4">
                                                                <input class="form-control" id="pic5" type="file" name="files[]" />

                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="pic6" class="col-sm-2 control-label">รูปภาพที่ 6</label>
                                                            <div class="col-md-4">
                                                                <input class="form-control" id="pic6" type="file" name="files[]" />

                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="pic7" class="col-sm-2 control-label">รูปภาพที่ 7</label>
                                                            <div class="col-md-4">
                                                                <input class="form-control" id="pic7" type="file" name="files[]" />

                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="pic8" class="col-sm-2 control-label">รูปภาพที่ 8</label>
                                                            <div class="col-md-4">
                                                                <input class="form-control" id="pic8" type="file" name="files[]" />

                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="pic9" class="col-sm-2 control-label">รูปภาพที่ 9</label>
                                                            <div class="col-md-4">
                                                                <input class="form-control" id="pic9" type="file" name="files[]" />

                                                            </div>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="pic10" class="col-sm-2 control-label">รูปภาพที่ 10</label>
                                                            <div class="col-md-4">
                                                                <input class="form-control" id="pic10" type="file" name="files[]" />

                                                            </div>
                                                        </div>

                                                        <hr/>
                                                        <div class="form-group">
                                                            <label for="inputEmail3" class="col-sm-2 control-label">ยี่ห้อรถ</label>
                                                            <div class="col-md-4">
                                                                <select class="form-control" id="brand" name="brandid" required="true">
                                                                    <option>-เลือก-</option>
                                                                    <?php
                                                                    $objBrand = new ManageBrandCar ();
                                                                    $rsBrand = $objBrand->getBrandAll();
                                                                    foreach ($rsBrand as $row) {
                                                                        ?>
                                                                        <option value="<?php echo $row->id; ?>"><?php echo $row->name; ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="inputEmail3" class="col-sm-2 control-label">รุ่น</label>

                                                            <div class="col-md-4">
                                                                <select class="form-control" name="modelid" id="model"
                                                                        style="visibility: hidden;" required="true">
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="inputEmail3" class="col-sm-2 control-label">ประเภทรถยนต์</label>
                                                            <div class="col-md-4">

                                                                <select class="form-control" name="typecar" required="true">
                                                                    <option value="0">-เลือก-</option>
                                                                    <option value="1">รถเก๋ง</option>
                                                                    <option value="2">รถกระบะ</option>

                                                                </select>
                                                            </div>

                                                        </div>
                                                        <div class="form-group">
                                                            <label for="inputEmail3" class="col-sm-2 control-label">ปีที่ผลิต</label>
                                                            <div class="col-sm-4">
                                                                <input class="form-control" id="inputEmail3" type="number"
                                                                       name="caryear" />
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="inputPassword3" class="col-sm-2 control-label">เลขตัวถัง</label>
                                                            <div class="col-sm-4">
                                                                <input class="form-control" id="inputPassword3"
                                                                       type="text" name="bodynumber" required="true"/>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="inputPassword3" class="col-sm-2 control-label">ปริมาตรกระบอกสูบ
                                                                (CC)</label>
                                                            <div class="col-sm-4">
                                                                <input class="form-control" id="inputPassword3"
                                                                       type="text" name="cylinder" required="true"/>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="inputPassword3" class="col-sm-2 control-label">ความจุถังน้ำมัน</label>
                                                            <div class="col-sm-4">
                                                                <input class="form-control" id="inputPassword3"
                                                                       type="text" name="fueltank" required="true"/>
                                                            </div>
                                                        </div>
                                                        <button type="reset" class="btn btn-primary">&nbsp;&nbsp;ล้างข้อมูล&nbsp;&nbsp;</button>
                                                        <button type="submit" class="btn btn-success">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;เพิ่ม&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>

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

                    <script type="text/javascript">
                        $(function () {
                            $('#brand').change(function () {
                                var brandid = $('#brand').val();
                                $('#model').css('visibility', 'visible');
                                $.post('json/listModel.php', {id: brandid}, function (data) {
                                    $('#model').html(data);
                                });


                            });

                        });
                    </script>

                    </body>
                    </html>
