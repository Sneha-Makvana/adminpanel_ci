<nav id="sidebar" class="sidebar js-sidebar">
    <div class="sidebar-content js-simplebar">
        
        <a class="navbar-brand text-center" href="index.html">Admin</a>
        <ul class="sidebar-nav">
            <li class="sidebar-item">
                <a class="sidebar-link" href="<?= base_url('/admin')?>">
                    <i class="align-middle text-light" data-feather="sliders"></i> <span class="align-middle">Dashboard</span>
                </a>
            </li>

            <!-- Customer Dropdown -->
            <li class="sidebar-item">
                <a class="sidebar-link d-flex align-items-center" href="#salesSubmenu" data-toggle="collapse" aria-expanded="false">
                    <i class="align-middle me-2 text-light" data-feather="user"></i> <span class="align-middle">Customers</span>
                    <i class="ms-auto align-middle" data-feather="chevron-right"></i>
                </a>
                <ul class="collapse list-unstyled" id="salesSubmenu">
                    <li><a class="sidebar-link" href="<?= base_url('customer/view'); ?>">All Customer</a></li>
                    <li><a class="sidebar-link" href="<?= base_url('customer/'); ?>">Add Customer</a></li>
                </ul>
            </li>

            <!-- Events Dropdown -->
            <li class="sidebar-item">
                <a class="sidebar-link d-flex align-items-center" href="#productSubmenu" data-toggle="collapse" aria-expanded="false">
                    <i class="align-middle text-light" data-feather="box"></i> <span class="align-middle">Products</span>
                    <i class="ms-auto align-middle" data-feather="chevron-right"></i>
                </a>
                <ul class="collapse list-unstyled" id="productSubmenu">
                    <li><a class="sidebar-link" href="<?= base_url('product/view'); ?>">All Products</a></li>
                    <li><a class="sidebar-link" href="<?= base_url('product/'); ?>">Add Product</a></li>
                    <li><a class="sidebar-link" href="<?= base_url('category/'); ?>">Category</a></li>
                </ul>
            </li>

            <!-- Booking Dropdown -->
            <li class="sidebar-item">
                <a class="sidebar-link d-flex align-items-center" href="#tableSubmenu" data-toggle="collapse" aria-expanded="false">
                    <i class="align-middle me-2 text-light" data-feather="tablet"></i> <span class="align-middle">Orders</span>
                    <i class="ms-auto align-middle" data-feather="chevron-right"></i>
                </a>
                <ul class="collapse list-unstyled" id="tableSubmenu">
                    <li><a class="sidebar-link" href="<?= base_url('order/view'); ?>">All Orders</a></li>
                    <li><a class="sidebar-link" href="<?= base_url('order/'); ?>">Add Order</a></li>
                </ul>
            </li>
        </ul>
    </div>
</nav>