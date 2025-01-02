<?= $this->extend('layout'); ?>
<?= $this->section('content'); ?>

<div class="container-fluid p-0 mt-5">
    <h1 class="h3 mb-3"><strong>Analytics</strong> Dashboard</h1>
    <div class="row">
        <div class="col-xl-12 col-xxl-5 d-flex">
            <div class="w-100">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="card bg-info-subtle">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col mt-0">
                                        <a href="/event/view" style="text-decoration: none;">
                                            <h5 class="text-dark fs-4">Products</h5>
                                        </a>
                                    </div>
                                </div>
                                <h1 class="mt-1 mb-3"></h1>
                                <div class="mb-0">
                                    <span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i> -3.65% </span>
                                    <span class="text-muted">Since last week</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="card bg-success-subtle">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col mt-0">
                                        <a href="/customer/view" style="text-decoration: none;">
                                            <h5 class="text-dark fs-4">Customers</h5>
                                        </a>
                                    </div>
                                </div>
                                <h1 class="mt-1 mb-3"></h1>
                                <div class="mb-0">
                                    <span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i> -2.25% </span>
                                    <span class="text-muted">Since last week</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="card bg-primary-subtle">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col mt-0">
                                        <a href="/booking/view" style="text-decoration: none;">
                                            <h5 class="text-dark fs-4">Orders</h5>
                                        </a>
                                    </div>
                                </div>
                                <h1 class="mt-1 mb-3"></h1>
                                <div class="mb-0">
                                    <span class="text-success"> <i class="mdi mdi-arrow-bottom-right"></i> 5.25% </span>
                                    <span class="text-muted">Since last week</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-lg-12 col-xxl-9 d-flex">
            <div class="card flex-fill">
                <div class="card-header">
                    <h5 class="text-dark fs-4 mb-0">Latest Orders</h5>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th class="bg-dark text-light">No.</th>
                                <th class="bg-dark text-light">Customer Name</th>
                                <th class="bg-dark text-light">Product Name</th>
                                <th class="bg-dark text-light">Quantity</th>
                                <th class="bg-dark text-light">Price</th>
                                <th class="bg-dark text-light">Order Date</th>
                                <th class="bg-dark text-light">Total</th>
                                <th class="bg-dark text-light">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<?= $this->endSection(); ?>