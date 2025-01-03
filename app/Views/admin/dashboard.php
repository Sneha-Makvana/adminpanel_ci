<?= $this->extend('layout'); ?>
<?= $this->section('content'); ?>

<div class="container-fluid p-0 mt-5">
    <h1 class="h3 mb-3"><strong>Analytics</strong> Dashboard</h1>
    
    <div class="row">
        <div class="col-xl-12 col-xxl-5 d-flex">
            <div class="w-100">
                <div class="row">
                    <!-- Total Products Card -->
                    <div class="col-sm-4">
                        <div class="card bg-info-subtle">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col mt-0">
                                        <a href="/product/view" style="text-decoration: none;">
                                            <h5 class="text-dark fs-4">Products</h5>
                                        </a>
                                    </div>
                                </div>
                                <h1 class="mt-1 mb-3"><?= $totalProducts ?></h1>
                                <div class="mb-0">
                                    <span class="text-muted">Total products in inventory</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Total Customers Card -->
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
                                <h1 class="mt-1 mb-3"><?= $totalCustomers ?></h1>
                                <div class="mb-0">
                                    <span class="text-muted">Total registered customers</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Total Orders Card -->
                    <div class="col-sm-4">
                        <div class="card bg-primary-subtle">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col mt-0">
                                        <a href="/order/view" style="text-decoration: none;">
                                            <h5 class="text-dark fs-4">Orders</h5>
                                        </a>
                                    </div>
                                </div>
                                <h1 class="mt-1 mb-3"><?= $totalOrders ?></h1>
                                <div class="mb-0">
                                    <span class="text-muted">Total orders placed</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Latest Orders Table -->
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
                         
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($latestOrders as $order): ?>
                                <tr>
                                    <td><?= $order['id'] ?></td>
                                    <td><?= $order['customer_name'] ?></td>
                                    <td><?= $order['product_name'] ?></td>
                                    <td><?= $order['quantity'] ?></td>
                                    <td><?= number_format($order['price'], 2) ?></td>
                                    <td><?= $order['order_date'] ?></td>
                                    <td><?= number_format($order['total'], 2) ?></td>
                                   
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- AJAX for delete action -->
<script>
    $(document).ready(function() {
        // Handle delete booking action
        $('#myTable').on('click', '.delete-btn', function() {
            const bookingId = $(this).data('id');
            if (confirm('Are you sure you want to delete this booking?')) {
                $.ajax({
                    url: `<?= site_url('admin/deleteBooking'); ?>/${bookingId}`,
                    type: "DELETE",
                    success: function(response) {
                        if (response.success) {
                            alert(response.message);
                            location.reload(); // Reload the page to reflect the deletion
                        } else {
                            alert(response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        alert('Error deleting booking: ' + error);
                    }
                });
            }
        });
    });
</script>

<?= $this->endSection(); ?>
