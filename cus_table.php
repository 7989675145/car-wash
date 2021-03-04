<?php
session_start();
include('db.php');
$value="";
$value='<table id="mytable">
		<thead>
				<tr>
					<th>Car Type</th>
					<th>Wash Type</th>
					<th>Car Number</th>
					<th>Date</th>
					<th>Slot</th>
					<th>Price</th>
					<th>Status</th>
				</tr>
			</thead>
			<tbody>';
			$details=mysqli_query($link,"SELECT user_details.name as name,user_details.id as id,booking.status as status,wash_prices.car_type as car,wash_prices.wash_type as wash,booking.price as  price,booking.number as num,booking.dated as dated,booking.slot as slot FROM user_details JOIN booking ON user_details.id=booking.id and booking.id='".$_SESSION['id']."' JOIN wash_prices ON wash_prices.wash_id=booking.wash_id");
			$num=mysqli_num_rows($details);
			if($num>0)
			{
			while($fetch=mysqli_fetch_assoc($details))
			{
				$value.='<tr>';
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
						$value.='<td>'.$fetch['price'].'</td>';
					if($fetch['status']==0) 
					{
						$value.='<td>Pending</td>';
					} 
					else if($fetch['status']==1)
					{ 
						$value.='<td>Approved</td>';
					} 
					else 
					{ 
					$value.='<td>Rejected</td>';
					}
					$value.='</tr>';
				
			}
			}
			else
			{
				$value.='<tr>
				<td colspan="8">No bookings available!</td>
				</tr>';
			
			}
		
				$value.='</tbody>
			</table>';
echo $value;
?>