<?php
session_start();
include('db.php');
/*print_r($_SESSION);
exit;*/
if(!isset($_SESSION['user']))
{
	header("location:index.php");
	exit;
}

?>
<!doctype html>
<html lang="en">
  <head>
   
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
	
	<!-- Datepicker CSS -->
	<link rel="stylesheet" href="css/jquery-ui.min.css">
	<!-- LineAwesome -->
	<link rel="stylesheet" href="css/line-awesome.min.css">
  <title>Car Wash</title>
	
  </head>
  <body>
    <nav class="navbar navbar-dark bg-dark">
			<a class="navbar-brand" href="#">
			