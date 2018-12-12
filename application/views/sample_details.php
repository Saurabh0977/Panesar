<div class = "content-wrapper">
	<div class = "content">
		<div class = "row">
			<div class="col-md-6">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Sample Details</h5>
						<div class="heading-elements">
							<ul class="icons-list">
		                		<li><a data-action="collapse"></a></li>
		                		<li><a data-action="reload"></a></li>
		                		<li><a data-action="close"></a></li>
		                	</ul>
		                </div>
					</div>
					<div class="panel-body">
						<table class="table">
							<tr>	
								<td>Name</td>
								<td><?php echo $sample->NAME; ?></td>
							</tr>
							<tr>	
								<td>Created By</td>
								<td><?php echo $sample->CREATOR_NAME; ?></td>
							</tr>
							<tr>	
								<td>Created At</td>
								<td><?php echo $sample->CREATED_AT; ?></td>
							</tr>			 
						</table>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Item Details</h5>
						<div class="heading-elements">
							<ul class="icons-list">
		                		<li><a data-action="collapse"></a></li>
		                		<li><a data-action="reload"></a></li>
		                		<li><a data-action="close"></a></li>
		                	</ul>
			            </div>
					</div>
					<div class="panel-body">
						<table class="table datatable-show-all">
							<thead>
								<tr>
									<th>ITEM NAME</th>
									<th>ITEM PHOTO</th>
								</tr>	
							</thead>
							<tbody>
								<?php
								foreach($sample_item as $sample_items)
								{
									?>
									<tr>
										<td><?php echo $sample_items->ITEM_NAME; ?></td>
										<td>
										<?php
										if($sample_items->ITEM_PHOTO == "") {
											echo "No Photo";
										} else {
											?>
											<img src = "<?php echo site_url(); ?>uploads/<?php echo $sample_items->ITEM_PHOTO; ?>" width = "100px"></td>
											<?php
										}
										?>
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



						
					
			