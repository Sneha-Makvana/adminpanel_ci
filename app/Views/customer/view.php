<?= $this->extend('layout'); ?>
<?= $this->section('content'); ?>

<div class="container-fluid dashboard-content">
    <div class="row">
        <a href="/customer">
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        function loadCustomers() {
            $.ajax({
                url: "<?= site_url('customer/fetch'); ?>",
                type: "GET",
                dataType: "json",
                success: function(data) {
                    var rows = '';
                    $.each(data, function(index, customer) {

                        const profileImageUrl = customer.profile_image ? `<?= base_url('uploads/customers/'); ?>${customer.profile_image}` : '<?= base_url('public/uploads/customers/default-avatar.jpg'); ?>';

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
                    feather.replace();
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching data: ' + error);
                }
            });
        }

        loadCustomers();

        $('#myTable').on('click', '.delete-btn', function() {
            const customerId = $(this).data('id');
            if (confirm('Are you sure you want to delete this customer?')) {
                $.ajax({
                    url: `<?= site_url('customer/delete'); ?>/${customerId}`,
                    type: "POST",
                    success: function(response) {
                        if (response.success) {
                            $(`#customer-${customerId}`).remove();
                            alert(response.message);
                        } else {
                            alert(response.message);
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