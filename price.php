<?php
include("header.php");
if(isset($_SESSION['user']) && $_SESSION['user']!='ADMIN')
{
	header("location:index.php");
}

?>
		Prices 
			</a>
		<div>
			<a class="btn btn-success " href="admin.php">Back</a>
			<?php
			$s=mysqli_query($link,"SELECT count(wash_id) as num FROM wash_prices");
			$fet=mysqli_fetch_assoc($s);
			if($fet['num']<=12)
			{
			?>
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#insert">
				Add Price
				</button>
			<?php
			}
			?>
			<a class="btn btn-danger " href="logout.php">Logout</a>
		</div>
	</nav>

<div class="container">
<div class="row justify-content-center">
<div class="col-3">
<div class="alert alert-primary" id='ale' role="alert">
  Service updated Successfully 
</div>	
</div>
</div>	
</div>
<div class="container">
	<div class="row mt-3 justify-content-center">
		<div class="col-6">
			<table id="price" class="table table-bordered table-striped mt-3">
			
			</table>
			</div>
		</div>
	</div>
	
<div class="modal fade" id="insert" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Add Price</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	<div class="row mt-9 justify-content-center login-form">
		<div class="col-7">
			<div class="card border-0">
				
			<div class="card-body">
				<form id="add_price">
				<label>Car</label>
				<select name="car_type" class="form-control mt-2" id="car_type"/><br>
				<option value="">Select</option>
				<?php
				for($i=1;$i<=3;$i++)
				{
					$r=mysqli_query($link,"select count(wash_type) as count from wash_prices where car_type=$i ORDER BY car_type");
					$row=mysqli_fetch_assoc($r);
					if($row['count']!=3)
					{					
						echo "<option value='$i'>";
						if($i==1) { echo "HatchBack"; } elseif($i==2) { echo "Sedan";} elseif($i==3) { echo "SUV";}
						echo"</option>";							
					}
				}
				
				?>
				</select><br>
				<label>Wash</label>
				<select name="wash_type" class="form-control mt-2" id="wash" required/><br>
				<option value="">Select</option>
				</select><br>
				<div class="form-group">
					<label>Amount</label>
					<input type="text" class="form-control" name="amount" id="amount"/>
				</div>
				<div class="text-center">
					<button type="button" id="add" class="btn btn-info mt-2">Add</button>
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

<!--Update Modal-->
     <div class="modal" id="update">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h3 class="text-dark">Update Price</h3>
          </div>
          <div class="modal-body">
          <p id="up-message" class="text-dark"></p>
           <form id="update_form">
				<input type="hidden" class="form-control mt-2" id="wash_id" name="id"/>
				<label>Amount</label>
				<input type="text" class="form-control mt-2" id="edit_price" name="edit_price" placeholder="Price" required/>
			</form> 
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-success" id="btn_update">Update Now</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal" id="btn_close">Close</button>
          </div>
        </div>
      </div>
    </div>

<!--Delete Modal-->
    <div class="modal" id="delete">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h3 class="text-dark">Delete Record</h3>
          </div>
          <div class="modal-body">
		    <p> Do You Want to Delete the Record ?</p>
            <button type="button" class="btn btn-success" id="btn_delete_record" data-id2="de_id">Delete Now</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal" id="btn_close">Close</button>
          </div>
        </div>
      </div>
    </div>
	
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/ajax.min.js"></script>
<script>
$(document).ready(function(){	
	price_table();
	$("#ale").hide();
$("#amount").keypress(function (e) 
	{		 
		if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57))
		{
			alert("Please enter only Numbers.");
			return false;
		}
	});
$("#edit_price").keypress(function (e) 
	{		 
		if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57))
		{
			alert("Please enter only Numbers.");
			return false;
		}
	});
});
/*$("#add_price").on("submit", function (e)
	{
    //e.preventDefault();*/

$(document).on('click','#add',function()
{
				if($("#car_type").val()=="")
	              {
					alert("Please select a Car");
					return false;
				  }
				else if($("#wash_type").val()=="")
	              {
					alert("Please select a Wash");
					return false;
				  }
				  
				else if($("#amount").val()=="")
	              {
					alert("Please specify the fare");
					return false;
				  }
				  
				else
				{
				$("#add_price").ajaxSubmit
					({					
							url: "price_insert.php",
							type: "POST",
							dataType: "json",
							success: function(data)
							{
									if(data['status']=="Success")
									{	
										alert("Price Added Successfully!");
										//window.location.reload();
										$('#insert').modal('hide');
										$('#add_price').trigger('reset');
										price_table();
										
									}
									else
									{
										alert("Already Taken!");
										price_table();
									}										
							}
					});
				}
			});
	//});

$("#car_type").change(function(){
        $("#wash").html('<option>Select</option>');
		var car = $(this).val();
		$.ajax({
            url: 'ad_wash.php',
            type: 'post',
            data: {depart:car},
            dataType: 'json',
            success:function(data){
				var len = data.length;
				console.log(data)
				
				 for( var i = 0; i<len; i++){
					 var id = data[i]['id'];
					 var wash = data[i]['wash'];
					  $("#wash").append("<option value='"+id+"'>"+wash+"</option>");
					}
			}
		});
});
	
$(document).on('click','.edit',function(){
	var ID = $(this).attr("data-id");
	$.ajax(
	{
		url :'price_edit.php',
		method: 'post',
        data:{S_ID:ID},
        dataType: 'JSON',
        success: function(data)
        {
			$("#wash_id").val(data['wash_id']);
			$("#edit_price").val(data['price']);
			$("#update").modal('show');
		}
	});
});

$(document).on('click','#btn_update',function(){
	var amount = $('#edit_price').val();
	if(amount=="")
	{
		alert("Please enter the amount");
		$('#update').modal('show');
	}
	else
	{
		$("#update_form").ajaxSubmit({
			url:'update_price.php',
			type:'POST',
			dataType:'JSON',
			success: function(data)
				{
					//window.location.reload();
					//alert('Updated successfully');
					$("#ale").fadeIn(1000);
					$("#ale").fadeOut(3000);
					$('#update').modal('hide');
					price_table();
                }
		})
	}
});

$(document).on('click','#btn_delete',function(){
	var ID = $(this).attr('data-id1');
	$("#delete").modal('show');
	$("#btn_delete_record").data('data-id2',ID);
});

$(document).on('click','#btn_delete_record',function(){
	var ID = $("#btn_delete_record").data('data-id2');
	delete_price(ID);
});

function delete_price(id)
{
	$.ajax({
		url:'delete.php',
		method: 'POST',
        data:{Del_ID:id},
        success: function(data)
        {
			//window.location.reload();
			$('#delete').modal('hide');
			price_table();
		}
	});
}

function price_table()
	{
		$.ajax({
			url: "price_table.php",
			type: "POST",
			datatype: "html",
			success:function(data)
			{
			$("#price").html(data);
			}
		});
	}		
</script>
<?php
include("footer.php");
?>
	