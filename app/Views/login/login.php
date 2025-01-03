<?= $this->extend('layout'); ?>
<?= $this->section('content'); ?>

<section class="vh-100">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col col-xl-10">
                <div class="card">
                    <div class="row g-0">
                        <div class="col-md-6 col-lg-5 d-none d-md-block">
                            <img src="<?= base_url('public/assets/img/photos/projects4.jpg'); ?>" width="100%" height="500px" alt="login form" class="" style="border-radius: 1rem 0 0 1rem;" />
                        </div>
                        <div class="col-md-6 col-lg-7 d-flex align-items-center">
                            <div class="card-body p-4 p-lg-5 text-black">
                                <form id="loginForm">
                                    <?= csrf_field(); ?>
                                    <div class="d-flex align-items-center mb-3 pb-1">
                                        <img src="<?= base_url('assets/img/photos/logo.webp'); ?>" alt="">
                                    </div>
                                    <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Sign into your account</h5>
                                    <div data-mdb-input-init class="form-outline mb-4">
                                        <label class="form-label">Email</label>
                                        <input class="form-control" type="email" name="email" id="email" placeholder="Enter your email">
                                        <div class="text-danger" id="error-email"></div>
                                    </div>

                                    <div data-mdb-input-init class="form-o  utline mb-4">
                                        <label class="form-label">Password</label>
                                        <input class="form-control" type="password" name="password" id="password" placeholder="Enter your password">
                                        <div class="text-danger" id="error-password"></div>
                                    </div>

                                    <div class="pt-1 mb-4">
                                        <button data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-lg btn-block" type="submit">Login</button>
                                    </div>

                                    <a class="small text-muted" href="#!">Forgot password?</a>
                                    <p class="mb-2 pb-lg-2" style="color: #393f81;">Don't have an account? <a href="" class="text-info">Register</a></p>
                                    <div class="text-center pe-4 icons mb-3 mt-3">
                                        <i class="ri-facebook-fill"></i><i class="ri-twitter-fill"></i><i class="ri-google-fill"></i>
                                    </div>
                                    <div id="message"></div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#loginForm').on('submit', function(e) {
            e.preventDefault();
            $(".text-danger").html("");

            let formData = new FormData(this);

            $.ajax({
                url: '<?= base_url('/login')?>',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                dataType: 'json',
                success: function(response) {
                    if (response.status === true) {
                        $('#message').html('<p class="text-success">' + response.message + '</p>');
                        window.location.href = "<?= base_url('/admin'); ?>";
                    } else if (response.status === 'error') {
                        let errors = response.errors;
                        for (let key in errors) {
                            $('#error-' + key).html(errors[key]);
                        }
                    } else {
                        $('#message').html('<p class="text-danger">' + response.message + '</p>');
                    }
                },
                error: function(xhr, status, error) {
                    $('#message').html('<p class="text-danger">An unexpected error occurred. Please try again.</p>');
                },
            });
        });
    });
</script>

<?= $this->endSection(); ?>