<?= $this->extend('layout'); ?>
<?= $this->section('content'); ?>

<div class="container-fluid p-0 mt-5">
    <div class="mb-3">
        <h1 class="h3 d-inline align-middle">Profile</h1>
    </div>
    <div class="row">
        <div class="col-md-4 col-xl-3">
            <div class="card mb-3">
                <div class="card-header">
                    <h5 class="card-title mb-0">Profile Details</h5>
                </div>
                <div class="card-body text-center">
                    <img id="image" src="<?= base_url('public/img/default-avatar.jpg'); ?>" alt="User Avatar" class="img-fluid rounded-circle mb-2" width="130" height="130" />
                </div>
            </div>
        </div>
        <div class="col-md-8 col-xl-9">
            <div class="card">
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
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $.ajax({
            url: "<?= base_url('/admin/get-profile'); ?>",
            type: "GET",
            dataType: "json",
            success: function(response) {
                if (response.status === true) {
                    const user = response.data;

                    $('#customer-name').text(user.name);
                    $('#customer-email').text(user.email);
                    $('#customer-gender').text(user.gender);
                    $('#customer-phone_no').text(user.phone_no);
                    $('#customer-address').text(user.address);
                    $('#customer-city').text(user.city);

                    // Load profile image
                    const imagePath = user.image ? `<?= base_url('public/uploads/customers'); ?>/${user.image}` : '<?= base_url('public/img/default-avatar.jpg'); ?>';
                    $('#image').attr('src', imagePath);
                } else {
                    alert(response.message || 'Failed to load profile data.');
                }
            },
            error: function() {
                alert('An error occurred while loading the profile.');
            }
        });
    });
</script>

<?= $this->endSection(); ?>