<?php
include 'src/class/ActionsNonMember.php';

$action = $_GET['action'];
$data['POST'] = $_POST;
$data['GET'] = $_GET;
$objAction = new ActionsNonMember();
$objAction->setData($data);
$objAction->process($action);

?>
