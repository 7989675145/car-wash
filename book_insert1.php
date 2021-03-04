<?php
include("db.php");
session_start();

$car_type=mysqli_real_escape_string($link,$_POST['car_type']);
$wash_type=mysqli_real_escape_string($link,$_POST['wash_type']);
$slot=mysqli_real_escape_string($link,$_POST['slot']);
$reg=mysqli_real_escape_string($link,$_POST['reg']);
$date=mysqli_real_escape_string($link,$_POST['date']);
$flag=mysqli_real_escape_string($link,$_POST['flag_check']);
$r=mysqli_query($link,"SELECT * FROM booking WHERE number='".$reg."'");
$num=mysqli_num_rows($r);

if($flag==0)
{
	$da=mysqli_query($link,"SELECT id FROM booking WHERE dated='".$date."' and slot='".$slot."' and id='".$_SESSION['id']."'");//single slot for user
	$single_slot=mysqli_num_rows($da);
	
	//echo $da;
	$p=mysqli_query($link,"SELECT dated FROM booking WHERE slot='".$slot."' and dated='".$date."'");//
	$three_slots=mysqli_num_rows($p);//3 bookings per slot per day
	//echo $p;
	if($car_type=="HatchBack")
	{
		$car_type=1;
	}
	else if($car_type=="Sedan")
	{
		$car_type=2;
	}
	else if($car_type=="SUV")
	{
		$car_type=3;
	}
	if($wash_type=="Interior")
	{
		$wash_type=1;
	}
	else if($wash_type=="Body")
	{
		$wash_type=2;
	}
	else if($wash_type=="Full")
	{
		$wash_type=3;
	}
	if($slot=='10:00 - 11:00')
	{
		$slot=1;
	}
	else if($slot=='11:00 - 12:00')
	{
		$slot=2;
	}
	else if($slot=='12:00 - 01:00')
	{
		$slot=3;
	}
	else if($slot=='01:00 - 02:00')
	{
		$slot=4;
	}
	else if($slot=='02:00 - 03:00')
	{
		$slot=5;
	}
	else if($slot=='03:00 - 04:00')
	{
		$slot=6;
	}
	else if($slot=='04:00 - 05:00')
	{
		$slot=7;
	}
	else if($slot=='05:00 - 06:00')
	{
		$slot=8;
	}
	$flip=true;
	if($num>0)
	{	
		$data['status']= "num";
		$flip=false;
	}
	if($single_slot>0)
	{	
		$data['status']="single_slot";
		$flip=false;
	}
	if($three_slots>2)
	{
		$data['status']="three_slots";
		$flip=false;
	}
	if($flip==true)
	{
		$data['status']="proceed";
	}
}
if($flag==1)
{
	$l=mysqli_query($link,"SELECT wash_id as wash_id,price as price FROM wash_prices WHERE car_type='".$car_type."' and wash_type='".$wash_type."'");
	$fetch=mysqli_fetch_assoc($l);
	//mysqli_query($link,"INSERT INTO `user_vehicle`(`wash_id`,`id`,`number`) VALUES ('".$fetch['wash_id']."','".$_SESSION['id']."','".$reg."')");
	mysqli_query($link,"INSERT INTO `booking`(`wash_id`, `number`,`id`, `dated`, `slot`,`price`) VALUES ('".$fetch['wash_id']."','".$reg."','".$_SESSION['id']."','".$date."','".$slot."','".$fetch['price']."')");
	$data['status']="booked";
}
echo json_encode($data);
?>