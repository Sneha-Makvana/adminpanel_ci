<?= $this->extend('layout'); ?>
<?= $this->section('content'); ?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

<div class="container-fluid dashboard-content">
    <div class="row">

        <div class="col-12 col-lg-8 mx-5 mt-5">
            <div class="card">
                <form id="categoryForm">
                    <input type="hidden" name="id" id="id">
                    <div class="card-body">
                        <label for="category_name" class="text-dark mb-3 fs-4">Product Category</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="category_name" id="category_name" placeholder="Enter category">
                        </div>
                        <div id="category_nameError" class="error text-danger"></div>
                    </div>
                    <div class="card-body">
                        <button type="submit" class="btn btn-info btn-lg">Save Category</button>
                    </div>
                    <div id="response_message" class="success-message"></div>
                </form>
            </div>
        </div>

        <div class="col-12 col-lg-8 mx-5 mt-5">
            <div class="card">
                <h5 class="card-header text-secondary fs-4 text-center">Categories</h5>
                <div class="card-body">
                    <table class="table table-striped table-hover table-bordered" id="myTable">
                        <thead>
                            <tr>
                                <th class="bg-dark text-light">Category</th>
                                <th class="bg-dark text-light">Actions</th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        function loadCategories() {
            $.get("<?= base_url('/category/fetch') ?>", function(data) {
                let rows = '';
                data.forEach(category => {
                    rows += `
                    <tr id="category-${category.id}">
                        <td>${category.category_name}</td>
                        <td>
                            <a href="javascript:void(0)" class="edit-btn text-primary me-3" data-id="${category.id}">
                            <i class='align-middle' data-feather='edit'></i>
                            </a>
                            <a href="javascript:void(0)" class="delete-btn text-danger" data-id="${category.id}">
                            <i class='align-middle' data-feather='trash-2'></i>
                            </a>    
                        </td>
                    </tr>
                `;
                });
                $('#myTable tbody').html(rows);
                feather.replace();
            });
        }
        loadCategories();

        $('#categoryForm').on('submit', function(e) {
            e.preventDefault();
            const formData = $(this).serialize();
            const action = $('#id').val() ? 'update' : 'insert';
            $(".error").html("");

            $.post(`<?= base_url('/category/') ?>${action}`, formData, function(response) {
                if (response.success) {
                    $('#response_message').html(`<p class="text-success">${response.message}</p>`);
                    loadCategories();
                    $('#categoryForm')[0].reset();
                } else {
                    $.each(response.errors, function(key, value) {
                        $(`#${key}Error`).html(value);
                    });
                }
            });
        });

        $('#myTable').on('click', '.edit-btn', function() {
            const id = $(this).data('id');
            $(".error").html("");
            $.get(`<?= base_url('/category/fetchCategory/') ?>${id}`, function(response) {
                if (response.success) {
                    $('#id').val(response.data.id);
                    $('#category_name').val(response.data.category_name);
                }
            });
        });

        $('#myTable').on('click', '.delete-btn', function() {
            const id = $(this).data('id');

            Swal.fire({
                title: 'Are you sure?',
                text: "This will delete the category. Make sure there are no associated products!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `<?= base_url('/category/delete/') ?>${id}`,
                        type: 'POST',
                        success: function(response) {
                            if (response.success) {
                                Swal.fire(
                                    'Deleted!',
                                    response.message,
                                    'success'
                                );
                                $(`#category-${id}`).remove();
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
                                'An error occurred while deleting the category.',
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