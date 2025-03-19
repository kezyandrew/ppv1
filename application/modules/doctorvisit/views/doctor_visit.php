<!-- Add custom CSS -->
<link href="common/extranal/css/doctor/doctor-visits.css" rel="stylesheet">

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="fw-bold"><?php echo lang('doctor_visit') ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="home"><?php echo lang('home') ?></a></li>
                        <li class="breadcrumb-item"><a href="doctor"><?php echo lang('doctor') ?></a></li>
                        <li class="breadcrumb-item active"><?php echo lang('doctor_visit') ?></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-outline card-primary shadow-sm">
                        <div class="card-header">
                            <h3 class="card-title"><?php echo lang('Comprehensive List of Visit Types and Associated Charges for Each Doctor'); ?></h3>
                            <?php if ($this->ion_auth->in_group('admin')) { ?>
                                <div class="card-tools">
                                    <a data-toggle="modal" href="#myModal" class="btn-add-visit">
                                        <button class="btn btn-primary">
                                            <i class="fa fa-plus-circle me-1"></i> <?php echo lang('add_doctor_visit'); ?>
                                        </button>
                                    </a>
                                </div>
                            <?php } ?>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover" id="editable-sample">
                                    <thead>
                                        <tr>
                                            <th class="fw-bold">#</th>
                                            <th class="fw-bold"><?php echo lang('doctor'); ?> <?php echo lang('name'); ?></th>
                                            <th class="fw-bold"><?php echo lang('visit'); ?> <?php echo lang('description'); ?></th>
                                            <th class="fw-bold"><?php echo lang('visit'); ?> <?php echo lang('charges'); ?></th>
                                            <th class="fw-bold"><?php echo lang('status'); ?></th>
                                            <?php if ($this->ion_auth->in_group('admin')) { ?>
                                                <th class="no-print text-center fw-bold"><?php echo lang('options'); ?></th>
                                            <?php } ?>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- DataTables will fill this -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
            
            <!-- Mobile Add Button (visible only on small screens) -->
            <div class="floating-add-btn d-md-none">
                <button class="btn btn-primary rounded-circle shadow" data-toggle="modal" data-target="#myModal">
                    <i class="fa fa-plus"></i>
                </button>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>

<!-- Add Doctor Visit Modal-->
<div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h4 class="modal-title"> <?php echo lang('add_doctor_visit'); ?></h4>
                <button type="button" class="close text-white" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <form role="form" action="doctorvisit/addNew" class="clearfix" method="post" enctype="multipart/form-data">
                    <div class="form-group mb-3">
                        <label for="adoctors" class="form-label fw-bold"> <?php echo lang('doctor'); ?> <span class="text-danger">*</span></label>
                        <select class="form-control m-bot15 doctor" id="adoctors" name="doctor" value='' required="">
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="visit_description" class="form-label fw-bold"><?php echo lang('visit'); ?> <?php echo lang('description'); ?> <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="visit_description" id="visit_description" value='' placeholder="Enter visit description" required="">
                    </div>
                    <div class="form-group mb-3">
                        <label for="visit_charges" class="form-label fw-bold"><?php echo lang('visit'); ?> <?php echo lang('charges'); ?> <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><?php echo $settings->currency; ?></span>
                            </div>
                            <input type="number" min="1" class="form-control" name="visit_charges" id="visit_charges" placeholder="Enter amount" required="">
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <label for="status" class="form-label fw-bold"><?php echo lang('status'); ?></label>
                        <select class="form-control" name="status" id="status">
                            <option value="active"><?php echo lang('active'); ?></option>
                            <option value="disable"><?php echo lang('in_active'); ?></option>
                        </select>
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-light me-2" data-dismiss="modal"><?php echo lang('close'); ?></button>
                        <button type="submit" name="submit" class="btn btn-primary"><?php echo lang('submit'); ?></button>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Add Doctor Visit Modal-->

<!-- Edit Doctor Visit Modal-->
<div class="modal fade" id="myModal2" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h4 class="modal-title"> <?php echo lang('edit_doctor_visit'); ?></h4>
                <button type="button" class="close text-white" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <form role="form" id="editDoctorvisitForm" class="clearfix" action="doctorvisit/addNew" method="post" enctype="multipart/form-data">
                    <div class="form-group mb-3">
                        <label for="adoctors1" class="form-label fw-bold"> <?php echo lang('doctor'); ?> <span class="text-danger">*</span></label>
                        <select class="form-control m-bot15 doctor" id="adoctors1" name="doctor" value='' required="">
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="visit_description_edit" class="form-label fw-bold"><?php echo lang('visit'); ?> <?php echo lang('description'); ?> <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="visit_description" id="visit_description_edit" value='' placeholder="Enter visit description" required="">
                    </div>
                    <div class="form-group mb-3">
                        <label for="visit_charges_edit" class="form-label fw-bold"><?php echo lang('visit'); ?> <?php echo lang('charges'); ?> <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><?php echo $settings->currency; ?></span>
                            </div>
                            <input type="number" min="1" class="form-control" name="visit_charges" id="visit_charges_edit" placeholder="Enter amount" required="">
                        </div>
                    </div>
                    <div class="form-group mb-4">
                        <label for="status_edit" class="form-label fw-bold"><?php echo lang('status'); ?></label>
                        <select class="form-control" name="status" id="status_edit">
                            <option value="active"><?php echo lang('active'); ?></option>
                            <option value="disable"><?php echo lang('in_active'); ?></option>
                        </select>
                    </div>

                    <input type="hidden" name="id" value=''>

                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-light me-2" data-dismiss="modal"><?php echo lang('close'); ?></button>
                        <button type="submit" name="submit" class="btn btn-primary"><?php echo lang('submit'); ?></button>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Edit Doctor Visit Modal-->

<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript">
    var language = "<?php echo $this->language; ?>";
</script>
<script type="text/javascript">
    var select_doctor = "<?php echo lang('select_doctor'); ?>";
</script>
<script src="common/extranal/js/doctor/doctor_visit.js"></script>