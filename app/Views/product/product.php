<?= $this->extend('layout'); ?>
<?= $this->section('content'); ?>

<div class="container-fluid dashboard-content mt-5">
    <div class="row">
        <div class="col-12 col-lg-8 mx-auto">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0 text-secondary fs-4">Add Product</h5>
                </div>
                <form action="" id="EventForm" enctype="multipart/form-data">
                    <div class="card-body">
                        <!-- Event Name -->
                        <div class="form-row">
                            <input type="hidden" name="id" id="id">
                            <div class="form-group col-md-3">
                                <label for="event_name" class="col-form-label">Product Name</label>
                            </div>
                            <div class="form-group col-md-9 mb-4">
                                <div class="input-group">

                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i data-feather="user"></i>
                                        </span>
                                    </div>
                                    <input type="text" class="form-control" name="name" id="name" placeholder="Enter your product name">
                                </div>
                                <div class="error" id="nameError"></div>
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="description" class="col-form-label">Product Description</label>
                            </div>
                            <div class="form-group col-md-9 mb-4">
                                <div class="input-group">

                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i data-feather="map"></i>
                                        </span>
                                    </div>
                                    <textarea class="form-control" name="description" id="description" rows="3" placeholder="Enter description"></textarea>
                                </div>
                                <div class="error" id="descriptionError"></div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="booking_ticket" class="col-form-label">Quantity</label>
                            </div>
                            <div class="form-group col-md-9 mb-4">
                                <div class="input-group">

                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i data-feather="tablet"></i>
                                        </span>
                                    </div>
                                    <input type="number" class="form-control" name="quantity" id="quantity" placeholder="Enter quantity">
                                </div>
                                <div class="error" id="booking_ticketError"></div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="booking_ticket" class="col-form-label">Price</label>
                            </div>
                            <div class="form-group col-md-9 mb-4">
                                <div class="input-group">

                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i data-feather="tablet"></i>
                                        </span>
                                    </div>
                                    <input type="number" class="form-control" name="price" id="price" placeholder="Enter Booking ticket price">
                                </div>
                                <div class="error" id="priceError"></div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="category" class="col-form-label">Category</label>
                            </div>
                            <div class="form-group col-md-9 mb-4">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i data-feather="cast"></i>
                                        </span>
                                    </div>
                                    <select class="form-select" name="category" id="category">
                                        <option selected disabled>Select Category</option>

                                    </select>
                                </div>
                                <div class="error" id="categoryError"></div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="booking_ticket" class="col-form-label">Size</label>
                            </div>
                            <div class="form-group col-md-9 mb-4">
                                <div class="input-group">

                                    <div class="input-group-prepend">
                                        <span class="input-group-text">
                                            <i data-feather="tablet"></i>
                                        </span>
                                    </div>
                                    <input type="number" class="form-control" name="size" id="size" placeholder="Enter Booking ticket price">
                                </div>
                                <div class="error" id="sizeError"></div>
                            </div>
                        </div>
                        <!-- Upload Multiple Images -->
                        <div class="form-row">
                            <div class="form-group col-md-3">
                                <label for="event_images" class="col-form-label">Product Image</label>
                            </div>
                            <div class="form-group col-md-9 mb-4">
                                <input type="file" class="form-control" id="product_image" name="product_image" multiple accept="image/*">
                                <div class="error" id="event_imagesError"></div>
                                <div id="currentProductImage"></div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="form-row">
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
            fetchEventData(id);
        }

        function fetchEventData(id) {
            $.ajax({
                url: `<?= base_url('/event/fetchEvent/') ?>${id}`,
                method: 'GET',
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        populateForm(response.data);
                    } else {
                        alert('Failed to fetch event data: ' + response.message);
                    }
                },
                error: function() {
                    alert('An error occurred while fetching event data.');
                }
            });
        }

        function populateForm(data) {
            $("#id").val(data.id);
            $("#event_name").val(data.event_name);
            $("#description").val(data.description);
            $("#location").val(data.location);
            $("#start_date").val(data.start_date);
            $("#end_date").val(data.end_date);
            $("#booking_ticket").val(data.booking_ticket);
            $("#category").val(data.category_id);
            $("#no_of_tickets").val(data.no_of_tickets);

            if (data.event_images) {
                const images = data.event_images.split(',');
                let imageHTML = '<p>Current Images:</p>';
                images.forEach(function(image) {
                    imageHTML += `
                <div class="event-image" data-image="${image}">
                    <img src="<?= base_url() ?>/uploads/events/${image}" alt="Event Image" class="img-fluid" style="max-width: 100px; height: auto; margin-right: 10px; margin-bottom: 10px;" />
                    <button type="button" class="btn btn-danger btn-sm delete-image" data-image="${image}">Delete</button>
                </div>
            `;
                });
                $("#currentEventImage").html(imageHTML);
            }
        }

        $(document).on('click', '.delete-image', function() {
            const imageName = $(this).data('image');
            const eventId = $("#id").val();

            $.ajax({
                url: `<?= base_url('/event/deleteImage/') ?>${eventId}`,
                method: 'POST',
                data: {
                    image_name: imageName
                },
                success: function(response) {
                    if (response.success) {
                        $(`.event-image[data-image="${imageName}"]`).remove();
                        alert(response.message);
                    } else {
                        alert('Error: ' + response.message);
                    }
                },
                error: function() {
                    alert('An error occurred while deleting the image.');
                }
            });
        });


        function getQueryParameter(param) {
            const urlParams = new URLSearchParams(window.location.search);
            return urlParams.get(param);
        }

        $("#EventForm").on('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            const formAction = id ? 'update' : 'insert';

            $(".error").html("");

            $.ajax({
                url: `<?= base_url('event/') ?>${formAction}`,
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.success) {
                        $("#responseMessage").html('<p class="text-success">' + response.message + '<a href="/event/view">View</a>' + '</p>');
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