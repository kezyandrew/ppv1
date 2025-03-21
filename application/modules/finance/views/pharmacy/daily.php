<!--sidebar end-->
<!--main content start-->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<link href="common/extranal/css/pharmacy/daily.css" rel="stylesheet">
<?php
$currently_processing_month = date('m', $first_minute);
$currently_processing_year = date('Y', $first_minute);
if ($currently_processing_month < 12) {
    $next_month = $currently_processing_month + 1;
    $next_year = $currently_processing_year;
} else {
    $next_month = 1;
    $next_year = $currently_processing_year + 1;
}

if ($currently_processing_month > 1) {
    $previous_month = $currently_processing_month - 1;
    $previous_year = $currently_processing_year;
} else {
    $previous_month = 12;
    $previous_year = $currently_processing_year - 1;
}
?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><?php echo date('F, Y', $first_minute) . ' ' . lang('pharmacy') . ' ' . lang('sales_report'); ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="home"><?php echo lang('home') ?></a></li>
                        <li class="breadcrumb-item active"><?php echo date('F, Y', $first_minute) . ' ' . lang('pharmacy') . ' ' . lang('sales_report'); ?></li>
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
                            <h3 class="card-title"><?php echo lang('Pharmacy daily sales report for each month'); ?></h3>
                            <div class="float-right no-print mr-1">
                                <a class="btn btn-sm btn-secondary no-print float-right" onclick="javascript:window.print();"> <i class="fa fa-print"></i> </a>
                            </div>
                            <div class="float-right no-print mr-1">
                                <a href="finance/pharmacy/daily?year=<?php echo $next_year; ?>&month=<?php echo $next_month; ?>">
                                    <button title="<?php echo lang('next'); ?>" class="btn btn-success btn-sm">
                                        <?php echo lang('next'); ?> <?php echo lang('month'); ?> <i class="fa fa-arrow-right"></i>
                                    </button>
                                </a>
                            </div>
                            <div class="float-right no-print mr-1">
                                <a href="finance/pharmacy/daily?year=<?php echo $previous_year; ?>&month=<?php echo $previous_month; ?>">
                                    <button title="<?php echo lang('previous'); ?>" class="btn btn-warning btn-sm">
                                        <i class="fa fa-arrow-left"></i> <?php echo lang('previous'); ?> <?php echo lang('month'); ?>
                                    </button>
                                </a>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table class="table table-bordered table-hover" id="editable-sample">
                                <thead>
                                    <tr>
                                        <th> <?php echo lang('date'); ?> </th>
                                        <th> <?php echo lang('amount'); ?> </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $number_of_days = date('t', $first_minute);
                                    for ($d = 1; $d <= $number_of_days; $d++) {
                                        $time = mktime(12, 0, 0, $month, $d, $year);
                                        if (!empty($all_payments[date('D d-m-y', $time)])) {
                                            if (date('m', $time) == $month) {
                                                $day = date('d-m-y', $time);
                                                $weekday = date('l', $time);
                                                $amount = $all_payments[date('D d-m-y', $time)];
                                            }
                                        } else {
                                            if (date('m', $time) == $month) {
                                                $day = date('d-m-y', $time);
                                                $weekday = date('l', $time);
                                                $amount = 0;
                                            }
                                        }
                                    ?>
                                        <tr>
                                            <td><?php echo lang(strtolower($weekday)) . ', ' . $day; ?></td>
                                            <td><?php echo $this->currency; ?><?php echo number_format($amount, 2, '.', ','); ?></td>
                                            <?php $total_amount[] = $amount; ?>
                                        </tr>

                                    <?php
                                    }
                                    ?>

                                    <?php
                                    if (!empty($total_amount)) {
                                        $total_amount = array_sum($total_amount);
                                    } else {
                                        $total_amount = 0;
                                    }
                                    ?>

                                    <tr class="total_amount">
                                        <td><?php echo lang('total'); ?></td>
                                        <td><?php echo $this->currency; ?><?php echo number_format($total_amount, 2, '.', ','); ?></td>
                                    </tr>




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
<!--footer end-->

</section>

<!-- js placed at the end of the document so the pages load faster -->

<script src="common/js/codearistos.min.js"></script>

</body>

</html>