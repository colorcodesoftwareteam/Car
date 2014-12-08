<?php
include 'src/class/ActionsMember.php';

$action = $_GET['action'];
$data = $_POST;
$objAction = new ActionsMember();
$objAction->setData($data);
$objAction->process($action);

?>