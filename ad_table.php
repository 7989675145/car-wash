<?php
include('db.php');
$value="";
$value='<table id="mytable">
		<thead>
				<tr>
					<th>Customer Details</th>
					<th>Car Details</th>
					<th>Wash Type</th>
					<th>Number</th>
					<th>Date</th>
					<th>Slot</th>
					<th>Status</th>
				</tr>
			</thead>
			<tbody>';
			$s=mysqli_query($link,"SELECT user_details.name as name,user_details.id as id,booking.status as status,wash_prices.car_type as car,wash_prices.wash_type as wash,booking.price as price,booking.number as num,booking.dated as dated,booking.slot as slot FROM user_details JOIN booking ON booking.id=user_details.id JOIN wash_prices ON wash_prices.wash_id=booking.wash_id");
			$num=mysqli_num_rows($s);
			if($num>0)
			{
				while($fetch=mysqli_fetch_assoc($s))
				{
			$value.='<tr>
					<td>'.$fetch['name'].'</td>';
					if($fetch['car']==1)
					{
						$value.='<td>Hatchback</td>';
						
					}
					 else if($fetch['car']==2) 
					{ 	
						$value.='<td>Sedan</td>';
						
					}
					else if($fetch['car']==3) 
					{	
						$value.='<td>SUV</td>';
						
					}
					if($fetch['wash']==1) 
					{
						$value.='<td>Interior</td>';
					} 
					else if($fetch['wash']==2) 
					{
						$value.='<td>Body</td>';
					}
					else if($fetch['wash']==3) 
					{
						$value.='<td>Full</td>';
					}
					$value.='<td>'.$fetch['num'].'</td>
							<td>'.$fetch['dated'].'</td>';
					if($fetch['slot']==1) 
					{
						$value.='<td>10:00-11:00</td>';
					} 
					else if($fetch['slot']==2) 
					{
						$value.='<td>11:00-12:00</td>';
					}
					else if($fetch['slot']==3) 
					{
						$value.='<td>12:00-01:00</td>';
					}
					else if($fetch['slot']==4) 
					{
						$value.='<td>01:00-02:00</td>';
					}
					else if($fetch['slot']==5) 
					{
						$value.='<td>02:00-03:00</td>';
					}
					else if($fetch['slot']==6) 
					{
						$value.='<td>03:00-04:00</td>';
					}
					else if($fetch['slot']==7) 
					{
						$value.='<td>04:00-05:00</td>';
					}
					else if($fetch['slot']==8) 
					{
						$value.='<td>05:00-06:00</td>';
					}
					if($fetch['status']==1) 
					{
						$value.='<td>Approved</td>
								</tr>';
					}
					else if($fetch['status']==2) 
					{
						$value.='<td>Rejected</td>
								</tr>';
					}
					else 
					{ 
						$value.='<td><button type="button" class="btn btn-success" id="btn_approve" data-id1='.$fetch['id'].' data-slot='.$fetch['slot'].'>Pending</button></td>
								</tr>';
					}
				}
			}
			else
			{
			$value.='<tr>
					 <td colspan="5">No records Found</td>
					 </tr>';			
			}
			$value.='</tbody>
					</table>';
echo $value;
?>