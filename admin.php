<?php 
include("header.php");

if(isset($_SESSION['user']) && $_SESSION['user']!='ADMIN')
{
	header("location:index.php");
}
?>
WELCOME <?php echo $_SESSION['user']; ?>
			</a>
		<div>
			
			<a class="btn btn-success " href="price.php">Manage Prices</a>			
			<a class="btn btn-danger " href="logout.php">Logout</a>
		</div>
	</nav>
	
<div class="container">
	<div class="row mt-3 justify-content-center">
		<div class="col-12">
			<table id="mytable" class="table table-bordered table-striped mt-3">
			
			
			</table>
			</div>
		</div>
	</div>

<div class="modal" id="approve">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h3 class="text-dark">Approve Record</h3>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
          </div>
          <div class="modal-body">
            <p> Do You want to Approve the Record ?</p>
            <button type="button" class="btn btn-success" id="btn_final_approve" data-id2="ap_id" data-slot-id1="slot_num">Approve</button>
            <button type="button" class="btn btn-danger" id="btn_final_cancel" data-id3="can_id" data-slot-id2="slot_num">Reject</button>
          </div>
        </div>
      </div>
    </div>	
	
<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.bundle.min.js"></script>
<script>
$(document).ready(function(){
	table();
$(document).on('click','#btn_approve',function()
    {
        var approve_id = $(this).attr('data-id1');
		var slot = $(this).attr('data-slot');
        $('#approve').modal('show');
		console.log(approve_id)
		console.log(slot)
		$('#btn_final_approve').data('data-id2', approve_id);//sending id value to approve button in the model
		$('#btn_final_approve').data('data-slot-id1',slot);
		$('#btn_final_cancel').data('data-id3', approve_id);
		$('#btn_final_cancel').data('data-slot-id2',slot);
	});
$(document).on('click','#btn_final_approve',function()
    {
		var approve_id = $('#btn_final_approve').data('data-id2');
		var slot = $('#btn_final_approve').data('data-slot-id1');
		
		approve(approve_id,slot);
	});
		
		function approve(approve_id,slot)
		{
			var flag=1;
			$.ajax(
                {
                    url: 'approve.php',
                    method: 'post',
                    data:{app_id:approve_id,slot_id:slot,a_flag:flag},
                    success: function(data)
                    {
                        $('#approve').modal('hide');
						//alert("Approved");
						//window.location.reload();
						table();
                    }
                });
		}
		
		
$(document).on('click','#btn_final_cancel',function()
	{
		var cancel_id = $('#btn_final_cancel').data('data-id3');
		var slot = $('#btn_final_cancel').data('data-slot-id2');//slot for specific cancel not all cancels
		console.log(cancel_id,slot);
		cancel(cancel_id,slot);
	});
	
		function cancel(cancel_id,slot)
		{
			$.ajax(
                {
                    url: 'cancel.php',
                    method: 'post',
                    data:{can_id:cancel_id,slot_id:slot},
                    success: function(data)
                    {
                        $('#approve').modal('hide');
						//alert("Rejected");
						//window.location.reload();
						table();
                    }
                });
		}
	
//$("#sta").css("color","green");
function table()
	{
		$.ajax({
			url: "ad_table.php",
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
<?php
include("footer.php");
?>