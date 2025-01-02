<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
    <link href="<?= base_url('public/assets/css/app.css'); ?>" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <section class="vh-100">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-xl-10">
                    <div class="card">
                        <div class="row g-0">
                            <div class="col-md-6 col-lg-5 d-none d-md-block">
                                <img src="<?= base_url('public/assets/img/photos/projects4.jpg'); ?>" width="100%" height="500px" alt="login form" style="border-radius: 1rem 0 0 1rem;" />
                            </div>
                            <div class="col-md-6 col-lg-7 d-flex align-items-center">
                                <div class="card-body p-4 p-lg-5 text-black">
                                    <form id="loginForm">
                                        <?= csrf_field(); ?>
                                        
                                        <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Sign into your account</h5>
                                        <div class="form-outline mb-4">
                                            <label class="form-label">Email</label>
                                            <input class="form-control" type="email" name="email" id="email" placeholder="Enter your email">
                                            <div class="text-danger" id="error-email"></div>
                                        </div>

                                        <div class="form-outline mb-4">
                                            <label class="form-label">Password</label>
                                            <input class="form-control" type="password" name="password" id="password" placeholder="Enter your password">
                                            <div class="text-danger" id="error-password"></div>
                                        </div>

                                        <div class="pt-1 mb-4">
                                            <button class="btn btn-primary btn-lg btn-block" type="submit">Login</button>
                                        </div>

                                        <a class="small text-muted" href="#!">Forgot password?</a>
                                        <p class="mb-2 pb-lg-2" style="color: #393f81;">Don't have an account? <a href="" class="text-info">Register</a></p>
                                    </form>
                                    <div id="message"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
   $(document).ready(function() {
    $('#loginForm').submit(function(e) {
        e.preventDefault();

        var email = $('#email').val();
        var password = $('#password').val();

        $.ajax({
            url: '<?= base_url('login/authenticate'); ?>',
            type: 'POST',
            data: {
                email: email,
                password: password,
                <?= csrf_token() ?>: $('input[name="<?= csrf_token() ?>"]').val()
            },
            success: function(response) {
                var res = JSON.parse(response);

                // Check if login was successful
                if (res.status == 'success') {
                    $('#message').html('<div class="alert alert-success">' + res.message + '</div>');
                    window.location.href = '/dashboard'; // Redirect to the dashboard or another page
                } else {
                    $('#message').html('<div class="alert alert-danger">' + res.message + '</div>');
                }
            },
            error: function(xhr, status, error) {
                // Handle any AJAX errors (e.g., network issues)
                $('#message').html('<div class="alert alert-danger">An error occurred. Please try again.</div>');
            }
        });
    });
});

    </script>
</body>
</html>
