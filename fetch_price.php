<?php
include("db.php");
$car=mysqli_real_escape_string($link,$_POST['car']);
$wash=mysqli_real_escape_string($link,$_POST['wash']);
$sq=mysqli_query($link,"SELECT price as price from wash_prices WHERE car_type='".$car."' and wash_type='".$wash."'");
$fetch=mysqli_fetch_assoc($sq);
$res=$fetch['price'];
$price=$res;
echo json_encode($price);
?>