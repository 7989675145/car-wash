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
	for($j=1;$j<=3;$j++)
			{
			$r=mysqli_query($link,"SELECT DISTINCT wash_type FROM wash_prices WHERE car_type='".$flash."' and wash_type=$j ORDER BY wash_type");
			$row=mysqli_fetch_assoc($r);
			if($row==null)
			{
				if($j==1)
				{
					$res="Interior";
				}
				else if($j==2)
				{
					$res="Body";
				}
				if($j==3)
				{
					$res="Full";
				}
				$wash_arr[]=array("id" => $j,"wash" => $res);
			}
			}
}
echo json_encode($wash_arr);
?>