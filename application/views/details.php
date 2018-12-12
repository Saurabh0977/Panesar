<div class = "content-wrapper">
	<div class = "content">
		<div class = "row">
			<div class="col-md-6">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Items Details</h5>
						<div class="heading-elements">
							<ul class="icons-list">
								<li><a data-action="collapse"></a></li>
								<li><a data-action="reload"></a></li>
								<li><a data-action="close"></a></li>
							</ul>
						</div>
					</div>
					<div class = "panel-body">
						<table class="table">
							<tr>
								<td>PHOTO</td>
								<td>
								<?php
								if($item->PHOTO == "") {
									echo "No Photo";
								} else {
									?>
									<img src = "<?php echo site_url(); ?>uploads/<?php echo $item->PHOTO; ?>" width = "200px">
									<?php
								} 
								?>
								</td>
							</tr>
							<tr>	
								<td>Name</td>
								<td><?php echo $item->NAME; ?></td>
							</tr>
							<tr>	
								<td>UNIT</td>
								<td><?php echo $item->UNIT_NAME; ?></td>
							</tr>
							<tr>	
								<td>COLOR</td>
								<td><?php echo $item->COLOR; ?></td>
							</tr>
							<tr>	
								<td>MIN_THRESHOLD</td>
								<td><?php echo $item->MIN_THRESHOLD." ".$item->UNIT_NAME; ?></td>
							</tr>
							<tr>	
								<td>CURRENT QTY.</td>
								<td><?php echo $item->CURRENT_QTY." ".$item->UNIT_NAME; ?></td>
							</tr>
							<tr>	
								<td>STATUS</td>
								<td>
								<?php 
								if($item->STATUS == 1) {
									echo "Active"; 
								} else {
									echo "Inactive";
								}
								?>
								</td>
							</tr>
						</table>
					</div>
				</div>
			</div>

			<div class="col-md-6">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Stock Details</h5>
						<div class="heading-elements">
							<ul class="icons-list">
								<li><a data-action="collapse"></a></li>
								<li><a data-action="reload"></a></li>
								<li><a data-action="close"></a></li>
							</ul>
						</div>
					</div>
					<div class = "panel-body">
						<table class="table datatable-show-all">
							<thead>
								<tr>
									<th>PURCHASED FROM</th>
									<th>QTY</th>
									<th>RATE</th>
									<th>CREATED AT</th>
								</tr>
							</thead>
							<tbody>
								<?php	
								foreach($stock as $stocks){
									?>
									<tr>
										<td><?php echo $stocks->SELLER->NAME; ?></td>
										<td><?php echo $stocks->QUANTITY; ?></td>
										<td><?php echo $stocks->RATE; ?></td>
										<td><?php echo $stocks->CREATED_AT; ?></td>
									</tr>
									<?php
								}
								?>
							</tbody>			 
						</table>
					</div>
				</div>
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Sold Details</h5>
						<div class="heading-elements">
							<ul class="icons-list">
								<li><a data-action="collapse"></a></li>
								<li><a data-action="reload"></a></li>
								<li><a data-action="close"></a></li>
							</ul>
						</div>
					</div>
					<div class = "panel-body">
						<table class="table datatable-show-all">
							<thead>
								<tr>
									<th>SOLD TO</th>
									<th>QUANTITY</th>
									<th>RATE</th>
									<th>CREATED AT</th>	
								</tr>
							</thead>
							<tbody>
								<?php	
								foreach($lot as $lots){
									?>
									<tr>
										<td><?php echo $lots->SOLD; ?></td>
										<td><?php echo $lots->QUANTITY; ?></td>
										<td><?php echo $lots->RATE; ?></td>
										<td><?php echo $lots->CREATED_AT; ?></td>
									</tr>
									<?php
								}
								?>
							</tbody>			 
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>