<!DOCTYPE html>
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
	
	<title>Final</title>
	</head>

<body>
<nav class="navbar navbar-dark bg-dark">
			<a class="navbar-brand" href="#">Welcome</a>
		
		<ul class="nav justify-content-end">
  <li class="nav-item">
    <button type="button" class="btn btn-primary mx-2" data-toggle="modal" data-target="#admin">
	LOGIN</button>
  </li>
  <li class="nav-item">
  
  
  </ul>
  </nav>

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

  <script src="js/jquery.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/ajax.min.js"></script> 
<script>
$(document).ready(function(){
	var ph=/^([1-9]{1}[0-9]{9})$/;
	$(document).on('keyup','#log_mobile',function(){
		$("#log_err_mobile").html("");		
	});
	$(document).on('keyup','#log_pwd',function(){
		$("#log_err_pass").html("");
	});
	$('#admin').on('hidden.bs.modal', function () {
    $('#log_form')[0].reset();
	$("#log_err_mobile").html("");
	$("#log_err_pass").html("");
	});
	$(document).on('click','#log_sub',function(){
	var flip=true;
	if($("#log_mobile").val()==null || $("#log_mobile").val()=="")
	{
		$("#log_err_mobile").html("*Please enter number");
		flip=false;
	}
	else if(!$("#log_mobile").val().match(ph))
	{
		$("#log_err_mobile").html("*Please check phone number");
		flip=false;
	}
	if($("#log_pwd").val()==null || $("#log_pwd").val()=="")
	{
		$("#log_err_pass").html("*Please enter password");
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
})
</script>

</body>
</html>