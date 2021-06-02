<!-- Sidebar Menu -->
<nav class="mt-2">
	<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
		<li class="nav-item">
			<a href="<?= base_url(ADMIN_PATH . '/dashboard') ?>" class="nav-link menu-item <?= ($menu ?? "") == 'dashboard' ? 'active' : '' ?>">
				<i class="nav-icon fas fa-tachometer-alt"></i>
				<p>
					Dashboard
				</p>
			</a>
		</li>
		<?php if (session('level') == '1') :  ?>
			<li class="nav-item">
				<a href="<?= base_url(ADMIN_PATH . '/users') ?>" class="nav-link menu-item <?= ($menu ?? "") == 'users' ? 'active' : '' ?>">
					<i class="nav-icon fas fa-users"></i>
					<p>
						Pengguna
					</p>
				</a>
			</li>
		<?php endif ?>
		<li class="nav-item <?= ($menu ?? "" == 'post') ? 'menu-open' : '' ?>">
			<a href="#" class="nav-link">
				<i class="nav-icon fas fa-paper-plane"></i>
				<p>
					Konten
					<i class="right fas fa-angle-left"></i>
				</p>
			</a>
			<ul class="nav nav-treeview">
				<?php if (session('level') == '1') :  ?>
					<li class="nav-item">
						<a href="<?= base_url(ADMIN_PATH . '/category') ?>" class="nav-link menu-item <?= ($subMenu ?? "") == 'category' ? 'active' : '' ?>">
							<i class="fas fa-tag nav-icon"></i>
							<p>Kategori</p>
						</a>
					</li>
					<!-- <li class="nav-item">
						<a href="<?= base_url(ADMIN_PATH . '/tags') ?>" class="nav-link menu-item <?= ($subMenu ?? "") == 'tags' ? 'active' : '' ?>">
							<i class="fas fa-tags nav-icon"></i>
							<p>Tags</p>
						</a>
					</li> -->
				<?php endif ?>
				<li class="nav-item">
					<a href="<?= base_url(ADMIN_PATH . '/article') ?>" class="nav-link menu-item <?= ($subMenu ?? "") == 'artikel' ? 'active' : '' ?>">
						<i class="fas fa-newspaper nav-icon"></i>
						<p>Artikel & Berita</p>
					</a>
				</li>
			</ul>
		</li>
		<!-- <li class="nav-item">
			<a href="#" class="nav-link">
				<i class="nav-icon fas fa-cogs"></i>
				<p>
					Pengaturan
					<i class="right fas fa-angle-left"></i>
				</p>
			</a>
			<ul class="nav nav-treeview">
				<li class="nav-item">
					<a href="./index.html" class="nav-link">
						<i class="far fa-circle nav-icon"></i>
						<p>Dashboard v1</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="./index2.html" class="nav-link">
						<i class="far fa-circle nav-icon"></i>
						<p>Dashboard v2</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="./index3.html" class="nav-link">
						<i class="far fa-circle nav-icon"></i>
						<p>Dashboard v3</p>
					</a>
				</li>
			</ul>
		</li> -->
		<li class="nav-header">Profile</li>
		<li class="nav-item">
			<a href="<?= base_url(ADMIN_PATH . '/user/settings') ?>" class="nav-link menu-item <?= ($menu ?? "") == 'userSettings' ? 'active' : '' ?>">
				<i class="nav-icon fas fa-user-cog"></i>
				<p>
					Pengaturan Profile
				</p>
			</a>
		</li>
	</ul>
</nav>
<!-- /.sidebar-menu -->