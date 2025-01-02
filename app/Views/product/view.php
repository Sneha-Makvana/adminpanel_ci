<?= $this->extend('layout'); ?>
<?= $this->section('content'); ?>

<div class="container-fluid dashboard-content mt-5">
    <div class="row">
        <a href="<?= base_url('/product')?>"><button type="button" class="btn btn-info btn-lg float-end mb-2">Add Product</button></a>
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
<script>
   
</script>

<?= $this->endSection(); ?>