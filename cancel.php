<?php
include('db.php');
$id=mysqli_real_escape_string($link,$_POST['can_id']);
$slot=mysqli_real_escape_string($link,$_POST['slot_id']);
mysqli_query($link,"UPDATE `booking` SET `status`='2' WHERE id='".$id."' and slot='".$slot."'");
$data= array('status'=>"Success");
echo json_encode($data);
?>