<html>
<head>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/assets/css/customstyle.css">
<style>
table, th, td {
    border: 1px solid black;

}
table
{
width:80%;	

}
table {
    border-collapse: collapse;
}
th
{

	font-size: 12px;
	height: 30px;
}


</style>	
</head>
<body>

						<h3 class="heading1" align="center">Sales List</h3>	



						<table class="itemtable" align="center">
							
								<tr>
									<th width="100px">SOLD TO</th>
									<th width="100px">LOT NAME</th>
									<th width="100px">QUANTITY</th>
									<th width="100px">PRICE</th>
									<th width="100px">SOLD ON</th>
								</tr>	
								
									
								<?php
								foreach($sales as $sale) {
									?>
										<tr>
										<td align="center"><?php echo $sale->NAME; ?></td>
										<td align="center"><?php echo $sale->lname; ?></td>
										<td align="center"><?php echo $sale->QUANTITY; ?></td>
										<td align="center"><?php echo $sale->PRICE; echo " Rs "?></td>	
										<td align="center"><?php echo $sale->CREATED_AT; ?></td>
									</tr>
									<?php

								}
								?>
								
							
						</table>
					</body>
					</html>