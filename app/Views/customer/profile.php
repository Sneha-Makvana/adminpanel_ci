<?= $this->extend('layout'); ?>
<?= $this->section('content'); ?>

<div class="container-fluid p-0 mt-5">

    <div class="mb-3">
        <h1 class="h3 d-inline align-middle">Customer Profile</h1>
    </div>
    <div class="row">
        <div class="col-md-4 col-xl-3">
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="card-title mb-0">Profile Details</h5>
                </div>
                <div class="card-body text-center">
                    <img id="profile-image" src="<?= base_url('public/img/default-avatar.jpg'); ?>" alt="Customer Avatar" class="img-fluid rounded-circle mb-2" width="128" height="128" />
                    <div>
                        <a class="btn btn-primary btn-sm" href="#">Follow</a>
                        <a class="btn btn-primary btn-sm" href="#"><span data-feather="message-square"></span> Message</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-8 col-xl-9">
            <div class="card">
                <div class="card-body h-100">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Name</h6>
                            </div>
                            <div class="col-sm-9 text-secondary" id="customer-name"></div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Email</h6>
                            </div>
                            <div class="col-sm-9 text-secondary" id="customer-email"></div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Gender</h6>
                            </div>
                            <div class="col-sm-9 text-secondary" id="customer-gender"></div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Phone</h6>
                            </div>
                            <div class="col-sm-9 text-secondary" id="customer-phone_no"></div>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Address</h6>
                            </div>
                            <div class="col-sm-9 text-secondary" id="customer-address"></div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">City</h6>
                            </div>
                            <div class="col-sm-9 text-secondary" id="customer-city"></div>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-sm-12">
                                <a href="<?= base_url('/customer/view') ?>" class="btn btn-info">Back to List</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        const params = new URLSearchParams(window.location.search);
        const customerId = params.get('id');

        if (customerId) {
            $.ajax({
                url: `<?= site_url('customer/details'); ?>/${customerId}`,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#customer-name').text(data.name || 'N/A');
                    $('#customer-email').text(data.email || 'N/A');
                    $('#customer-gender').text(data.gender || 'N/A');
                    $('#customer-phone_no').text(data.phone_no || 'N/A');
                    $('#customer-address').text(data.address || 'N/A');
                    $('#customer-city').text(data.city || 'N/A');

                    if (data.image_url) {
                        $('#profile-image').attr('src', data.image_url);
                    }
                },
                error: function(xhr, status, error) {
                    alert('Error fetching customer details: ' + error);
                }
            });
        } else {
            alert('No customer ID provided.');
        }
    });
</script>

<?= $this->endSection(); ?>