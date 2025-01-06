<?= $this->extend('layout'); ?>
<?= $this->section('content'); ?>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
<!-- SweetAlert2 CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

<div class="container-fluid dashboard-content mt-5">
    <div class="row">
        <a href="<?= base_url('/product') ?>"><button type="button" class="btn btn-info btn-lg float-end mb-2">Add Product</button></a>
    </div>
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <h5 class="card-header text-secondary fs-4">All Products</h5>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="myTable">
                            <thead>
                                <tr>
                                    <th class="bg-dark text-light">Product Image</th>
                                    <th class="bg-dark text-light">Product Name</th>
                                    <th class="bg-dark text-light">Quantity</th>
                                    <th class="bg-dark text-light">Price</th>
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
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
<!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function() {
        var table = $('#myTable').DataTable({
            "paging": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "bDestroy": true // Allows re-initialization of DataTable after content is updated
        });

        function loadEvent() {
            $.ajax({
                url: "<?= site_url('product/fetch'); ?>",
                type: "GET",
                dataType: "json",
                success: function(data) {
                    var rows = '';
                    $.each(data, function(index, product) {
                        let firstImage = '';
                        if (product.product_image) {
                            const images = product.product_image.split(',');
                            firstImage = images[0] ? `<?= base_url('public/uploads/events/'); ?>/${images[0]}` : '';
                        }
                        rows += `
                    <tr id="products-${product.id}">
                        <td>
                            ${firstImage ? `<img src="${firstImage}" alt="Event Image" class="img-thumbnail" style="width: 80px; height: 80px;">` : 'No Image'}
                        </td>
                        <td>${product.product_name}</td>
                        <td>${product.quantity}</td>
                        <td>${product.price}</td>
                        <td>${product.category_name}</td>
                        <td>
                            <a href="<?= base_url('/product/profile') ?>?id=${product.id}">
                                <i class='align-middle me-2' data-feather='eye'></i>
                            </a>
                            <a href="<?= base_url('/product') ?>?id=${product.id}">
                                <i class='align-middle me-2' data-feather='edit'></i>
                            </a>
                            <a href="javascript:void(0);" class="delete-btn" data-id="${product.id}">
                                <i class='align-middle me-2' data-feather='trash-2'></i>
                            </a>
                        </td>
                    </tr>`;
                    });
                    $('#myTable tbody').html(rows);

                    table.clear();
                    table.rows.add($('#myTable tbody tr'));
                    table.draw();

                    feather.replace();
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching data: ' + error);
                }
            });
        }

        loadEvent();

        // Handle delete button click with SweetAlert2
        $('#myTable').on('click', '.delete-btn', function() {
            const productId = $(this).data('id');
            
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `<?= site_url('product/delete'); ?>/${productId}`,
                        type: "DELETE",
                        success: function(response) {
                            if (response.success) {
                                Swal.fire(
                                    'Deleted!',
                                    response.message,
                                    'success'
                                );
                                loadEvent(); // Reload table
                            } else {
                                Swal.fire(
                                    'Error!',
                                    response.message,
                                    'error'
                                );
                            }
                        },
                        error: function(xhr, status, error) {
                            Swal.fire(
                                'Error!',
                                'An error occurred while deleting.',
                                'error'
                            );
                        }
                    });
                }
            });
        });

    });
</script>

<?= $this->endSection(); ?>
