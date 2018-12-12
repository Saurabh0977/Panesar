<div class = "content-wrapper">
	<div class="content">
		<div class="row">
			<form action="<?php echo base_url();?>Samples/submit" method="post">
				<div class="col-md-6">
					<div class="panel panel-flat">
						<div class="panel-heading">
							<h5 class="panel-title">Add Sample</h5>
						</div>
						<div class="panel-body">
							<div class="form-group">
								<label>Sample Name</label>
								<input type="text" name="iname" class="form-control" placeholder="Choose a Name for this Sample" required>
							</div>
							<div class = "form-group">
								<label>Search Items</label>	
								<input type="text" onkeyup="searchItems(this.value);" id="fname" name="sid" id="sid"  placeholder="Start typing name of Items to add to this Sample" class="form-control" autocomplete="off">
							</div>
							<div class="form-group" style = "margin-top: 20px;">
								<span id = "itemlist">
								</span>
							</div>
						</div>
					</div>
				</div>

				<div class = "col-md-6">
					<div id = "session_items">
						<div class="panel panel-flat">
							<div class="panel-body">
								<table class = "table">
									<tr>
										<th>Name</th>
										<th>Quantity</th>
										<th>Delete Items</th>
									</tr>
									<?php
									$data = $this->session->userdata('items_for_sample');
									if(count($data) > 0) {
										foreach($data as $row) {
											?>
											<tr>
												<td><?php echo $row["name"]; ?></td>
												<td><?php echo $row["qty"]; ?></td>
												<td><button type = "button" class = "btn btn-danger" onclick="myItemsId(<?php echo $row['id']; ?>)">Delete</button></td>	
											</tr>
											<?php
										}
									}
									?>
								</table>
							</div>
						</div>
					</div>
					<div class = "row">
						<button class = "btn btn-primary pull-right" type = "submit">Create Sample</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<script>
function searchItems(val) {
	if(val.length > 2) {
		$.ajax({ 
			url: '<?php echo site_url(); ?>items/get_item_like',
			data: 'val=' + val,
			type: 'post',
			success: function(response) {
				$("#itemlist").html(response);
	            //alert(output);
	        }
	    });
	} else {
		$("#itemlist").html("");
	}
}

function myItems(name, id, i)
{
	var qty = $("#qty" + i).val();
	$.ajax({ 
		url: '<?php echo site_url(); ?>samples/add_item_to_session',
		data: 'id=' + id + '&name=' + name + '&qty=' + qty,
		type: 'post',
		success: function(response) {
			$("#session_items").html(response);
	    }
	});
}

function myItemsId(id)
{
	$.ajax({
		url: '<?php echo base_url(); ?>samples/delete_item_from_session',
		data: 'id=' + id,
		type: 'post',
		success: function(response){
			$("#session_items").html(response);
		}
	});
}
</script>