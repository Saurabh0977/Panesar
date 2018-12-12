<div class="content-wrapper">
	<div class="content">
		<div class="row">
			<div class="col-md-6">
				<form action="<?php echo base_url();?>User/create_user" method="post">
					<div class="panel panel-flat">
						<div class="panel-heading">
							<h5 class="panel-title">Add User</h5>
							<?php
							foreach($errors as $error) {
								?>
								<p style="color:red;"><?php echo $error; ?></p>
								<?php
							}
							?>
						</div>
						<div class="panel-body">
							<div class="form-group">
								<label>Name</label>
								<input type="text" name="name" class="form-control" placeholder="Enter the Name of New User" required>
							</div>

							<div class="form-group">
								<label>Username</label>
								<input type="text" name="uname" class="form-control" placeholder="Choose a Username for this user" required>
							</div>


							<div class="form-group">
								<label>Password</label>
								<input type="password" name="pass" class="form-control" placeholder="Enter a new Password">
							</div>

							<div class="form-group">
								<label>Re-Enter Password</label>
								<input type="password" name="rpass" class="form-control" placeholder="Re-enter the Password">
							</div>

							<div class="form-group">
								<label>Type</label>
								<select class="select form-control" name="type">
									<option value="2">Operator</option>
									<option value="1">Admin</option>
								</select>
							</div>

							<div class="text-right">
								<button type="submit" class="btn btn-primary">Create User</button>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>