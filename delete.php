<?php
include("db.php");
$id=mysqli_real_escape_string($link,$_POST['Del_ID']);
mysqli_query($link,"DELETE FROM `wash_prices` WHERE wash_id='".$id."'");
?>