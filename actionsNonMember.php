<?php
include 'src/class/ActionsNonMember.php';

$action = $_GET['action'];
$data = $_POST;
$objAction = new ActionsNonMember();
$objAction->setData($data);
$objAction->process($action);

?>