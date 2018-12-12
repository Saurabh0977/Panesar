<div class = "content-wrapper">
	<div class="content">
		<div class="row">
			<div class="col-md-4">
				<form action="<?php echo base_url();?>Lot/add_lot_details" method="post" enctype="multipart/form-data">
					<div class="panel panel-flat">
						<div class="panel-heading">
							<h5 class="panel-title">Add Lot</h5>
						</div>
						<div class="panel-body">
							<div class="form-group">
								<label>Lot Name</label>
								<input type="text" name="lname" class="form-control" placeholder="Choose a name for new Lot" required onkeyup="add_lot_name(this.value);">
							</div>
							<div class="form-group">
								<label>Choose a Sample</label>
								<select class ="select form-control" id="samples" name = "samples" onchange="check_lot_details(this.value);">
									<option value="">--Choose an Option--</option>
									<?php
									foreach($samples as $sample) {
										?>
										<option value = "<?php echo $sample->ID;?>"><?php echo $sample->NAME; ?></option>
										<?php
									}
									?>
								</select>
							</div>
							<div class="form-group">
								<label>Quantity</label>
								<input type="number" name="qty" onkeyup="check_final_lot_details(this.value);" class="form-control" placeholder="Enter Quantity">
							</div>
							<div class="text-right">
								<button type="submit" id="create_lot" class="btn btn-primary" disabled="true">Create Lot</button>
							</div>
						</div>
					</div>
				</form>
			</div>
			<div class = "col-md-8">
				<div class="panel panel-flat">
					<div class="panel-heading">
						<h5 class="panel-title">Lot Details</h5>
					</div>
					<div class="panel-body">
						<h2 id = "lot_name">Your Lot Name</h2>
						<div class = "row">
							<table class="table" id = "lot_details">
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
function add_lot_name(name) {
	if(name.length == 0) {
		$("#lot_name").html("Your Lot Name");	
	} else {
		$("#lot_name").html(name);
	}
}

function check_lot_details(sample_id) {
	$.ajax({ 
		url: '<?php echo site_url(); ?>samples/get_sample_by_id',
		data: 'sample_id=' + sample_id,
		type: 'post',
		success: function(response) {
			$("#lot_details").html(response);
	    }
	});
}

function check_final_lot_details(qty) {
	var sample_id=$("#samples").val();
	$.ajax({ 
		url: '<?php echo site_url(); ?>samples/get_sample_by_id_with_qty',
		data: 'sample_id=' + sample_id + '&qty=' + qty,
		type: 'post',
		success: function(response) {
			$("#lot_details").html(response);
	    }
	});

	$.ajax({ 
		url: '<?php echo site_url(); ?>samples/can_lot_be_created',
		data: 'sample_id=' + sample_id + '&qty=' + qty,
		type: 'post',
		success: function(response) {
			if(response == 1) {
				$("#create_lot").prop('disabled',false);
			} else {
				$("#create_lot").prop('disabled',true);
			}
	    }
	});
}
</script>
