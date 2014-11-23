<?php
include 'src/class/ManageBrandCar.php';
include 'src/class/ManageModelCar.php';
include 'src/class/ManageCar.php';

$objcar = new ManageCar ();
if (@$_GET ['submit'] == 'true') {
	$brandid = $_POST ['brandid'];
	$modelid = $_POST ['modelid'];
	$caryear = $_POST ['caryear'];
	$bodynumber = $_POST ['bodynumber'];
	$cylinder = $_POST ['cylinder'];
	$fueltank = $_POST ['fueltank'];
	
	if ($objcar->add ( $brandid, $modelid, $caryear, $bodynumber, $cylinder, $fueltank ))
		echo '<meta http-equiv=REFRESH CONTENT=0;url=ManageCarProfile.php>';
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

<!--link rel="stylesheet/less" href="less/bootstrap.less" type="text/css" /-->
<!--link rel="stylesheet/less" href="less/responsive.less" type="text/css" /-->
<!--script src="js/less-1.3.3.min.js"></script-->
<!--append ‘#!watch’ to the browser URL, then refresh the page. -->

<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">

<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
<!--[if lt IE 9]>
          <script src="js/html5shiv.js"></script>
        <![endif]-->

<!-- Fav and touch icons -->
<link rel="apple-touch-icon-precomposed" sizes="144x144"
	href="img/apple-touch-icon-144-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="114x114"
	href="img/apple-touch-icon-114-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="72x72"
	href="img/apple-touch-icon-72-precomposed.png">
<link rel="apple-touch-icon-precomposed"
	href="img/apple-touch-icon-57-precomposed.png">
<link rel="shortcut icon" href="img/favicon.png">

<script type="text/javascript" src="js/jquery.min.js"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/scripts.js"></script>
</head>

<body>
	<div class="container">
		<div class="row clearfix page-header">
			<div class="col-md-12 column">
				<div class="row clearfix">
					<div class="col-md-4 column">
						<img class="img-rounded" src="http://placehold.it/650x250" alt="">
					</div>
					<div class="col-md-4 column"></div>

					<div class="col-md-8 ">
						<form class="form-inline pull-right" role="form">
							<div class="form-group">
								<div class="input-group">
									<label class="sr-only" for="exampleInputEmail2">ชื่อผู้ใช้</label>
									<input type="email" class="form-control"
										id="exampleInputEmail2" placeholder="ชื่อผู้ใช้">
								</div>
							</div>
							<div class="form-group">
								<label class="sr-only" for="exampleInputPassword2">รหัสผ่าน</label>
								<input type="password" class="form-control"
									id="exampleInputPassword2" placeholder="รหัสผ่าน">
							</div>
							<button type="submit" class="btn btn-default">เข้าสู่ระบบ</button>
							<div class="form-inline">
								<label> <a href="#">สมัครสมาชิก</a>
								</label>
							</div>
						</form>
					</div>
				</div>
				<nav class="navbar navbar-default" role="navigation">
					<div class="navbar-header pull-right">
						<button type="button" class="navbar-toggle" data-toggle="collapse"
							data-target="#bs-example-navbar-collapse-1">
							<span class="sr-only">หน้าหลัก</span><span class="icon-bar"></span><span
								class="icon-bar"></span><span class="icon-bar"></span>
						</button>
						<a class="navbar-brand" href="#">หน้าหลัก</a>
						<button type="button" class="navbar-toggle" data-toggle="collapse"
							data-target="#bs-example-navbar-collapse-1">
							<span class="sr-only">เปรียบเทียบรถยนต์</span><span
								class="icon-bar"></span><span class="icon-bar"></span><span
								class="icon-bar"></span>
						</button>
						<a class="navbar-brand" href="#">เปรียบเทียบรถยนต์</a>
					</div>
				</nav>
			</div>
		</div>


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

								<button type="button" class="btn btn-primary btn-lg">เพิ่มรูป</button>
								<br></br>
								<div class="row clearfix">
									<div class="col-md-12 column">
										<div class="panel panel-default">

											<div class="panel-body">
												<form class="form-horizontal" role="form"
													action="addCarProfile.php?submit=true" method="post">

													<div class="form-group">
														<label for="inputEmail3" class="col-sm-2 control-label">ยี่ห้อรถ</label>
														<div class="col-md-4">
															<select class="form-control" id="brand" name="brandid">
																<option>-เลือก-</option>
															<?php
															$objBrand = new ManageBrandCar ();
															$rsBrand = $objBrand->getBrandAll ();
															while ( $rowBrand = mysql_fetch_object ( $rsBrand ) ) {
																?>
																<option value="<?php echo $rowBrand->id;?>"><?php echo $rowBrand->name;?></option>
															<?php }?>
															</select>
														</div>
													</div>
													<div class="form-group">
														<label for="inputEmail3" class="col-sm-2 control-label">รุ่น</label>

														<div class="col-md-4">
															<select class="form-control" name="modelid" id="model"
																style="visibility: hidden;">


															</select>

														</div>
													</div>
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
													<div class="form-group">
														<label for="inputEmail3" class="col-sm-2 control-label">ปีที่ผลิต</label>
														<div class="col-sm-10">
															<input class="form-control" id="inputEmail3" type="text"
																name="caryear" />
														</div>
													</div>
													<div class="form-group">
														<label for="inputPassword3" class="col-sm-2 control-label">เลขตัวถัง</label>
														<div class="col-sm-10">
															<input class="form-control" id="inputPassword3"
																type="text" name="bodynumber" />
														</div>
													</div>
													<div class="form-group">
														<label for="inputPassword3" class="col-sm-2 control-label">ปริมาตรกระบอกสูบ
															(CC)</label>
														<div class="col-sm-10">
															<input class="form-control" id="inputPassword3"
																type="text" name="cylinder" />
														</div>
													</div>
													<div class="form-group">
														<label for="inputPassword3" class="col-sm-2 control-label">ความจุถังน้ำมัน</label>
														<div class="col-sm-10">
															<input class="form-control" id="inputPassword3"
																type="text" name="fueltank" />
														</div>
													</div>
													<button type="button" class="btn btn-success btn-lg">&nbsp;&nbsp;ล้างข้อมูล&nbsp;&nbsp;</button>
													<button type="submit" class="btn btn-primary btn-lg">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;เพิ่ม&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>

												</form>
											</div>

										</div>

									</div>
								</div>
							</div>
						</div>
					</div>

				</div>
				<div class="row clearfix">
					<p></p>
				</div>
				<footer class="panel-footer">
					<div class="container">
						<p class="text-muted">Copyright © Your Website 2014</p>
					</div>
				</footer>

				<script type="text/javascript">
				$(function(){
					$('#brand').change(function(){
						var brandid = $('#brand').val();
						$('#model').css('visibility','visible');
						$.post('json/listModel.php',{id:brandid},function(data){
							$('#model').html(data);
						});
						
						
					});

				});
				</script>

</body>
</html>
