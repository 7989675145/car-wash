<?php
session_start();
if(isset($_SESSION['user']))
{
	if($_SESSION['user']=='CUSTOMER')
	{
		header("location:view_bookings.php");
	}
	if($_SESSION['user']=='ADMIN')
	{
		header("location:admin.php");
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
	
	<title>CAR WASH</title>
	<style>
	.login-form
	{	
		padding-top:10%;
	}
	body, html {
  height: 100%;
  margin: 0;
}

.bg {
  /* The image used */
  background-image: url("img.jpg");

  /* Full height */
  height: 100%; 

  /* Center and scale the image nicely */
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
}
.log_mob{
    color: red;
}
.log_pas{
	color:red;
}
.user_nam{
	color: red;	
}
.user_mob{
	color: red;	
}
.user_pas{
	color: red;	
}
.hidden {
     visibility:hidden;
}


	</style>
</head>

<body>
<nav class="navbar navbar-dark bg-dark">
			<a class="navbar-brand" href="#">Welcome to Car Wash</a>
		
		<ul class="nav justify-content-end">
  <li class="nav-item">
    <button type="button" class="btn btn-primary mx-2" data-toggle="modal" data-target="#admin">
	LOGIN</button>
  </li>
  <li class="nav-item">
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#signup">
		Sign Up
	</button>
  </li>
</ul>
		
	</nav>
	<div class="row justify-content-center">
		<div class="col-6">
	<div class="alert alert-primary reg hidden"  id="reg_alert" role="alert">
  Registered Successfully
</div>
	</div>
	</div>
<div class="bg"></div>



<div class="modal fade" id="admin" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">LOGIN</h5>
        <button type="button" class="close" data-dismiss="modal" id="log_close" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	<div class="row mt-9 justify-content-center login-form">
		<div class="col-7">
			<div class="card border-0">
				
			<div class="card-body">
				<form action="login_check.php" method="POST" id="log_form">
				<div class="form-group">
					<label>Mobile</label>
					<input type="text" class="form-control" id="log_mobile" name="mobile" maxlength="10" placeholder="Mobile Number"/>
					<span id="log_err_mobile" class="text-danger"></span>
				 </div>
				 <div class="form-group">
					<label>Password</label>
					<input type="password" class="form-control" name="pwd" id="log_pwd" placeholder="Password"/>
					<span id="log_err_pass" class="text-danger"></span>
				</div>
				<div class="text-center">
					<button type="button" class="btn btn-info mt-2" id="log_sub">Login</button>
					<p><span id="login" class="text-danger"></span></p>
					</div>
				</form>
			</div>
  </div>
</div>
</div>
</div>
    </div>
  </div>
</div>


<div class="modal fade" id="signup" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">REGISTRATION FORM</h5>
        <button type="button" class="close" data-dismiss="modal" id="reg_close" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	<div class="row mt-9 justify-content-center login-form">
		<div class="col-8">
			<div class="card border-0">
				
			<div class="card-body">
				<form method="POST" action="signup_check.php" id="regist_form">
				<div class="form-group">
					<label>Username</label>
					<input type="text" class="form-control" name="name" id="reg_name" placeholder="Username"/>
					<p><span id="user_err_name" class="text-danger"></span></p>
				 </div>
				<div class="form-group">
					<label>Mobile</label>
					<input type="text" class="form-control" id="reg_mobile" name="mobile" maxlength="10" placeholder="Mobile Number"/>
					<p><span id="user_err_mob" class="text-danger"></span></p>
				</div>
				 <div class="form-group">
					<label>Password</label>
					<input type="password" class="form-control" name="pass" id="reg_pwd" placeholder="Password"/>
					<p><span id="user_err_pass" class="text-danger"></span></p>
				</div>
				<div class="form-group">
					<label>Confirm Password</label>
					<input type="password" class="form-control" name="con_pass" id="con_reg_pwd" placeholder="Confirm Password"/>
					<p><span id="con_err_pass" class="text-danger"></span></p>
				</div>
				<div class="text-center">
					<button type="button" class="btn btn-info mt-2" id="reg_sub">Login</button>
					
					</div>
				</form>
			</div>
  </div>
</div>
</div>
</div>
    </div>
  </div>
</div>


<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script>
$(document).ready(function(){
	$("#reg_alert").hide();
	var regnum=/^[0-9]{10}$/;
	var regnam=/^([a-zA-Z_]{3,20})$/;
	var pass=/^([a-zA-Z0-9]{10})$/;
	var ph=/^([1-9]{1}[0-9]{9})$/;
	
	$(document).on('keyup','#log_mobile',function(){
		$("#log_err_mobile").html("");		
	});
	$(document).on('keyup','#log_pwd',function(){
		$("#log_err_pass").html("");
	});
	$(document).on('keyup','#reg_name',function(){
		$("#user_err_name").html("");		
	});
	$(document).on('keyup','#reg_mobile',function(){
		$("#user_err_mob").html("");		
	});
	$(document).on('keyup','#reg_pwd',function(){
		$("#user_err_pass").html("");		
	});
	$(document).on('keyup','#con_reg_pwd',function(){
		$("#con_err_pass").html("");		
	});
	$('#admin').on('hidden.bs.modal', function () {
    $('#log_form')[0].reset();
	$("#log_err_mobile").html("");
	$("#log_err_pass").html("");
	});
	$('#signup').on('hidden.bs.modal', function () {
    $('#regist_form')[0].reset();
	$("#user_err_name").html("");
	$("#user_err_mob").html("");
	$("#user_err_pass").html("");
	$("#con_err_pass").html("");
});
	$(document).on('click','#log_sub',function(){
	var flip=true;
	if($("#log_mobile").val()==null || $("#log_mobile").val()=="")
	{
		$("#log_err_mobile").html("*Please enter username");
		flip=false;
	}
	else if(!$("#log_mobile").val().match(ph))
	{
		$("#log_err_mobile").html("*Check phone number");
		flip=false;
	}
	if($("#log_pwd").val()==null || $("#log_pwd").val()=="")
	{
		$("#log_err_pass").html("*Please enter phone number");
		flip=false;
	}
	if(flip==true)
	{
		var l_phone=$("#log_mobile").val();
		var l_pass=$("#log_pwd").val();
		$.ajax({
			url:'login_check_ajax.php',
			method: 'post',
			dataType:'json',
            data:{phone:l_phone,pass:l_pass},
            success: function(result)
            {
				if(result['val']=="fail")		
				{
					$("#login").html("*Not registered yet!");
				}
				else
				{
					$("#login").html("");
				}
				if(result['val']=="password")
				{
					$("#log_err_pass").html("*Wrong password");
				}
				else
				{
					$("#log_err_pass").html("");
				}
				if(result['val']=="correct")
				{
					$("#log_form").submit();
				}
			}
		})
	}
	});
	$(document).on('click','#reg_sub',function(){
		var flag=true;
		
		if($("#reg_name").val()==null || $("#reg_name").val()=="")
		{
			$("#user_err_name").html("*Please enter username");
			flag=false;
		}
		else if(!$("#reg_name").val().match(regnam))
		{
			$("#user_err_name").html("No special characters allowed except underscore");
			flag=false;
		}
		else
		{		
			$("#user_err_name").html("");			
		}
		if($("#reg_mobile").val()==null || $("#reg_mobile").val()=="" || $("#reg_mobile").val().length!=10)
		{
			$("#user_err_mob").html("*Please enter mobile");
			flag=false;
		}
		else if(!$("#reg_mobile").val().match(ph))
		{
			$("#user_err_mob").html("Zero not accepted first");
			flag=false;
		}
		else
		{
			$("#user_err_mob").html("");
		}
		if($("#reg_pwd").val()==null || $("#reg_pwd").val()=="")
		{
			$("#user_err_pass").html("*Please enter password");
			flag=false;
		}
		else
		{
			$("#user_err_pass").html("");
		}
		if($("#con_reg_pwd").val()==null || $("#con_reg_pwd").val()=="")
		{
			$("#con_err_pass").html("*Reenter Password");
			flag=false;
		}
		else if($("#reg_pwd").val()!=$("#con_reg_pwd").val())
			{
				$("#con_err_pass").html("*Password mismatch");
				flag=false;
			}
		if(flag==true)
		{
			var name=$("#reg_name").val();
			var pwd=$("#reg_pwd").val();
			var mobile=$("#reg_mobile").val();
			//console.log("FDSHF")
			$.ajax({
				url:'signup_check.php',
				method: 'post',
				dataType:'json',
				data:{u_name:name,u_pwd:pwd,u_mob:mobile},
				success: function(result)
				{
					console.log(result['value'])
					if(result['value']==0)
					{
						console.log(11)					
						$("#user_err_mob").html("*Please check your number");
					}
					if(result['value']==1)
					{
					$("#signup").modal('hide');
					$('.reg').removeClass('hidden');
					//$('.reg').show();
					$("#reg_alert").fadeIn(2500);
					$("#reg_alert").fadeOut(2500);
					}
					
				}
			})
		}
	});
});
</script>
</body>
</html>