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
                                <h6 class="mb-0">Name</h6>
                            </div>
                            <div class="col-sm-9 text-secondary" id="event-event_name"></div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Description</h6>
                            </div>
                            <div class="col-sm-9 text-secondary" id="event-description"></div>
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
                                <h6 class="mb-0">Start Date</h6>
                            </div>
                            <div class="col-sm-9 text-secondary" id="event-start_date"></div>
                        </div>
                        <hr>

                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">End Date</h6>
                            </div>
                            <div class="col-sm-9 text-secondary" id="event-end_date"></div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Booking Ticket</h6>
                            </div>
                            <div class="col-sm-9 text-secondary" id="event-booking_ticket"></div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">No Of Ticket</h6>
                            </div>
                            <div class="col-sm-9 text-secondary" id="event-no_of_tickets"></div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3">
                                <h6 class="mb-0">Event Images</h6>
                            </div>
                            <div class="col-sm-9 text-secondary" id="event-event_images">

                            </div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-sm-12">
                                <a href="/event/view" class="btn btn-info">Back to List</a>
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
        const params = new URLSearchParams(window.location.search);
        const eventId = params.get('id');

        if (eventId) {
            $.ajax({
                url: `<?= site_url('event/details'); ?>/${eventId}`,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#event-event_name').text(data.event_name || 'N/A');
                    $('#event-description').text(data.description || 'N/A');
                    $('#event-location').text(data.location || 'N/A');
                    $('#event-start_date').text(data.start_date || 'N/A');
                    $('#event-end_date').text(data.end_date || 'N/A');
                    $('#event-booking_ticket').text(data.booking_ticket || 'N/A');
                    $('#event-no_of_tickets').text(data.no_of_tickets || 'N/A');

                    if (data.event_images) {
                        const images = data.event_images.split(',');
                        let imagesHtml = '';
                        images.forEach(image => {
                            const imageUrl = `<?= base_url('uploads/events/'); ?>/${image}`;
                            imagesHtml += `<img src="${imageUrl}" alt="Event Image" class="img-fluid rounded mb-2 mx-2" style="max-width: 150px; max-height: 150px;">`;
                        });
                        $('#event-event_images').html(imagesHtml);
                    } else {
                        $('#event-event_images').text('No images available.');
                    }
                },
                error: function(xhr, status, error) {
                    alert('Error fetching event details: ' + error);
                }
            });
        } else {
            alert('No event ID provided.');
        }
    });
</script>

<?= $this->endSection(); ?>