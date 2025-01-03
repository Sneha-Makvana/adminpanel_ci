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
                                    <input type="text" class="form-control" name="product_name" id="product_name" placeholder="Enter your product name">
                                </div>
                                <div class="error" id="product_nameError"></div>
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
                                <div class="error" id="quantityError"></div>
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
                                        <?php foreach ($category as $category) : ?>
                                            <option value="<?= $category['id'] ?>"><?= $category['category_name'] ?></option>
                                        <?php endforeach; ?>
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
                                <label for="product_image" class="col-form-label">Product Image</label>
                            </div>
                            <div class="form-group col-md-9 mb-4">
                                <input type="file" class="form-control" id="product_image" name="product_image[]" multiple accept="image/*">
                                <div class="error" id="product_imageError"></div>
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
                url: `<?= base_url('/product/fetchProduct/') ?>${id}`,
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
                    alert('An error occurred while fetching product data.');
                }
            });
        }

        function populateForm(data) {
            $("#id").val(data.id);
            $("#product_name").val(data.product_name);
            $("#description").val(data.description);
            $("#quantity").val(data.quantity);
            $("#price").val(data.price);
            $("#size").val(data.size);
            $("#category").val(data.category_id);

            // Handle images: Split the product_image field into individual image paths and display them.
            if (data.product_image) {
                const images = data.product_image.split(','); // Split images by comma
                let imageHTML = '<p>Current Images:</p>';
                images.forEach(function(image) {
                    imageHTML += `
                <div class="product-image" data-image="${image}">
                    <img src="<?= base_url() ?>public/uploads/events/${image}" alt="Event Image" class="img-fluid" style="max-width: 100px; height: auto; margin-right: 10px; margin-bottom: 10px;" />
                </div>
            `;
                });
                $("#currentProductImage").html(imageHTML); // Render the images in the HTML.
            }
        }




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
                url: `<?= base_url('product/') ?>${formAction}`,
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    if (response.success) {
                        $("#responseMessage").html('<p class="text-success">' + response.message + '<a href="<?= base_url('/product/view') ?>">View</a>' + '</p>');
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