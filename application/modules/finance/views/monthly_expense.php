<!--sidebar end-->
<!--main content start-->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

<link href="common/extranal/css/finance/monthly_expense.css" rel="stylesheet">

<?php
$currently_processing_year = date('Y', $first_minute);
$next_year = $currently_processing_year + 1;
$previous_year = $currently_processing_year - 1;

// Initialize expense_values array before using it
$month_names = array();
$expense_values = array();
$total_amount = 0;

// Define direct month names
$month_display_names = array(
    1 => 'January',
    2 => 'February',
    3 => 'March',
    4 => 'April',
    5 => 'May',
    6 => 'June',
    7 => 'July',
    8 => 'August',
    9 => 'September',
    10 => 'October',
    11 => 'November',
    12 => 'December'
);

// Process expense data for all months
for ($month = 1; $month <= 12; $month++) {
    $time = mktime(12, 0, 0, $month, 1, $year);
    $month_names[] = $month_display_names[$month];
    
    if (!empty($all_expenses[date('m-Y', $time)])) {
        $amount = $all_expenses[date('m-Y', $time)];
    } else {
        $amount = 0;
    }
    
    $expense_values[] = $amount;
    $total_amount += $amount;
}

// Calculate highest expense month
$highest_expense = 0;
$highest_month = 0;

for ($i = 0; $i < count($expense_values); $i++) {
    if ($expense_values[$i] > $highest_expense) {
        $highest_expense = $expense_values[$i];
        $highest_month = $i + 1;
    }
}
?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>
                        <i class="fa fa-file-invoice-dollar"></i> <?php echo date('Y', $first_minute) . ' ' . lang('expense_report'); ?>
                        <?php if(isset($is_current_year) && $is_current_year): ?>
                            <span class="badge badge-expense year-badge"><?php echo lang('current_year'); ?></span>
                        <?php endif; ?>
                    </h1>
                    <p class="text-muted"><?php echo lang('hospital') . ' ' . lang('financial_overview'); ?></p>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="home"><?php echo lang('home') ?></a></li>
                        <li class="breadcrumb-item"><a href="finance/financialReport"><?php echo lang('financial_report') ?></a></li>
                        <li class="breadcrumb-item active"><?php echo lang('expense_report'); ?></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Summary Cards -->
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                    <div class="summary-card">
                        <div class="summary-card-icon">
                            <i class="fas fa-calculator"></i>
                        </div>
                        <div class="summary-card-title"><?php echo lang('total_expense'); ?></div>
                        <div class="summary-card-value total-expense animate-number"><?php echo $settings->currency; ?> <?php echo number_format(array_sum($expense_values), 2, '.', ','); ?></div>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                    <div class="summary-card">
                        <div class="summary-card-icon">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <div class="summary-card-title"><?php echo lang('average_monthly_expense'); ?></div>
                        <div class="summary-card-value average-expense animate-number"><?php echo $settings->currency; ?> <?php echo number_format(array_sum($expense_values) / 12, 2, '.', ','); ?></div>
                    </div>
                </div>
                
                <?php if ($highest_expense > 0): ?>
                <div class="col-lg-4 col-md-6 col-sm-12 mb-3">
                    <div class="summary-card">
                        <div class="summary-card-icon">
                            <i class="fas fa-exclamation-circle"></i>
                        </div>
                        <div class="summary-card-title"><?php echo lang('highest_expense_month'); ?></div>
                        <div class="summary-card-value">
                            <?php echo isset($highest_month) ? $month_display_names[$highest_month] : ''; ?>
                            <div class="small text-muted"><?php echo $settings->currency; ?> <?php echo number_format($highest_expense, 2, '.', ','); ?></div>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
            </div>

            <!-- Main content card -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-chart-bar mr-2"></i><?php echo date('Y', $first_minute) . ' ' . lang('expense_report'); ?>
                                <?php if(isset($is_current_year) && $is_current_year): ?>
                                    <span class="badge badge-expense ml-2"><?php echo lang('current_year'); ?></span>
                                <?php endif; ?>
                            </h3>
                            
                            <div class="d-flex flex-wrap gap-2 float-right no-print">
                                <?php if(!isset($is_current_year) || !$is_current_year): ?>
                                <a href="finance/monthlyExpense" class="btn btn-primary btn-sm mr-1">
                                    <i class="fa fa-calendar-day"></i> <?php echo lang('current_year'); ?>
                                </a>
                                <?php endif; ?>
                                
                                <a href="finance/monthlyExpense?year=<?php echo $previous_year; ?>" class="btn btn-outline-secondary btn-sm mr-1">
                                    <i class="fa fa-arrow-left"></i> <?php echo $previous_year; ?>
                                </a>
                                
                                <a href="finance/monthlyExpense?year=<?php echo $next_year; ?>" class="btn btn-outline-secondary btn-sm mr-1">
                                    <i class="fa fa-arrow-right"></i> <?php echo $next_year; ?>
                                </a>
                                
                                <button id="export-data" class="btn btn-info btn-sm mr-1">
                                    <i class="fa fa-file-export"></i> <?php echo lang('export'); ?>
                                </button>
                                
                                <button class="btn btn-secondary btn-sm btn-print">
                                    <i class="fa fa-print"></i> <?php echo lang('print'); ?>
                                </button>
                            </div>
                        </div>

                        <!-- /.card-header -->
                        <div class="card-body">
                            <?php if(isset($is_current_year) && $is_current_year): ?>
                            <div class="alert alert-info">
                                <i class="fa fa-info-circle"></i> <?php echo lang('showing_data_for'); ?> <strong><?php echo date('Y'); ?></strong>
                            </div>
                            <?php endif; ?>

                            <div id="expense-chart" class="chart-container"></div>
                            
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" id="editable-sample1">
                                    <thead>
                                        <tr>
                                            <th> <?php echo lang('month'); ?> </th>
                                            <th> <?php echo lang('expense'); ?> </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // We already processed the data above, just display it here
                                        for ($month = 1; $month <= 12; $month++) {
                                            $time = mktime(12, 0, 0, $month, 1, $year);
                                            
                                            // Check if this is the current month
                                            $is_current_month = (date('m Y') == date('m Y', $time));
                                            $row_class = $is_current_month ? 'current-month' : '';
                                            
                                            // Amount is already stored in the expense_values array
                                            $amount = $expense_values[$month - 1];
                                            
                                            // Check if this is the highest expense month
                                            $is_highest_month = ($month == $highest_month && $amount > 0);
                                            if ($is_highest_month) {
                                                $row_class .= ' high-expense';
                                            }
                                        ?>
                                            <tr class="<?php echo $row_class; ?>">
                                                <td>
                                                    <?php 
                                                    echo $month_display_names[$month]; 
                                                    if ($is_current_month) {
                                                        echo ' <span class="badge badge-expense">' . lang('current') . '</span>';
                                                    }
                                                    if ($is_highest_month) {
                                                        echo ' <i class="fas fa-exclamation-triangle text-warning ml-2" data-toggle="tooltip" title="' . lang('highest_expense') . '"></i>';
                                                    }
                                                    ?>
                                                </td>
                                                <td class="animate-number"><?php echo $settings->currency; ?> <?php echo number_format($amount, 2, '.', ','); ?></td>
                                            </tr>
                                        <?php } ?>

                                        <tr class="total_amount">
                                            <td><?php echo lang('total'); ?></td>
                                            <td class="animate-number"><?php echo $settings->currency; ?> <?php echo number_format($total_amount, 2, '.', ','); ?></td>
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
            
            <!-- Additional Analysis Section -->
            <div class="row mt-4">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-chart-pie mr-2"></i><?php echo lang('quarterly_breakdown'); ?>
                            </h3>
                        </div>
                        <div class="card-body">
                            <div id="quarterly-chart" style="height: 300px;"></div>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-chart-line mr-2"></i><?php echo lang('expense_trends'); ?>
                            </h3>
                        </div>
                        <div class="card-body">
                            <div id="trend-chart" style="height: 300px;"></div>
                        </div>
                    </div>
                </div>
            </div>
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
    var lang_expense = "<?php echo lang('expense'); ?>";
    var lang_for = "<?php echo lang('for'); ?>";
    var lang_month = "<?php echo lang('month'); ?>";
    var lang_export = "<?php echo lang('export'); ?>";
    var lang_quarterly_breakdown = "<?php echo lang('quarterly_breakdown'); ?>";
    var lang_expense_trends = "<?php echo lang('expense_trends'); ?>";
    var lang_first_quarter = "<?php echo lang('first_quarter'); ?>";
    var lang_second_quarter = "<?php echo lang('second_quarter'); ?>";
    var lang_third_quarter = "<?php echo lang('third_quarter'); ?>";
    var lang_fourth_quarter = "<?php echo lang('fourth_quarter'); ?>";
    var currency_symbol = "<?php echo $settings->currency; ?>";
    
    // Pass month names and expense data to JavaScript
    var chartMonths = <?php echo json_encode($month_names); ?>;
    var chartExpenses = <?php echo json_encode($expense_values); ?>;
    var yearValue = <?php echo date('Y', $first_minute); ?>;
    
    // Calculate quarterly data
    var q1Total = parseFloat(chartExpenses[0]) + parseFloat(chartExpenses[1]) + parseFloat(chartExpenses[2]);
    var q2Total = parseFloat(chartExpenses[3]) + parseFloat(chartExpenses[4]) + parseFloat(chartExpenses[5]);
    var q3Total = parseFloat(chartExpenses[6]) + parseFloat(chartExpenses[7]) + parseFloat(chartExpenses[8]);
    var q4Total = parseFloat(chartExpenses[9]) + parseFloat(chartExpenses[10]) + parseFloat(chartExpenses[11]);
    
    var quarterlyData = [q1Total, q2Total, q3Total, q4Total];
</script>

<script src="common/js/codearistos.min.js"></script>
<script src="common/extranal/js/finance/monthly_expense_report.js"></script>

</body>

</html>