<?php
include("db.php");
$id=mysqli_real_escape_string($link,$_POST['id']);
$price=mysqli_real_escape_string($link,$_POST['edit_price']);
mysqli_query($link,"UPDATE `wash_prices` SET `price`='".$price."' WHERE wash_id='".$id."'");
$data= array('status'=>"Success");
echo json_encode($data);
?>