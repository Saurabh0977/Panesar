<div class="content-wrapper">
	<div class = "content">
		<div class="panel panel-flat">
			<div class="panel-heading">
				<h5 class="panel-title">LOTS LIST</h5>
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
						<th>LOT NAME</th>
						<th>SAMPLE NAME</th>
						<th>LOT QUANTITY</th>
						<th>BALANCE QUANTITY</th>
					</tr>
					<?php
					foreach($lot as $lots) {
						?>
						<tr>
							<td><?php echo $lots->NAME; ?></td>
							<td><?php echo $lots->sample_name->NAME; ?></td>
							<td><?php echo $lots->QUANTITY; ?></td>
							<td><?php echo $lots->CURRENT_QUANTITY; ?></td>
						</tr>
						<?php
					}
					?>
				</table>
			</div>
		</div>
	</div>
</div>