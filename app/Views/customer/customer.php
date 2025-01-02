<?= $this->extend('layout'); ?>
<?= $this->section('content'); ?>

<div class="container-fluid dashboard-content mt-5">
    <div class="row">
        <div class="col-12 col-lg-8 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0 text-secondary fs-4">Add Customer</h5>
                </div>
                <form action="" id="customerForm" enctype="multipart/form-data">
                    <div class="card-body">
                        <div class="form-row align-items-center">
                            <input type="hidden" name="id" id="id">

                            <!-- Name Field -->
                            <div class="form-group col-md-3">
                                <label for="name" class="col-form-label">Name</label>
                            </div>
                            <div class="form-group col-md-9 mb-4">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i data-feather="user"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name">
                                </div>
                                <div class="error" id="nameError"></div>
                            </div>

                            <!-- Email Field -->
                            <div class="form-group col-md-3">
                                <label for="email" class="col-form-label">Email</label>
                            </div>
                            <div class="form-group col-md-9 mb-4">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i data-feather="mail"></i>
                                        </span>
                                    </div>
                                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email">
                                </div>
                                <div class="error" id="emailError"></div>
                            </div>

                            <!-- Gender Field -->
                            <div class="form-group col-md-3">
                                <label class="col-form-label">Gender</label>
                            </div>
                            <div class="form-group col-md-9 mb-4">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="gender" value="male">
                                    <label class="form-check-label">Male</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" id="gender" value="female">
                                    <label class="form-check-label">Female</label>
                                </div>
                                <div class="error" id="genderError"></div>
                            </div>

                            <!-- Address Field -->
                            <div class="form-group col-md-3">
                                <label for="address" class="col-form-label">Address</label>
                            </div>
                            <div class="form-group col-md-9 mb-4">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i data-feather="disc"></i>
                                        </span>
                                    </div>
                                    <textarea class="form-control" name="address" id="address" rows="2" placeholder="Enter your address"></textarea>
                                </div>
                                <div class="error" id="addressError"></div>
                            </div>

                            <!-- City Field -->
                            <div class="form-group col-md-3">
                                <label for="city" class="col-form-label">City</label>
                            </div>
                            <div class="form-group col-md-9">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i data-feather="map-pin"></i>
                                        </span>
                                    </div>
                                    <select class="form-select" name="city" id="city" required>
                                        <option selected disabled>Select City</option>
                                        <option value="India">India</option>
                                        <option value="London">London</option>
                                        <option value="Japan">Japan</option>
                                        <option value="USA">USA</option>
                                        <option value="Dubai">Dubai</option>
                                        <option value="Canada">Canada</option>
                                        <option value="UK">UK</option>
                                        <option value="Africa">Africa</option>
                                    </select>
                                </div>
                                <div class="error" id="cityError"></div>
                            </div>

                            <!-- Phone Field -->
                            <div class="form-group col-md-3">
                                <label for="phone_no" class="col-form-label">Phone No.</label>
                            </div>
                            <div class="form-group col-md-9 mb-4">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i data-feather="phone-call"></i>
                                        </span>
                                    </div>
                                    <input type="tel" class="form-control" id="phone_no" name="phone_no" placeholder="Enter your Phone no" pattern="[0-9]{10}">
                                </div>
                                <div class="error" id="phone_noError"></div>
                            </div>

                            <div class="form-group col-md-3">
                                <label for="image" class="col-form-label">Profile Image</label>
                            </div>
                            <div class="form-group col-md-9">
                                <input type="file" class="form-control" name="profile_image" id="profile_image" accept="image/*">
                                <div class="error" id="profile_imageError"></div>
                                <input type="hidden" name="existing_profile_image" id="existing_profile_image" value="">
                                <div id="currentProfileImage"></div>
                            </div>

                            <div class="form-group col-md-12 text-center">
                                <button type="submit" id="submitBtn" class="btn btn-info btn-lg mt-3">Submit</button>
                            </div>
                        </div>
                        <div id="responseMessage" class="mt-3"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        const id = getQueryParameter('id');
        if (id) {
            fetchUserData(id);
        }

        function fetchUserData(id) {
            $.ajax({
                url: `<?= base_url('/customer/fetchCustomer/') ?>${id}`,
                method: 'GET',
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        populateForm(response.data);
                    } else {
                        alert('Failed to fetch user data: ' + response.message);
                    }
                },
                error: function() {
                    alert('An error occurred while fetching user data.');
                }
            });
        }

        function populateForm(data) {
            $("#id").val(data.id);
            $("#name").val(data.name);
            $("#email").val(data.email);
            $(`input[name="gender"][value="${data.gender}"]`).prop("checked", true);
            $("#address").val(data.address);
            $("#city").val(data.city);
            $("#phone_no").val(data.phone_no);

            $("#existing_profile_image").val(data.profile_image);

            if (data.profile_image) {
                $("#currentProfileImage").html(
                    `<p>Current Image: <img src="<?= base_url() ?>/uploads/customers/${data.profile_image}" alt="Profile Image" class="img-fluid" style="max-width: 100px;"></p>`
                );
            }
        }

        function getQueryParameter(param) {
            const urlParams = new URLSearchParams(window.location.search);
            return urlParams.get(param);
        }

        $("#customerForm").on('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            const formAction = id ? 'update' : 'insert';

            $(".error").html("");

            $.ajax({
                url: `<?= base_url('customer/') ?>${formAction}`,
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.success) {
                        $("#responseMessage").html('<p class="text-success">' + response.message + '<a href="/customer/view">View</a>' + '</p>');
                        $("#customerForm")[0].reset();
                    } else {
                        $.each(response.errors, function(key, value) {
                            $('#' + key + 'Error').html('<small class="text-danger">' + value + '</small>');
                        });
                    }
                },
                error: function() {
                    $("#responseMessage").html('<p class="text-danger">An error occurred while submitting the form. Please try again.</p>');
                }
            });
        });
    });
</script>

<?= $this->endSection(); ?>