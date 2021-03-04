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
	
	</style>
</head>

<body>
<nav class="navbar navbar-dark bg-dark">
			<a class="navbar-brand" href="#">Welcome to Car Wash</a>
		
		<ul class="nav justify-content-end">

</ul>
		
	</nav>
	
	
<div class="row mt-9 justify-content-center login-form">
	<div class="col-12">
	<input type="text" id="mail"><span id="error">error</span>
	<button type="button" class="btn btn-success" id="sub">SUBMIT</button>
	</div>
</div>

<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script>
$(document).ready(function(){
	$("#error").hide();
	$(document).on('click','#sub',function()
	{
	var va = $("#mail").val();
	if(va=="")
	{
		$("#error").show();
		
	}
	console.log(va)
	});
});
</script>
</body>
</html>