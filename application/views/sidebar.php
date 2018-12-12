	<!-- Main navigation -->
	<!-- Main sidebar -->
			<div class="sidebar sidebar-main">
				<div class="sidebar-content">
					<!-- User menu -->
					<div class="sidebar-user">
						<div class="category-content">
							<div class="media">
								<div class="media-body">
									<span class="media-heading text-semibold">Welcome, <?php echo strtoupper($this->session->userdata('uname')); ?></span>
								</div>
							</div>
						</div>
					</div>
					<!-- /user menu -->
					<div class="sidebar-category sidebar-category-visible">
						<div class="category-content no-padding">
							<ul class="navigation navigation-main navigation-accordion">
								<!-- Main -->
								<li class="navigation-header"><span>Main Menu</span> <i class="icon-menu" title="Main pages"></i></li>
								<li><a href="<?php echo site_url(); ?>User/Dashboard"><i class="icon-home4"></i> <span>Dashboard</span></a></li>
								<li><a href="<?php echo site_url(); ?>Items/list_items"><i class="icon-file-text2"></i> <span>Items</span></a></li>
								<li><a href="<?php echo site_url(); ?>Samples/list_samples"><i class="icon-clipboard"></i> <span>Samples</span></a></li>
								<li><a href="<?php echo site_url(); ?>Lot/list_lots"><i class="icon-clipboard2"></i> <span>Lots</span></a></li>
								<li><a href="<?php echo site_url(); ?>Sales/list_sales"><i class="icon-grid52"></i> <span>Sales</span></a></li>
								<li><a href="<?php echo site_url(); ?>Report/report_view"><i class="icon-file-zip"></i> <span>Reports</span></a></li>
								<li><a href="<?php echo site_url(); ?>User/lists"><i class="icon-user"></i> <span>Users</span></a></li>
								<!-- /page kits -->
							</ul>
						</div>
					</div>
					<!-- /main navigation -->

				</div>
			</div>

			<!-- /main sidebar -->