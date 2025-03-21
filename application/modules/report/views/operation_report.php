<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?php echo lang('operation_report') ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="home"><?php echo lang('home') ?></a></li>
                        <li class="breadcrumb-item active"><?php echo lang('operation_report') ?></li>
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
                            <h3 class="card-title"><?php echo lang('All the Operation reports names and related informations'); ?></h3>
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
                            <table class="table table-bordered table-hover" id="editable-sample">
                                <thead>
                                    <tr>
                                        <th><?php echo lang('patient'); ?></th>
                                        <th><?php echo lang('description'); ?></th>
                                        <th><?php echo lang('doctor'); ?></th>
                                        <th><?php echo lang('date'); ?></th>
                                        <th class="no-print"><?php echo lang('options'); ?></th>
                                    </tr>
                                </thead>
                                <tbody>



                                    <?php foreach ($reports as $report) { ?>
                                        <tr class="">
                                            <td>
                                                <?php
                                                $patient = explode('*', $report->patient);
                                                if (!empty($patient)) {
                                                    echo $this->patient_model->getPatientById($patient[0])->name;
                                                }
                                                ?>
                                            </td>
                                            <td> <?php echo $report->description; ?></td>
                                            <td>
                                                <?php
                                                if (!empty($report->doctor)) {
                                                    echo $this->doctor_model->getDoctorById($report->doctor)->name;
                                                }
                                                ?>
                                            </td>
                                            <td class="center"><?php echo $report->date; ?></td>
                                            <td class="no-print">
                                                <button type="button" class="btn btn-info btn-sm editbutton" title="<?php echo lang('edit'); ?>" data-toggle="modal" data-id="<?php echo $report->id; ?>"><i class="fa fa-edit"></i> </button>
                                                <a class="btn btn-danger btn-sm" href="report/delete?id=<?php echo $report->id; ?>" title="<?php echo lang('delete'); ?>" onclick="return confirm('Are you sure you want to delete this item?');"><i class="fa fa-trash"></i> </a>
                                            </td>
                                        </tr>
                                    <?php } ?>


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








<!-- Add Accountant Modal-->
<div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"> <?php echo lang('add_new_report'); ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form role="form" action="report/addReport" class="clearfix" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('select_type'); ?> &ast;</label>
                        <select class="form-control m-bot15" name="type" value='' required="">
                            <option value="birth" <?php
                                                    if (!empty($report->report_type)) {
                                                        if ($report->report_type == 'birth') {
                                                            echo 'selected';
                                                        }
                                                    }
                                                    ?>><?php echo lang('birth'); ?></option>
                            <option value="operation" <?php
                                                        if (!empty($report->report_type)) {
                                                            if ($report->report_type == 'operation') {
                                                                echo 'selected';
                                                            }
                                                        }
                                                        ?>><?php echo lang('operation'); ?></option>
                            <option value="expire" <?php
                                                    if (!empty($report->report_type)) {
                                                        if ($report->report_type == 'expire') {
                                                            echo 'selected';
                                                        }
                                                    }
                                                    ?>><?php echo lang('expire'); ?></option>
                        </select>
                    </div>
                    <div class="form-group">


                        <label for="exampleInputEmail1"><?php echo lang('description'); ?> &ast;</label>
                        <input type="text" class="form-control" name="description" id="editor" value='' placeholder="">

                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('patient'); ?> &ast;</label>
                        <select class="form-control m-bot15 js-example-basic-single" name="patient" value='' required="">
                            <?php foreach ($patients as $patient) { ?>
                                <option value="<?php echo $patient->id . '*' . $patient->ion_user_id; ?>" <?php
                                                                                                            if (!empty($report->patient)) {
                                                                                                                if (explode('*', $report->patient)[1] == $patient->ion_user_id) {
                                                                                                                    echo 'selected';
                                                                                                                }
                                                                                                            }
                                                                                                            ?>><?php echo $patient->name; ?> </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('doctor'); ?> &ast;</label>
                        <select class="form-control m-bot15 js-example-basic-single" name="doctor" value='' required="">
                            <?php foreach ($doctors as $doctor) { ?>
                                <option value="<?php echo $doctor->id; ?>" <?php
                                                                            if (!empty($report->doctor)) {
                                                                                if ($report->doctor == $doctor->name) {
                                                                                    echo 'selected';
                                                                                }
                                                                            }
                                                                            ?>><?php echo $doctor->name; ?> </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('date'); ?> &ast;</label>
                        <input class="form-control form-control-inline input-medium default-date-picker readonly" name="date" size="16" type="text" required="" value="" />

                    </div>
                    <input type="hidden" name="id" value=''>
                    <div class="">
                        <button type="submit" name="submit" class="btn btn-info float-right"><?php echo lang('submit'); ?></button>
                    </div>
                </form>

            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Add Accountant Modal-->







<!-- Edit Event Modal-->
<div class="modal fade" id="myModal2" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><?php echo lang('edit_operation_report'); ?></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form role="form" id="editReportForm" action="report/addReport" class="clearfix" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('select_type'); ?> &ast;</label>
                        <select class="form-control m-bot15" name="type" value='' required="">
                            <option value="birth" <?php
                                                    if (!empty($report->report_type)) {
                                                        if ($report->report_type == 'birth') {
                                                            echo 'selected';
                                                        }
                                                    }
                                                    ?>><?php echo lang('birth'); ?></option>
                            <option value="operation" <?php
                                                        if (!empty($report->report_type)) {
                                                            if ($report->report_type == 'operation') {
                                                                echo 'selected';
                                                            }
                                                        }
                                                        ?>><?php echo lang('operation'); ?></option>
                            <option value="expire" <?php
                                                    if (!empty($report->report_type)) {
                                                        if ($report->report_type == 'expire') {
                                                            echo 'selected';
                                                        }
                                                    }
                                                    ?>><?php echo lang('expire'); ?></option>
                        </select>
                    </div>
                    <div class="form-group">


                        <label for="exampleInputEmail1"><?php echo lang('description'); ?> &ast;</label>
                        <input type="text" class="form-control" name="description" id="editor1" value='' placeholder="">

                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('patient'); ?> &ast;</label>
                        <select class="form-control m-bot15 js-example-basic-single patient" name="patient" value='' required="">
                            <?php foreach ($patients as $patient) { ?>
                                <option value="<?php echo $patient->id . '*' . $patient->ion_user_id; ?>" <?php
                                                                                                            if (!empty($report->patient)) {
                                                                                                                if (explode('*', $report->patient)[1] == $patient->ion_user_id) {
                                                                                                                    echo 'selected';
                                                                                                                }
                                                                                                            }
                                                                                                            ?>><?php echo $patient->name; ?> </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('doctor'); ?> &ast;</label>
                        <select class="form-control m-bot15 js-example-basic-single doctor" name="doctor" value='' required="">
                            <?php foreach ($doctors as $doctor) { ?>
                                <option value="<?php echo $doctor->id; ?>" <?php
                                                                            if (!empty($report->doctor)) {
                                                                                if ($report->doctor == $doctor->name) {
                                                                                    echo 'selected';
                                                                                }
                                                                            }
                                                                            ?>><?php echo $doctor->name; ?> </option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1"><?php echo lang('date'); ?> &ast;</label>
                        <input class="form-control form-control-inline input-medium default-date-picker readonly" name="date" required="" size="16" type="text" value="" />

                    </div>
                    <input type="hidden" name="id" value=''>
                    <div class="">
                        <button type="submit" name="submit" class="btn btn-info float-right"><?php echo lang('submit'); ?></button>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>
<!-- Edit Event Modal-->

<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript">
    var language = "<?php echo $this->language; ?>";
</script>
<script src="common/assets/tinymce/tinymce.min.js"></script>
<script src="common/extranal/js/report/operation_report.js"></script>