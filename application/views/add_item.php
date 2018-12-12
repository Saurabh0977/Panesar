<div class = "content-wrapper">
	<div class="content">
		<div class="row">
			<div class="col-md-6">
				<form action="<?php echo base_url();?>Items/create_item" method="post" enctype="multipart/form-data">
					<div class="panel panel-flat">
						<div class="panel-heading">
							<h5 class="panel-title">Add Item</h5>
							<span style = "color:#4caf50;"><?php echo $message; ?></span>
							<span style = "color:red;">
								<?php
								foreach($errors as $error) {
									?>
									<p><?php echo $error; ?></p>
									<?php
								}
								?>
							</span>
						</div>

						<div class="panel-body">
							<div class="form-group">
								<label>Item Name</label>
								<input type="text" name="iname" class="form-control" placeholder="Choose a name for New Item" required>
							</div>

							<div class="form-group">
								<label>Unit</label>
								<select class ="select" name = "unit">
									<?php
									foreach($units as $id =>$name) {
										?>
										<option value = "<?php echo $id; ?>"><?php echo $name; ?></option>
										<?php
									}
									?>
								</select>
							</div>

							<div class="form-group">
								<label>Photo</label>
								<input type="file" name="userfile" class="form-control">
							</div>

							<div class="form-group">
								<label>Color</label>
								<input type="text" name="color" class="form-control" placeholder="Choose a Color for this item">
							</div>

							<div class="form-group">
								<label>Minimum Threshold</label>
								<input type="number" name="mthreshold" class="form-control" placeholder="Enter the minimum quantity for this item you would like to keep in stock." required>
							</div>
							<div class="text-right">
								<button type="submit" class="btn btn-primary">Add Item</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>