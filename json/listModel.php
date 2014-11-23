<option>-เลือก-</option>
<?php
$id = $_POST ['id'];
include '../src/class/ManageModelCar.php';
$objModel = new ManageModelCar ();
$rsModel = $objModel->getModelById($id);

while ( $rowModel = mysql_fetch_object ( $rsModel ) ) {
	?>
<option value="<?php echo $rowModel->id;?>"><?php echo $rowModel->name;?></option>
<?php }?>
															
													