<?php
include('db.php');
$mobile=mysqli_real_escape_string($link,$_POST['phone']);
$pass=mysqli_real_escape_string($link,$_POST['pass']);
$m="SELECT * FROM login WHERE phone='".$mobile."'";
$res_m=mysqli_query($link,$m);
$num=mysqli_num_rows($res_m);
if($num>0)
{
	$mob=mysqli_fetch_assoc($res_m);
	if($mob['password']!=md5($pass))
	{	
		$res['val']="password";
	}
	else
	{
		$res['val']="correct";
	}
}
else
{
	$res['val']="fail";
}
echo json_encode($res)
?>