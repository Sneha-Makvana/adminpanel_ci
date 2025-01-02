<?= $this->extend('layout'); ?>
<?= $this->section('content'); ?>

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

        <!-- Display Categories -->
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
<script>
    
</script>

<?= $this->endSection(); ?>