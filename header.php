<?php
session_start();
include_once 'src/class/MemberSystem.php';
?>
<!-- Navigation panel -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">หน้าหลัก</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">

                <li>
                    <a href="carCompare.php">เปรียบเทียบรถยนต์</a>
                </li>
<?php if (isset($_SESSION['memberId'])) { ?>
                    <li>
                        <a href="ManageCarProfile.php">จัดการรถยนต์</a>
                    </li>
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
                if (@$_SESSION['type_member'] == 'admin') {
                    ?>

                    <li>
                        <a href="#">จัดการสมาชิก</a>
                    </li>
<?php } ?>
            </ul>
            <!-- Login form -->
<?php if (!isset($_SESSION['memberId'])) { ?>
                <form class="form-inline pull-right" style="margin-top:10px;" role="form" action="actionsNonMember.php?action=login"  method="post">
                    <div class="form-group">
                        <div class="form-group">
                            <label class="sr-only" for="exampleInputEmail2">ชื่อผู้ใช้</label>
                            <input type="email" name="email" class="form-control" id="exampleInputEmail2" placeholder="ชื่อผู้ใช้">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="sr-only" for="exampleInputPassword2">รหัสผ่าน</label>
                        <input type="password" name="password" class="form-control" id="exampleInputPassword2" placeholder="รหัสผ่าน">
                    </div>
                    <button type="submit" class="btn btn-default">เข้าสู่ระบบ</button>
                    <div class="form-inline">
                        <label>
                            <a href="addMemberProfile.php">สมัครสมาชิก</a>
                        </label>
                    </div>
                </form>
            <?php
            } else {
                $objMem = new MemberSystem();
                $curMember = $objMem->getMemeberById($_SESSION['memberId']);
                ?>

                <span class="" style="color:white;">สวัสดี <?php echo $curMember->current()->name . ' ' . $curMember->current()->lastname; ?></span>,<a href="editMemberProfile.php"<button class="btn btn-default">แก้ไขข้อมูล</button></a> <a href="actionsMember.php?action=logout" ><button class="btn btn-danger">ออกจากระบบ</button></a>
<?php } ?>
        </div>
        <!-- /.navbar-collapse -->
    </div>
</nav>

<!-- Header image -->
<header id="myCarousel" class="carousel slide">
    <!-- Indicators -->
    <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner">
        <div class="item active">
            <div class="fill" style="background-image:url('http://placehold.it/1900x1080&text=Slide One');"></div>
            <div class="carousel-caption">
                <h2>Caption 1</h2>
            </div>
        </div>
        <div class="item">
            <div class="fill" style="background-image:url('http://placehold.it/1900x1080&text=Slide Two');"></div>
            <div class="carousel-caption">
                <h2>Caption 2</h2>
            </div>
        </div>
        <div class="item">
            <div class="fill" style="background-image:url('http://placehold.it/1900x1080&text=Slide Three');"></div>
            <div class="carousel-caption">
                <h2>Caption 3</h2>
            </div>
        </div>
    </div>

    <!-- Controls -->
    <a class="left carousel-control" href="#myCarousel" data-slide="prev">
        <span class="icon-prev"></span>
    </a>
    <a class="right carousel-control" href="#myCarousel" data-slide="next">
        <span class="icon-next"></span>
    </a>
</header>
