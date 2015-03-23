<?php
session_start();
include_once 'src/class/MemberSystem.php';
?>
<!-- Navigation panelcontainer -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <!-- <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">หน้าหลัก</a>
        </div> -->
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li>
                    <a href="index.php">หน้าหลัก</a>
                </li>
                <li>
                    <a href="http://goo.gl/forms/mZ9U0m4IOU" target="_blank">* แบบสอบถาม</a>
                </li>
                <li>
                    <a href="carCompare.php">เปรียบเทียบรถยนต์</a>
                </li>
                <li>
                    <a href="ManageCarProfile.php">จัดการรถยนต์</a>
                </li>
                <?php if (isset($_SESSION['memberId'])) { ?>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">จัดการหมวดหมู่รถยนต์<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="ManageBrand.php">จัดการยี่ห้อ</a>
                        </li>
                        <li>
                            <a href="ManageModel.php">จัดการรุ่น</a>
                        </li>
                    </ul>
                </li>
                <?php
                }
                if (@$_SESSION['role_id'] == '1') {
                    ?>
                    <li>
                        <a href="ManageMemberProfile.php">จัดการสมาชิก</a>
                    </li>
                <?php } ?>
            </ul>
            <!-- Login form -->
            <div style="float:right;">
                <?php if (!isset($_SESSION['memberId'])) { ?>
                    <form class="form-inline pull-right" role="form" action="actionsNonMember.php?action=login"  method="post">
                        <div class="form-group">
                            <label class="sr-only" for="exampleInputEmail2">ชื่อผู้ใช้</label>
                            <input type="email" name="email" class="form-control" id="exampleInputEmail2" placeholder="ชื่อผู้ใช้">
                        </div>
                        <div class="form-group">
                            <label class="sr-only" for="exampleInputPassword2">รหัสผ่าน</label>
                            <input type="password" name="password" class="form-control" id="exampleInputPassword2" placeholder="รหัสผ่าน">
                        </div>
                        <button type="submit" class="btn btn-default">เข้าสู่ระบบ</button>

                        <div class="form-inline">
                            <label>
                                <!-- a href="addMemberProfile.php">สมัครสมาชิก</a -->
                            </label>
                        </div>
                        <?php if (@$_GET['username'] == 'false') { ?>
                            <div class="form-inline">
                                <span class="text-danger"><b>username นี้ไม่มีในระบบ ! </b></span>
                            </div>
                            <?php
                        } else if (@$_GET['login'] == 'false') {
                            ?>
                            <div class="form-inline">
                                <span class="text-danger"><b>รหัสผ่านไม่ถูกต้อง ! </b></span>
                            </div>
                        <?php } ?>
                    </form>
                    <?php
                } else {
                    $objMem = new MemberSystem();
                    $curMember = $objMem->getMemeberById($_SESSION['memberId']);
                    ?>
                    <span class="" style="color:white;">สวัสดี,&nbsp;&nbsp;<?php echo $curMember->current()->name; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>,<a href="editMemberProfile.php?id=<?= $_SESSION['memberId'] ?>"<button class="btn btn-default">แก้ไขข้อมูล</button></a> <a href="actionsMember.php?action=logout" ><button class="btn btn-danger">ออกจากระบบ</button></a>
                <?php } ?>
            </div>
            <!-- /.navbar-collapse -->
        </div>
    </div>
</nav>

<!-- Header image -->
<header id="myCarousel" class="carousel slide">
    <!-- Wrapper for slides -->
    <div class="carousel-inner">
        <div class="item active">
            <div class="fill" style="background-image:url('img/header.png');"></div>
        </div>
    </div>
</header>
