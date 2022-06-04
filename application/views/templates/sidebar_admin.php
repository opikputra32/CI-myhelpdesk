<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-light-primary elevation-4">
	<!-- Brand Logo -->
	<a href="" class="brand-link">
		<img src="<?php echo base_url('assets/'); ?>dist/img/adonia.png" alt="zADONIA Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
		<span class="brand-text font-weight-bold">ADMINISTRATOR</span>
	</a>
	<!-- Sidebar -->
	<div class="sidebar">
		<!-- Sidebar user panel (optional) -->
		<div class="user-panel mt-3 pb-3 mb-3 d-flex">
			<div class="image">
				<img src="<?php echo base_url('assets/dist/img/profile/' . $user['image']); ?>" class="img-circle elevation-2" alt="User Image">
			</div>
			<div class="info">
				<a href="#" class="d-block"><?php echo $user['nama']; ?></a>
			</div>
		</div>
		<!-- Sidebar Menu -->
		<nav class="mt-2">
			<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
				<!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
				<li class="nav-header">ADMIN</li>
				<li class="nav-item">
					<a href="<?php echo base_url('admin/index'); ?>" class="nav-link">
						<i class="nav-icon fas fa-home"></i>
						<p class="text">Beranda</p>
					</a>
				</li>
				<li class="nav-item has-treeview">
					<a href="#" class="nav-link">
						<i class="nav-icon fas fa-toolbox"></i>
						<p>
							Master Data
							<i class="right fas fa-angle-left"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<li class="nav-item">
							<a href="<?php echo base_url('admin/list_user'); ?>" class="nav-link">
								<i class="far fa-circle nav-icon"></i>
								<p>Master User</p>
							</a>
						</li>
						<!-- <li class="nav-item">
							<a href="<?php echo base_url('admin/list_client'); ?>" class="nav-link">
								<i class="far fa-circle nav-icon"></i>
								<p>Master Klien</p>
							</a>
						</li> -->
					</ul>
				</li>
				<li class="nav-item has-treeview">
					<a href="#" class="nav-link">
						<i class="nav-icon fas fa-compress-arrows-alt"></i>
						<p>
							Data Komplain
							<i class="fas fa-angle-left right"></i>
						</p>
					</a>
					<ul class="nav nav-treeview">
						<!-- <li class="nav-item">
							<a href="<?php echo base_url('admin/list_member'); ?>" class="nav-link">
								<i class="far fa-circle nav-icon"></i>
								<p>Data Client</p>
							</a>
						</li> -->
						<li class="nav-item">
							<a href="<?php echo base_url('admin/list_komplain'); ?>" class="nav-link">
								<i class="far fa-circle nav-icon"></i>
								<p>Komplain</p>
							</a>
						</li>
					</ul>
				</li>
				<li class="nav-item">
					<a href="<?php echo base_url('admin/laporan'); ?>" class="nav-link">
						<i class="nav-icon fas fa-file-alt"></i>
						<p class="text">Laporan</p>
					</a>
				</li>
				<li class="nav-header">END</li>
				<li class="nav-item">
					<a href="<?php echo base_url('auth/logout'); ?>" id="tombol-logout" class="nav-link">
						<i class="nav-icon fas fa-sign-out-alt text-danger"></i>
						<p class="text">Logout</p>
					</a>
				</li>
			</ul>
		</nav>
		<!-- /.sidebar-menu -->
	</div>
	<!-- /.sidebar -->
</aside>
