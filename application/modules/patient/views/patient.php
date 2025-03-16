

<link href="common/extranal/css/patient/medical_history.css" rel="stylesheet">

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?php echo lang('patient'); ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="home"> <?php echo lang('home'); ?></a></li>
                        <li class="breadcrumb-item active"> <?php echo lang('patient'); ?></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-8">
                                    <h3 class="card-title"><?php echo lang('Complete directory of patients and their associated details'); ?></h3>
                                </div>
                                <div class="col-md-4 text-right d-print-none">
                                    <a data-toggle="modal" href="#myModal">
                                        <button id="" class="btn btn-success btn-sm">
                                            <i class="fa fa-plus-circle"></i> <?php echo lang('add_new'); ?>
                                        </button>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body">

                            <table class="table table-bordered table-hover datatables" id="editable-sample">
                                <thead>
                                    <tr>
                                        <th><?php echo lang('patient_id'); ?></th>
                                        <th><?php echo lang('name'); ?></th>
                                        <th><?php echo lang('phone'); ?></th>
                                        <?php if ($this->ion_auth->in_group(array('admin', 'Accountant', 'Receptionist'))) { ?>
                                            <th><?php echo lang('due_balance'); ?></th>
                                        <?php } ?>
                                        <th class="no-print"><?php echo lang('options'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>

                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->


                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
</div>






<!-- Add Patient Modal-->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel"><?php echo lang('register_new_patient'); ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="patient/addNew" method="post" enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="name"><?php echo lang('name'); ?> *</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email"><?php echo lang('email'); ?> *</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="password"><?php echo lang('password'); ?> *</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="address"><?php echo lang('address'); ?> *</label>
                            <input type="text" class="form-control" id="address" name="address" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="phone"><?php echo lang('phone'); ?> *</label>
                            <input type="number" class="form-control" id="phone" name="phone" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="sex"><?php echo lang('sex'); ?></label>
                            <select class="form-control" id="sex" name="sex">
                                <option value="Male"><?php echo lang('male'); ?></option>
                                <option value="Female"><?php echo lang('female'); ?></option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="birthdate"><?php echo lang('birth_date'); ?></label>
                            <input type="text" class="form-control default-date-picker" id="birthdate" name="birthdate">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="age"><?php echo lang('age'); ?></label>
                            <input type="number" class="form-control" id="age" name="age">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1"><?php echo lang('blood_group'); ?></label>
                            <select class="form-control m-bot15" name="bloodgroup" value=''>
                                <option></option>
                                <?php foreach ($groups as $group) { ?>
                                    <option value="<?php echo $group->group; ?>" <?php
                                                                                    if (!empty($patient->bloodgroup)) {
                                                                                        if ($group->group == $patient->bloodgroup) {
                                                                                            echo 'selected';
                                                                                        }
                                                                                    }
                                                                                    ?>> <?php echo $group->group; ?> </option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1"><?php echo lang('doctor'); ?></label>
                            <select class="form-control m-bot15" id="doctorchoose1" name="doctor" value=''>

                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <!-- <label for="img_url"><?php echo lang('image'); ?></label>
                            <input type="file" class="form-control fileinput-button" id="img_url" name="img_url"> -->
                            <div class="form-group mt-3">
                                <label for="sms"><?php echo lang('send_sms'); ?></label>
                                <input type="checkbox" id="sms" name="sms">
                            </div>
                        </div>



                        <div class="form-group col-md-6">
                            <label class="control-label"><?php echo lang('image'); ?></label>
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
                    <button type="submit" class="btn btn-primary float-right"><?php echo lang('submit'); ?></button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Add Patient Modal-->







<!-- Edit Patient Modal-->

<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel"><?php echo lang('edit_patient'); ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form role="form" id="editPatientForm" action="patient/addNew" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1"><?php echo lang('name'); ?> &ast;</label>
                            <input type="text" class="form-control" name="name" value='' required>
                        </div>



                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1"><?php echo lang('email'); ?></label>
                            <input type="email" class="form-control" name="email" value='' placeholder="" required="">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1"><?php echo lang('change'); ?><?php echo lang('password'); ?></label>
                            <input type="password" class="form-control" name="password" placeholder="" autocomplete="off">
                        </div>



                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1"><?php echo lang('address'); ?> &ast;</label>
                            <input type="text" class="form-control" name="address" value='' placeholder="" required="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1"><?php echo lang('phone'); ?> &ast;</label>
                            <input type="text" class="form-control" name="phone" value='' placeholder="" required="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1"><?php echo lang('sex'); ?></label>
                            <select class="form-control m-bot15" name="sex" value=''>

                                <option value="Male" <?php
                                                        if (!empty($patient->sex)) {
                                                            if ($patient->sex == 'Male') {
                                                                echo 'selected';
                                                            }
                                                        }
                                                        ?>> <?php echo lang('male'); ?> </option>
                                <option value="Female" <?php
                                                        if (!empty($patient->sex)) {
                                                            if ($patient->sex == 'Female') {
                                                                echo 'selected';
                                                            }
                                                        }
                                                        ?>> <?php echo lang('female'); ?> </option>
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label><?php echo lang('birth_date'); ?> &ast;</label>
                            <input class="form-control form-control-inline input-medium default-date-picker" type="text" name="birthdate" value="" placeholder="" onkeypress="return false;">
                        </div>
                        <div class="form-group col-md-6">
                            <div class="">
                                <label><?php echo lang('age'); ?></label>

                            </div>
                            <div class="">
                                <div class="input-group m-bot15">
                                    <input type="number" min="0" max="150" class="form-control" name="years" value='' placeholder="<?php echo lang('years'); ?>">
                                    <span class="input-group-addon"><?php echo lang('y'); ?></span>
                                    <input type="number" class="form-control input-group-addon" min="0" max="12" name="months" value='' placeholder="<?php echo lang('months'); ?>">
                                    <span class="input-group-addon"><?php echo lang('m'); ?></span>
                                    <input type="number" class="form-control input-group-addon" name="days" min="0" max="29" value='' placeholder="<?php echo lang('days'); ?>">
                                    <span class="input-group-addon"><?php echo lang('d'); ?></span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1"><?php echo lang('blood_group'); ?></label>
                            <select class="form-control m-bot15" name="bloodgroup" value=''>
                                <option></option>
                                <?php foreach ($groups as $group) { ?>
                                    <option value="<?php echo $group->group; ?>" <?php
                                                                                    if (!empty($patient->bloodgroup)) {
                                                                                        if ($group->group == $patient->bloodgroup) {
                                                                                            echo 'selected';
                                                                                        }
                                                                                    }
                                                                                    ?>> <?php echo $group->group; ?> </option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1"><?php echo lang('doctor'); ?></label>
                            <select class="form-control m-bot15" id="doctorchoose" name="doctor" value=''>

                            </select>
                        </div>



                        <div class="form-group col-md-6">
                            <label class="control-label"><?php echo lang('image'); ?></label>
                            <div class="">
                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                    <div class="fileupload-new thumbnail img_class fileupload-preview fileupload-exists thumbnail img_thumb">
                                        <img src="" height="100px" id="img" alt="" />
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


                        <div class="form-group col-md-6">
                            <input type="checkbox" name="sms" value="sms"> <?php echo lang('send_sms') ?><br>
                        </div>

                        <input type="hidden" name="id" value=''>
                        <input type="hidden" name="p_id" value='<?php
                                                                if (!empty($patient->patient_id)) {
                                                                    echo $patient->patient_id;
                                                                }
                                                                ?>'>



                        <div class="form-group col-md-12">
                            <button type="submit" name="submit" class="btn btn-info float-right"><?php echo lang('submit'); ?></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Patient Modal-->














<div class="modal fade" id="infoModal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modalLabel"><?php echo lang('patient'); ?> <?php echo lang('info'); ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body row">
                <form role="form" action="patient/addNew" class="form-horizontal" method="post" enctype="multipart/form-data">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label><?php echo lang('patient_id'); ?></label>
                                <div class="patientIdClass"></div>
                            </div>

                            <div class="form-group col-md-4">
                                <label><?php echo lang('name'); ?></label>
                                <div class="nameClass"></div>
                            </div>

                            <div class="form-group col-md-4">
                                <label><?php echo lang('email'); ?></label>
                                <div class="emailClass"></div>
                            </div>

                            <div class="form-group col-md-4">
                                <label><?php echo lang('age'); ?></label>
                                <div class="ageClass"></div>
                            </div>

                            <div class="form-group col-md-4">
                                <label><?php echo lang('address'); ?></label>
                                <div class="addressClass"></div>
                            </div>

                            <div class="form-group col-md-4">
                                <label><?php echo lang('gender'); ?></label>
                                <div class="genderClass"></div>
                            </div>

                            <div class="form-group col-md-4">
                                <label><?php echo lang('phone'); ?></label>
                                <div class="phoneClass"></div>
                            </div>

                            <div class="form-group col-md-4">
                                <label><?php echo lang('blood_group'); ?></label>
                                <div class="bloodgroupClass"></div>
                            </div>

                            <div class="form-group col-md-4">
                                <label><?php echo lang('birth_date'); ?></label>
                                <div class="birthdateClass"></div>
                            </div>

                            <div class="form-group col-md-4">
                                <label><?php echo lang('doctor'); ?></label>
                                <div class="doctorClass"></div>
                            </div>

                            <!-- For image upload -->
                            <div class="form-group col-md-4">
                                <label for="img_url"><?php echo lang('image_upload'); ?></label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="img_url" name="img_url">
                                </div>
                                <div class="mt-2">
                                    <img src="" id="img1" class="img-thumbnail">
                                </div>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>




<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript">
    var select_doctor = "<?php echo lang('select_doctor'); ?>";
</script>
<script type="text/javascript">
    var language = "<?php echo $this->language; ?>";
</script>

<script src="common/extranal/js/patient/patient.js"></script>


<!-- <script>
    function openNewWindow() {
        window.open('https://codearistos.net/dev/hmz/v2/patient/medicalHistory?id=24', '_blank', 'toolbar=yes,scrollbars=yes,resizable=yes,top=500,left=300,width=1000,height=600');
    }
</script> -->