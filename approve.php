<?php
include('db.php');
$id=mysqli_real_escape_string($link,$_POST['app_id']);
$slot=mysqli_real_escape_string($link,$_POST['slot_id']);
$flag=mysqli_real_escape_string($link,$_POST['a_flag']);
if($flag==1)
{
mysqli_query($link,"UPDATE `booking` SET `status`='1' WHERE id='".$id."' and slot='".$slot."'");
$data= array('status'=>"Success");
}
echo json_encode($data);
?>