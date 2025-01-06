<?= $this->extend('layout'); ?>
<?= $this->section('content'); ?>

<!-- DataTables CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
<!-- SweetAlert2 CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

<div class="container-fluid dashboard-content mt-5">
    <div class="row">
        <a href="<?= base_url('/customer') ?>">
            <button type="button" class="btn btn-info btn-lg float-end mb-2">Add Customer</button>
        </a>
    </div>
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <h5 class="card-header text-secondary fs-4">All Customers</h5>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="myTable">
                            <thead>
                                <tr>
                                    <th class="bg-dark text-light">Profile</th>
                                    <th class="bg-dark text-light">Name</th>
                                    <th class="bg-dark text-light">Email</th>
                                    <th class="bg-dark text-light">Address</th>
                                    <th class="bg-dark text-light">Phone No.</th>
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

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- DataTables JS -->
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function () {

        function loadCustomers() {
            $.ajax({
                url: "<?= site_url('customer/fetch'); ?>",
                type: "GET",
                dataType: "json",
                success: function (data) {
                    var rows = '';
                    $.each(data, function (index, customer) {
                        const profileImageUrl = customer.profile_image ? `<?= base_url('public/uploads/customers/'); ?>${customer.profile_image}` : '<?= base_url('public/uploads/customers/default-avatar.jpg'); ?>';

                        rows += `
                        <tr id="customer-${customer.id}">
                            <td><img src="${profileImageUrl}" alt="Customer Avatar" class="img-fluid rounded-circle" width="40" height="40" /></td>
                            <td>${customer.name}</td>
                            <td>${customer.email}</td>
                            <td>${customer.address}</td>
                            <td>${customer.phone_no}</td>
                            <td>
                                <a href="<?= base_url('/customer/profile') ?>?id=${customer.id}">
                                    <i class='align-middle me-2' data-feather='eye'></i>
                                </a>
                                <a href="<?= base_url('/customer') ?>?id=${customer.id}">
                                    <i class='align-middle me-2' data-feather='edit'></i>
                                </a>
                                <a href="javascript:void(0);" class="delete-btn" data-id="${customer.id}">
                                    <i class='align-middle me-2' data-feather='trash-2'></i>
                                </a>
                            </td>
                        </tr>`;
                    });
                    $('#myTable tbody').html(rows);
                    feather.replace(); // Re-initialize feather icons

                    // Re-initialize DataTables after new data is loaded
                    $('#myTable').DataTable().draw();
                },
                error: function (xhr, status, error) {
                    console.error('Error fetching data: ' + error);
                }
            });
        }

        // Load customers when the page is ready
        loadCustomers();

        // Handle delete button click using SweetAlert2
        $('#myTable').on('click', '.delete-btn', function () {
            const customerId = $(this).data('id');
            
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `<?= site_url('customer/delete'); ?>/${customerId}`,
                        type: "DELETE",
                        success: function (response) {
                            if (response.success) {
                                $(`#customer-${customerId}`).remove();
                                Swal.fire(
                                    'Deleted!',
                                    response.message,
                                    'success'
                                );
                            } else {
                                Swal.fire(
                                    'Error!',
                                    response.message,
                                    'error'
                                );
                            }
                        },
                        error: function (xhr, status, error) {
                            Swal.fire(
                                'Error!',
                                'Something went wrong while deleting.',
                                'error'
                            );
                        }
                    });
                }
            });
        });
    });
</script>

<?= $this->endSection(); ?>
