<?= $this->extend('layout'); ?>
<?= $this->section('content'); ?>

<div class="container-fluid dashboard-content mt-5">
    <div class="row">
        <a href="<?= base_url('/customer')?>">
            <button type="button" class="btn btn-info btn-lg float-end mb-2">Add Customer</button>
        </a>
    </div>
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <h5 class="card-header text-secondary fs-4">All Customers</h5>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered" id="myTable">
                            <thead>
                                <tr>
                                    <th class="bg-dark text-light">Profile</th>
                                    <th class="bg-dark text-light">Name</th>
                                    <th class="bg-dark text-light">Email</th>
                                    <th class="bg-dark text-light">Address</th>
                                    <th class="bg-dark text-light">Phone No.</th>
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