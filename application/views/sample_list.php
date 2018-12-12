<div class = "content-wrapper">
	<div class = "content">
		<div class = "row">
			<div class = "col-md-12">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">SAMPLES LIST</h5>
						<div class="heading-elements">
							<ul class="icons-list">
								<li><a data-action="collapse"></a></li>
								<li><a data-action="reload"></a></li>
								<li><a data-action="close"></a></li>
							</ul>
						</div>
					</div>
					<table class="table datatable-show-all">
						<thead>
							<tr>
								<th>SAMPLE NAME</th>
								<th>TOTAL ITEMS</th>
								<th>STATUS</th>
								<th class="text-center">ACTIONS</th>
							</tr>
						</thead>
						<tbody>
							<?php
							foreach($samples as $sample) {
								?>
								<tr>
									<td><?php echo $sample->NAME; ?></td>
									<td><?php echo $sample->ITEM_COUNT; ?></td>
									<td>
										<?php
										if($sample->STATUS == 1) {
											?>
											<span class="label label-success">Active</span></td>
											<?php
										} 
										else 
										{
											?>
											<span class="label label-danger">Inactive</span></td>
											<?php
										}
										?>
										<td class="text-center">
											<p><a href = "<?php echo base_url();?>/Samples/sample_details_c/<?php echo $sample->ID; ?>">View Details</a></p>
											<p><a href = "<?php echo base_url();?>/Samples/edit_sample_c/<?php echo $sample->ID; ?>">Edit Sample</a></p>
											<?php
											if($sample->STATUS == 1)
											{	
												?>
												<p><a href = "<?php echo site_url(); ?>Samples/delete_sample/<?php echo $sample->ID; ?>">Delete Sample</a></p>
												<?php
											}
											else
											{
												?>
												<p><a href = "<?php echo site_url(); ?>Samples/activate_sample/<?php echo $sample->ID; ?>">Activate Sample</a></p>
												<?php
											}
											?>
										</td>
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