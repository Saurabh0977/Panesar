<!-- Main navbar -->
	<div class="navbar navbar-inverse ">
		<div class="navbar-header">
			<a class="navbar-brand" href="<?php echo site_url(); ?>"><?php echo strtoupper(PROJECT_NAME); ?></a>
			<ul class="nav navbar-nav visible-xs-block">
				<li><a data-toggle="collapse" data-target="#navbar-mobile"><i class="icon-tree5"></i></a></li>
				<li><a class="sidebar-mobile-main-toggle"><i class="icon-paragraph-justify3"></i></a></li>
			</ul>
		</div>

		<div class="navbar-collapse collapse" id="navbar-mobile">
			<ul class="nav navbar-nav">
				<li><a class="sidebar-control sidebar-main-toggle hidden-xs"><i class="icon-paragraph-justify3"></i></a></li>
			</ul>

			<ul class="nav navbar-nav navbar-right">
				<li class="dropdown language-switch">
					<a class="dropdown-toggle" data-toggle="dropdown">
						<i class="icon-plus22"></i> 
						New
						<span class="caret"></span>
					</a>
					<ul class="dropdown-menu">
						<li><a href="<?php echo base_url();?>Items/add_item"><i class="icon-file-plus"></i> Item</a></li>
						<li><a href="<?php echo base_url();?>Samples/add_sample"><i class="icon-clipboard"></i> Sample</a></li>
						<li><a href="<?php echo base_url();?>Lot/add_lot"><i class="icon-clipboard2"></i> Lot</a></li>
						<li><a href="<?php echo base_url();?>Purchases/add_purchase"><i class="icon-grid4"></i> Purchases</a></li>
						<li><a href="<?php echo base_url();?>Sales/add_sale"><i class="icon-grid52"></i> Sale</a></li>
						<li><a href="<?php echo base_url();?>User/add"><i class="icon-user-plus"></i> User</a></li>
					</ul>
				</li>


				<li class="dropdown dropdown-user">
					<a class="dropdown-toggle" data-toggle="dropdown">
						<i class="icon-user"></i> 
						<span><?php echo ucfirst($this->session->userdata('uname')); ?></span>
						<i class="caret"></i>
					</a>

					<ul class="dropdown-menu dropdown-menu-right">
						<li><a href="<?php echo base_url();?>User/logout"><i class="icon-switch2"></i> Logout</a></li>
					</ul>
				</li>
			</ul>
		</div>
	</div>
	<!-- /main navbar -->