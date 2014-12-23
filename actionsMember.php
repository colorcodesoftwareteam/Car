<?php
include 'src/class/ActionsMember.php';

$action = $_GET['action'];
$data['POST'] = $_POST;
$data['GET'] = $_GET;
$data['FILES'] = $_FILES;
$objAction = new ActionsMember();
$objAction->setData($data);
$objAction->process($action);

?>
