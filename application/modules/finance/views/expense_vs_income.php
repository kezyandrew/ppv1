<?php
/**
 * Expense vs Income Report View
 * This file provides a comprehensive view of income vs expense comparison
 */

// Get request parameters
$year = $this->input->get('year') ? $this->input->get('year') : date('Y');

// Calculate previous and next year
$prev_year = $year - 1;
$next_year = $year + 1;

// Prepare month data
$month_names = array();
$expense_data = array();
$income_data = array();

// Get language keys for months
for ($i = 1; $i <= 12; $i++) {
    $month_key = 'month_' . strtolower(date('F', mktime(0, 0, 0, $i, 10)));
    $month_names[$i] = lang($month_key);
}

// Initialize counters
$total_expense = 0;
$total_income = 0;
$highest_expense_month = '';
$highest_expense_amount = 0;
$highest_income_month = '';
$highest_income_amount = 0;

// Ensure we have a currency symbol to use
$currency_symbol = isset($settings) && isset($settings->currency_symbol) ? $settings->currency_symbol : '$';

// Process expense and income data
if (!empty($expenses)) {
    foreach ($expenses as $expense) {
        if (isset($expense->amount) && isset($expense->date)) {
            $month = intval(date('m', strtotime($expense->date)));
            if (!isset($expense_data[$month])) {
                $expense_data[$month] = 0;
            }
            $expense_data[$month] += $expense->amount;
            $total_expense += $expense->amount;
            
            // Track highest expense month
            if ($expense_data[$month] > $highest_expense_amount) {
                $highest_expense_amount = $expense_data[$month];
                $highest_expense_month = isset($month_names[$month]) ? $month_names[$month] : '';
            }
        }
    }
}

if (!empty($payments)) {
    foreach ($payments as $payment) {
        if (isset($payment->deposited_amount) && isset($payment->date)) {
            $month = intval(date('m', strtotime($payment->date)));
            if (!isset($income_data[$month])) {
                $income_data[$month] = 0;
            }
            $income_data[$month] += $payment->deposited_amount;
            $total_income += $payment->deposited_amount;
            
            // Track highest income month
            if (isset($income_data[$month]) && $income_data[$month] > $highest_income_amount) {
                $highest_income_amount = $income_data[$month];
                $highest_income_month = isset($month_names[$month]) ? $month_names[$month] : '';
            }
        }
    }
}

// Calculate profit/loss
$total_profit = $total_income - $total_expense;
$profit_status = $total_profit >= 0 ? 'profit' : 'loss';

// Prepare chart data
$chart_months = array();
$chart_incomes = array();
$chart_expenses = array();

for ($i = 1; $i <= 12; $i++) {
    $chart_months[] = $month_names[$i];
    $chart_incomes[] = isset($income_data[$i]) ? $income_data[$i] : 0;
    $chart_expenses[] = isset($expense_data[$i]) ? $expense_data[$i] : 0;
}

// Set targets and budget values for progress bars
$target_income = $total_income * 1.1; // 10% higher than current as a target
$budget_expense = $total_expense * 0.9; // 10% lower than current as a budget
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <base href="<?php echo base_url(); ?>">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo lang('expense_vs_income'); ?></title>
    <link rel="stylesheet" href="common/extranal/css/finance/expense_vs_income.css">
</head>
<body>
<!--main content start-->
<section id="main-content">
    <section class="wrapper">
        <!-- page start-->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
            <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                            <h1 class="m-0 text-dark"><?php echo lang('expense_vs_income_report'); ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="finance/financialReport"><?php echo lang('financial_report'); ?></a></li>
                                <li class="breadcrumb-item active"><?php echo lang('expense_vs_income'); ?></li>
                    </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.content-header -->

    <!-- Main content -->
            <div class="content">
        <div class="container-fluid">
                    <!-- Year selection and navigation - smaller compact version -->
            <div class="row">
                        <div class="col-lg-12">
                            <div class="card mb-2">
                                <div class="card-header py-2">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h5 class="card-title mb-0">
                                            <?php echo lang('financial_report_for'); ?> <?php echo $year; ?>
                                        </h5>
                                        <div class="year-selection">
                                            <a href="finance/expenseVsIncome?year=<?php echo $prev_year; ?>" class="btn btn-info btn-sm" id="prev-year">
                                                <i class="fa fa-chevron-left"></i> <?php echo $prev_year; ?>
                                            </a>
                                            <a href="finance/expenseVsIncome?year=<?php echo $next_year; ?>" class="btn btn-info btn-sm" id="next-year">
                                                <?php echo $next_year; ?> <i class="fa fa-chevron-right"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Summary Cards - without percentages -->
                            <div class="row">
                        <div class="col-lg-4 col-md-6">
                            <div class="small-box bg-success mb-2">
                                <div class="inner">
                                    <h3 class="animate-number"><?php echo $currency_symbol . number_format($total_income, 2); ?></h3>
                                    <p class="mb-0"><?php echo lang('total_income'); ?></p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-money-bill-wave"></i>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-4 col-md-6">
                            <div class="small-box bg-danger mb-2">
                                <div class="inner">
                                    <h3 class="animate-number"><?php echo $currency_symbol . number_format($total_expense, 2); ?></h3>
                                    <p class="mb-0"><?php echo lang('total_expense'); ?></p>
                                </div>
                                <div class="icon">
                                    <i class="fa fa-credit-card"></i>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-lg-4 col-md-6">
                            <div class="small-box <?php echo $profit_status === 'profit' ? 'bg-primary' : 'bg-warning'; ?> mb-2">
                                <div class="inner">
                                    <h3 class="animate-number"><?php echo $currency_symbol . number_format(abs($total_profit), 2); ?></h3>
                                    <p class="mb-0"><?php echo $profit_status === 'profit' ? lang('net_profit') : lang('net_loss'); ?></p>
                                </div>
                                <div class="icon">
                                    <i class="fa <?php echo $profit_status === 'profit' ? 'fa-chart-line' : 'fa-arrow-down'; ?>"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons - Centralized in a compact row -->
                    <div class="row">
                        <div class="col-12 mb-2 text-center">
                            <button class="btn btn-sm btn-outline-primary" id="print">
                                <i class="fa fa-print"></i> <?php echo lang('print'); ?>
                            </button>
                            <button class="btn btn-sm btn-outline-info" id="export-data">
                                <i class="fa fa-download"></i> <?php echo lang('export'); ?>
                            </button>
                        </div>
                    </div>

                    <!-- Monthly data table - more compact -->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="card-title mb-0"><?php echo lang('monthly_expense_income'); ?></h5>
                                </div>
                                <div class="card-body p-0">
                                    <div class="table-responsive">
                                        <table class="table table-sm table-striped table-bordered mb-0" id="expense_vs_income_table">
                                        <thead>
                                            <tr>
                                                    <th><?php echo lang('month'); ?></th>
                                                    <th class="text-right"><?php echo lang('income'); ?></th>
                                                    <th class="text-right"><?php echo lang('expense'); ?></th>
                                                    <th class="text-right"><?php echo lang('profit_loss'); ?></th>
                                                    <th class="text-center" style="width: 100px;"><?php echo lang('status'); ?></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                                <?php 
                                                $total_month_income = 0;
                                                $total_month_expense = 0;
                                                $total_month_profit = 0;
                                                
                                                for ($i = 1; $i <= 12; $i++): 
                                                    $month_income = isset($income_data[$i]) ? $income_data[$i] : 0;
                                                    $month_expense = isset($expense_data[$i]) ? $expense_data[$i] : 0;
                                                    $month_profit = $month_income - $month_expense;
                                                    $month_status = $month_profit >= 0 ? 'profit' : 'loss';
                                                    
                                                    $total_month_income += $month_income;
                                                    $total_month_expense += $month_expense;
                                                    $total_month_profit += $month_profit;
                                                    
                                                    $current_month = (date('n') == $i && date('Y') == $year);
                                                    $highest_income = ($month_income > 0 && $highest_income_amount > 0 && $month_income == $highest_income_amount);
                                                    $highest_expense = ($month_expense > 0 && $highest_expense_amount > 0 && $month_expense == $highest_expense_amount);
                                                    
                                                    $row_class = '';
                                                    if ($current_month) {
                                                        $row_class = 'table-primary';
                                                    } elseif ($highest_income && $highest_expense) {
                                                        $row_class = 'table-warning';
                                                    } elseif ($highest_income) {
                                                        $row_class = 'table-success';
                                                    } elseif ($highest_expense) {
                                                        $row_class = 'table-danger';
                                                    }
                                                ?>
                                                <tr class="<?php echo $row_class; ?>">
                                                    <td>
                                                        <?php echo isset($month_names[$i]) ? $month_names[$i] : ''; ?>
                                                        <?php if ($current_month): ?>
                                                            <span class="badge badge-primary"><?php echo lang('current'); ?></span>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td class="text-right">
                                                        <?php echo $currency_symbol . number_format($month_income, 2); ?>
                                                        <?php if ($highest_income): ?>
                                                            <i class="fa fa-trophy text-warning ml-1" data-toggle="tooltip" title="<?php echo lang('highest_income'); ?>"></i>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td class="text-right">
                                                        <?php echo $currency_symbol . number_format($month_expense, 2); ?>
                                                        <?php if ($highest_expense): ?>
                                                            <i class="fa fa-exclamation-triangle text-danger ml-1" data-toggle="tooltip" title="<?php echo lang('highest_expense'); ?>"></i>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td class="text-right <?php echo $month_status; ?>">
                                                        <?php echo $currency_symbol . number_format(abs($month_profit), 2); ?>
                                                        <?php if ($month_profit != 0): ?>
                                                            <i class="fa fa-arrow-<?php echo $month_profit >= 0 ? 'up text-success' : 'down text-danger'; ?>"></i>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <?php if ($month_profit >= 0): ?>
                                                            <span class="badge badge-success"><?php echo lang('profit'); ?></span>
                                                        <?php else: ?>
                                                            <span class="badge badge-danger"><?php echo lang('loss'); ?></span>
                                                        <?php endif; ?>
                                                    </td>
                                            </tr>
                                                <?php endfor; ?>
                                        </tbody>
                                            <tfoot>
                                            <tr class="total_amount">
                                                    <td><strong><?php echo lang('total'); ?></strong></td>
                                                    <td class="text-right"><strong><?php echo $currency_symbol . number_format($total_month_income, 2); ?></strong></td>
                                                    <td class="text-right"><strong><?php echo $currency_symbol . number_format($total_month_expense, 2); ?></strong></td>
                                                    <td class="text-right <?php echo $total_month_profit >= 0 ? 'profit' : 'loss'; ?>">
                                                        <strong><?php echo $currency_symbol . number_format(abs($total_month_profit), 2); ?></strong>
                                                        <?php if ($total_month_profit != 0): ?>
                                                            <i class="fa fa-arrow-<?php echo $total_month_profit >= 0 ? 'up text-success' : 'down text-danger'; ?>"></i>
                                                        <?php endif; ?>
                                                    </td>
                                                    <td class="text-center">
                                                        <?php if ($total_month_profit >= 0): ?>
                                                            <span class="badge badge-success"><?php echo lang('profit'); ?></span>
                                                        <?php else: ?>
                                                            <span class="badge badge-danger"><?php echo lang('loss'); ?></span>
                                                        <?php endif; ?>
                                                    </td>
                                            </tr>
                                            </tfoot>
                                    </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Footer -->
                    <div class="row">
                        <div class="col-12 text-center">
                            <div class="mt-2 mb-2">
                                <small class="text-muted"><?php echo date('Y'); ?> © By Code Aristos</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- page end-->
    </section>
</section>
<!--main content end-->

<!-- JS Script Variables -->
<script type="text/javascript">
    // Chart data
    var chartMonths = <?php echo json_encode(array_values($month_names)); ?>;
    var chartIncomes = <?php echo json_encode(array_values($chart_incomes)); ?>;
    var chartExpenses = <?php echo json_encode(array_values($chart_expenses)); ?>;
    
    // Total values
    var totalIncomeValue = <?php echo isset($total_income) ? $total_income : 0; ?>;
    var totalExpenseValue = <?php echo isset($total_expense) ? $total_expense : 0; ?>;
    var targetIncomeValue = <?php echo isset($target_income) ? $target_income : 0; ?>;
    var budgetExpenseValue = <?php echo isset($budget_expense) ? $budget_expense : 0; ?>;
    
    // Currency format
    var currencySymbol = '<?php echo $currency_symbol; ?>';
    var currencyFormat = 'currency';
    
    // Update UI elements - ensure progress bars and indicators show correctly
    $(document).ready(function() {
        // Set income progress
        var incomeProgress = Math.min(100, totalIncomeValue > 0 && targetIncomeValue > 0 ? 
            (totalIncomeValue / targetIncomeValue) * 100 : 0);
        $('#income-progress .progress-bar').css('width', incomeProgress + '%');
        $('#income-progress-text').text(incomeProgress.toFixed(1) + '%');
        
        // Set expense progress
        var expenseProgress = Math.min(100, totalExpenseValue > 0 && budgetExpenseValue > 0 ? 
            (totalExpenseValue / budgetExpenseValue) * 100 : 0);
        $('#expense-progress .progress-bar').css('width', expenseProgress + '%');
        $('#expense-progress-text').text(expenseProgress.toFixed(1) + '%');
        
        // Initialize tooltips
        $('[data-toggle="tooltip"]').tooltip();
        
        // Handle print button
        $('#print').on('click', function() {
            window.print();
        });

        // Initialize the download button correctly
        $('#export-data').on('click', function() {
            exportTableToCSV('expense_vs_income_report.csv');
            return false;
        });
        
        // Animate numbers for better user experience
        $('.animate-number').each(function() {
            const $this = $(this);
            const value = $this.text().replace(/[^0-9.]/g, '');
            $this.prop('Counter', 0).animate({
                Counter: value
            }, {
                duration: 1000,
                easing: 'swing',
                step: function(now) {
                    const formattedValue = parseFloat(now).toFixed(2);
                    $this.text(currencySymbol + numberWithCommas(formattedValue));
                }
            });
        });
        
        // Helper function for number formatting
        function numberWithCommas(x) {
            return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }
    });
    
    // Translations
    var expense_vs_income_lang = {
        expense_vs_income_report: '<?php echo lang('expense_vs_income_report'); ?>',
        month: '<?php echo lang('month'); ?>',
        income: '<?php echo lang('income'); ?>',
        expense: '<?php echo lang('expense'); ?>',
        profit: '<?php echo lang('profit'); ?>',
        loss: '<?php echo lang('loss'); ?>',
        profit_loss: '<?php echo lang('profit_loss'); ?>',
        category: '<?php echo lang('category'); ?>',
        percentage: '<?php echo lang('percentage'); ?>',
        amount: '<?php echo lang('amount'); ?>',
        annual_financial_overview: '<?php echo lang('annual_financial_overview'); ?>',
        income_expense_distribution: '<?php echo lang('income_expense_distribution'); ?>',
        financial_insights: '<?php echo lang('financial_insights'); ?>',
        highest_income_month: '<?php echo lang('highest_income_month'); ?>',
        highest_expense_month: '<?php echo lang('highest_expense_month'); ?>',
        profit_margin: '<?php echo lang('profit_margin'); ?>',
        no_data: '<?php echo lang('no_data_available'); ?>',
        showing: '<?php echo lang('showing'); ?>',
        to: '<?php echo lang('to'); ?>',
        of: '<?php echo lang('of'); ?>',
        entries: '<?php echo lang('entries'); ?>',
        show: '<?php echo lang('show'); ?>',
        search: '<?php echo lang('search'); ?>',
        first: '<?php echo lang('first'); ?>',
        last: '<?php echo lang('last'); ?>',
        next: '<?php echo lang('next'); ?>',
        previous: '<?php echo lang('previous'); ?>'
    };
</script>

<!-- Load javascript files -->
<script src="common/extranal/js/finance/expense_vs_income.js"></script>

<style>
/* Custom styles to reduce whitespace and improve UI */
.content-wrapper {
    padding: 0;
    background-color: #f8f9fa;
}
.card {
    margin-bottom: 0.75rem;
    border-radius: 10px;
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    border: none;
    overflow: hidden;
    transition: box-shadow 0.3s ease;
}
.card:hover {
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
}
.card-header {
    padding: 0.75rem 1rem;
    background-color: #fff;
    border-bottom: 1px solid rgba(0,0,0,0.06);
}
.card-header .card-title {
    font-weight: 600;
    color: #212529;
}
.card-body {
    padding: 0.75rem;
}
.small-box {
    margin-bottom: 0.75rem;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    position: relative;
}
.small-box:hover {
    transform: translateY(-3px);
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
}
.small-box .inner {
    padding: 1.5rem 1.5rem;
    z-index: 10;
    position: relative;
}
.small-box .inner h3 {
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
    text-shadow: 1px 1px 3px rgba(0,0,0,0.1);
}
.small-box .inner p {
    font-weight: 500;
    margin-bottom: 0;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    font-size: 0.9rem;
}
.small-box .icon {
    top: 15px;
    right: 15px;
    font-size: 3.5rem;
    opacity: 0.2;
    z-index: 5;
    position: absolute;
}
.small-box:before {
    display: none;
}
.row {
    margin-bottom: 0.75rem;
}
.table td, .table th {
    padding: 0.5rem 0.75rem;
    vertical-align: middle;
}
.btn {
    border-radius: 5px;
    padding: 0.375rem 0.75rem;
    font-weight: 500;
    margin: 0 0.25rem;
    transition: all 0.3s ease;
}
.btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 0.25rem 0.5rem rgba(0, 0, 0, 0.1);
}
.btn-outline-primary, .btn-outline-info {
    background-color: white;
    border-width: 2px;
}
.btn-outline-primary:hover {
    background-color: #007bff;
}
.btn-outline-info:hover {
    background-color: #17a2b8;
}
/* Improve table style */
#expense_vs_income_table {
    font-size: 0.9rem;
}
#expense_vs_income_table thead th {
    background-color: #f8f9fa;
    font-weight: 600;
    color: #495057;
    text-transform: uppercase;
    font-size: 0.8rem;
    letter-spacing: 0.5px;
}
#expense_vs_income_table tbody tr:hover {
    background-color: rgba(0, 123, 255, 0.05);
}
#expense_vs_income_table .badge {
    padding: 0.35em 0.65em;
    font-weight: 500;
    border-radius: 4px;
}
.badge-success {
    background-color: #28a745;
}
.badge-danger {
    background-color: #dc3545;
}
.fa-arrow-up.text-success, .fa-arrow-down.text-danger {
    margin-left: 0.25rem;
}
/* Year selector buttons */
.year-selection .btn {
    border-radius: 5px;
    font-weight: 500;
    background-color: rgba(0, 123, 255, 0.1);
    border: none;
    color: #007bff;
}
.year-selection .btn:hover {
    background-color: rgba(0, 123, 255, 0.2);
}
/* Footer styling */
.text-muted {
    color: #6c757d !important;
}
.mt-2 {
    margin-top: 0.75rem !important;
}
.mb-2 {
    margin-bottom: 0.75rem !important;
}
.text-center {
    text-align: center !important;
}

/* Responsive enhancements */
@media (max-width: 767.98px) {
    .small-box .inner h3 {
        font-size: 1.75rem;
    }
    .small-box .icon {
        font-size: 2.5rem;
    }
    .small-box .inner {
        padding: 1.25rem 1.25rem;
    }
    .card-header {
        padding: 0.5rem 0.75rem;
    }
    .card-body {
        padding: 0.5rem;
    }
    .btn {
        padding: 0.25rem 0.5rem;
        font-size: 0.875rem;
    }
    }
</style>
</body>
</html>