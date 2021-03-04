<?php
include("db.php");
session_start();
$date=mysqli_real_escape_string($link,$_POST['date']);
$da=mysqli_query($link,"SELECT slot FROM booking WHERE dated='".$date."' and id='".$_SESSION['id']."'");
$single=mysqli_fetch_assoc($da);
$p=mysqli_query($link,"SELECT slot FROM booking WHERE dated='".$date."'");



SELECT id,slot,count(slot) FROM booking GROUP BY id,slot HAVING COUNT(slot) > 1
?>