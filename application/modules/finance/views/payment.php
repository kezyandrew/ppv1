<!-- CSS for modernized UI -->
<link href="common/extranal/css/finance/payment.css" rel="stylesheet">

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-primary"><?php echo lang('payments') ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="home"><?php echo lang('home') ?></a></li>
                        <li class="breadcrumb-item active"><?php echo lang('payments') ?></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card card-outline card-primary shadow-lg">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-money-bill-wave me-2"></i><?php echo lang('List of Payments from OPD, IPD, and Appointments'); ?>
                            </h3>
                            <div class="card-tools">
                                <a href="finance/addPaymentView" class="btn btn-primary btn-sm">
                                    <i class="fas fa-plus-circle"></i> <?php echo lang('add_new'); ?>
                                </a>
                            </div>
                        </div>
                        
                        <div class="card-body">
                            <div class="row mb-4">
                                <div class="col-md-6 offset-md-6">
                                    <div class="input-group date-filter">
                                        <input type="text" class="form-control form-control-sm default-date-picker" name="date_from" id="date_from" value="" placeholder="<?php echo lang('date_from'); ?>" readonly>
                                        <span class="input-group-text"><i class="fas fa-arrow-right"></i></span>
                                        <input type="text" class="form-control form-control-sm default-date-picker" name="date_to" id="date_to" value="" placeholder="<?php echo lang('date_to'); ?>" readonly>
                                        <button class="btn btn-outline-primary btn-sm" id="date_filter_btn">
                                            <i class="fas fa-filter"></i> <?php echo lang('filter'); ?>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped table-hover" id="editable-sample3">
                                    <thead>
                                        <tr>
                                            <th><?php echo lang('invoice_id'); ?></th>
                                            <th style="width: 15%"><?php echo lang('patient'); ?></th>
                                            <th><?php echo lang('doctor'); ?></th>
                                            <th><?php echo lang('date'); ?></th>
                                            <th><?php echo lang('from'); ?></th>
                                            <th><?php echo lang('sub_total'); ?></th>
                                            <th><?php echo lang('vat'); ?></th>
                                            <th><?php echo lang('discount'); ?></th>
                                            <th><?php echo lang('grand_total'); ?></th>
                                            <th><?php echo lang('paid'); ?> <?php echo lang('amount'); ?></th>
                                            <th><?php echo lang('due'); ?></th>
                                            <th><?php echo lang('remarks'); ?></th>
                                            <th class="no-print text-center"><?php echo lang('options'); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- Payments will be loaded dynamically -->
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Edit Payment Modal -->
<div class="modal fade" id="editPaymentModal" tabindex="-1" role="dialog" aria-labelledby="editPaymentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="editPaymentModalLabel"><i class="fas fa-edit me-2"></i><?php echo lang('edit_payment'); ?></h5>
                <button type="button" class="btn-close bg-white" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- The edit payment form will be loaded here via AJAX -->
            </div>
        </div>
    </div>
</div>

<!-- Delete Payment Confirmation Modal -->
<div class="modal fade" id="deletePaymentModal" tabindex="-1" role="dialog" aria-labelledby="deletePaymentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="deletePaymentModalLabel"><i class="fas fa-trash-alt me-2"></i><?php echo lang('delete_payment'); ?></h5>
                <button type="button" class="btn-close bg-white" data-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><?php echo lang('are_you_sure_you_want_to_delete_this_payment'); ?></p>
                <div class="d-flex justify-content-end">
                    <button type="button" class="btn btn-secondary me-2" data-dismiss="modal"><?php echo lang('cancel'); ?></button>
                    <button type="button" class="btn btn-danger" id="confirmDeletePayment"><?php echo lang('delete'); ?></button>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="common/js/codearistos.min.js"></script>
<script type="text/javascript">
    var language = "<?php echo $this->language; ?>";
</script>
<script src="common/extranal/js/finance/payments.js"></script>
<script>
    $(document).ready(function() {
        $('#date_from').on('change', function() {
            var date_from = $(this).val();
            var date_to = $('#date_to').val();
            var date_from_split = date_from.split('-');
            var date_from_new = date_from_split[1] + '/' + date_from_split[0] + '/' + date_from_split[2]
            if (date_to != '' || date_to != null) {
                var date_to_split = date_to.split('-');
                var date_to_new = date_to_split[1] + '/' + date_to_split[0] + '/' + date_to_split[2];
            }
            if (date_to != '' || date_to != null) {
                if (Date.parse(date_to_new) <= Date.parse(date_from_new)) {
                    toastr.warning('<?php echo lang("select_a_valid_date_end_date_should_be_greater_than_start_date"); ?>');
                    $(this).val("");
                } else {
                    $('#editable-sample3').DataTable().destroy().clear();
                    "use strict";
                    var table = $('#editable-sample3').DataTable({
                        responsive: true,
                        "processing": true,
                        "serverSide": true,
                        "searchable": true,
                        "ajax": {
                            url: "finance/getPayment?start_date=" + date_from + "&end_date=" + date_to,
                            type: 'POST',
                        },
                        scroller: {
                            loadingIndicator: true
                        },
                        dom: "<'row mb-1'<'col-md-3'l><'col-sm-5 text-center'B><'col-sm-4'f>>" +
                            "<'row'<'col-sm-12'tr>>" +
                            "<'row'<'col-sm-5'i><'col-sm-7'p>>",

                        buttons: [{
                                extend: 'copyHtml5', className: 'btn-outline-primary btn-sm',
                                exportOptions: {
                                    columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11],
                                }
                            },
                            {
                                extend: 'excelHtml5', className: 'btn-outline-primary btn-sm',
                                exportOptions: {
                                    columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11],
                                }
                            },
                            {
                                extend: 'csvHtml5', className: 'btn-outline-primary btn-sm',
                                exportOptions: {
                                    columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11],
                                }
                            },
                            {
                                extend: 'pdfHtml5', className: 'btn-outline-primary btn-sm',
                                exportOptions: {
                                    columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11],
                                }
                            },
                            {
                                extend: 'print', className: 'btn-outline-primary btn-sm',
                                exportOptions: {
                                    columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11],
                                }
                            },
                        ],
                        aLengthMenu: [
                            [10, 25, 50, 100, -1],
                            [10, 25, 50, 100, "All"]
                        ],
                        iDisplayLength: 100,

                        "order": [
                            [0, "desc"]
                        ],

                        "language": {
                            "lengthMenu": "_MENU_",
                            search: "_INPUT_",
                            "url": "common/assets/DataTables/languages/" + language + ".json"
                        }
                    });
                    table.buttons().container().appendTo('.custom_buttons');
                }
            }
        });

        $('#date_to').on('change', function() {
            var date_to = $(this).val();
            var date_from = $('#date_from').val();

            var date_to_split = date_to.split('-');
            var date_to_new = date_to_split[1] + '/' + date_to_split[0] + '/' + date_to_split[2];
            if (date_from != '' || date_from != null) {
                var date_from_split = date_from.split('-');
                var date_from_new = date_from_split[1] + '/' + date_from_split[0] + '/' + date_from_split[2];
            }
            if (date_from != '' || date_from != null) {
                if (Date.parse(date_to_new) <= Date.parse(date_from_new)) {
                    toastr.warning('<?php echo lang("select_a_valid_date_end_date_should_be_greater_than_start_date"); ?>');
                    $(this).val("");
                } else {
                    $('#editable-sample3').DataTable().destroy().clear();
                    "use strict";
                    var table = $('#editable-sample3').DataTable({
                        responsive: true,
                        "processing": true,
                        "serverSide": true,
                        "searchable": true,
                        "ajax": {
                            url: "finance/getPayment?start_date=" + date_from + "&end_date=" + date_to,
                            type: 'POST',
                        },
                        scroller: {
                            loadingIndicator: true
                        },
                        dom: "<'row mb-1'<'col-md-3'l><'col-sm-5 text-center'B><'col-sm-4'f>>" +
                            "<'row'<'col-sm-12'tr>>" +
                            "<'row'<'col-sm-5'i><'col-sm-7'p>>",
                        buttons: [{
                                extend: 'copyHtml5', className: 'btn-outline-primary btn-sm',
                                exportOptions: {
                                    columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11],
                                }
                            },
                            {
                                extend: 'excelHtml5', className: 'btn-outline-primary btn-sm',
                                exportOptions: {
                                    columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11],
                                }
                            },
                            {
                                extend: 'csvHtml5', className: 'btn-outline-primary btn-sm',
                                exportOptions: {
                                    columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11],
                                }
                            },
                            {
                                extend: 'pdfHtml5', className: 'btn-outline-primary btn-sm',
                                exportOptions: {
                                    columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11],
                                }
                            },
                            {
                                extend: 'print', className: 'btn-outline-primary btn-sm',
                                exportOptions: {
                                    columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11],
                                }
                            },
                        ],
                        aLengthMenu: [
                            [10, 25, 50, 100, -1],
                            [10, 25, 50, 100, "All"]
                        ],
                        iDisplayLength: 100,

                        "order": [
                            [0, "desc"]
                        ],

                        "language": {
                            "lengthMenu": "_MENU_",
                            search: "_INPUT_",
                            "url": "common/assets/DataTables/languages/" + language + ".json"
                        }
                    });
                    table.buttons().container().appendTo('.custom_buttons');
                }
            }
        });
    });
</script>