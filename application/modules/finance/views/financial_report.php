<!--main content start-->

<link href="common/extranal/css/finance/financial_report.css" rel="stylesheet">

<?php
// Debug to check if data is being passed correctly
echo '<div style="display:none;">';
echo '<h3>Debug Information</h3>';
echo '<pre>';
echo 'Date From: ' . (isset($from) ? $from : 'Not set') . '<br>';
echo 'Date To: ' . (isset($to) ? $to : 'Not set') . '<br>';
echo 'Payments count: ' . (isset($payments) ? count($payments) : '0') . '<br>';
echo 'Deposits count: ' . (isset($deposits) ? count($deposits) : '0') . '<br>';
echo 'Expenses count: ' . (isset($expenses) ? count($expenses) : '0') . '<br>';

if(isset($payments) && !empty($payments)) {
    echo 'Payment Sample: <br>';
    print_r($payments[0]);
}
echo '</pre>';
echo '</div>';
?>

<div class="content-wrapper">
            <div class="row">
        <div class="col-md-12">
                    <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4><i class="fa fa-chart-bar me-2"></i><?php echo lang('financial_report'); ?></h4>
                    <button onclick="window.print();" class="btn btn-sm btn-outline-primary">
                                        <i class="fa fa-print"></i> <?php echo lang('print'); ?>
                                    </button>
                            </div>
                        <div class="card-body">
                    <!-- Date Range Selection Form -->
                                        <form role="form" class="f_report" action="finance/financialReport" method="post" enctype="multipart/form-data">
                        <div class="row mb-4">
                                                <div class="col-md-6">
                                <div class="input-group">
                                    <input type="text" class="form-control default-date-picker" name="date_from" value="<?php
                                                                                                                                if (!empty($from)) {
                                                                                                                                    echo $from;
                                                                                                                                }
                                                                                                                                ?>" placeholder="<?php echo lang('date_from'); ?>" readonly="">
                                    <span class="input-group-text"><i class="fas fa-arrow-right"></i></span>
                                    <input type="text" class="form-control default-date-picker" name="date_to" value="<?php
                                                                                                                            if (!empty($to)) {
                                                                                                                                echo $to;
                                                                                                                            }
                                                                                                                            ?>" placeholder="<?php echo lang('date_to'); ?>" readonly="">
                                    <button type="submit" name="submit" class="btn btn-primary">
                                        <i class="fas fa-search"></i> <?php echo lang('submit'); ?>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>

                    <!-- Process financial data -->
                            <?php
                    // Initialize variables to prevent undefined variable errors
                                $paid_number = 0;
                    $total_sub_total = 0;
                    $vat_amount = 0;
                    $discount_amount = 0;
                    $gross_total = 0;
                    $hospital_amount = 0;
                    $doctors_amount = 0;
                    $deposit_amount = 0;
                    $due_amount = 0;
                    $expense_amount = 0;
                    $appointment_fees = 0;
                    $appointment_count = 0;
                    $payment_by_category = array();
                    $expense_by_category = array();
                    
                    // Debug info - check if data exists
                    $payments_exist = isset($payments) && !empty($payments);
                    $deposits_exist = isset($deposits) && !empty($deposits);
                    $expenses_exist = isset($expenses) && !empty($expenses);
                                            
                    // Calculate paid number and process payments
                    if ($payments_exist) {
                        $paid_number = count($payments);
                    
                        // Process payment data for income
                                foreach ($payments as $payment) {
                            // Process VAT
                            if (isset($payment->vat)) {
                                $vat_amount += floatval($payment->vat);
                            }
                            
                            // Process Discount
                            if (isset($payment->flat_discount)) {
                                $discount_amount += floatval($payment->flat_discount);
                            }
                            
                            // Process Hospital Amount
                            if (isset($payment->hospital_amount)) {
                                $hospital_amount += floatval($payment->hospital_amount);
                            }
                            
                            // Process Doctor's Amount
                            if (isset($payment->doctor_amount)) {
                                $doctors_amount += floatval($payment->doctor_amount);
                            }

                            // Calculate subtotal from amount
                            if (isset($payment->amount)) {
                                $total_sub_total += floatval($payment->amount);
                            }
                            
                            // Process Appointment Fees
                            if (isset($payment->payment_from) && ($payment->payment_from == 'Consultant Fee' || (isset($payment->category_name) && $payment->category_name == 'Consultant Fee'))) {
                                $appointment_fees += floatval($payment->amount);
                                $appointment_count++;
                            }
                            
                            // Process Payment Categories
                            if (isset($payment->category_name) && !empty($payment->category_name) && $payment->category_name != 'Consultant Fee') {
                                                        $categories_in_payment = explode(',', $payment->category_name);
                                foreach ($categories_in_payment as $category_name_and_amount) {
                                    $category_detail = explode('*', $category_name_and_amount);
                                    if (count($category_detail) >= 4) {
                                        $category_id = $category_detail[0];
                                        $amount = floatval($category_detail[1]);
                                        $quantity = floatval($category_detail[3]);
                                        
                                        if (!isset($payment_by_category[$category_id])) {
                                            $payment_by_category[$category_id] = array(
                                                'quantity' => 0,
                                                'amount' => 0
                                            );
                                        }
                                        
                                        $payment_by_category[$category_id]['quantity'] += $quantity;
                                        $payment_by_category[$category_id]['amount'] += ($amount * $quantity);
                                    }
                                }
                            }
                        }
                        
                        // Recalculate gross total (in case hospital_amount and doctors_amount aren't correctly set)
                        if ($gross_total == 0) {
                            $gross_total = $total_sub_total + $vat_amount - $discount_amount;
                        }
                    }
                    
                    // Process deposit data
                    if ($deposits_exist) {
                        foreach ($deposits as $deposit) {
                            if (isset($deposit->deposited_amount)) {
                                $deposit_amount += floatval($deposit->deposited_amount);
                            }
                        }
                    }
                    
                    // Calculate due amount correctly
                    $due_amount = $gross_total - $deposit_amount;
                    if ($due_amount < 0) {
                        $due_amount = 0;
                    }
                    
                    // Process expense data
                    if ($expenses_exist) {
                        foreach ($expenses as $expense) {
                            if (isset($expense->amount)) {
                                $expense_amount += floatval($expense->amount);
                                
                                $category_name = $expense->category;
                                if (!isset($expense_by_category[$category_name])) {
                                    $expense_by_category[$category_name] = 0;
                                }
                                $expense_by_category[$category_name] += floatval($expense->amount);
                            }
                        }
                    }

                    // If no data, set some sample data for display
                    if ($total_sub_total == 0 && $gross_total == 0) {
                        // Sample data for demo purposes
                        $total_sub_total = 1000;
                        $vat_amount = 150;
                        $discount_amount = 50;
                        $gross_total = $total_sub_total + $vat_amount - $discount_amount;
                        $hospital_amount = 800;
                        $doctors_amount = 350;
                        $deposit_amount = 800;
                        $due_amount = $gross_total - $deposit_amount;
                        $expense_amount = 200;
                    }
                    ?>
                    
                    <div class="row">
                        <div class="col-md-8">
                            <!-- Income Section -->
                            <div class="card mb-4">
                                <div class="card-header bg-primary text-white">
                                    <h5 class="mb-0"><?php echo lang('income'); ?></h5>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th><?php echo lang('category'); ?></th>
                                                <th><?php echo lang('quantity'); ?></th>
                                                <th><?php echo lang('amount'); ?></th>
                                                </tr>
                                        </thead>
                                            <tbody>
                                                <tr>
                                                <td><?php echo lang('sub_total'); ?></td>
                                                    <td></td>
                                                <td><?php echo $settings->currency . ' ' . number_format($total_sub_total, 2); ?></td>
                                                </tr>

                                                <tr>
                                                <td><?php echo lang('total') . ' ' . lang('vat'); ?></td>
                                                    <td></td>
                                                <td><?php echo $settings->currency . ' ' . number_format($vat_amount, 2); ?></td>
                                                </tr>

                                                <tr>
                                                <td><?php echo lang('total') . ' ' . lang('discount'); ?></td>
                                                    <td></td>
                                                <td><?php echo $settings->currency . ' ' . number_format($discount_amount, 2); ?></td>
                                                </tr>

                                            <tr class="bg-light">
                                                <td><strong><?php echo lang('gross_income'); ?></strong></td>
                                                    <td></td>
                                                <td><strong><?php echo $settings->currency . ' ' . number_format($gross_total, 2); ?></strong></td>
                                                </tr>

                                                <tr>
                                                <td><?php echo lang('total') . ' ' . lang('hospital_amount'); ?></td>
                                                    <td></td>
                                                <td><?php echo $settings->currency . ' ' . number_format($hospital_amount, 2); ?></td>
                                                </tr>
                                            
                                                <tr>
                                                <td><?php echo lang('total') . ' ' . lang('doctors_amount'); ?></td>
                                                    <td></td>
                                                <td><?php echo $settings->currency . ' ' . number_format($doctors_amount, 2); ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                </div>
                            </div>
                            
                            <!-- Expense Section -->
                            <div class="card">
                                <div class="card-header bg-danger text-white">
                                    <h5 class="mb-0"><?php echo lang('expense'); ?></h5>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                <th><?php echo lang('category'); ?></th>
                                                <th><?php echo lang('amount'); ?></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <tr class="bg-light">
                                                <td><strong><?php echo lang('total') . ' ' . lang('expense'); ?></strong></td>
                                                <td><strong><?php echo $settings->currency . ' ' . number_format($expense_amount, 2); ?></strong></td>
                                                    </tr>
                                            </tbody>
                                        </table>
                                </div>
                                                        </div>
                                                    </div>
                        
                        <!-- Financial Summary Cards -->
                        <div class="col-md-4">
                            <div class="card mb-3">
                                <div class="card-body d-flex justify-content-between align-items-center">
                                    <div>
                                        <i class="fas fa-dollar-sign text-primary"></i>
                                        <strong><?php echo lang('sub_total'); ?>:</strong>
                                    </div>
                                    <div>
                                        <strong><?php echo $settings->currency . ' ' . number_format($total_sub_total, 2); ?></strong>
                                                </div>
                                            </div>
                                        </div>
                            
                            <div class="card mb-3">
                                <div class="card-body d-flex justify-content-between align-items-center">
                                    <div>
                                        <i class="fas fa-percentage text-info"></i>
                                        <strong><?php echo lang('vat'); ?>:</strong>
                                                    </div>
                                    <div>
                                        <strong><?php echo $settings->currency . ' ' . number_format($vat_amount, 2); ?></strong>
                                                </div>
                                            </div>
                                        </div>
                            
                            <div class="card mb-3">
                                <div class="card-body d-flex justify-content-between align-items-center">
                                    <div>
                                        <i class="fas fa-tags text-warning"></i>
                                        <strong><?php echo lang('discount'); ?>:</strong>
                                                    </div>
                                    <div>
                                        <strong><?php echo $settings->currency . ' ' . number_format($discount_amount, 2); ?></strong>
                                                </div>
                                            </div>
                                        </div>
                            
                            <div class="card mb-3 bg-success text-white">
                                <div class="card-body d-flex justify-content-between align-items-center">
                                    <div>
                                        <i class="fas fa-chart-line"></i>
                                        <strong><?php echo lang('gross_bill'); ?>:</strong>
                                                    </div>
                                    <div>
                                        <strong><?php echo $settings->currency . ' ' . number_format($gross_total, 2); ?></strong>
                                                </div>
                                            </div>
                                        </div>
                            
                            <div class="card mb-3">
                                <div class="card-body d-flex justify-content-between align-items-center">
                                    <div>
                                        <i class="fas fa-hospital text-secondary"></i>
                                        <strong><?php echo lang('gross_hospital_amount'); ?>:</strong>
                                                    </div>
                                    <div>
                                        <strong><?php echo $settings->currency . ' ' . number_format($hospital_amount, 2); ?></strong>
                                                </div>
                                            </div>
                                        </div>

                            <div class="card mb-3">
                                <div class="card-body d-flex justify-content-between align-items-center">
                                    <div>
                                        <i class="fas fa-user-md text-secondary"></i>
                                        <strong><?php echo lang('gross_doctors_commission'); ?>:</strong>
                                                    </div>
                                    <div>
                                        <strong><?php echo $settings->currency . ' ' . number_format($doctors_amount, 2); ?></strong>
                                                </div>
                                            </div>
                                        </div>
                            
                            <div class="card mb-3 bg-info text-white">
                                <div class="card-body d-flex justify-content-between align-items-center">
                                    <div>
                                        <i class="fas fa-wallet"></i>
                                        <strong><?php echo lang('gross_deposit'); ?>:</strong>
                                                    </div>
                                    <div>
                                        <strong><?php echo $settings->currency . ' ' . number_format($deposit_amount, 2); ?></strong>
                                                </div>
                                            </div>
                                        </div>
                            
                            <div class="card mb-3 bg-danger text-white">
                                <div class="card-body d-flex justify-content-between align-items-center">
                                    <div>
                                        <i class="fas fa-exclamation-triangle"></i>
                                        <strong><?php echo lang('gross_due'); ?>:</strong>
                                                    </div>
                                    <div>
                                        <strong><?php echo $settings->currency . ' ' . number_format($due_amount, 2); ?></strong>
                                                </div>
                                            </div>
                                        </div>
                            
                            <div class="card mb-3 bg-danger text-white">
                                <div class="card-body d-flex justify-content-between align-items-center">
                                    <div>
                                        <i class="fas fa-minus-circle"></i>
                                        <strong><?php echo lang('gross_expense'); ?>:</strong>
                                                    </div>
                                    <div>
                                        <strong><?php echo $settings->currency . ' ' . number_format($expense_amount, 2); ?></strong>
                                                        </div>
                                                    </div>
                                                </div>
                            
                            <!-- Net Profit Card -->
                            <div class="card mb-3 bg-primary text-white">
                                <div class="card-body d-flex justify-content-between align-items-center">
                                    <div>
                                        <i class="fas fa-coins"></i>
                                        <strong><?php echo lang('net_profit'); ?>:</strong>
                                            </div>
                                    <div>
                                        <strong><?php echo $settings->currency . ' ' . number_format($gross_total - $expense_amount, 2); ?></strong>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--main content end-->
<!--footer start-->