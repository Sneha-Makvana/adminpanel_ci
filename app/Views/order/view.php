<?= $this->extend('layout'); ?>
<?= $this->section('content'); ?>

<!-- Link to DataTable CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">

<div class="container-fluid dashboard-content mt-5">
    <div class="row">
        <a href="<?= base_url('/order') ?>"><button type="button" class="btn btn-info btn-lg float-end mt-2 mb-2">Add Order</button></a>
    </div>

    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <h5 class="card-header text-secondary fs-4">All Orders</h5>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-bordered" id="myTable">
                            <thead>
                                <tr>
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
                                <!-- Rows will be populated here via AJAX -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- DataTable and jQuery JS files -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function() {
        // Initialize DataTable
        var table = $('#myTable').DataTable({
            "paging": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "bDestroy": true // Allows DataTable to be reinitialized after the content is dynamically loaded
        });

        // Function to load orders via AJAX
        function loadOrders() {
            $.ajax({
                url: '<?= base_url('order/fetchOrders'); ?>',
                type: 'GET',
                success: function(response) {
                    if (response.success) {
                        let rows = '';
                        $.each(response.orders, function(index, order) {
                            rows += `
                                <tr id="orders-row-${order.id}">
                                    <td>${order.customer_name}</td>
                                    <td>${order.product_name}</td>
                                    <td>${order.quantity}</td>
                                    <td>${order.price}</td>
                                    <td>${order.order_date}</td>
                                    <td>${order.total}</td>
                                    <td>
                                        <a href="<?= base_url('/order/display') ?>/${order.id}">
                                            <i class='align-middle me-2' data-feather='eye'></i>
                                        </a>
                                        <a href="javascript:void(0);" class="delete-btn" data-id="${order.id}">
                                            <i class='align-middle me-2' data-feather='trash-2'></i>
                                        </a>
                                    </td>
                                </tr>
                            `;
                        });
                        $('#myTable tbody').html(rows); // Append rows to the table

                        feather.replace(); // Re-initialize feather icons after loading content

                        // Reinitialize DataTable after loading new rows
                        table.clear(); // Clear previous data
                        table.rows.add($('#myTable tbody tr')); // Add new rows
                        table.draw(); // Redraw the DataTable
                    } else {
                        alert('Error loading orders: ' + response.message);
                    }
                },
                error: function(xhr, status, error) {
                    alert('Error: ' + error);
                }
            });
        }

        // Initial load of orders when the page is ready
        loadOrders();

        // Handle delete button click
        $('#myTable').on('click', '.delete-btn', function() {
            const orderId = $(this).data('id');
            const row = $('#orders-row-' + orderId);

            if (confirm('Are you sure you want to delete this booking?')) {
                $.ajax({
                    url: `<?= site_url('order/deleteBooking'); ?>/${orderId}`,
                    type: "POST",
                    success: function(response) {
                        if (response.success) {
                            row.remove(); // Remove the row from the table
                            alert(response.message); // Show success message
                        } else {
                            alert(response.message); // Show error message
                        }
                    },
                    error: function(xhr, status, error) {
                        alert('Error deleting record: ' + error);
                    }
                });
            }
        });
    });
</script>

<?= $this->endSection(); ?>
