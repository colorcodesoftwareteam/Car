<?php
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



    if ($objCar->add($brandid, $modelid, $caryear, $bodynumber, $cylinder, $fueltank)){
		$lastRow = $objCar->getLastCar();
	
		for($i=0;$i<10;$i++){
			if($files['name'][$i]==''){
				continue;
			}
				$folder = 'img/upload/';
				$name = $files['name'][$i];
				$ext = explode('.',$name);
				$newname = $ext[0].'_'.date('YmdHis').'.'.$ext[1];
				$path = $folder.$newname;

				move_uploaded_file($files['tmp_name'][$i],$path);
				
				$objCar->addImage($lastRow->id,$name,$path);
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
										
										
														  
													<hr/>
                                                        <div class="form-group">
                                                            <label for="inputEmail3" class="col-sm-2 control-label">ชื่อ</label>
                                                            <div class="col-md-4">
                                                                 <input class="form-control" id="inputPassword3"
                                                                       type="text" name="fueltank" />
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="inputEmail3" class="col-sm-2 control-label">นามสกุล</label>

                                                            <div class="col-md-4">
                                                                <input class="form-control" id="inputPassword3"
                                                                       type="text" name="fueltank" />

                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="inputEmail3" class="col-sm-2 control-label">เพศ</label>
                                                            <div class="col-md-4">

                                                                <select class="form-control" name="typecar">
                                                                    <option value="0">ชาย</option>
                                                                    <option value="1">หญิง</option>

                                                                </select>
                                                            </div>

                                                        </div>
                                                        <div class="form-group">
                                                            <label for="inputEmail3" class="col-sm-2 control-label">วันเกิด</label>
                                                            <div class="col-sm-10">
                                                                <input class="form-control" id="dateData" type="datetime" name="caryear" />
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="inputPassword3" class="col-sm-2 control-label">ที่อยู่</label>
                                                            <div class="col-sm-10">
                                                                <input class="form-control" id="inputPassword3"
                                                                       type="text" name="bodynumber" />
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="inputPassword3" class="col-sm-2 control-label">เบอร์โทรศัพท์</label>
                                                            <div class="col-sm-10">
                                                                <input class="form-control" id="inputPassword3"
                                                                       type="text" name="cylinder" />
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="inputPassword3" class="col-sm-2 control-label">อีเมลล์</label>
                                                            <div class="col-sm-10">
                                                                <input class="form-control" id="inputPassword3"
                                                                       type="text" name="fueltank" />
                                                            </div>
                                                        </div>
														
														<div class="panel panel-default">
														<div class="panel-body">
														<div class="form-group">
                                                            <label for="inputEmail3" class="col-sm-2 control-label">บทบาท</label>
                                                            <div class="col-md-4">

                                                                <select class="form-control" name="typecar">
                                                                    <option value="0">อ่านกระทู้</option>
                                                                    <option value="1">เขียนกระทู้</option>

                                                                </select>
                                                            </div>

                                                        </div>
														</div>
														</div>
														
														
                                                        <button type="button" class="btn btn-success btn-lg">&nbsp;&nbsp;ล้างข้อมูล&nbsp;&nbsp;</button>
                                                        <button type="submit" class="btn btn-primary btn-lg">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;แก้ไข&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>

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
                        $(function() {
                            $('#brand').change(function() {
                                var brandid = $('#brand').val();
                                $('#model').css('visibility', 'visible');
                                $.post('json/listModel.php', {id: brandid}, function(data) {
                                    $('#model').html(data);
                                });


                            });
							
							$( "#datepicker" ).datepicker();
							});

                        });
	
                    </script>


                    </body>
                    </html>
