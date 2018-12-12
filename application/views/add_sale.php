<div class = "content-wrapper">
	<div class="content">
		<div class="row">
			<div class="col-md-6">
				<form action="<?php echo base_url();?>Sales/add_sale_details" method="post" enctype="multipart/form-data">
					<div class="panel panel-flat">
						<div class="panel-heading">
							<h5 class="panel-title">Add Sale</h5>
						</div>
						<div class="panel-body">
							<div class="form-group">
								<label>Selling To</label>
								<input type="text" name="name" class="form-control" placeholder="Enter Purchasers Name" required>
							</div>
							<div class="form-group">
								<label>Select Lot</label>
								<select class ="select form-control" name = "lotid">
									<?php
									foreach($lotlist as $lotlists ) {
										?>
										<option value = "<?php echo $lotlists->ID;?>"><?php echo $lotlists->NAME; ?></option>
										<?php
									}
									?>
								</select>
							</div>
							<div class="form-group">
								<label>Quantity</label>
								<input type="number" name="qty" class="form-control" placeholder="Enter Quantity">
							</div>
							<div class="form-group">
								<label>Price</label>
								<input type="number" name="price" class="form-control" placeholder="Enter Selling Price">
							</div>
							<div class="text-right">
								<button type="submit" class="btn btn-primary">Add Sale</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>








