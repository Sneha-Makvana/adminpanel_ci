<?= $this->extend('layout'); ?>
<?= $this->section('content'); ?>

<div class="container-fluid dashboard-content">
    <div class="row">
        <div class="col-12 col-lg-6 mx-5 mt-5">
            <div class="card">
                <div class="card-body">
                    <label for="name">Customers</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">
                                <i data-feather="user-plus"></i>
                            </span>
                        </div>
                        <select id="customer" name="customer_id" class="form-control" required>
                            <option value="">Select Customer</option>
                            <?php foreach ($customers as $customer) : ?>
                                <option value="<?= $customer['id'] ?>"><?= $customer['name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="card-body">
                    <label for="name">Events</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1">
                                <i data-feather="file-plus"></i>
                            </span>
                        </div>
                        <select id="event" name="event_id" class="form-control" required>
                            <option value="">Select Event</option>
                            <?php foreach ($events as $event) : ?>
                                <option value="<?= $event['id'] ?>" data-price="<?= $event['booking_ticket'] ?>"><?= $event['event_name'] ?></option>
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

        <div class="col-12 col-lg-10 mx-5 mt-5">
            <div class="card" id="bookingCard" style="display: none;">
                <h5 class="card-header fs-4 text-center">Events Bookings</h5>
                <div class="card-body">
                    <div class="table table-striped table-hover table-bordered" id="eventTableContainer">
                        <table class="table" id="eventTable">
                            <thead>
                                <tr>
                                    <th class="bg-dark text-light">Event Name</th>
                                    <th class="bg-dark text-light">Price</th>
                                    <th class="bg-dark text-light">Qty</th>
                                    <th class="bg-dark text-light">Total</th>
                                    <th class="bg-dark text-light">Action</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
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
        const eventId = $('#event').val();
        const eventName = $('#event option:selected').text();
        const eventPrice = $('#event option:selected').data('price');

        if (!customerId || !eventId) {
            $('#message').text('Please select both customer and event.');
            return;
        }

        if (!customerSelected) {
            $('#customer').prop('disabled', true);
            customerSelected = true;
        }

        $('#bookingCard').show();

        const newRow = `
            <tr>
                <td>${eventName}</td>
                <td><input type="number" class="form-control price" value="${eventPrice}" readonly></td>
                <td><input type="number" class="form-control qty" value="1" min="1"></td>
                <td><input type="number" class="form-control total" value="${eventPrice}" readonly></td>
                <td><button type="button" class="btn btn-danger removeRowBtn">Remove</button></td>
            </tr>
        `;
        $('#eventTable tbody').append(newRow);

        bookingData.push({
            customer_id: customerId,
            event_id: eventId,
            qty: 1,
            total: eventPrice
        });

        calculateTotal();
    });

    $(document).on('input', '.qty', function() {
        const row = $(this).closest('tr');
        const qty = $(this).val();
        const price = row.find('.price').val();

        if (qty < 1) {
            row.find('.total').val(0);
        } else {
            const total = qty * price;
            row.find('.total').val(total);
        }

        const rowIndex = row.index();
        bookingData[rowIndex].qty = qty;
        bookingData[rowIndex].total = row.find('.total').val();

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

        bookingData.splice(rowIndex, 1);
        row.remove();

        calculateTotal();
    });

    $('#submitBookingBtn').click(function() {
        let isValid = true;
        let errorMessage = '';

        $('.qty').each(function() {
            const qty = $(this).val();
            if (qty < 1) {
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
            url: '<?= base_url('booking/submitBooking') ?>',
            method: 'POST',
            data: {
                booking_data: bookingData
            },
            success: function(response) {
                if (response.status === 'success') {
                    $('#messageContainer').text(response.message).removeClass('d-none').addClass('text-success'); // Success message in green
                    $('#eventTable tbody').empty();
                    bookingData = [];
                    $('#customer').prop('disabled', false);
                    customerSelected = false;
                    $('#totalPrice').text('0');
                } else {
                    $('#messageContainer').text('Failed to submit booking.').removeClass('d-none').addClass('text-danger'); // Error message in red
                }
            }
        });

    });
</script>

<?= $this->endSection(); ?>