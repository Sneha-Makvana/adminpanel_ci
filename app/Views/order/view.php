<?= $this->extend('layout'); ?>
<?= $this->section('content'); ?>

<!-- Link to DataTable CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

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
                                    <th class="bg-dark text-light">Order ID</th>
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

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
                                    <td>${order.id}</td>
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
                        $('#myTable tbody').html(rows);

                        feather.replace();

                        table.clear();
                        table.rows.add($('#myTable tbody tr')); // Add new rows
                        table.draw(); // Redraw the DataTable
                    } else {
                        Swal.fire('Error!', response.message, 'error');
                    }
                },
                error: function(xhr, status, error) {
                    Swal.fire('Error!', 'An error occurred while loading orders.', 'error');
                }
            });
        }

        loadOrders();

        $('#myTable').on('click', '.delete-btn', function() {
            const orderId = $(this).data('id');
            const row = $('#orders-row-' + orderId);

            Swal.fire({
                title: 'Are you sure?',
                text: "This action will delete the order permanently!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `<?= site_url('order/deleteBooking'); ?>/${orderId}`,
                        type: "POST",
                        success: function(response) {
                            if (response.success) {
                                Swal.fire(
                                    'Deleted!',
                                    response.message,
                                    'success'
                                );
                                row.remove(); // Remove the row from the table
                            } else {
                                Swal.fire('Error!', response.message, 'error');
                            }
                        },
                        error: function(xhr, status, error) {
                            Swal.fire('Error!', 'An error occurred while deleting the record.', 'error');
                        }
                    });
                }
            });
        });
    });
</script>


<?= $this->endSection(); ?>