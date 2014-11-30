<?php
include 'src/class/ActionsNonMember.php';

$action = $_GET['action'];
$objAction = new ActionsNonMember($action);

?>