<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="/admin">
            <img src="<?= base_url('assets/img/photos/logo2.webp'); ?>" alt="">
        </a>

        <ul class="sidebar-nav">
            <li class="sidebar-item">
                <a class="sidebar-link" href="/admin">
                    <i class="align-middle text-light" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
                </a>
            </li>

            <!-- Customer Dropdown -->
            <li class="sidebar-item">
                <a class="sidebar-link d-flex align-items-center" href="#salesSubmenu" data-toggle="collapse" aria-expanded="false">
                    <i class="align-middle me-2 text-light" data-feather="user"></i> <span class="align-middle">Customer</span>
                    <i class="ms-auto align-middle" data-feather="chevron-right"></i>
                </a>
                <ul class="collapse list-unstyled" id="salesSubmenu">
                    <li><a class="sidebar-link" href="<?= base_url('customer/view');?>">All Customer</a></li>
                    <li><a class="sidebar-link" href="<?= base_url('customer/');?>">Add Customer</a></li>
                </ul>
            </li>

            <!-- Events Dropdown -->
            <li class="sidebar-item">
                <a class="sidebar-link d-flex align-items-center" href="#productSubmenu" data-toggle="collapse" aria-expanded="false">
                    <i class="align-middle text-light" data-feather="box"></i> <span class="align-middle">Events</span>
                    <i class="ms-auto align-middle" data-feather="chevron-right"></i>
                </a>
                <ul class="collapse list-unstyled" id="productSubmenu">
                    <li><a class="sidebar-link" href="<?= base_url('event/view');?>">All Events</a></li>
                    <li><a class="sidebar-link" href="<?= base_url('event/');?>">Add Events</a></li>
                    <li><a class="sidebar-link" href="<?= base_url('category/');?>">Category</a></li>
                </ul>
            </li>

            <!-- Booking Dropdown -->
            <li class="sidebar-item">
                <a class="sidebar-link d-flex align-items-center" href="#tableSubmenu" data-toggle="collapse" aria-expanded="false">
                    <i class="align-middle me-2 text-light" data-feather="tablet"></i> <span class="align-middle">Booking</span>
                    <i class="ms-auto align-middle" data-feather="chevron-right"></i>
                </a>
                <ul class="collapse list-unstyled" id="tableSubmenu">
                    <li><a class="sidebar-link" href="<?= base_url('booking/view');?>">All Bookings</a></li>
                    <li><a class="sidebar-link" href="<?= base_url('booking/');?>">Add Bookings</a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav>