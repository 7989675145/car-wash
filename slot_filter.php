<?php
include('db.php');
session_start();

$slot=mysqli_real_escape_string($link,$_POST['slot']);
$date=mysqli_real_escape_string($link,$_POST['date']);
$t=mysqli_query($link,"SELECT slot FROM booking WHERE (id='".$_SESSION['id']."' and slot='".$slot."' and dated='".$date."') or (slot='".$slot."' and dated='".$date."')");
while($fetch=mysqli_fetch_assoc($t))
{
	if($fetch['slot']==$slot)
	{
		$a[]=$fetch['slot'];
	}
}
echo json_encode($a);
?>