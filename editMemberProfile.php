<?php
include_once 'src/class/MemberSystem.php';
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
                            <h4>แก้ไขโปรไฟล์</h4>
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
                                                    <?php
                                                    $objMem = new MemberSystem();
                                                    $curMember = $objMem->getMemeberById($_SESSION['memberId']);
                                                    ?>
                                                    <form class="form-horizontal" role="form"
                                                          action="actionsMember.php?action=updateprofile&memberid=<?php echo $_SESSION['memberId'] ?>" method="post"  enctype="multipart/form-data">
                                                        <hr/>


                                                        <div class="form-group">
                                                            <label for="inputEmail3" class="col-sm-2 control-label">ชื่อ</label>
                                                            <div class="col-md-4">
                                                                <input class="form-control" id="inputPassword3"
                                                                       type="text" name="name"  value="<?php echo $curMember->current()->name; ?>"/>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="inputEmail3" class="col-sm-2 control-label">นามสกุล</label>

                                                            <div class="col-md-4">
                                                                <input class="form-control" id="inputPassword3"
                                                                       type="text" name="lastname" value="<?php echo $curMember->current()->lastname; ?>" />

                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="inputEmail3" class="col-sm-2 control-label">เพศ</label>
                                                            <div class="col-md-4">

                                                                <select class="form-control" name="gender">
                                                                    <option value="0" <?php echo ($curMember->current()->gender == '0') ? 'selected' : ''; ?>>ชาย</option>
                                                                    <option value="1" <?php echo ($curMember->current()->gender == '1') ? 'selected' : ''; ?>>หญิง</option>
                                                                </select>
                                                            </div>

                                                        </div>
                                                        <div class="form-group">
                                                            <label for="inputEmail3" class="col-sm-2 control-label">วันเกิด</label>
                                                            <div class="col-sm-10">
                                                                <input class="form-control" id="dateData" type="datetime" name="birthdate" value="<?php echo $curMember->current()->birthdate; ?>"/>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="inputPassword3" class="col-sm-2 control-label">ที่อยู่</label>
                                                            <div class="col-sm-10">
                                                                <input class="form-control" id="inputPassword3"
                                                                       type="text" name="address"  value="<?php echo $curMember->current()->address; ?>"/>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="inputPassword3" class="col-sm-2 control-label">เบอร์โทรศัพท์</label>
                                                            <div class="col-sm-10">
                                                                <input class="form-control" id="inputPassword3"
                                                                       type="text" name="phoneNumber"  value="<?php echo $curMember->current()->phoneNumber; ?>"/>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="inputPassword3" class="col-sm-2 control-label">อีเมลล์</label>
                                                            <div class="col-sm-10">
                                                                <input class="form-control" id="inputPassword3"
                                                                       type="email" name="email" value="<?php echo $curMember->current()->email; ?>" />
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="inputPassword3" class="col-sm-2 control-label">รหัสผ่าน</label>
                                                            <div class="col-sm-4">
                                                                <input class="form-control" id="inputPassword3"
                                                                       type="password" name="password" />
                                                            </div>
                                                        </div>
                                                        <!-- <button type="button" class="btn btn-success">&nbsp;&nbsp;ล้างข้อมูล&nbsp;&nbsp;</button> -->
                                                        <button type="submit" class="btn btn-success">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;แก้ไข&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>



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
