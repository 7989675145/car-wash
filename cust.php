<?php
include("db.php");
session_start();
if(!isset($_SESSION['user']))
{
	header("location:index.php");
	exit;
}
if(isset($_SESSION['user']) && $_SESSION['user']!='CUSTOMER')
{
	header("location:index.php");
}

	$_SESSION['server']=$_SERVER['HTTP_REFERER'];
	//echo $_SESSION['server'];
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
	<style>
	.table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {

        padding: 0px !important; // currently 8px
    }
	</style>
  </head>
  <body>
    <nav class="navbar navbar-light">
			<a class="navbar-brand" href="#">
			
			</a>
		<div>
		
		<button type="button" class="btn btn-primary" id="book">New Booking</button>
		
		<a class="btn btn-danger " href="logout.php">Logout</a>
		</div>		
	</nav>
	
	<div class="row  text-center">
		<div class="col">
	
	</div>
	</div>
	
	
	
	
	<div class="modal fade" id="pro" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="p_form">
			<div class="form-group">
				<label>Car Type</label>
				<input type="text" class="form-control car" name="p_car" id="p_car" readonly />
			</div>
			<div class="form-group">
				<label>Wash Type</label>
				<input type="text" class="form-control car" name="p_wash" id="p_wash" readonly />
			</div>
			<div class="form-group">
				<label>Date</label>
				<input type="text" class="form-control car" name="p_date" id="p_date" readonly />
			</div>
			<div class="form-group">
				<label>Slot</label>
				<input type="text" class="form-control car" name="p_slot" id="p_slot" readonly />
			</div>
			<div class="form-group">
				<label>Car Number</label>
				<input type="text" class="form-control car" name="p_num" id="p_num" readonly />
			</div>
			<div class="form-group">
				<label>Price</label>
				<input type="text" class="form-control car" name="p_price" id="p_price" readonly />
			</div>
			</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" id="cancel">Cancel</button>
		<button type="button" class="btn btn-success" id="edit">Edit</button>
		<button type="button" class="btn btn-info" id="sub">Submit</button>
      </div>
    </div>
  </div>
</div>
	
	<div class="container">
	<div class="row mt-9 justify-content-center login-form">
		<div class="col-4">
		<form id="booking">
				<div class="form-group" id="car">
				<label>Select Car Type</label>
				<select name="car_type" class="form-control mt-2" id="car_type"/><br>
				<option value="">Select</option>
				<?php
				$s=mysqli_query($link,"SELECT DISTINCT car_type FROM wash_prices ORDER BY car_type");
				while($row=mysqli_fetch_assoc($s))
				{
					echo "<option value='".$row['car_type']."'>";
					if($row['car_type']==1) { echo "HatchBack"; } elseif($row['car_type']==2) { echo "Sedan";} elseif($row['car_type']==3) { echo "SUV";}
					echo"</option>";
				}
				?>
				</select><span id="car_type_err" class="text-danger">
				</div>
				<div class="form-group" id="wash">
				<label>Select Wash Type</label>
				<select name="wash_type" class="form-control mt-2" id="wash_type"/><br>
				<option value="">Select</option>
				</select><span id="wash_type_err" class="text-danger"></span>
				</div>
				<div class="form-group" id="price">
				<label>Price</label>
					<input type="text" class="form-control" id="f_price" readonly/>
				</div>
				<div class="form-group" id="dat">
				<label>Date</label>
				<input type="text" class="form-control"  id="datepicker" placeholder="Date" name="date"/><i class="las la-calendar"></i>
				</div>
				<div class="form-group" id="sl">
				<label>Select Slot</label>
				<select name="slot" class="form-control mt-2" id="slot"/><br>
				<option value="">Select</option>
				<option value="1">10:00 - 11:00</option>
				<option value="2">11:00 - 12:00</option>
				<option value="3">12:00 - 01:00</option>
				<option value="4">01:00 - 02:00</option>
				<option value="5">02:00 - 03:00</option>
				<option value="6">03:00 - 04:00</option>
				<option value="7">04:00 - 05:00</option>
				<option value="8">05:00 - 06:00</option>
				</select><span id="slot_book1" class="text-danger"></span><span id="slot_book2" class="text-danger"></span>
				</div>
				<div class="form-group" id="num">
				<label>Car Number</label>
				<input type="text" class="form-control car" minlength="10" maxlength="10" name="reg" id="reg" placeholder="Car Number" required/><span id="car_num" class="text-danger"></span><span id="car_num1" class="text-danger"></span>
				</div><span id="car_num2" class="text-danger"></span><span id="car_num3" class="text-danger"></span>
				<div class="text-center" id="b_id">
					<button type="button" class="btn btn-info mt-2" id="btn_approve">Book</button>
					</div>
				</form>	
			</div>
	</div>
</div>



<div class="modal fade" id="insert" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Bookings</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
		</div>
		<div class="modal-body">
		<div class="row justify-content-center">
		<div class="col-12">
			<div class="card border-0">
				
			<div class="card-body">
				
			<div class="container">
	<div class="row mt-3 justify-content-center">
		<div class="col">
			<table id="mytable" class="table table-bordered table-striped mt-3">
			
		</div>
	</div>
</div>	
			</div>
			</div>
			</div>
	</div>
	</div>
    </div>
  </div>
</div>


<script src="js/jquery.min.js"></script>
<script src="js/jquery-ui.min.js"></script>
<script src="js/ajax.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script>
$(document).ready(function(){
	var num=/^([A-Z]{2}[0-9]{2}[A-Z]{2}[0-9]{4})$/;
table();
	$("#reg").keypress(function (e) 
	{		 
		if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57) && (e.which < 65 || e.which > 90))
		{
			$("#car_num2").html("Please use capital numbers")
			return false;
		}
		else
		{
			$("#car_num2").html("");
		}
	
});
	$("#car").hide();
	$("#wash").hide();
	$("#dat").hide();
	$("#sl").hide();
	$("#num").hide();
	$("#price").hide();
	$("#b_id").hide();
	$('#datepicker').datepicker({
		minDate: 0,
		dateFormat: 'dd-mm-yy'
	});
	$(document).on('change','#car_type',function(){
		$("#car_type_err").html("");
	});
	$(document).on('change','#wash_type',function(){
		$("#wash_type_err").html("");
	});
	$(document).on('click','#book',function(){
		$("#book").hide();
		$("#car").show();
	})
	
	$("#car_type").change(function(){
		$("#wash").show();
        $("#wash_type").html('<option>Select</option>');
		var car = $(this).val();

        $.ajax({
            url: 'disp_wash.php',
            type: 'post',
            data: {depart:car},
            dataType: 'json',
            success:function(data){
                var len = data.length;
				console.log(data)                
                for(var i = 0; i<len; i++){
					var id = data[i]['id'];
                    var wash = data[i]['wash'];
                    $("#wash_type").append("<option value='"+id+"'>"+wash+"</option>");

                }
            }
        });
    });
	$("#wash_type").change(function(){
		$("#dat").show();
	});
	
	$("#datepicker").change(function(){
		$("#sl").show();
	});
	$("#sl").change(function(){
		$("#num").show();
		$("#b_id").show();
	});
	$(document).on('click','#btn_approve',function(){
	var number=/^([A-Z]{2}[0-9]{2}[A-Z]{2}[0-9]{4})$/;
	var s = $("#reg").val();
	
	if(s.length!=10)
	{
		$("#car_num1").html("*Please enter car number");
	}
	else
	{
		if(!s.match(number))
		{
		$("#car_num3").html("*Please check car number");
		return false;
		}
		else
		{
			$("#car_num3").html("");
			//alert("working")
		}
		$("#car_num1").html("");
		var n_car=$("#car_type").val();
		if(n_car==1)
		{
			$("#p_car").val("HatchBack");
		}
		else if(n_car==2)
		{
			$("#p_car").val("Sedan");
		}
		else if(n_car==3)
		{
			$("#p_car").val("SUV");
		}
		
		var n_wash=$("#wash_type").val();
		
		if(n_wash==1)
		{
			$("#p_wash").val("Interior");
		}
		else if(n_wash==2)
		{
			$("#p_wash").val("Body");
		}
		else if(n_wash==3)
		{
			$("#p_wash").val("Full");
		}
		var n_date=$("#datepicker").val();
		{
			$("#p_date").val(n_date);
		}
		var n_slot=$("#slot").val();
		if(n_slot==1)
		{
			$("#p_slot").val("10:00 - 11:00");
		}
		else if(n_slot==2)
		{
			$("#p_slot").val("11:00 - 12:00");
		}
		else if(n_slot==3)
		{
			$("#p_slot").val("12:00 - 01:00");
		}
		else if(n_slot==4)
		{
			$("#p_slot").val("01:00 - 02:00");
		}
		else if(n_slot==5)
		{
			$("#p_slot").val("02:00 - 03:00");
		}
		else if(n_slot==6)
		{
			$("#p_slot").val("03:00 - 04:00");
		}
		else if(n_slot==7)
		{
			$("#p_slot").val("04:00 - 05:00");
		}
		else if(n_slot==8)
		{
			$("#p_slot").val("05:00 - 06:00");
		}
		var n_num=$("#reg").val();
		{
			$("#p_num").val(n_num);
		}
		var n_price=$("#f_price").val();
		{
			$("#p_price").val(n_price);
		}
		if($("#car_type").val()=="")
		{
			$("#car_type_err").html("*Please select car type");
			$("#wash_type").val("");
			$("#p_wash").val("");			
			return false;
		}
		else
		{
			$("#car_type_err").html("");
		}
		if($("#car_type").val()=="" && $("#car_type").change(function(){}))
			{
				$("#p_wash").val("");
			}
		if($("#p_wash").val()=="")
		{
			$("#wash_type_err").html("*Please select wash type");
			return false;
		}
		if($("#car_type").val()!="" && $("#p_wash").val()!="")
		{
			$("#wash_type_err").html("");
		//console.log()
		var flag=0;
		$("#booking").ajaxSubmit
		({
			url: 'book_insert1.php',
			type: 'post',
			dataType: 'json',
			data:{flag_check:flag},
			success: function(result)
			{
				var s=true;
				if(result['status']=="single_slot")
				{
					//console.log(2341324)
					$("#slot_book1").html("*Slot already booked");					
					table();
					s=false;
					//$("#book").hide();
					//$("#booking").hide();
				}
				else
				{
					$("#slot_book").html("");					
					table();
				}				
				if(result['status']=="num")
				{					
					$("#car_num").html("*Please check car number");
					table();
					s=false;
				}
				else
				{
					$("#car_num").html("");					
					table();
				}	
				if(result['status']=="three_slots")
				{
					$("#slot_book2").html("*Slot not available");	
					table();
					s=false;
				}
				else
				{
					$("#slot_book2").html("");					
					table();
				}	
				if(result['status']=="proceed")
				{
					$("#pro").modal('show');
				}
			}
		});
	
		}
	}
	});
	
	
	
	$("#car_type").change(function(){
	var car_tp=$("#car_type").val();
	console.log(car_tp)

	$("#wash_type").click(function(){
	var wash_tp=$("#wash_type").val();
	console.log(wash_tp)
	
	$.ajax({
            url: 'fetch_price.php',
            type: 'post',
            data: {car:car_tp,wash:wash_tp},
            dataType: 'json',
            success:function(data){
				console.log(data)
				$("#f_price").val(data);
				$("#price").show();
			}
	});
});

	});
$(document).on('click','#cancel',function(){
		$('#booking')[0].reset();
		$("#pro").modal('hide');
		$("#car").hide();
	$("#wash").hide();
	$("#dat").hide();
	$("#sl").hide();
	$("#num").hide();
	$("#price").hide();
	$("#b_id").hide();
		$("#book").show();
	});
	$(document).on('click','#edit',function(){
		$("#pro").modal('hide');
	});
$(document).on('click','#sub',function()
    {
		var flag=1;
		$("#booking").ajaxSubmit
		({
			url: 'book_insert1.php',
			type: 'post',
			dataType: 'json',
			data:{flag_check:flag},
			success: function(response)
			{
				console.log(response)
				if(response['status']=="booked")
				{
					//alert("Booked Successfully");
					location.href = "view_bookings.php";
					table();
					$("#pro").modal('hide');
					$('#booking').trigger('reset');
					$("#car").hide();
					$("#wash").hide();
					$("#dat").hide();
					$("#sl").hide();
					$("#num").hide();
					$("#price").hide();
					$("#b_id").hide();
					$("#book").show();
				}				
			}
		});
	});
	
function table()
	{
		$.ajax({
			url: "cus_table.php",
			type: "POST",
			datatype: "html",
			success:function(data)
			{
			$("#mytable").html(data);
			}
		});
	}
});

</script>
</body>
</html>