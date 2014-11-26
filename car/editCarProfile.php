<?php
include 'src/class/ManageBrandCar.php';
include 'src/class/ManageModelCar.php';
include 'src/class/ManageCar.php';
include 'src/class/ImageHelper.php';

$id = $_GET ['id'];
$objcar = new ManageCar ();
$objBrand = new ManageBrandCar ();
$objModel = new ManageModelCar ();
$rsCar = $objcar->getImageByCarId($id);
$numRow = mysql_num_rows($rsCar);

if (@$_GET ['submit'] == 'true') {
    $brandid = $_POST ['brandid'];
    $modelid = $_POST ['modelid'];
    $caryear = $_POST ['caryear'];
    $bodynumber = $_POST ['bodynumber'];
    $cylinder = $_POST ['cylinder'];
    $fueltank = $_POST ['fueltank'];
	$files = $_FILES['files'];
	
    if ($objcar->edit($id, $brandid, $modelid, $caryear, $bodynumber, $cylinder, $fueltank)){
		for($i=0;$i<(10-$numRow);$i++){
			if($files['name'][$i]==''){
				continue;
			}
				$folder = 'img/upload/';
				$name = $files['name'][$i];
				$ext = explode('.',$name);
				$newname = $ext[0].'_'.date('YmdHis').'.'.$ext[1];
				$path = $folder.$newname;

				move_uploaded_file($files['tmp_name'][$i],$path);
				
				$objcar->addImage($id,$name,$path);
		}
        echo '<meta http-equiv=REFRESH CONTENT=0;url=ManageCarProfile.php>';
		
	}
}

if(@$_GET['delete']== 'true'){
	$carid = $_GET['carid'];
	if ($objcar->deleteImageById($id)){
		
		echo '<meta http-equiv=REFRESH CONTENT=0;url=editCarProfile.php?id='.$carid.'>';
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
                            <h4>แก้ไขรายละเอียดถยนต์</h4>
                            <small></small>
                        </div>

                        <div class="panel-body">
                            <div class="row clearfix">
                                <div class="col-md-12 column">


                                    <div class="row clearfix">
                                        <div class="col-md-12 column">
                                            <div class="panel panel-default">

                                                <div class="panel-body">
                                                    <form class="form-horizontal" role="form"
                                                          action="editCarProfile.php?submit=true&id=<?php echo $id ?>"
                                                          method="post"  enctype="multipart/form-data">

					<?php


					for($i=1;$i<=(10-$numRow);$i++){
					?>
					<div class="form-group">
																			<label for="pic<?php echo $i;?>" class="col-sm-2 control-label">รูปภาพที่
																				<?php echo $i;?></label>
																			<div class="col-md-4">
																				<input class="form-control" id="pic<?php echo $i;?>" type="file"
																					name="files[]" />

																			</div>
																		</div>
					<?php
					}
					$objImage = new ImageHelper();

						while($rowImages = mysql_fetch_object($rsCar)){
							$objImage->init($rowImages->path,$rowImages->id,$id);
							$objImage->process();
						}
					?>

                                                        <hr />

                                                        <div class="form-group">
                                                            <label for="inputEmail3" class="col-sm-2 control-label">ยี่ห้อรถ</label>
                                                            <div class="col-md-4">
                                                                <select class="form-control" id="brand" name="brandid">
                                                                    <option>-เลือก-</option>
                                                                    <?php
                                                                    $arrCar = $objcar->getCarById($id);
                                                                    $arrBrand = $objBrand->getBrandAll();
                                                                    foreach ($arrBrand as $row) {
                                                                        ?>
                                                                        <option
                                                                            value="<?php echo $row->id; ?>"
                                                                            <?php echo ($row->id == $arrCar->current()->brand_id) ? 'selected' : '' ?>>
                                                                            <?php echo $row->name; ?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="inputEmail3" class="col-sm-2 control-label">รุ่น</label>

                                                            <div class="col-md-4">
                                                                <select class="form-control" name="modelid" id="model">
                                                                    <?php
                                                                    $arrModel = $objModel->getModelByBrand($arrCar->current()->brand_id);
                                                                    foreach ($arrModel as $row) {
                                                                        ?>
                                                                        <option
                                                                            value="<?php echo $row->id; ?>"
                                                                            <?php echo ($row->id == $arrCar->current()->model_id) ? 'selected' : ''; ?>><?php echo $row->name; ?></option>
                                                                        <?php } ?>
                                                                </select>

                                                            </div>
                                                        </div>
                                                        <!-- 
        <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">ประเภทรถยนต์</label>
                <div class="col-md-4">

                        <select class="form-control" name="typecar">
                                <option value="0">-เลือก-</option>
                                <option value="1">รถเก๋ง</option>
                                <option value="2">รถกระบะ</option>

                        </select>
                </div>

        </div>
                                                        -->
                                                        <div class="form-group">
                                                            <label for="inputEmail3" class="col-sm-2 control-label">ปีที่ผลิต</label>
                                                            <div class="col-sm-10">
                                                                <input class="form-control" id="inputEmail3" type="text"
                                                                       name="caryear" value="<?php echo $arrCar->current()->car_year; ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="inputPassword3" class="col-sm-2 control-label">เลขตัวถัง</label>
                                                            <div class="col-sm-10">
                                                                <input class="form-control" id="inputPassword3"
                                                                       type="text" name="bodynumber"
                                                                       value="<?php echo $arrCar->current()->body_number; ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="inputPassword3" class="col-sm-2 control-label">ปริมาตรกระบอกสูบ
                                                                (CC)</label>
                                                            <div class="col-sm-10">
                                                                <input class="form-control" id="inputPassword3"
                                                                       type="text" name="cylinder"
                                                                       value="<?php echo $arrCar->current()->cylinder; ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="inputPassword3" class="col-sm-2 control-label">ความจุถังน้ำมัน</label>
                                                            <div class="col-sm-10">
                                                                <input class="form-control" id="inputPassword3"
                                                                       type="text" name="fueltank"
                                                                       value="<?php echo $arrCar->current()->fuel_tank; ?>" />
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
                    </body>
                    </html>