<?= $this->extend('layout'); ?>
<?= $this->section('content'); ?>

<div class="container-fluid p-0">
    <h1 class="h3 mb-3"><strong>Analytics</strong> Dashboard</h1>
    <div class="row">
        <div class="col-xl-12 col-xxl-5 d-flex">
            <div class="w-100">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="card bg-info-subtle">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col mt-0">
                                        <a href="/event/view" style="text-decoration: none;">
                                            <h5 class="text-dark fs-4">Events</h5>
                                        </a>
                                    </div>
                                </div>
                                <h1 class="mt-1 mb-3"><?= $totalEvents; ?></h1>
                                <div class="mb-0">
                                    <span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i> -3.65% </span>
                                    <span class="text-muted">Since last week</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="card bg-success-subtle">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col mt-0">
                                        <a href="/customer/view" style="text-decoration: none;">
                                            <h5 class="text-dark fs-4">Customers</h5>
                                        </a>
                                    </div>
                                </div>
                                <h1 class="mt-1 mb-3"><?= $totalCustomers; ?></h1>
                                <div class="mb-0">
                                    <span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i> -2.25% </span>
                                    <span class="text-muted">Since last week</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="card bg-primary-subtle">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col mt-0">
                                        <a href="/booking/view" style="text-decoration: none;">
                                            <h5 class="text-dark fs-4">Bookings</h5>
                                        </a>
                                    </div>
                                </div>
                                <h1 class="mt-1 mb-3"><?= $totalBookings; ?></h1>
                                <div class="mb-0">
                                    <span class="text-success"> <i class="mdi mdi-arrow-bottom-right"></i> 5.25% </span>
                                    <span class="text-muted">Since last week</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12 col-lg-12 col-xxl-9 d-flex">
            <div class="card flex-fill">
                <div class="card-header bg-secondary-subtle">
                    <h5 class="text-secondary fs-4 mb-0"><strong>Event</strong> Calendar</h5>
                </div>
                <div class="card-body d-flex">
                    <div class="align-self-center w-100">
                        <div id='calendar1'></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="eventDetailsModal" tabindex="-1" aria-labelledby="eventDetailsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-secondary-subtle">
                    Event Name: <h5 class="modal-title" id="modalEventTitle"> </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Customer Name:</strong> <span id="modalCustomerName"></span></p>
                            <hr>
                            <p><strong>Event Price:</strong> <span id="modalEventPrice"></span></p>
                            <hr>
                            <p><strong>Booking Qty:</strong> <span id="modalBookingQty"></span></p>
                            <hr>
                            <p><strong>Event Category:</strong> <span id="modalEventCategory"></span></p>
                        </div>
                        <div class="col-md-6">

                            <p><strong>Event Location:</strong> <span id="modalEventLocation"></span></p>
                            <hr>
                            <p><strong>Booking Date:</strong> <span id="modalBookingDate"></span></p>
                            <hr>
                            <p><strong>Total Price:</strong> <span id="modalBookingTotal"></span></p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12 col-lg-12 col-xxl-9 d-flex">
            <div class="card flex-fill">
                <div class="card-header">
                    <h5 class="text-dark fs-4 mb-0">Latest Bookings</h5>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr>
                                <th class="bg-dark text-light">No.</th>
                                <th class="bg-dark text-light">Customer Name</th>
                                <th class="bg-dark text-light">Event Name</th>
                                <th class="bg-dark text-light">Location</th>
                                <th class="bg-dark text-light">Ticket Price</th>
                                <th class="bg-dark text-light">Quantity</th>
                                <th class="bg-dark text-light">Total</th>
                                <th class="bg-dark text-light">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($latestBookings)) : ?>
                                <?php foreach ($latestBookings as $index => $booking) : ?>
                                    <tr>
                                        <td><?= $index + 1; ?></td>
                                        <td><?= esc($booking['customer_name']); ?></td>
                                        <td><?= esc($booking['event_name']); ?></td>
                                        <td><?= esc($booking['location']); ?></td>
                                        <td><?= esc($booking['booking_ticket']); ?></td>
                                        <td><?= esc($booking['qty']); ?></td>
                                        <td><?= esc($booking['total']); ?></td>
                                        <td>
                                            <a href="<?= base_url('/booking/display/' . $booking['id']); ?>">
                                                <i class="align-middle me-2" data-feather="eye"></i>
                                            </a>
                                            <a href="javascript:void(0);" class="delete-btn" data-id="<?= $booking['id']; ?>">
                                                <i class="align-middle me-2" data-feather="trash-2"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <tr>
                                    <td colspan="8" class="text-center">No bookings found</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        $('.delete-btn').on('click', function() {
            const bookingId = $(this).data('id');
            if (confirm('Are you sure you want to delete this booking?')) {
                $.ajax({
                    url: `<?= site_url('admin/deleteBooking'); ?>/${bookingId}`,
                    type: "POST",
                    success: function(response) {
                        if (response.success) {
                            alert(response.message);
                            location.reload();
                        } else {
                            alert('Failed to delete booking');
                        }
                    },
                    error: function() {
                        alert('Error occurred while deleting booking');
                    }
                });
            }
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar1');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            events: {
                url: '<?= site_url('admin/getEvents'); ?>',
                method: 'GET',
                failure: function() {
                    alert('Error fetching events');
                },
            },
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay',
            },
            eventContent: function(arg) {
                let customHtml = `<div style="color: black; padding: px; border-radius: 5px;">${arg.event.title}</div>`;
                return {
                    html: customHtml
                };
            },
            eventClassNames: function() {
                return ['custom-event'];
            },
            eventClick: function(info) {
                document.getElementById('modalEventTitle').textContent = info.event.title;
                document.getElementById('modalCustomerName').textContent = info.event.extendedProps.customerName;
                document.getElementById('modalBookingQty').textContent = info.event.extendedProps.bookingQty;
                document.getElementById('modalBookingTotal').textContent = info.event.extendedProps.bookingTotal;
                document.getElementById('modalEventLocation').textContent = info.event.extendedProps.eventLocation;
                document.getElementById('modalEventPrice').textContent = info.event.extendedProps.eventPrice;
                document.getElementById('modalEventCategory').textContent = info.event.extendedProps.eventCategory;
                document.getElementById('modalBookingDate').textContent = new Date(info.event.start).toLocaleDateString();

                var modal = new bootstrap.Modal(document.getElementById('eventDetailsModal'));
                modal.show();

                info.jsEvent.preventDefault();
            },
        });

        calendar.render();
    });
</script>

<?= $this->endSection(); ?>