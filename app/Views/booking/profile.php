<?= $this->extend('layout'); ?>
<?= $this->section('content'); ?>

<div class="container-fluid p-0">
    <div class="mb-3">
        <h1 class="h3 d-inline align-middle">Profile</h1>
    </div>
    <div class="row">
        <div class="col-md-8 col-xl-9">
            <div class="card">
                <div class="card-body h-100">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Customer Name</h6>
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
                                <h6 class="mb-0">Phone</h6>
                            </div>
                            <div class="col-sm-9 text-secondary" id="customer-phone"></div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Event Name</h6>
                            </div>
                            <div class="col-sm-9 text-secondary" id="event-name"></div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Location</h6>
                            </div>
                            <div class="col-sm-9 text-secondary" id="event-location"></div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Booking Ticket</h6>
                            </div>
                            <div class="col-sm-9 text-secondary" id="event-booking-ticket"></div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">No Of Tickets</h6>
                            </div>
                            <div class="col-sm-9 text-secondary" id="booking-qty"></div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Total</h6>
                            </div>
                            <div class="col-sm-9 text-secondary" id="booking-total"></div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-12">
                                <a href="/booking/view" class="btn btn-info">Back to List</a>
                            </div>
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
        const bookingId = <?= $bookingId; ?>;

        $.ajax({
            url: `/booking/fetchBookingDetails/${bookingId}`,
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    const data = response.data;
                    $('#customer-name').text(data.customer_name);
                    $('#customer-email').text(data.email);
                    $('#customer-phone').text(data.phone_no);
                    $('#event-name').text(data.event_name);
                    $('#event-location').text(data.location);
                    $('#event-booking-ticket').text(data.booking_ticket);
                    $('#booking-qty').text(data.qty);
                    $('#booking-total').text(data.total);
                } else {
                    alert(response.message);
                }
            },
            error: function() {
                alert('An error occurred while fetching booking details.');
            }
        });
    });
</script>

<?= $this->endSection(); ?>