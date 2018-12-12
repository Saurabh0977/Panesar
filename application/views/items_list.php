<div class = "content-wrapper">
	<div class = "content">
		<div class="panel panel-flat">
			<div class="panel-heading">
				<h5 class="panel-title">ITEMS LIST</h5>
				<div class="heading-elements">
					<ul class="icons-list">
						<li><a data-action="collapse"></a></li>
						<li><a data-action="reload"></a></li>
						<li><a data-action="close"></a></li>
					</ul>
				</div>
			</div>
			<table class="table datatable-basic">
				<thead>
					<tr>
						<th width="10%">IMAGE</th>
						<th width="30%">NAME</th>
						<th width="10%">COLOR</th>
						<th width="15%">MIN QTY</th>
						<th width="15%">CURR QTY</th>
						<th width="20%" class="text-center">ACTIONS</th>
					</tr>
				</thead>
				<tbody>
					<?php
					foreach($items as $item) {
						if($item->STATUS == 1) {
							?>
							<tr>
							<?php
						} else {
							?>
							<tr style = "background-color: #ddd">
							<?php
						}
						?>
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
							<td><?php echo ucfirst($item->NAME); ?></td>
							<td><?php echo ucfirst($item->COLOR); ?></td>
							<td><?php echo $item->MIN_THRESHOLD; ?>&nbsp;<?php echo $item->UNIT_NAME; ?></td>
							<td><?php echo $item->CURRENT_QTY; ?>&nbsp;<?php echo $item->UNIT_NAME; ?></td>
							<td class="text-center">
								<p><a href = "<?php echo base_url(); ?>Items/item_details/<?php echo $item->ID; ?>">View Details</a></p>
								<p><a href = "<?php echo base_url(); ?>Items/update_item/<?php echo $item->ID; ?>">Edit Item</a></p>

								<?php
								if($item->STATUS == 1)
								{	
									?>
									<p><a href = "<?php echo site_url(); ?>Items/delete_items/<?php echo $item->ID; ?>">Delete Item</a></p>
									<?php
								}
								else
								{
									?>
									<p><a href = "<?php echo site_url(); ?>Items/activate_items/<?php echo $item->ID; ?>">Activate Item</a></p>
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