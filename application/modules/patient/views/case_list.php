<!--sidebar end-->
<!--main content start-->


<!-- <link href="common/extranal/css/patient/case_list.css" rel="stylesheet"> -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1> <?php echo lang('cases'); ?> / <?php echo lang('add'); ?> <?php echo lang('case'); ?> </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="home"><?php echo lang('home') ?></a></li>
                        <li class="breadcrumb-item"><a href="patient"><?php echo lang('patient') ?></a></li>
                        <li class="breadcrumb-item active"> <?php echo lang('add'); ?> <?php echo lang('case'); ?> </li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->


    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-4">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><?php echo lang('Add a new case'); ?></h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row"> <!-- Added row class here -->
                                <form role="form" action="patient/addMedicalHistory" class="clearfix w-100" method="post" enctype="multipart/form-data">
                                    <div class="row col-md-12">
                                        <div class="form-group col-md-6">
                                            <label for="exampleInputEmail1"><?php echo lang('date'); ?> &ast;</label>
                                            <input type="text" class="form-control default-date-picker" name="date" placeholder="" autocomplete="off" required="">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="exampleInputEmail1"><?php echo lang('patient'); ?> &ast;</label>
                                            <select class="form-control m-bot15" id="patientchoose" name="patient_id" required="">
                                            </select>
                                        </div>

                                        <div class="form-group col-md-12">
                                            <label for="exampleInputEmail1"><?php echo lang('title'); ?> &ast;</label>
                                            <input type="text" class="form-control" name="title" placeholder="" required="">
                                        </div>
                                        <div class="form-group col-md-12 no-print">
                                            <label><?php echo lang('case'); ?> &ast;</label>
                                            <textarea class="form-control ckeditor" name="description" id="editor1" rows="10"></textarea>
                                        </div>
                                        <input type="hidden" name="redirect" value='patient/caseList'>
                                        <section class="col-md-12 no-print">
                                            <button type="submit" name="submit" class="btn btn-info float-right"><?php echo lang('submit'); ?></button>
                                        </section>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <div class="col-8">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">All the previous cases</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-hover" id="editable-sample">
                                <thead>
                                    <tr>
                                        <th class="table_head"><?php echo lang('date'); ?></th>
                                        <th class="table_head1"><?php echo lang('patient'); ?></th>
                                        <th class="table_head1"><?php echo lang('case'); ?> <?php echo lang('title'); ?></th>
                                        <th class="table_head no-print"><?php echo lang('options'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Table data will go here -->
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













<!--main content end-->
<!--footer start-->






<!-- Add Case Modal-->
<div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"> <?php echo lang('add_medical_history'); ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body row">
                <form role="form" action="patient/addMedicalHistory" class="clearfix" method="post" enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1"><?php echo lang('date'); ?> &ast;</label>
                            <input type="text" class="form-control form-control-inline input-medium default-date-picker" name="date" value='' placeholder="" readonly="" required="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1"><?php echo lang('patient'); ?> &ast;</label>
                            <select class="form-control m-bot15 js-example-basic-single" name="patient_id" value='' required="">
                                <?php foreach ($patients as $patient) { ?>
                                    <option value="<?php echo $patient->id; ?>"> <?php echo $patient->name; ?> </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1"><?php echo lang('title'); ?> &ast;</label>
                            <input type="text" class="form-control form-control-inline input-medium" name="title" value='' placeholder="" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label class=""><?php echo lang('description'); ?> &ast;</label>
                            <textarea class="ckeditor form-control" name="description" value="" rows="10" required></textarea>
                        </div>
                        <input type="hidden" name="id" value=''>
                        <input type="hidden" name="redirect" value='patient/caseList'>
                        <section class="col-md-12">
                            <button type="submit" name="submit" class="btn btn-info submit_button float-right"> <?php echo lang('submit'); ?></button>
                        </section>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Add Case Modal-->

<!-- Edit Case Modal-->
<div class="modal fade" id="myModal2" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"> <?php echo lang('edit_medical_history'); ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body row">
                <form role="form" id="medical_historyEditForm" class="clearfix" action="patient/addMedicalHistory" method="post" enctype="multipart/form-data">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1"><?php echo lang('date'); ?> &ast;</label>
                            <input type="text" class="form-control form-control-inline input-medium default-date-picker" name="date" value='' placeholder="" required="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="exampleInputEmail1"><?php echo lang('patient'); ?> &ast;</label>
                            <select class="form-control m-bot15 patient" id="patientchoose1" name="patient_id" value='' required="">

                            </select>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="exampleInputEmail1"><?php echo lang('title'); ?> &ast;</label>
                            <input type="text" class="form-control form-control-inline input-medium" name="title" value='' placeholder="" required="">
                        </div>
                        <div class="form-group col-md-12">
                            <label class=""><?php echo lang('description'); ?> &ast;</label>
                            <div class="">
                                <textarea class="ckeditor form-control editor" id="editor" name="description" value="" rows="10"></textarea>
                            </div>
                        </div>
                        <input type="hidden" name="id" value=''>
                        <input type="hidden" name="redirect" value='patient/caseList'>
                        <div class="col-md-12 no-print">
                            <button type="submit" name="submit" class="btn btn-info submit_button float-right"><?php echo lang('submit'); ?></button>
                        </div>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>






<div class="modal fade" id="caseModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"> <?php echo lang('case'); ?> <?php echo lang('details'); ?></h4>
                <button type="button" class="close no-print" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body row">
                <form role="form" id="medical_historyEditForm" class="clearfix form-row" action="patient/addMedicalHistory" method="post" enctype="multipart/form-data">
                    <div class="form-group col-md-12 row">
                        <div class="form-group col-md-6 case_date_block">
                            <label for="exampleInputEmail1"><?php echo lang('case'); ?> <?php echo lang('creation'); ?> <?php echo lang('date'); ?></label>
                            <div class="case_date"></div>
                        </div>
                        <div class="form-group col-md-6 case_patient_block">
                            <label for="exampleInputEmail1"><?php echo lang('patient'); ?></label>
                            <div class="case_patient"></div>
                            <div class="case_patient_id"></div>
                        </div>
                        <div>
                            <hr>
                        </div>
                    </div>

                    <div class="form-group col-md-12">
                        <label for="exampleInputEmail1"><?php echo lang('title'); ?> </label>
                        <div class="case_title"></div>
                        <hr>
                    </div>
                    <div class="form-group col-md-12">
                        <label for="exampleInputEmail1"> <?php echo lang('details'); ?></label>
                        <div class="case_details"></div>
                        <hr>
                    </div>


                    <div class="col-md-9">
                        <h5 class="float-right">
                            <?php echo $settings->title . '<br>' . $settings->address; ?>
                        </h5>
                    </div>


                    <div class="col-md-3 no-print">
                        <a class="btn btn-info invoice_button float-right" onclick="javascript:window.print();"><i class="fa fa-print"></i> <?php echo lang('print'); ?> </a>
                    </div>

                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>

<style>
    @media print {

        /* Hide everything by default */
        body * {
            display: none;
        }

        /* Show only the modal and its content */
        .modal,
        .modal * {
            display: block !important;
            position: absolute;
            right: 0;
            left: 0;
            top: 0;
            bottom: 0;
        }
    }
</style>

<?php
$current_user = $this->ion_auth->get_user_id();
if ($this->ion_auth->in_group('Doctor')) {
    $doctor_id = $this->db->get_where('doctor', array('ion_user_id' => $current_user))->row()->id;
}
?>

<script src="common/js/codearistos.min.js"></script>
<script src="common/assets/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
    var select_patient = "<?php echo lang('select_patient'); ?>";
</script>
<script type="text/javascript">
    var language = "<?php echo $this->language; ?>";
</script>
<script src="common/extranal/js/patient/case_list.js"></script>