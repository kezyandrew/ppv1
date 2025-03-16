<!-- Add your custom CSS -->
<link href="common/extranal/css/doctor/doctor.css" rel="stylesheet">



<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?php echo lang('doctors') ?></h1>
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
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><?php echo lang('All the doctor names and related informations'); ?></h3>
                            <div class="float-right">
                                <a data-toggle="modal" href="#myModal">
                                    <button id="" class="btn btn-success btn-sm">
                                        <i class="fa fa-plus-circle"></i> <?php echo lang('add_new'); ?>
                                    </button>
                                </a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-hover datatables" id="editable-sample">
                                <thead>
                                    <tr>
                                        <th><?php echo lang('id'); ?></th>
                                        <th><?php echo lang('name'); ?></th>
                                        <th><?php echo lang('email'); ?></th>
                                        <th><?php echo lang('phone'); ?></th>
                                        <th><?php echo lang('department'); ?></th>
                                        <th><?php echo lang('profile'); ?></th>
                                        <th class="d-none d-md-table-cell"><?php echo lang('options'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>

    <!-- /.content -->
</div>










<!-- Add Doctor Modal-->
<div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"> <?php echo lang('add_new_doctor'); ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <form role="form" action="doctor/addNew" class="clearfix" method="post" enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1"><?php echo lang('name'); ?> &ast; </label>
                            <input type="text" class="form-control" name="name" value='' placeholder="" required="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1"><?php echo lang('email'); ?> &ast; </label>
                            <input type="text" class="form-control" name="email" value='' placeholder="" required="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1"><?php echo lang('password'); ?> &ast; </label>
                            <input type="password" class="form-control" name="password" placeholder="********" required="">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1"><?php echo lang('address'); ?> &ast; </label>
                            <input type="text" class="form-control" name="address" value='' placeholder="" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1"><?php echo lang('phone'); ?> &ast; </label>
                            <input type="text" class="form-control" name="phone" value='' placeholder="" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1"><?php echo lang('department'); ?></label>
                            <select class="form-control m-bot15 js-example-basic-single" name="department" value=''>
                                <?php foreach ($departments as $department) { ?>
                                    <option value="<?php echo $department->id; ?>"> <?php echo $department->name; ?> </option>
                                <?php } ?>
                            </select>
                        </div>




                        <!-- <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="signatureInput"><?php echo lang('signature'); ?> &ast;</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="signatureInput" name="signature">
                                    <label class="custom-file-label" for="signatureInput"><i class="fa fa-paper-clip"></i> <?php echo lang('select'); ?> <?php echo lang('signature'); ?></label>
                                </div>
                                <div class="img-thumbnail mt-3 img_class">
                                    <img src="" alt="" id="signaturePreview">
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="imageInput"><?php echo lang('profile'); ?> <?php echo lang('image'); ?></label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="imageInput" name="img_url">
                                    <label class="custom-file-label" for="imageInput"><i class="fa fa-paper-clip"></i> <?php echo lang('select_image'); ?></label>
                                </div>
                                <div class="img-thumbnail mt-3 img_class">
                                    <img src="" alt="" id="imagePreview">
                                </div>
                            </div>
                        </div> -->



                        <div class="col-md-12 row">
                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1"><?php echo lang('signature'); ?> &ast; </label>
                                <div class="">
                                    <div class="fileupload fileupload-new" data-provides="fileupload">
                                        <div class="fileupload-new thumbnail img_class fileupload-preview fileupload-exists thumbnail img_thumb">
                                            <img src="" height="100px" alt="" />
                                        </div>
                                        <div>
                                            <span class="btn btn-white btn-file">
                                                <span class="btn fileupload-new badge badge-secondary"><i class="fa fa-paper-clip"></i> <?php echo lang('select_image'); ?></span>
                                                <!-- <span class="fileupload-exists"><i class="fa fa-undo"></i> <?php echo lang('change'); ?></span> -->
                                                <input type="file" class="default" name="signature" />
                                            </span>
                                        </div>
                                    </div>

                                </div>

                            </div>
                            <div class="form-group last col-md-6">
                                <label class="control-label"><?php echo lang('image'); ?> </label>
                                <div class="">
                                    <div class="fileupload fileupload-new" data-provides="fileupload">
                                        <div class="fileupload-new thumbnail img_class fileupload-preview fileupload-exists thumbnail img_thumb">
                                            <img src="" height="100px" alt="" />
                                        </div>
                                        <div>
                                            <span class="btn btn-white btn-file">
                                                <span class="btn fileupload-new badge badge-secondary"><i class="fa fa-paper-clip"></i> <?php echo lang('select_image'); ?></span>
                                                <!-- <span class="fileupload-exists"><i class="fa fa-undo"></i> <?php echo lang('change'); ?></span> -->
                                                <input type="file" class="default" name="img_url" />
                                            </span>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="form-group col-md-12 profile">
                            <label for="exampleInputEmail1"><?php echo lang('doctor'); ?> <?php echo lang('description'); ?></label>
                            <textarea class="form-control ckeditor" id="editor1" name="profile" value="" rows="50" cols="20"></textarea>
                            <!-- <input type="hidden" name="profile" id="profile" value=""> -->
                        </div>

                        <div class="form-group col-md-12">
                            <button type="submit" name="submit" class="btn btn-info float-right"><?php echo lang('submit'); ?></button>
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
            <div class="modal-header">
                <h4 class="modal-title"> <?php echo lang('edit_doctor'); ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form role="form" id="editDoctorForm" class="clearfix" action="doctor/addNew" method="post" enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1"><?php echo lang('name'); ?> &ast;</label>
                            <input type="text" class="form-control" name="name" value='' placeholder="" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1"><?php echo lang('email'); ?> &ast;</label>
                            <input type="text" class="form-control" name="email" value='' placeholder="" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1"><?php echo lang('password'); ?></label>
                            <input type="password" class="form-control" name="password" placeholder="********">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1"><?php echo lang('address'); ?> &ast;</label>
                            <input type="text" class="form-control" name="address" value='' placeholder="" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1"><?php echo lang('phone'); ?> &ast;</label>
                            <input type="text" class="form-control" name="phone" value='' placeholder="" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1"><?php echo lang('department'); ?></label>
                            <select class="form-control m-bot15 js-example-basic-single department" name="department" value=''>
                                <?php foreach ($departments as $department) { ?>
                                    <option value="<?php echo $department->id; ?>" <?php
                                                                                    if (!empty($doctor->department)) {
                                                                                        if ($department->id == $doctor->department) {
                                                                                            echo 'selected';
                                                                                        }
                                                                                    }
                                                                                    ?>> <?php echo $department->name; ?> </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="col-md-12 row">
                            <div class="form-group col-md-6">
                                <label for="exampleInputEmail1"><?php echo lang('signature'); ?> &ast; </label>
                                <div class="">
                                    <div class="fileupload fileupload-new" data-provides="fileupload">
                                        <div class="fileupload-new thumbnail img_class fileupload-preview fileupload-exists thumbnail img_thumb">
                                            <img src="" id="signature" height="100px" alt="" />
                                        </div>
                                        <div>
                                            <span class="btn btn-white btn-file">
                                                <span class="btn fileupload-new badge badge-secondary"><i class="fa fa-paper-clip"></i> <?php echo lang('select_image'); ?></span>
                                                <!-- <span class="fileupload-exists"><i class="fa fa-undo"></i> <?php echo lang('change'); ?></span> -->
                                                <input type="file" class="default" name="signature" />
                                            </span>
                                        </div>
                                    </div>

                                </div>

                            </div>
                            <div class="form-group last col-md-6">
                                <label class="control-label"><?php echo lang('image'); ?> </label>
                                <div class="">
                                    <div class="fileupload fileupload-new" data-provides="fileupload">
                                        <div class="fileupload-new thumbnail img_class fileupload-preview fileupload-exists thumbnail img_thumb">
                                            <img src="" id="img" height="100px" alt="" />
                                        </div>
                                        <div>
                                            <span class="btn btn-white btn-file">
                                                <span class="btn fileupload-new badge badge-secondary"><i class="fa fa-paper-clip"></i> <?php echo lang('select_image'); ?></span>
                                                <!-- <span class="fileupload-exists"><i class="fa fa-undo"></i> <?php echo lang('change'); ?></span> -->
                                                <input type="file" class="default" name="img_url" />
                                            </span>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="form-group col-md-12 profile1">
                            <label for="exampleInputEmail1"><?php echo lang('doctor'); ?> <?php echo lang('description'); ?></label>
                            <textarea class="form-control" id="editor3" name="profile" value="" rows="50" cols="20"></textarea>
                            <!-- <input type="hidden" name="profile" id="profile1" value=""> -->
                        </div>
                        <input type="hidden" name="id" id="id_value" value=''>
                        <div class="form-group col-md-12">
                            <button type="submit" name="submit" class="btn btn-info float-right"><?php echo lang('submit'); ?></button>
                        </div>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Edit Doctor Modal-->



<div class="modal fade" id="infoModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"> <?php echo lang('doctor'); ?> <?php echo lang('info'); ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                    <div class="form-row">
                        <div class="form-group last col-md-6">
                            <div class="">
                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                    <div class="fileupload-new thumbnail img_class">
                                        <img height="100px" src="" id="img1" alt="" />
                                    </div>
                                    <div class="fileupload-preview fileupload-exists thumbnail img_url"></div>
                                </div>

                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1"><?php echo lang('name'); ?></label>
                            <div class="nameClass"></div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1"><?php echo lang('email'); ?></label>
                            <div class="emailClass"></div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1"><?php echo lang('address'); ?></label>
                            <div class="addressClass"></div>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1"><?php echo lang('phone'); ?></label>
                            <div class="phoneClass"></div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1"><?php echo lang('department'); ?></label>
                            <div class="departmentClass"></div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1"><?php echo lang('profile'); ?></label>
                            <div class="profileClass"></div>
                        </div>
                    </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>


<style>
    .mr-1 {
        margin-bottom: 5px;
    }
</style>



<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript">
    var language = "<?php echo $this->language; ?>";
</script>
<script src="common/assets/tinymce/tinymce.min.js"></script>
<script src="common/extranal/js/doctor/doctor.js"></script>