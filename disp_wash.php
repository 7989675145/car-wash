<?php
include("db.php");
$flash=0;
if(isset($_POST['depart']))
{
	$flash=mysqli_real_escape_string($link,$_POST['depart']);
}
$wash_arr = array();
if($flash>0)
{
	$sq=mysqli_query($link,"SELECT * from wash_prices WHERE car_type='".$flash."' ORDER BY wash_type");
	while($row=mysqli_fetch_array($sq))
	{
		$wash=$row['wash_type'];
		if($wash==1)
		{
		$res="Interior";
		}
		else if($wash==2)
		{
		$res="Body";
		}
		else if($wash==3)
		{
		$res="Full";
		}
		$wash_arr[]=array("id" => $wash,"wash" => $res);
	}
}
echo json_encode($wash_arr);
?>
