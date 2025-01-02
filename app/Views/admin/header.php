<nav class="navbar navbar-expand navbar-light navbar-bg fixed-top">
    <div class="container-fluid">
        <div class="navbar-collapse collapse">
            <ul class="navbar-nav navbar-align ms-auto">
                <li class="nav-item dropdown">
                    <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
                        <i class="align-middle" data-feather="settings"></i>
                    </a>
                    <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                        <img src="<?= base_url('public/assets/img/photos/a1.jpg'); ?>" class="avatar img-fluid rounded me-1" alt="" />
                        <span class="text-dark">Username</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item" href="<?= base_url('/logout') ?>">
                            <i class="align-middle me-1" data-feather="log-out"></i> Log out
                        </a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>
