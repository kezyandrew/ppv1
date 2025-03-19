<!-- Add your custom CSS -->
<link href="common/extranal/css/doctor/doctor.css" rel="stylesheet">
<link href="common/extranal/css/doctor/doctor-custom.css" rel="stylesheet">

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="fw-bold"><?php echo lang('doctors') ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="home"><?php echo lang('home') ?></a></li>
                        <li class="breadcrumb-item active"><?php echo lang('doctor') ?></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Search & Filter Row -->
            <div class="row mb-4">
                <div class="col-md-7">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fa fa-search"></i></span>
                        </div>
                        <input type="text" class="form-control" id="doctorFilterInput" placeholder="Search doctors...">
                    </div>
                </div>
                <div class="col-md-2">
                    <select class="form-control" id="departmentFilter">
                        <option value="all">All Departments</option>
                        <?php foreach ($departments as $department) { ?>
                            <option value="<?php echo $department->name; ?>"><?php echo $department->name; ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="col-md-3 text-right">
                    <button class="btn btn-outline-primary me-1" id="viewToggleBtn">
                        <i class="fa fa-th-large me-1"></i> Grid View
                    </button>
                    <a href="doctorvisit" class="btn btn-outline-info">
                        <i class="fa fa-calendar-check-o me-1"></i> <?php echo lang('doctor_visit'); ?>
                    </a>
                </div>
            </div>
            
            <div class="row">
                <div class="col-12">
                    <div class="card card-outline card-primary shadow-sm">
                        <div class="card-header">
                            <h3 class="card-title"><?php echo lang('All the doctor names and related informations'); ?></h3>
                            <div class="card-tools">
                                <a data-toggle="modal" href="#myModal" class="btn-add-doctor">
                                    <button class="btn btn-primary">
                                        <i class="fa fa-plus-circle me-1"></i> <?php echo lang('add_new'); ?>
                                    </button>
                                </a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <!-- Table View -->
                            <div id="doctorTableView">
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover" id="editable-sample">
                                        <thead>
                                            <tr>
                                                <th class="fw-bold"><?php echo lang('id'); ?></th>
                                                <th class="fw-bold"><?php echo lang('name'); ?></th>
                                                <th class="fw-bold"><?php echo lang('email'); ?></th>
                                                <th class="fw-bold"><?php echo lang('phone'); ?></th>
                                                <th class="fw-bold"><?php echo lang('department'); ?></th>
                                                <th class="fw-bold"><?php echo lang('profile'); ?></th>
                                                <th class="text-center fw-bold"><?php echo lang('options'); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- DataTables will fill this -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            
                            <!-- Grid View (Initially Hidden) -->
                            <div id="doctorGridView" class="d-none">
                                <div class="doctor-grid">
                                    <!-- Will be populated with JS -->
                                </div>
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

<!-- Add Doctor Modal-->
<div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h4 class="modal-title"> <?php echo lang('add_new_doctor'); ?></h4>
                <button type="button" class="close text-white" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <form role="form" action="doctor/addNew" class="clearfix" method="post" enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="form-group col-md-6 mb-3">
                            <label for="name" class="form-label fw-bold"><?php echo lang('name'); ?> &ast; </label>
                            <input type="text" class="form-control" name="name" id="name" value='' placeholder="Enter doctor's name" required="">
                        </div>
                        <div class="form-group col-md-6 mb-3">
                            <label for="email" class="form-label fw-bold"><?php echo lang('email'); ?> &ast; </label>
                            <input type="email" class="form-control" name="email" id="email" value='' placeholder="Enter email address" required="">
                        </div>
                        <div class="form-group col-md-6 mb-3">
                            <label for="password" class="form-label fw-bold"><?php echo lang('password'); ?> &ast; </label>
                            <input type="password" class="form-control" name="password" id="password" placeholder="********" required="">
                        </div>

                        <div class="form-group col-md-6 mb-3">
                            <label for="address" class="form-label fw-bold"><?php echo lang('address'); ?> &ast; </label>
                            <input type="text" class="form-control" name="address" id="address" value='' placeholder="Enter address" required>
                        </div>
                        <div class="form-group col-md-6 mb-3">
                            <label for="phone" class="form-label fw-bold"><?php echo lang('phone'); ?> &ast; </label>
                            <input type="text" class="form-control" name="phone" id="phone" value='' placeholder="Enter phone number" required>
                        </div>
                        <div class="form-group col-md-6 mb-3">
                            <label for="department" class="form-label fw-bold"><?php echo lang('department'); ?></label>
                            <select class="form-control m-bot15 js-example-basic-single" name="department" id="department" value=''>
                                <?php foreach ($departments as $department) { ?>
                                    <option value="<?php echo $department->id; ?>"> <?php echo $department->name; ?> </option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="col-md-12 row mb-4">
                            <div class="form-group col-md-6">
                                <label for="signature" class="form-label fw-bold"><?php echo lang('signature'); ?> &ast; </label>
                                <div class="">
                                    <div class="fileupload fileupload-new" data-provides="fileupload">
                                        <div class="fileupload-new thumbnail img_class fileupload-preview fileupload-exists thumbnail img_thumb">
                                            <img src="" alt="Signature" />
                                        </div>
                                        <div>
                                            <span class="btn btn-white btn-file">
                                                <span class="btn fileupload-new badge bg-secondary"><i class="fa fa-paper-clip"></i> <?php echo lang('select_image'); ?></span>
                                                <input type="file" class="default" name="signature" id="signature" />
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group last col-md-6">
                                <label class="form-label fw-bold"><?php echo lang('image'); ?> </label>
                                <div class="">
                                    <div class="fileupload fileupload-new" data-provides="fileupload">
                                        <div class="fileupload-new thumbnail img_class fileupload-preview fileupload-exists thumbnail img_thumb">
                                            <img src="" alt="Profile image" />
                                        </div>
                                        <div>
                                            <span class="btn btn-white btn-file">
                                                <span class="btn fileupload-new badge bg-secondary"><i class="fa fa-paper-clip"></i> <?php echo lang('select_image'); ?></span>
                                                <input type="file" class="default" name="img_url" />
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-md-12 mb-4">
                            <label for="editor1" class="form-label fw-bold"><?php echo lang('doctor'); ?> <?php echo lang('description'); ?></label>
                            <textarea class="form-control ckeditor" id="editor1" name="profile" value="" rows="6"></textarea>
                        </div>

                        <div class="form-group col-md-12">
                            <button type="button" class="btn btn-light" data-dismiss="modal"><?php echo lang('close'); ?></button>
                            <button type="submit" name="submit" class="btn btn-primary float-right"><?php echo lang('submit'); ?></button>
                        </div>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Add Doctor Modal-->

<!-- Edit Doctor Modal-->
<div class="modal fade" id="myModal2" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h4 class="modal-title"> <?php echo lang('edit_doctor'); ?></h4>
                <button type="button" class="close text-white" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form role="form" id="editDoctorForm" class="clearfix" action="doctor/addNew" method="post" enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="form-group col-md-6 mb-3">
                            <label for="name_edit" class="form-label fw-bold"><?php echo lang('name'); ?> &ast;</label>
                            <input type="text" class="form-control" name="name" id="name_edit" value='' placeholder="Enter doctor's name" required>
                        </div>
                        <div class="form-group col-md-6 mb-3">
                            <label for="email_edit" class="form-label fw-bold"><?php echo lang('email'); ?> &ast;</label>
                            <input type="email" class="form-control" name="email" id="email_edit" value='' placeholder="Enter email address" required>
                        </div>
                        <div class="form-group col-md-6 mb-3">
                            <label for="password_edit" class="form-label fw-bold"><?php echo lang('password'); ?></label>
                            <input type="password" class="form-control" name="password" id="password_edit" placeholder="********">
                        </div>

                        <div class="form-group col-md-6 mb-3">
                            <label for="address_edit" class="form-label fw-bold"><?php echo lang('address'); ?> &ast;</label>
                            <input type="text" class="form-control" name="address" id="address_edit" value='' placeholder="Enter address" required>
                        </div>
                        <div class="form-group col-md-6 mb-3">
                            <label for="phone_edit" class="form-label fw-bold"><?php echo lang('phone'); ?> &ast;</label>
                            <input type="text" class="form-control" name="phone" id="phone_edit" value='' placeholder="Enter phone number" required>
                        </div>
                        <div class="form-group col-md-6 mb-3">
                            <label for="department_edit" class="form-label fw-bold"><?php echo lang('department'); ?></label>
                            <select class="form-control m-bot15 js-example-basic-single department" name="department" id="department_edit" value=''>
                                <?php foreach ($departments as $department) { ?>
                                    <option value="<?php echo $department->id; ?>"> <?php echo $department->name; ?> </option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="col-md-12 row mb-4">
                            <div class="form-group col-md-6">
                                <label for="signature_edit" class="form-label fw-bold"><?php echo lang('signature'); ?></label>
                                <div class="">
                                    <div class="fileupload fileupload-new" data-provides="fileupload">
                                        <div class="fileupload-new thumbnail img_class">
                                            <img src="" id="signature" alt="Signature" />
                                        </div>
                                        <div class="fileupload-preview fileupload-exists thumbnail img_thumb"></div>
                                        <div>
                                            <span class="btn btn-white btn-file">
                                                <span class="btn fileupload-new badge bg-secondary"><i class="fa fa-paper-clip"></i> <?php echo lang('select_image'); ?></span>
                                                <input type="file" class="default" name="signature" id="signature_edit" />
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="img_url_edit" class="form-label fw-bold"><?php echo lang('image'); ?></label>
                                <div class="">
                                    <div class="fileupload fileupload-new" data-provides="fileupload">
                                        <div class="fileupload-new thumbnail img_class">
                                            <img src="" id="img" alt="Profile image" />
                                        </div>
                                        <div class="fileupload-preview fileupload-exists thumbnail img_thumb"></div>
                                        <div>
                                            <span class="btn btn-white btn-file">
                                                <span class="btn fileupload-new badge bg-secondary"><i class="fa fa-paper-clip"></i> <?php echo lang('select_image'); ?></span>
                                                <input type="file" class="default" name="img_url" id="img_url_edit" />
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-md-12 mb-4">
                            <label for="editor3" class="form-label fw-bold"><?php echo lang('profile'); ?></label>
                            <textarea class="form-control ckeditor" id="editor3" name="profile" rows="6"></textarea>
                        </div>
                        <input type="hidden" name="id" value=''>

                        <div class="form-group col-md-12">
                            <button type="button" class="btn btn-light" data-dismiss="modal"><?php echo lang('close'); ?></button>
                            <button type="submit" name="submit" class="btn btn-primary float-right"><?php echo lang('submit'); ?></button>
                        </div>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Edit Doctor Modal-->

<!-- Info Modal -->
<div class="modal fade" id="infoModal" tabindex="-1" role="dialog" aria-labelledby="infoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title" id="infoModalLabel"><?php echo lang('doctor'); ?> <?php echo lang('info'); ?></h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-4 text-center">
                        <img src="" id="img1" alt="" class="img-fluid doctor-modal-img mb-3">
                    </div>
                    <div class="col-md-8">
                        <h4 class="nameClass doctor-modal-name"></h4>
                        <p class="doctor-modal-department departmentClass"></p>
                        <hr>
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong><?php echo lang('email'); ?>:</strong> <span class="emailClass"></span></p>
                                <p><strong><?php echo lang('phone'); ?>:</strong> <span class="phoneClass"></span></p>
                            </div>
                            <div class="col-md-6">
                                <p><strong><?php echo lang('address'); ?>:</strong> <span class="addressClass"></span></p>
                            </div>
                        </div>
                        <hr>
                        <h5><?php echo lang('profile'); ?></h5>
                        <div class="profileClass mt-2"></div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo lang('close'); ?></button>
            </div>
        </div>
    </div>
</div>

<!-- Doctor Card Template (Hidden, used for JS cloning) -->
<div id="doctorCardTemplate" class="d-none">
    <div class="doctor-card card">
        <div class="doctor-img-container">
            <img src="" alt="Doctor" class="doctor-img">
        </div>
        <div class="card-body">
            <h5 class="doctor-name"></h5>
            <p class="doctor-department"></p>
            <div class="doctor-info">
                <p class="doctor-email"></p>
                <p class="doctor-phone"></p>
            </div>
            <div class="d-flex justify-content-between mt-3">
                <button class="btn btn-outline-info btn-sm info-btn">
                    <i class="fa fa-info-circle"></i> Info
                </button>
                <button class="btn btn-outline-primary btn-sm edit-btn">
                    <i class="fa fa-edit"></i> Edit
                </button>
                <a class="btn btn-outline-danger btn-sm delete-doctor">
                    <i class="fa fa-trash"></i> Delete
                </a>
            </div>
        </div>
    </div>
</div>

<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript">
    var language = "<?php echo $this->language; ?>";
</script>
<script src="common/assets/tinymce/tinymce.min.js"></script>
<script src="common/extranal/js/doctor/doctor.js"></script>
<script src="common/extranal/js/doctor/doctor-custom.js"></script>