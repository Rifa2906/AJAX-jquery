<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container-fluid">
            <div class="page-title-box">
                <div class="row align-items-center">

                    <div class="col-sm-6">
                        <h4 class="page-title"><?= $title; ?></h4>
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active"></li>
                        </ol>

                    </div>
                </div>
            </div>
            <!-- end row -->


            <!-- isi -->
            <div class="row">

                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="mt-0 header-title">Tabel Kode Barang</h4>
                            <button type="button" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#myModal">Standard Modal</button>
                            <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>N0</th>
                                        <th>Kode</th>
                                        <th>Harga</th>
                                    </tr>
                                </thead>


                                <tbody id="target">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> <!-- end col -->

            </div>

        </div>
        <!-- end row -->
    </div>

</div>
<!-- end row -->
</div>
<!-- container-fluid -->

</div>
<!-- content -->


<!-- ============================================================== -->
<!-- End Right content here -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    function ambilData() {

        $.ajax({
            type: "POST",
            url: "<?= base_url('Kode_barang/tampil') ?>",
            dataType: "json",
            success: function(data) {
                console.log(data);
            }
        })
    }
</script>

<!-- sample modal content -->
<div id="myModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0" id="myModalLabel">Modal Heading</h5>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <label for="example-date-input" class="col">Date</label>
                <div class="col">
                    <input class="form-control" type="date" id="example-date-input">
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary waves-effect" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary waves-effect waves-light">Save changes</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->