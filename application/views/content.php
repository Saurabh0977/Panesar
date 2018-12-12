<div class="content-wrapper">
	<div class="content">
		<?php
		if(count($shortage) > 0) {
			?>
			<div class = "row">
				<div class = "col-md-12">
					<div class="panel panel-flat panel-collapsed">
						<div class="panel-heading" style = "background-color: orange;color:#FFF;">
							<h4 class="panel-title">Shortage Items (<?php echo count($shortage); ?>)</h4>
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
										<th width="20%">IMAGE</th>
										<th width="40%">NAME</th>
										<th width="20%">MINIMUM QTY</th>
										<th width="20%">CURRENT QTY</th>
									</tr>
								</thead>
								<tbody>
									<?php
									foreach($shortage as $item) {
										?>
										<tr>
											<td>
											<?php
											if($item->PHOTO == "") {
												echo "No Image";
											} else {
												?>
												<img src = "<?php echo site_url(); ?>uploads/<?php echo $item->PHOTO; ?>" width = "70px">
												<?php
											}
											?>
											</td>
											<td><?php echo $item->NAME; ?></td>
											<td><?php echo $item->MIN_THRESHOLD." ".$item->UNIT_NAME; ?> </td>
											<td><?php echo $item->CURRENT_QTY." ".$item->UNIT_NAME; ?></td>
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
			<?php
		}
		?>
		<div class = "row">
			<div class = "col-md-4">
				<div class="panel panel-default">
					<div class = "panel-heading">
						<h5 class = "panel-title"><center>ITEMS</center></h5>
					</div>
					<div class = "panel-body">
						<h1><center><?php echo $items_count; ?></center></h1>
					</div>
				</div>
			</div>
			<div class = "col-md-4">
				<div class="panel panel-default">
					<div class = "panel-heading">
						<h5 class = "panel-title"><center>SAMPLES</center></h5>
					</div>
					<div class = "panel-body">
						<h1><center><?php echo $samples_count; ?></center></h1>
					</div>
				</div>
			</div>
			<div class = "col-md-4">
				<div class="panel panel-default">
					<div class = "panel-heading">
						<h5 class = "panel-title"><center>LOTS</center></h5>
					</div>
					<div class = "panel-body">
						<h1><center><?php echo $lots_count; ?></center></h1>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>