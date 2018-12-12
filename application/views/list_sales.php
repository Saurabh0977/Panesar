<div class="content-wrapper">
	<div class = "content">
		<div class="panel panel-flat">
			<div class="panel-heading">
				<h5 class="panel-title">SALES LIST</h5>
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
					<tr>
						<th>SOLD TO</th>
						<th>LOT NAME</th>
						<th>QUANTITY</th>
						<th>PRICE</th>
					</tr>
					<?php
					foreach($list as $lists) {
						?>
						<tr>
							<td><?php echo $lists->NAME; ?></td>
							<td><?php echo $lists->lot_name; ?></td>
							<td><?php echo $lists->QUANTITY; ?></td>
							<td><?php echo $lists->PRICE; ?> </td>
						</tr>
						<?php
					}
					?>
				</table>
			</div>
		</div>
	</div>
</div>