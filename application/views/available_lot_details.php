<html>
<head>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/assets/css/customstyle.css">
<style>
table, th, td {
    border: 1px solid black;
    text-align: center;
    width:100px;

}
table
{
	
width:90%;	

}
table {
    border-collapse: collapse;
}
th
{    
	font-family: Arial;
	font-size: 12px;
	height: 30px;
}
td
{
	height:20px; 
}


</style>	
</head>
<body>

						<h3 class="heading1" align="center">Lots Details</h3>	


						<table align="center" class="itemtable">
							
								<tr>
								<?php	//<th>S.No</th> ?>
									<th>LOT NAME</th>
									<th>SAMPLE NAME</th>
									<th>QUANTITY</th>
									<th>SOLD TO</th>
									<th>SOLD QUANTITY</th>
									<th>SOLD PRICE</th>
									<th>DATE</th>
								</tr>
								
								<?php
								
								foreach($lots as $lot) {
									
									?>
									<tr>
									<?php /*	<td><?php 
										$sno = 1;
										echo $sno;
										$sno++; 
										 ?></td> */ ?>
										<td><?php echo $lot->NAME; ?></td>
										<td><?php echo $lot->sample_name->NAME; ?></td>
										<td><?php echo $lot->QUANTITY; ?> </td>
										<td><?php echo $lot->seller[0]->NAME; ?></td>
										<td><?php echo $lot->seller[0]->QUANTITY; ?></td>
										<td><?php echo $lot->seller[0]->PRICE; ?></td>
										<td><?php echo $lot->seller[0]->CREATED_AT; ?></td>
									</tr>
									<?php
								}
								?>
								
							
						</table>
					</body>
					</html>