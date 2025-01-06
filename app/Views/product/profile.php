<?= $this->extend('layout'); ?>
<?= $this->section('content'); ?>

<div class="container-fluid p-0 mt-5">
    <div class="mb-3">
        <h1 class="h3 d-inline align-middle">Product Profile</h1>
    </div>
    <div class="row">
        <div class="col-md-8 col-xl-9">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Product Name</h6>
                        </div>
                        <div class="col-sm-9 text-secondary" id="product-name"></div>
                    </div>
                    <hr>
                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Description</h6>
                        </div>
                        <div class="col-sm-9 text-secondary" id="product-description"></div>
                    </div>
                    <hr>
                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Quantity</h6>
                        </div>
                        <div class="col-sm-9 text-secondary" id="product-quantity"></div>
                    </div>
                    <hr>
                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Size</h6>
                        </div>
                        <div class="col-sm-9 text-secondary" id="product-size"></div>
                    </div>
                    <hr>
                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Price</h6>
                        </div>
                        <div class="col-sm-9 text-secondary" id="product-price"></div>
                    </div>
                    <hr>
                  
                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Images</h6>
                        </div>
                        <div class="col-sm-9 text-secondary" id="product-images"></div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-12">
                            <a href="<?= base_url('/product/view')?>" class="btn btn-info">Back to List</a>
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
        const productId = params.get('id');

        if (productId) {
            $.ajax({
                url: `<?= site_url('product/details'); ?>/${productId}`,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    if (data.error) {
                        alert('Error: ' + data.error);
                        return;
                    }

                    $('#product-name').text(data.product_name || 'N/A');
                    $('#product-description').text(data.description || 'N/A');
                    $('#product-quantity').text(data.quantity || 'N/A');
                    $('#product-size').text(data.size || 'N/A');
                    $('#product-price').text(data.price ? `$${data.price}` : 'N/A');

                    if (data.product_image) {
                        const images = data.product_image.split(',');
                        let imageHtml = '';
                        images.forEach(image => {
                            const imageUrl = `<?= base_url('public/uploads/events/'); ?>/${image}`;
                            imageHtml += `<img src="${imageUrl}" alt="Product Image" class="img-fluid rounded mb-2 mx-2" style="max-width: 150px; max-height: 150px;">`;
                        });
                        $('#product-images').html(imageHtml);
                    } else {
                        $('#product-images').text('No images available.');
                    }
                },
                error: function(xhr, status, error) {
                    alert('Error fetching product details: ' + error);
                }
            });
        } else {
            alert('No product ID provided.');
        }
    });
</script>

<?= $this->endSection(); ?>