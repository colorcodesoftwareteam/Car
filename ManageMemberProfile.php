<?php
session_start();
include 'src/class/MemberSystem.php';

$objMember = new MemberSystem();

$pageSize = 10;
$currentPage = 1;
if (isset($_GET['page'])) {
    $currentPage = $_GET['page'];
}
if (@$_GET['delete'] == 'true') {
    $id = $_GET['id'];
    if ($objMember->deleteMember($id))
        echo '<meta http-equiv=REFRESH CONTENT=0;url=ManageMemberProfile.php>';
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>ระบบจัดแสดงรถยนต์</title>
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
                            <h4>รายการสมาชิก</h4>
                            <small></small>
                        </div>

                        <div class="panel-body">
                            <div class="row clearfix">
                                <div class="col-md-12 column">
                                    <a href="addMemberProfile.php"><button type="button" class="btn btn-primary">เพิ่มสมาชิก</button></a>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>ชื่อ</th>
                                                <th>นามสกุล</th>
                                                <th>เพศ</th>
                                                <th>วันเกิด</th>
                                                <th>ทึ่อยู่</th>
                                                <th>เบอร์โทรศัพท์</th>
                                                <th>อีเมลล์</th>
                                                <th>บทบาท</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $arrMember = $objMember->getMemberAllPaging($pageSize, $currentPage);
                                            foreach ($arrMember as $row) {
                                                ?>
                                                <tr>
                                                    <td>
                                                        <a href="editMemberProfile.php?id=<?php echo $row->id; ?>"<button type="button" class="btn btn-warning">แก้ไข&nbsp;</button></a>
                                                        <a href="ManageMemberProfile.php?delete=true&id=<?php echo $row->id; ?>"><button type="button" class="btn btn-danger">&nbsp;&nbsp;&nbsp;ลบ&nbsp;&nbsp;</button></a>
                                                    </td>
                                                    <td><?php echo $row->name ?></td>
                                                    <td><?php echo $row->lastname ?></td>
                                                    <td><?php echo $row->gender == '0' ? "ชาย" : "หญิง" ?></td>
                                                    <td><?php echo $row->birthdate ?></td>
                                                    <td><?php echo $row->address ?></td>
                                                    <td><?php echo $row->phoneNumber ?></td>
                                                    <td><?php echo $row->email ?></td>
                                                    <td><?php echo $row->role_name ?></td>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="panel-footer">
                            <div class="row clearfix">
                                <div class="col-md-offset-4">
                                    <nav>
                                        <?php $objMember->getPaging("ManageMemberProfile", $currentPage); ?>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row clearfix">
            <div class="col-md-12 column"></div>
        </div>
        <!-- Footer -->
        <?php include 'footer.php'; ?>
    </body>
</html>
