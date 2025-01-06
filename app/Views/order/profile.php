<?= $this->extend('layout'); ?>
<?= $this->section('content'); ?>

<div class="container-fluid p-0 mt-5">
    <div class="mb-3">
        <h1 class="h3 d-inline align-middle">Order Profile</h1>
    </div>
    <div class="row">
        <div class="col-md-8 col-xl-9">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Customer Name</h6>
                        </div>
                        <div class="col-sm-9 text-secondary" id="customer-name"></div>
                    </div>
                    <hr>
                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Email</h6>
                        </div>
                        <div class="col-sm-9 text-secondary" id="customer-email"></div>
                    </div>
                    <hr>
                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Phone</h6>
                        </div>
                        <div class="col-sm-9 text-secondary" id="customer-phone"></div>
                    </div>
                    <hr>
                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Product Name</h6>
                        </div>
                        <div class="col-sm-9 text-secondary" id="product-name"></div>
                    </div>
                    <hr>
                     <div class="row mb-3">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Quantity</h6>
                        </div>
                        <div class="col-sm-9 text-secondary" id="order-quantity"></div>
                    </div>
                    <hr>
                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Order Date</h6>
                        </div>
                        <div class="col-sm-9 text-secondary" id="order-order_date"></div>
                    </div>
                    <hr>
                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Total</h6>
                        </div>
                        <div class="col-sm-9 text-secondary" id="order-total"></div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-12">
                            <a href="<?= base_url('/order/view')?>" class="btn btn-info">Back to List</a>
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
        const orderId = <?= $bookingId; ?>;

        $.ajax({
            url: `<?= base_url('/order/fetchOrderDetails/')?>${orderId}`,
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    const data = response.data;
                    $('#customer-name').text(data.customer_name);
                    $('#customer-email').text(data.email);
                    $('#customer-phone').text(data.phone_no);
                    $('#product-name').text(data.product_name);
                    $('#order-order_date').text(data.order_date);
                    $('#order-quantity').text(data.quantity);
                    $('#order-total').text('$' + data.total);
                } else {
                    alert(response.message);
                }
            },
            error: function() {
                alert('An error occurred while fetching the order details.');
            }
        });
    });
</script>

<?= $this->endSection(); ?>