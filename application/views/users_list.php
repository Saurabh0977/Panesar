<div class="content-wrapper">
	<div class = "content">
		<div class="panel panel-flat">
			<div class="panel-heading">
				<h5 class="panel-title">USERS LIST</h5>
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
						<th>NAME</th>
						<th>USERNAME</th>
						<th>TYPE</th>
						<th>STATUS</th>
						<th class="text-center">ACTIONS</th>
					</tr>
				</thead>
				<tbody>
					<?php
					foreach($users as $user) {
						?>
						<tr>
							<td><?php echo $user->NAME; ?></td>
							<td><?php echo $user->USERNAME; ?></td>
							<td>
								<?php
								if($user->TYPE == 1) {
									echo "Admin";
								} else {
									echo "Operator";
								}
								?>	
							</td>
							<td>
								<?php
								if($user->STATUS == 1) {
									?>
									<span class="label label-success">Active</span></td>
									<?php
								} else {
									?>
									<span class="label label-danger">Inactive</span></td>
									<?php
								}
								?>
								<td class="text-center">
									<?php
									if($user->STATUS == 1)
									{
										?>

										<p><a href = "<?php echo site_url(); ?>User/delete/<?php echo $user->ID; ?>">Delete User</a></p>

										<?php
									}		
									else
									{
										?>
										<p><a href = "<?php echo site_url(); ?>User/activate_user/<?php echo $user->ID; ?>">Activate User</a></p>
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