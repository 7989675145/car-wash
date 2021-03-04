<?php
include('db.php');
$value="";
$value='<table id="price">
		<thead>
				<tr>
					<th>Type</th>
					<th>Wash Type</th>
					<th>Price</th>
					<th>Edit</th>				
				</tr>
			</thead>
			<tbody>';
			$details=mysqli_query($link,"SELECT * FROM wash_prices ORDER BY car_type,wash_type");
			$num=mysqli_num_rows($details);
			if($num>0)
			{
				while($fetch=mysqli_fetch_assoc($details))
				{
				$value.='<tr>';
						if($fetch['car_type']==1) 
						{
					$value.='<td>Hatchback</td>';
						} 
						else if($fetch['car_type']==2) 
						{
					$value.='<td>Sedan</td>';
						}
						else if($fetch['car_type']==3)
						{
						$value.='<td>SUV</td>';
						}
					if($fetch['wash_type']==1)
						{
						$value.='<td>Interior</td>';
						} 
						else if($fetch['wash_type']==2) 
						{
						$value.='<td>Body</td>';
						} 
						else if($fetch['wash_type']==3) 
						{
							$value.='<td>Full</td>';
						}
					$value.='<td>'.$fetch['price'].'</td>
					<td><button class="btn btn-success edit" id="edit" data-id='.$fetch['wash_id'].'><i class="las la-edit"></i></button> </td>
					
					</tr>';
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