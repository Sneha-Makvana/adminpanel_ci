<?= $this->extend('layout'); ?>
<?= $this->section('content'); ?>

<div class="container-fluid dashboard-content">
    <div class="row">
        <a href="/booking"><button type="button" class="btn btn-info btn-lg float-end mt-2 mb-2">Add Booking</button></a>
    </div>

    <?php if (isset($message)) : ?>
        <div class="alert alert-info">
            <?= esc($message); ?>
        </div>
    <?php endif; ?>

    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <h5 class="card-header text-secondary fs-4">All Bookings</h5>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="myTable">
                            <thead>
                                <tr>
                                    <th class="bg-dark text-light">Customer Name</th>
                                    <th class="bg-dark text-light">Event Name</th>
                                    <th class="bg-dark text-light">Location</th>
                                    <th class="bg-dark text-light">Ticket Price</th>
                                    <th class="bg-dark text-light">Quantity</th>
                                    <th class="bg-dark text-light">Booking Date</th>
                                    <th class="bg-dark text-light">Total</th>
                                    <th class="bg-dark text-light">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($bookings as $booking) : ?>
                                    <tr id="booking-row-<?= $booking['id']; ?>">
                                        <td><?= esc($booking['customer_name']); ?></td>
                                        <td><?= esc($booking['event_name']); ?></td>
                                        <td><?= esc($booking['location']); ?></td>
                                        <td><?= esc($booking['booking_ticket']); ?></td>
                                        <td><?= esc($booking['qty']); ?></td>
                                        <td><?= esc($booking['booking_date']); ?></td>
                                        <td><?= esc($booking['total']); ?></td>
                                        <td>
                                            <a href="<?= base_url('/booking/display') ?>/<?= $booking['id']; ?>">
                                                <i class='align-middle me-2' data-feather='eye'></i>
                                            </a>

                                            <a href="javascript:void(0);" class="delete-btn" data-id="<?= $booking['id']; ?>">
                                                <i class='align-middle me-2' data-feather='trash-2'></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#myTable').on('click', '.delete-btn', function() {
            const bookingId = $(this).data('id');
            const row = $('#booking-row-' + bookingId);

            if (confirm('Are you sure you want to delete this booking?')) {
                $.ajax({
                    url: `<?= site_url('booking/deleteBooking'); ?>/${bookingId}`,
                    type: "POST",
                    success: function(response) {
                        if (response.success) {
                            row.remove();
                            alert(response.message);
                        } else {
                            alert(response.message);
                        }
                    },
                    error: function(xhr, status, error) {
                        alert('Error deleting record: ' + error);
                    }
                });
            }
        });
    });
</script>

<?= $this->endSection(); ?>

