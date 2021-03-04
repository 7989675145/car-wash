<?php
session_start();
if(isset($_SESSION['valid']))
{
	if($_SESSION['valid']=='admin')
	{
?>
		<div class="alert alert-danger container" id='admin_fail' role="alert">
  Wrong Credentails,Login Failed 
</div>	
<?php
	$_SESSION['valid']="";
	}
	if($_SESSION['valid']=='s_wrong')
	{
	?>
		<div class="alert alert-danger" id='fail' role="alert">
  Wrong Phone Number Registration failed 
</div>	
<?php
	$_SESSION['valid']="";
	}
	if($_SESSION['valid']=='s_right')
	{
?>
		<div class="alert alert-success" id='ale' role="alert">
  Registration Successful 
</div>		
<?php
	$_SESSION['valid']="";
	}
	//session_destroy();
}
if(isset($_SESSION['user']))
{
	if($_SESSION['user']=='CUSTOMER')
	{
		header("location:customer.php");
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
	
	
<div class="bg"></div>

<div class="modal fade" id="admin" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">LOGIN</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
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
					<input type="text" class="form-control" id="mobile" name="mobile" maxlength="10" placeholder="Mobile Number"/>
					<p><span class="log_mob hidden">Please enter mobile number</span></p>
				 </div>
				 <div class="form-group">
					<label>Password</label>
					<input type="password" class="form-control" name="pwd" id="pwd" placeholder="Password"/>
					<span class="log_pas hidden">Please enter password</span>
				</div>
				
				<div class="text-center">
					<button type="button" class="btn btn-info mt-2" id="log_sub">Login</button>
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
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	<div class="row mt-9 justify-content-center login-form">
		<div class="col-8">
			<div class="card border-0">
				
			<div class="card-body">
				<form method="POST" id='form' action="signup_check.php" id="regist_form">
				<div class="form-group">
					<label>Username</label>
					<input type="text" class="form-control" name="name" id="u_name" placeholder="Username"/>
					<p><span class="user_nam hidden">Please enter your name</span></p>
				 </div>
				<div class="form-group">
					<label>Mobile</label>
					<input type="text" class="form-control" id="phone" name="mobile" maxlength="10" placeholder="Mobile Number"/>
					<p><span class="user_mob hidden">Please enter mobile number</span></p>
				</div>
				 <div class="form-group">
					<label>Password</label>
					<input type="password" class="form-control" name="pass" id="pass" placeholder="Password"/>
					<p><span class="user_pas hidden">Please enter password</span></p>
				</div>
				<div class="text-center">
					<button type="submit" class="btn btn-info mt-2" id="reg_sub">Login</button>
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
	$("#ale").fadeOut(3000);
	$("#fail").fadeOut(3500);
	$("#admin_fail").fadeOut(3500);
	/*$("#mobile,#phone").keypress(function (e) 
	{		 
		if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57) && (e.which < 65 || e.which > 90))
		{
			alert("Please enter only Numbers.");
			return false;
		}
	});	
*/
	var regnum=/^[0-9]{10}$/;
	var regnam=/^([a-zA-Z_]{3,20})$/;
	var pass=/^([a-zA-Z0-9]{3,10})$/;
	var num=/^([A-Z]{2}[0-9]{2}[A-Z]{2}[0-9]{4})$/;
	$('#mobile').on('keypress keydown keyup',function(){
		if (!$(this).val().match(regnum)) {
              
                 $('.log_mob').removeClass('hidden');
                 $('.log_mob').show();
             }
           else{
                
                $('.log_mob').addClass('hidden');
               }
         });
	$('#phone').on('keypress keydown keyup',function(){
		if (!$(this).val().match(regnum)) {
              
                 $('.user_mob').removeClass('hidden');
                 $('.user_mob').show();
             }
           else{
                
                $('.user_mob').addClass('hidden');
               }
         });
	$('#u_name').on('keypress keydown keyup',function(){
		if (!$(this).val().match(regnam)) {
              
                 $('.user_nam').removeClass('hidden');
                 $('.user_nam').show();
             }
           else{                
                $('.user_nam').addClass('hidden');
               }
         });
		 $('#pwd').on('keypress keydown keyup',function(){
		if (!$(this).val().match(pass)) {
              
                 $('.log_pas').removeClass('hidden');
                 $('.log_pas').show();
             }
           else{
                
                $('.log_pas').addClass('hidden');
               }
         });
		 $('#pass').on('keypress keydown keyup',function(){
		if (!$(this).val().match(pass)) {
              
                 $('.user_pas').removeClass('hidden');
                 $('.user_pas').show();
             }
           else{
                
                $('.user_pas').addClass('hidden');
               }
         });
		$('#log_sub').on('click',function(){
			if($("#mobile").val()=="")
			{
				$('.log_mob').removeClass('hidden');
				$('.log_mob').show();
				//return false;
			}
			if($("#pwd").val()=="")
			{
				$('.log_pas').removeClass('hidden');
				$('.log_pas').show();
				
			}
			else
			{
				$('.log_mob').addClass('hidden');
				$('.log_pas').addClass('hidden');
				$("#log_form").submit();
			}
		});
		
		$('#reg_sub').on('click',function(){
			if($("#u_name").val()=="")
			{
				$('.user_nam').removeClass('hidden');
				$('.user_nam').show();
				return false;
			}
			if($("#mobile").val()=="")
			{
				$('.user_mob').removeClass('hidden');
				$('.user_mob').show();	
				return false;				
			}
			if($("#pass").val()=="")
			{
				$('.user_pas').removeClass('hidden');
				$('.user_pas').show();	
				return false;				
			}
			else
			{			
				$('.user_nam').addClass('hidden');
				$('.user_mob').addClass('hidden');
				$('.user_pas').addClass('hidden');
				$("#regist_form").submit();
			}
		});
});
</script>

</body>
</html>