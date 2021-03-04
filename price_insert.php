<?php
include("db.php");
$car_type=mysqli_real_escape_string($link,$_POST['car_type']);
$wash_type=mysqli_real_escape_string($link,$_POST['wash_type']);
$amount=mysqli_real_escape_string($link,$_POST['amount']);

$res = mysqli_query($link,"SELECT * FROM wash_prices WHERE car_type='".$car_type."' and wash_type='".$wash_type."'");
$num=mysqli_num_rows($res);
	if($num>0)
	{
		$data= array('status'=>"Failure");
	}
	else
	{
		mysqli_query($link,"INSERT INTO `wash_prices`(`car_type`, `wash_type`, `price`) VALUES ('".$car_type."','".$wash_type."','".$amount."')");
		$data= array('status'=>"Success");
	}
echo json_encode($data);
?>