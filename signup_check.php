<?php
include("db.php");
$name=mysqli_real_escape_string($link,$_POST['u_name']);
$phone=mysqli_real_escape_string($link,$_POST['u_mob']);
$pass=$_POST['u_pwd'];
$s=mysqli_query($link,"SELECT * FROM login WHERE phone='".$phone."'");
$num=mysqli_num_rows($s);
if($num>0)
{
	$data['value']=0;
}
else
{
	mysqli_query($link,"INSERT INTO `login`(`phone`, `password`) VALUES ('".$phone."','".md5($pass)."')");
	$k=mysqli_query($link,"SELECT * FROM login WHERE phone='".$phone."' and password='".md5($pass)."' and user_type='2'");
	$fetch=mysqli_fetch_assoc($k);
	mysqli_query($link,"INSERT INTO user_details(`id`,`name`) VALUES ('".$fetch['id']."','".$name."')");
	$data['value']=1;
}
echo json_encode($data);
?>