<?php
include("db.php");
$id=mysqli_real_escape_string($link,$_POST['S_ID']);
$res=mysqli_query($link,"SELECT * FROM wash_prices WHERE wash_id='".$id."'");
while($row=mysqli_fetch_assoc($res))
        {
            $data=$row;
        }
        echo json_encode($data);
?>