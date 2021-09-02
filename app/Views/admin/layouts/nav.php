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
		<?php if (session('level') == '1') :  ?>
			<li class="nav-item <?= (($menu ?? "") == 'master') ? 'menu-open' : '' ?>">
				<a href="#" class="nav-link">
					<i class="nav-icon fas fa-database"></i>
					<p>
						Master Data
						<i class="right fas fa-angle-left"></i>
					</p>
				</a>
				<ul class="nav nav-treeview">
					<li class="nav-item">
						<a href="<?= base_url(ADMIN_PATH . '/category') ?>" class="nav-link menu-item <?= ($subMenu ?? "") == 'category' ? 'active' : '' ?>">
							<i class="fas fa-tag nav-icon"></i>
							<p>Kategori</p>
						</a>
					</li>
					<li class="nav-item">
						<a href="<?= base_url(ADMIN_PATH . '/category-product') ?>" class="nav-link menu-item <?= ($subMenu ?? "") == 'category-product' ? 'active' : '' ?>">
							<i class="fas fa-tag nav-icon"></i>
							<p>Kategori Produk</p>
						</a>
					</li>
					<li class="nav-item">
						<a href="<?= base_url(ADMIN_PATH . '/category-faq') ?>" class="nav-link menu-item <?= ($subMenu ?? "") == 'category-faq' ? 'active' : '' ?>">
							<i class="fas fa-tag nav-icon"></i>
							<p>Kategori Faq</p>
						</a>
					</li>
					<li class="nav-item">
						<a href="<?= base_url(ADMIN_PATH . '/jobs') ?>" class="nav-link menu-item <?= ($subMenu ?? "") == 'jobs' ? 'active' : '' ?>">
							<i class="fas fa-briefcase nav-icon"></i>
							<p>Pekerjaan</p>
						</a>
					</li>
					<li class="nav-item">
						<a href="<?= base_url(ADMIN_PATH . '/products') ?>" class="nav-link menu-item <?= ($subMenu ?? "") == 'product' ? 'active' : '' ?>">
							<i class="fas fa-box-open nav-icon"></i>
							<p>Produk</p>
						</a>
					</li>
					<li class="nav-item">
						<a href="<?= base_url(ADMIN_PATH . '/products-brosur') ?>" class="nav-link menu-item <?= ($subMenu ?? "") == 'product-brosur' ? 'active' : '' ?>">
							<i class="fas fa-file nav-icon"></i>
							<p>Produk Brosur</p>
						</a>
					</li>
				</ul>
			</li>
		<?php endif ?>
		<li class="nav-item <?= (($menu ?? "") == 'post') ? 'menu-open' : '' ?>">
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
						<a href="<?= base_url(ADMIN_PATH . '/teams') ?>" class="nav-link menu-item <?= ($subMenu ?? "") == 'teams' ? 'active' : '' ?>">
							<i class="fas fa-user-friends nav-icon"></i>
							<p>Tim</p>
						</a>
					</li>
					<li class="nav-item">
						<a href="<?= base_url(ADMIN_PATH . '/clients') ?>" class="nav-link menu-item <?= ($subMenu ?? "") == 'clients' ? 'active' : '' ?>">
							<i class="fas fa-user-tie nav-icon"></i>
							<p>Klien</p>
						</a>
					</li>
					<li class="nav-item">
						<a href="<?= base_url(ADMIN_PATH . '/clients-orders') ?>" class="nav-link menu-item <?= ($subMenu ?? "") == 'clients-orders' ? 'active' : '' ?>">
							<i class="fas fa-shopping-cart nav-icon"></i>
							<p>Pesanan Klien </p>
						</a>
					</li>
					<li class="nav-item">
						<a href="<?= base_url(ADMIN_PATH . '/faq') ?>" class="nav-link menu-item <?= ($subMenu ?? "") == 'faq' ? 'active' : '' ?>">
							<i class="fas fa-question nav-icon"></i>
							<p>Faq </p>
						</a>
					</li>
				<?php endif ?>
				<li class="nav-item">
					<a href="<?= base_url(ADMIN_PATH . '/article') ?>" class="nav-link menu-item <?= ($subMenu ?? "") == 'artikel' ? 'active' : '' ?>">
						<i class="fas fa-newspaper nav-icon"></i>
						<p>Artikel & Berita</p>
					</a>
				</li>
			</ul>
		</li>
		<li class="nav-header">Profile</li>
		<li class="nav-item">
			<a href="<?= base_url(ADMIN_PATH . '/profile') ?>" class="nav-link menu-item <?= ($menu ?? "") == 'profile' ? 'active' : '' ?>">
				<i class="nav-icon fas fa-user-cog"></i>
				<p>
					Pengaturan Profile
				</p>
			</a>
		</li>
	</ul>
</nav>
<!-- /.sidebar-menu -->