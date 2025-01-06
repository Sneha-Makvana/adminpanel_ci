<nav class="navbar navbar-expand navbar-light navbar-bg fixed-top">
    <div class="container-fluid">
        <div class="navbar-collapse collapse">
            <ul class="navbar-nav navbar-align ms-auto">
                <li class="nav-item dropdown">
                    <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
                        <i class="align-middle" data-feather="settings"></i>
                    </a>
                    <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                        <img src="<?= base_url('public/uploads/customers/' . session()->get('user_image')); ?>" 
                             class="avatar img-fluid rounded me-1" alt="User Avatar" />
                        <span class="text-dark"><?= session()->get('user_name') ?: 'Guest'; ?></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item" href="<?= base_url('admin/profile') ?>">
                            <i class="align-middle me-1" data-feather="user"></i> Profile
                        </a>
                        <a class="dropdown-item" id="logout" href="<?= base_url('/logout') ?>">
                            <i class="align-middle me-1" data-feather="log-out"></i> Log out
                        </a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
