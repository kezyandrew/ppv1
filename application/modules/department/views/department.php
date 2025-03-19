<!--sidebar end-->
<!--main content start-->

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="fw-bold"><?php echo lang('departments') ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="home"><?php echo lang('home') ?></a></li>
                        <li class="breadcrumb-item active"><?php echo lang('department') ?></li>
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
                            <h3 class="card-title"><?php echo lang('All the department names and related informations'); ?></h3>
                            <div class="card-tools">
                                <a data-toggle="modal" href="#myModal" class="btn-add-department">
                                    <button id="" class="btn btn-primary">
                                        <i class="fa fa-plus-circle me-1"></i> <?php echo lang('add_new'); ?>
                                    </button>
                                </a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover" id="editable-sample">
                                    <thead>
                                        <tr>
                                            <th class="fw-bold"> <?php echo lang('name') ?></th>
                                            <th class="fw-bold"> <?php echo lang('description') ?></th>
                                            <th class="no-print text-center fw-bold"> <?php echo lang('options') ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($departments as $department) { ?>
                                            <tr>
                                                <td class="fw-medium"><?php echo $department->name; ?></td>
                                                <td><?php echo $department->description; ?></td>
                                                <td class="no-print text-center">
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-outline-primary btn-sm editbutton me-1" data-toggle="modal" title="<?php echo lang('edit'); ?>" data-id="<?php echo $department->id; ?>">
                                                            <i class="fa fa-edit"></i>
                                                        </button>
                                                        <a class="btn btn-outline-success btn-sm me-1" title="<?php echo lang('doctor_directory'); ?>" href="department/doctorDirectory?id=<?php echo $department->id; ?>">
                                                            <i class="fa fa-users"></i>
                                                        </a>
                                                        <a class="btn btn-outline-danger btn-sm" title="<?php echo lang('delete'); ?>" href="department/delete?id=<?php echo $department->id; ?>" onclick="return confirm('Are you sure you want to delete this item?');">
                                                            <i class="fa fa-trash"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php } ?>
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

<!-- Add Department Modal-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="exampleModalLabel"><?php echo lang('add_department') ?></h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="department/addNew" method="post" enctype="multipart/form-data">
                    <div class="form-group mb-3">
                        <label for="department_name" class="form-label fw-bold"><?php echo lang('department') ?> <?php echo lang('name') ?> *</label>
                        <input type="text" class="form-control" id="department_name" name="name" value="" placeholder="Enter department name" required>
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label fw-bold"><?php echo lang('description') ?> *</label>
                        <textarea class="form-control" name="description" id="editor" rows="6"></textarea>
                    </div>
                    <input type="hidden" name="id" value="">
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-light me-2" data-dismiss="modal"><?php echo lang('close') ?></button>
                        <button type="submit" name="submit" class="btn btn-primary"><?php echo lang('submit') ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Department Modal-->
<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="exampleModalLabel2"><?php echo lang('edit_department') ?></h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="departmentEditForm" action="department/addNew" method="post" enctype="multipart/form-data">
                    <div class="form-group mb-3">
                        <label class="form-label fw-bold"><?php echo lang('department') ?> <?php echo lang('name') ?></label>
                        <input type="text" class="form-control" name="name" value="" required>
                    </div>
                    <div class="form-group mb-3">
                        <label class="form-label fw-bold"><?php echo lang('description') ?></label>
                        <textarea class="form-control" id="editor1" name="description" rows="6"></textarea>
                    </div>
                    <input type="hidden" name="id" value="">
                    <input type="hidden" name="p_id" value="">  
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-light me-2" data-dismiss="modal"><?php echo lang('close') ?></button>
                        <button type="submit" name="submit" class="btn btn-primary"><?php echo lang('submit') ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript">
    var language = "<?php echo $this->language; ?>";
</script>
<script src="common/assets/tinymce/tinymce.min.js"></script>
<script src="common/extranal/js/department.js"></script>
<link rel="stylesheet" href="common/assets/bootstrap5/css/department-custom.css"><?php /* Custom styling for departments module */ ?>

