<nav class="navbar navbar-expand navbar-light navbar-bg bg-dark-subtle">
    <a class="sidebar-brand" href="/admin">
        <img src="<?= base_url('assets/img/photos/logo.webp');?>" alt="">
    </a>
    <div class="navbar-collapse collapse">
        <ul class="navbar-nav navbar-align">
            <li class="nav-item dropdown">
                <a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-bs-toggle="dropdown">
                    <i class="align-middle" data-feather="settings"></i>
                </a>

                <a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-bs-toggle="dropdown">
                    <img src="<?= base_url('assets/img/photos/a1.jpg');?>" class="avatar img-fluid rounded me-1" alt=""/> <span class="text-dark"></span>
                </a>
                <div class="dropdown-menu dropdown-menu-end">
                    <a class="dropdown-item" href="<?= base_url('/logout') ?>"><i class="align-middle me-1" data-feather="log-out"></i>Log out</a>
                </div>
            </li>
        </ul>
    </div>
</nav>