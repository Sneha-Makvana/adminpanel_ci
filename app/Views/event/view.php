<?= $this->extend('layout'); ?>
<?= $this->section('content'); ?>

<div class="container-fluid dashboard-content">
    <div class="row">
        <a href="/event"><button type="button" class="btn btn-info btn-lg float-end mb-2">Add Event</button></a>
    </div>
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <h5 class="card-header text-secondary fs-4">All Events</h5>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="myTable">
                            <thead>
                                <tr>
                                    <th class="bg-dark text-light">Event Image</th>
                                    <th class="bg-dark text-light">Event Name</th>
                                    <th class="bg-dark text-light">Location</th>
                                    <th class="bg-dark text-light">Price</th>
                                    <th class="bg-dark text-light">No Of Tickets</th>
                                    <th class="bg-dark text-light">Category</th>
                                    <th class="bg-dark text-light">Action</th>
                                </tr>
                            </thead>
                            <tbody>

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
        function loadEvent() {
            $.ajax({
                url: "<?= site_url('event/fetch'); ?>",
                type: "GET",
                dataType: "json",
                success: function(data) {
                    var rows = '';
                    $.each(data, function(index, event) {
                        let firstImage = '';
                        if (event.event_images) {
                            const images = event.event_images.split(',');
                            firstImage = images[0] ? `<?= base_url('uploads/events/'); ?>/${images[0]}` : '';
                        }
                        rows += `
                    <tr id="event-${event.id}">
                        <td>
                            ${firstImage ? `<img src="${firstImage}" alt="Event Image" class="img-thumbnail" style="max-width: 100px; max-height: 100px;">` : 'No Image'}
                        </td>
                        <td>${event.event_name}</td>
                        <td>${event.location}</td>
                        <td>${event.booking_ticket}</td>
                        <td>${event.no_of_tickets}</td>
                        <td>${event.category_name}</td> <!-- Display category name -->
                        <td>
                            <a href="<?= base_url('/event/profile') ?>?id=${event.id}">
                                <i class='align-middle me-2' data-feather='eye'></i>
                            </a>
                            <a href="<?= base_url('/event') ?>?id=${event.id}">
                                <i class='align-middle me-2' data-feather='edit'></i>
                            </a>
                            <a href="javascript:void(0);" class="delete-btn" data-id="${event.id}">
                                <i class='align-middle me-2' data-feather='trash-2'></i>
                            </a>
                        </td>
                    </tr>`;
                    });
                    $('#myTable tbody').html(rows);
                    feather.replace();
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching data: ' + error);
                }
            });
        }

        loadEvent();

        $('#myTable').on('click', '.delete-btn', function() {
            const eventId = $(this).data('id');
            if (confirm('Are you sure you want to delete this event?')) {
                $.ajax({
                    url: `<?= site_url('event/delete'); ?>/${eventId}`,
                    type: "POST",
                    success: function(response) {
                        if (response.success) {
                            $(`#event-${eventId}`).remove();
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