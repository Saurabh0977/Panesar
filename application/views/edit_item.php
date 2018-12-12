<div class="content-wrapper">
	<div class="content">
		<div class="row">
			<div class="col-md-12">
				<form action="<?php echo base_url();?>Items/update_item_data/<?php echo $item->ID; ?>" method="post" enctype="multipart/form-data">
					<div class="panel panel-flat">
						<div class="panel-heading">
							<h5 class="panel-title">Edit Item</h5>
						</div>
						<div class="panel-body">
							<div class="form-group">
								<label>Item Name</label>
								<input type="text" name="iname" value="<?php echo $item->NAME; ?>" class="form-control" placeholder="Item Name">
							</div>
							<div class="form-group">
								<label>Unit</label>
								<select class ="select" name = "unit">
									<?php
									foreach($units as $id=>$name) {
										if($item->UNIT == $id) {
											?>
											<option value="<?php echo $id; ?>" selected><?php echo $name; ?></option>
											<?php
										} else {
											?>
											<option value="<?php echo $id; ?>"><?php echo $name; ?></option>
											<?php
										}
										?>
										<?php
									}
									?>
								</select>
							</div>
							<div class="form-group">
								<label>Photo</label>
								<input type="file" name="userfile" value="<?php echo $item->PHOTO; ?> "class="form-control">
								<?php
								if($item->PHOTO == "") {
								} else {
									?>
									<img src = "<?php echo site_url(); ?>uploads/<?php echo $item->PHOTO; ?>" width = "200px">
									<?php
								}
								?>
							</div>
							<div class="form-group">
								<label>Color</label>
								<input type="text" name="color" value="<?php echo $item->COLOR; ?>" class="form-control" placeholder="Add Color">
							</div>
							<div class="form-group">
								<label>Minimum Threshold</label>
								<input type="number" name="mthreshold" value="<?php echo $item->MIN_THRESHOLD; ?>" class="form-control" placeholder="Enter Minimum Threshold">
							</div>
							<div class="text-right">
								<button type="submit" class="btn btn-primary">Update Item</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>