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
                            <h4>สมัครสมาชิก</h4>
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
                                                          action="actionsNonMember.php?action=register" submit=true" method="post"  enctype="multipart/form-data">
                                                        <hr/>
                                                        <div class="form-group">
                                                            <label for="inputEmail3" class="col-sm-2 control-label">ชื่อ</label>
                                                            <div class="col-md-4">
                                                                <input class="form-control" id="inputPassword3"
                                                                       type="text" name="name" required="true"/>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="inputEmail3" class="col-sm-2 control-label">นามสกุล</label>

                                                            <div class="col-md-4">
                                                                <input class="form-control" id="inputPassword3"
                                                                       type="text" name="lname" required="true"/>

                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="inputEmail3" class="col-sm-2 control-label">เพศ</label>
                                                            <div class="col-md-4">

                                                                <select class="form-control" name="gender" required="true">
                                                                    <option value="0">ชาย</option>
                                                                    <option value="1">หญิง</option>

                                                                </select>
                                                            </div>

                                                        </div>
                                                        <div class="form-group">
                                                            <label for="inputEmail3" class="col-sm-2 control-label">วันเกิด</label>
                                                            <div class="col-sm-4">
                                                                <input class="form-control" id="dateData" name="birthdate" placeholder="2014-12-31" required="true"/>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="inputPassword3" class="col-sm-2 control-label">ที่อยู่</label>
                                                            <div class="col-sm-4">
                                                                <input class="form-control" id="inputPassword3"
                                                                       type="text" name="address" required="true"/>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="inputPassword3" class="col-sm-2 control-label">เบอร์โทรศัพท์</label>
                                                            <div class="col-sm-4">
                                                                <input class="form-control" id="inputPassword3"
                                                                       type="number" name="phone" required="true" />
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="inputPassword3" class="col-sm-2 control-label">อีเมลล์</label>
                                                            <div class="col-sm-4">
                                                                <input class="form-control" id="inputPassword3"
                                                                       type="email" name="email" required="true"/>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="inputPassword3" class="col-sm-2 control-label">รหัสผ่าน</label>
                                                            <div class="col-sm-4">
                                                                <input class="form-control" id="inputPassword3"
                                                                       type="password" name="password" required="true"/>
                                                            </div>
                                                        </div>
                                                        <button type="reset" class="btn btn-success ">&nbsp;&nbsp;ล้างข้อมูล&nbsp;&nbsp;</button>
                                                        <button type="submit" class="btn btn-primary ">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;เพิ่ม&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>
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

                    <script>
                        $(function () {

                            $("#date").datepicker({
                                dateFormat: "yy-mm-dd"
                            });
                        });

                    </script>
                    </body>
                    </html>
