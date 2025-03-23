<!--sidebar end-->
<!--main content start-->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<link href="common/extranal/css/finance/daily.css" rel="stylesheet">

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
                    <h1>
                        <i class="fa fa-money-bill-wave"></i> <?php echo date('F Y', $first_minute); ?>
                        <?php if(isset($is_current_month) && $is_current_month): ?>
                            <span class="badge badge-primary"><?php echo lang('current_month'); ?></span>
                        <?php endif; ?>
                    </h1>
                    <p class="text-muted"><?php echo lang('hospital') . ' ' . lang('sales_report'); ?></p>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="home"><?php echo lang('home') ?></a></li>
                        <li class="breadcrumb-item active"><?php echo lang('sales_report'); ?></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Summary Cards Row -->
            <div class="row" id="summary-cards">
                <!-- Main summary cards -->
                <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                    <div class="small-box bg-primary">
                        <div class="inner">
                            <h3><?php echo $settings->currency; ?> <span class="animate-number"><?php echo number_format($total_amount, 2, '.', ','); ?></span></h3>
                            <p><?php echo lang('total'); ?> <?php echo lang('for'); ?> <?php echo date('F', $first_minute); ?></p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-money-bill-wave"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3><?php echo $settings->currency; ?> <span class="animate-number"><?php echo number_format($average_per_day, 2, '.', ','); ?></span></h3>
                            <p><?php echo lang('average'); ?> <?php echo lang('per'); ?> <?php echo lang('day'); ?></p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3><?php echo $settings->currency; ?> <span class="animate-number"><?php echo number_format($highest_amount, 2, '.', ','); ?></span></h3>
                            <p><?php echo lang('highest_sales'); ?>: <?php echo date('F', $first_minute); ?> <?php echo $highest_day; ?></p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-trophy"></i>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center flex-wrap">
                                <h3 class="card-title">
                                    <i class="fas fa-calendar-alt mr-2"></i><?php echo date('F Y', $first_minute); ?>
                                    <?php if(isset($is_current_month) && $is_current_month): ?>
                                        <span class="badge badge-primary"><?php echo lang('current_month'); ?></span>
                                    <?php endif; ?>
                                </h3>

                                <div class="d-flex flex-wrap no-print">
                                    <?php if(!isset($is_current_month) || !$is_current_month): ?>
                                    <a href="finance/daily" class="btn btn-primary btn-sm mr-1">
                                        <i class="fa fa-calendar-day"></i> <?php echo lang('current_month'); ?>
                                    </a>
                                    <?php endif; ?>
                                    
                                    <a href="finance/daily?year=<?php echo $previous_year; ?>&month=<?php echo $previous_month; ?>" class="btn btn-outline-secondary btn-sm mr-1">
                                        <i class="fa fa-arrow-left"></i> <?php echo lang('previous'); ?>
                                    </a>
                                    
                                    <a href="finance/daily?year=<?php echo $next_year; ?>&month=<?php echo $next_month; ?>" class="btn btn-outline-secondary btn-sm mr-1">
                                        <i class="fa fa-arrow-right"></i> <?php echo lang('next'); ?>
                                    </a>
                                    
                                    <button id="export-data" class="btn btn-info btn-sm mr-1">
                                        <i class="fa fa-file-export"></i> <?php echo lang('export'); ?>
                                    </button>
                                    
                                    <button class="btn btn-secondary btn-sm btn-print">
                                        <i class="fa fa-print"></i> <?php echo lang('print'); ?>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <?php if(isset($is_current_month) && $is_current_month): ?>
                            <div class="alert alert-info">
                                <i class="fa fa-info-circle"></i> <?php echo lang('showing_data_for'); ?> <strong><?php echo date('F Y'); ?></strong>
                            </div>
                            <?php endif; ?>
                            
                            <?php if(isset($is_current_month) && $is_current_month): ?>
                            <div class="month-progress mb-4">
                                <h5><i class="fas fa-chart-line mr-2"></i><?php echo lang('month_progress'); ?></h5>
                                <div class="progress" id="month-progress-bar">
                                    <div class="progress-bar" role="progressbar" style="width: <?php echo ($days_in_month > 0) ? ($days_passed / $days_in_month * 100) : 0; ?>%" 
                                         aria-valuenow="<?php echo ($days_in_month > 0) ? ($days_passed / $days_in_month * 100) : 0; ?>" aria-valuemin="0" aria-valuemax="100">
                                        <?php echo ($days_in_month > 0) ? round(($days_passed / $days_in_month * 100)) : 0; ?>%
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between text-muted mt-2">
                                    <small>1 <?php echo lang('day'); ?></small>
                                    <small id="progress-text"><?php echo $days_passed; ?> / <?php echo $days_in_month; ?> <?php echo lang('days'); ?></small>
                                    <small><?php echo $days_in_month; ?> <?php echo lang('days'); ?></small>
                                </div>
                            </div>
                            <?php endif; ?>
                            
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" id="editable-sample1">
                                    <thead>
                                        <tr>
                                            <th width="40%"> <?php echo lang('date'); ?> </th>
                                            <th> <?php echo lang('amount'); ?> </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $number_of_days = date('t', $first_minute);
                                        $days_with_sales = 0;
                                        
                                        for ($d = 1; $d <= $number_of_days; $d++) {
                                            $time = mktime(12, 0, 0, $month, $d, $year);
                                            $day = date('d-m-y', $time);
                                            $weekday = date('l', $time);
                                            
                                            // Check if this is the current day
                                            $is_current_day = (date('d-m-Y') == date('d-m-Y', $time));
                                            $row_class = $is_current_day ? 'current-day' : '';
                                            
                                            // Check if it's a weekend
                                            if ($weekday == 'Saturday' || $weekday == 'Sunday') {
                                                $row_class .= ' weekend';
                                            }
                                            
                                            if (!empty($all_payments[date('D d-m-y', $time)])) {
                                                $amount = $all_payments[date('D d-m-y', $time)];
                                                $days_with_sales++;
                                            } else {
                                                $amount = 0;
                                            }
                                            
                                            // Check if this is the highest day
                                            $is_highest_day = ($d == $highest_day);
                                            if ($is_highest_day) {
                                                $row_class .= ' highlight-row';
                                            }
                                        ?>
                                            <tr class="<?php echo $row_class; ?>" data-day="<?php echo $d; ?>">
                                                <td>
                                                    <?php 
                                                    echo lang(strtolower($weekday)) . ', ' . date('d', $time);
                                                    if ($is_current_day) {
                                                        echo ' <span class="badge badge-primary">' . lang('today') . '</span>';
                                                    }
                                                    if ($is_highest_day) {
                                                        echo ' <i class="fas fa-trophy text-warning ml-2" title="' . lang('highest_sales') . '"></i>';
                                                    }
                                                    ?>
                                                </td>
                                                <td class="animate-number" data-amount="<?php echo $amount; ?>"><?php echo $settings->currency; ?> <?php echo number_format($amount, 2, '.', ','); ?></td>
                                            </tr>

                                        <?php
                                        }
                                        ?>

                                        <tr class="total_amount">
                                            <td><?php echo lang('total'); ?></td>
                                            <td class="animate-number" id="total-amount"><?php echo $settings->currency; ?> <?php echo number_format($total_amount, 2, '.', ','); ?></td>
                                        </tr>
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
        </div>
        <!-- /.container-fluid -->
    </section>

    <!-- /.content -->
</div>

<!--main content end-->

</section>

<!-- JavaScript language variables for translation -->
<script type="text/javascript">
    var lang_total = "<?php echo lang('total'); ?>";
    var lang_for = "<?php echo lang('for'); ?>";
    var lang_average = "<?php echo lang('average'); ?>";
    var lang_per = "<?php echo lang('per'); ?>";
    var lang_day = "<?php echo lang('day'); ?>";
    var lang_days = "<?php echo lang('days'); ?>";
    var lang_remaining = "<?php echo lang('remaining'); ?>";
    var lang_in = "<?php echo lang('in'); ?>";
    var lang_month = "<?php echo lang('month'); ?>";
    var lang_progress = "<?php echo lang('progress'); ?>";
    var lang_of = "<?php echo lang('of'); ?>";
    var lang_export = "<?php echo lang('export'); ?>";
    var lang_saturday = "<?php echo lang('saturday'); ?>";
    var lang_sunday = "<?php echo lang('sunday'); ?>";
    var lang_highest_sales = "<?php echo lang('highest_sales'); ?>";
    var currency_symbol = "<?php echo $settings->currency; ?>";
    var is_current_month = <?php echo (isset($is_current_month) && $is_current_month) ? 'true' : 'false'; ?>;
    var highest_day = <?php echo $highest_day ?: 0; ?>;
    var highest_amount = <?php echo $highest_amount ?: 0; ?>;
    var today_amount = <?php echo (isset($is_current_month) && $is_current_month && isset($all_payments[date('D d-m-y')])) ? $all_payments[date('D d-m-y')] : 0; ?>;
    var current_day = <?php echo date('j'); ?>;
    var days_in_month = <?php echo $days_in_month; ?>;
    var month_text = "<?php echo date('F', $first_minute); ?>";
    var year_text = "<?php echo date('Y', $first_minute); ?>";
    var total_amount = <?php echo $total_amount; ?>;
    var average_per_day = <?php echo $average_per_day; ?>;
</script>

<script src="common/js/codearistos.min.js"></script>
<script src="common/extranal/js/finance/daily_report.js"></script>

</body>

</html>