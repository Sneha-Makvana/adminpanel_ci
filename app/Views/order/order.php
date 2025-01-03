<?= $this->extend('layout'); ?>
<?= $this->section('content'); ?>

<div class="container-fluid dashboard-content">
    <div class="row">
        <!-- Customer and Product Selection -->
        <div class="col-12 col-lg-6 mx-5 mt-5">
            <div class="card">
                <div class="card-body">
                    <label for="customer">Customers</label>
                    <div class="input-group">
                        <select id="customer" name="customer_id" class="form-control" required>
                            <option value="">Select Customer</option>
                            <?php foreach ($customer as $c) : ?>
                                <option value="<?= $c['id'] ?>"><?= $c['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="card-body">
                    <label for="product">Products</label>
                    <div class="input-group">
                        <select id="products" name="product_id" class="form-control" required>
                            <option value="">Select Product</option>
                            <?php foreach ($product as $p) : ?>
                                <option value="<?= $p['id'] ?>" data-price="<?= $p['price'] ?>"><?= $p['product_name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <div class="card-body">
                    <button type="button" class="btn btn-info btn-lg" id="addMoreBtn">Add More</button>
                    <div id="message" style="color: red;"></div>
                </div>
            </div>
        </div>

        <!-- Table to show selected orders -->
        <div class="col-12 col-lg-10 mx-5 mt-5">
            <div class="card" id="bookingCard" style="display: none;">
                <h5 class="card-header fs-4 text-center">Product Orders</h5>
                <div class="card-body">
                    <table class="table" id="productTable">
                        <thead>
                            <tr>
                                <th class="bg-dark text-light">Product Name</th>
                                <th class="bg-dark text-light">Price</th>
                                <th class="bg-dark text-light">Quantity</th>
                                <th class="bg-dark text-light">Total</th>
                                <th class="bg-dark text-light">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Rows will be added dynamically here -->
                        </tbody>
                    </table>
                    <div class="text-right">
                        <strong>Total Price:</strong> <span id="totalPrice">0</span>
                    </div>
                    <div class="card-body">
                        <button type="button" class="btn btn-info btn-lg float-end" id="submitBookingBtn">Submit</button>
                    </div>
                    <div id="messageContainer" class="text d-none" role="text"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    let bookingData = [];
    let customerSelected = false;

    $('#addMoreBtn').click(function() {
        const customerId = $('#customer').val();
        const productId = $('#products').val();
        const productName = $('#products option:selected').text(); // Get product name
        const productPrice = $('#products option:selected').data('price'); // Get product price

        if (!customerId || !productId) {
            $('#message').text('Please select both customer and product.');
            return;
        }

        $('#message').text(''); // Clear any previous message

        if (!customerSelected) {
            $('#customer').prop('disabled', true); // Disable customer select once selected
            customerSelected = true;
        }

        $('#bookingCard').show(); // Show the order table

        const newRow = `
            <tr>
                <td>${productName}</td>
                <td><input type="number" class="form-control price" value="${productPrice}" readonly></td>
                <td><input type="number" class="form-control quantity" value="1" min="1"></td>
                <td><input type="number" class="form-control total" value="${productPrice}" readonly></td>
                <td><button type="button" class="btn btn-danger removeRowBtn">Remove</button></td>
            </tr>
        `;
        $('#productTable tbody').append(newRow);

        // Add to booking data
        bookingData.push({
            customer_id: customerId,
            product_id: productId,
            quantity: 1,
            total: productPrice
        });

        calculateTotal();
    });

    $(document).on('input', '.quantity', function() {
        const row = $(this).closest('tr');
        const quantity = $(this).val();
        const price = row.find('.price').val();

        const total = quantity * price;
        row.find('.total').val(total);

        const rowIndex = row.index();
        bookingData[rowIndex].quantity = quantity;
        bookingData[rowIndex].total = total;

        calculateTotal();
    });

    function calculateTotal() {
        let totalPrice = 0;
        $('.total').each(function() {
            totalPrice += parseFloat($(this).val());
        });
        $('#totalPrice').text(totalPrice.toFixed(2));
    }

    $(document).on('click', '.removeRowBtn', function() {
        const row = $(this).closest('tr');
        const rowIndex = row.index();

        bookingData.splice(rowIndex, 1); // Remove from booking data
        row.remove();

        calculateTotal();
    });

    $('#submitBookingBtn').click(function() {
        let isValid = true;
        let errorMessage = '';

        $('.quantity').each(function() {
            const quantity = $(this).val();
            if (quantity < 1) {
                isValid = false;
                errorMessage = 'Quantity cannot be less than 1 for any row.';
                return false;
            }
        });

        if (!isValid) {
            $('#messageContainer').text(errorMessage).removeClass('d-none').addClass('text-danger');
            return;
        }

        $.ajax({
            url: '<?= base_url('order/submitBooking') ?>',
            method: 'POST',
            data: {
                booking_data: bookingData
            },
            success: function(response) {
                if (response.status === 'success') {
                    $('#messageContainer').text(response.message).removeClass('d-none').addClass('text-success');
                    $('#productTable tbody').empty();
                    bookingData = [];
                    $('#customer').prop('disabled', false);
                    customerSelected = false;
                    $('#totalPrice').text('0');
                } else {
                    $('#messageContainer').text('Failed to submit booking.').removeClass('d-none').addClass('text-danger');
                }
            }
        });
    });
</script>

<?= $this->endSection(); ?>
