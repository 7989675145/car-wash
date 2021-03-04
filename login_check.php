<?php
session_start();
include('db.php');
$mobile=mysqli_real_escape_string($link,$_POST['mobile']);
$pass=mysqli_real_escape_string($link,$_POST['pwd']);
$s="SELECT * FROM login WHERE phone='".$mobile."' and password='".md5($pass)."'";
$res=mysqli_query($link,$s);
$data=mysqli_fetch_assoc($res);
if($data!==null)
{
	if($data['user_type']==1)
	{
		$_SESSION['user']='ADMIN';
		header("location:admin.php");
	}
	else if($data['user_type']==2)
	{
		$_SESSION['user']='CUSTOMER';
		$_SESSION['id']=$data['id'];
		$k=mysqli_query($link,"SELECT DISTINCT user_details.id,booking.id FROM user_details JOIN booking ON user_details.id=booking.id AND booking.id='".$_SESSION['id']."'");
		$l=mysqli_num_rows($k);
		if($l>0)
		{
			header("location:view_bookings.php");
		}
		else
		{
			header("location:cust.php");
		}
	}
}
else
{
	$_SESSION['valid']='admin';
	header("location:index.php");
}
?>