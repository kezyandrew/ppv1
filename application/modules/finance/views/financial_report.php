<!--main content start-->

<link href="common/extranal/css/finance/financial_report.css" rel="stylesheet">

<style>
    .card .badge{
        font-size: 120%;
        margin-bottom: 5px;
        width: 100%;
        text-align: left !important;
        /* background: #fff !important; */
        /* color: #333; */
        padding: 16px;
    }
</style>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1> <?php echo lang('financial_report'); ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="home"><?php echo lang('home') ?></a></li>
                        <li class="breadcrumb-item active"><?php echo lang('department') ?></li>
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
                        <!-- <div class="card-header">
                            <h3 class="card-title">All the department names and related informations</h3>
                            <div class="float-right">
                                <a data-toggle="modal" href="#myModal">
                                    <button id="" class="btn btn-success btn-sm" onclick="javascript:window.print();">
                                        <i class="fa fa-print"></i> <?php echo lang('print'); ?>
                                    </button>
                                </a>
                            </div>
                        </div> -->
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="">
                                <div class="">
                                    <section>
                                        <form role="form" class="f_report" action="finance/financialReport" method="post" enctype="multipart/form-data">
                                            <div class="form-group row">

                                                <div class="col-md-6">
                                                    <div class="input-group input-large" data-date="13/07/2013" data-date-format="mm/dd/yyyy">
                                                        <input type="text" class="form-control dpd1" name="date_from" value="<?php
                                                                                                                                if (!empty($from)) {
                                                                                                                                    echo $from;
                                                                                                                                }
                                                                                                                                ?>" placeholder="<?php echo lang('date_from'); ?>" readonly="">
                                                        <span class="input-group-addon"></span>
                                                        <input type="text" class="form-control dpd2" name="date_to" value="<?php
                                                                                                                            if (!empty($to)) {
                                                                                                                                echo $to;
                                                                                                                            }
                                                                                                                            ?>" placeholder="<?php echo lang('date_to'); ?>" readonly="">
                                                    </div>
                                                    <div class="row"></div>
                                                    <span class="help-block"></span>
                                                </div>
                                                <div class="col-md-6 no-print">
                                                    <button type="submit" name="submit" class="btn btn-info range_submit"><?php echo lang('submit'); ?></button>
                                                </div>
                                            </div>
                                        </form>
                                    </section>
                                </div>
                            </div>

                            <?php
                            if (!empty($payments)) {
                                $paid_number = 0;
                                foreach ($payments as $payment) {
                                    $paid_number = $paid_number + 1;
                                }
                            }
                            ?>
                            <div class="row">
                                <div class="col-lg-7">
                                    <section class="card">
                                        <header class="card-header">
                                            <h4> <?php echo lang('income'); ?> </h4>
                                        </header>
                                        <table class="table table-striped table-advance table-hover">
                                            <thead>
                                                <tr>
                                                    <th> <?php echo lang('category'); ?></th>
                                                    <th> <?php echo lang('quantity'); ?></th>
                                                    <th class="hidden-phone"> <?php echo lang('amount'); ?></th>

                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php
                                                $category_id_for_report = array();
                                                foreach ($payment_categories as $cat_name) {
                                                    foreach ($payments as $payment) {
                                                        $categories_in_payment = explode(',', $payment->category_name);
                                                        foreach ($categories_in_payment as $key => $category_in_payment) {
                                                            $category_id = explode('*', $category_in_payment);
                                                            if ($category_id[0] == $cat_name->id) {
                                                                $category_id_for_report[] = $category_id[0];
                                                            }
                                                        }
                                                    }
                                                }
                                                $category_id_for_reports = array_unique($category_id_for_report);
                                                ?>

                                                <?php
                                                foreach ($payment_categories as $category) {

                                                    $category_quantity = array();
                                                    if (in_array($category->id, $category_id_for_reports)) {
                                                ?>
                                                        <tr class="">
                                                            <td><?php echo $category->category ?></td>
                                                            <td>


                                                                <?php
                                                                foreach ($payments as $paymentt) {
                                                                    $category_names_and_amountss = $paymentt->category_name;
                                                                    $category_names_and_amountss = explode(',', $category_names_and_amountss);
                                                                    foreach ($category_names_and_amountss as $category_name_and_amountt) {
                                                                        $category_namee = explode('*', $category_name_and_amountt);
                                                                        if (($category->id == $category_namee[0])) {
                                                                            $category_quantity[] = $category_namee[3];
                                                                        }
                                                                    }
                                                                }
                                                                if (!empty($category_quantity)) {
                                                                    echo array_sum($category_quantity);
                                                                } else {
                                                                    echo '0';
                                                                }
                                                                ?>




                                                            </td>
                                                            <td><?php echo $settings->currency; ?> <?php
                                                                                                    foreach ($payments as $payment) {
                                                                                                        $category_names_and_amounts = $payment->category_name;
                                                                                                        $category_names_and_amounts = explode(',', $category_names_and_amounts);
                                                                                                        foreach ($category_names_and_amounts as $category_name_and_amount) {
                                                                                                            $category_name = explode('*', $category_name_and_amount);
                                                                                                            if (($category->id == $category_name[0])) {
                                                                                                                $amount_per_category[] = $category_name[1] * $category_name[3];
                                                                                                            }
                                                                                                        }
                                                                                                    }
                                                                                                    if (!empty($amount_per_category)) {
                                                                                                        echo array_sum($amount_per_category);
                                                                                                        $total_payment_by_category[] = array_sum($amount_per_category);
                                                                                                    } else {
                                                                                                        echo '0';
                                                                                                    }

                                                                                                    $amount_per_category = NULL;
                                                                                                    ?>
                                                            </td>
                                                        </tr>
                                                <?php
                                                    }
                                                }
                                                ?>









                                                <tr class="">
                                                    <td><?php echo lang('appointment') ?></td>
                                                    <td>
                                                        <?php
                                                        foreach ($payments as $paymentt) {
                                                            if (($paymentt->payment_from == 'Consultant Fee')) {
                                                                $category_quantity[] = 1;
                                                            }
                                                        }
                                                        if (!empty($category_quantity)) {
                                                            echo array_sum($category_quantity);
                                                        } else {
                                                            echo '0';
                                                        }
                                                        ?>
                                                    </td>

                                                    <td>
                                                        <?php echo $settings->currency; ?>
                                                        <?php
                                                        foreach ($payments as $payment) {
                                                            if (($payment->category_name == 'Consultant Fee')) {
                                                                $amount_per_category[] = $payment->amount;
                                                            }
                                                        }
                                                        if (!empty($amount_per_category)) {
                                                            echo array_sum($amount_per_category);
                                                            $total_payment_by_category_for_appointment = array_sum($amount_per_category);
                                                        } else {
                                                            echo '0';
                                                        }

                                                        $amount_per_category = NULL;
                                                        ?>

                                                    </td>
                                                </tr>

















                                            </tbody>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <h3><?php echo lang('sub_total'); ?> </h3>
                                                    </td>
                                                    <td></td>
                                                    <td>
                                                        <?php echo $settings->currency; ?>
                                                        <?php
                                                        if (!empty($total_payment_by_category)) {
                                                            echo $total_sub_total = array_sum($total_payment_by_category) + $total_payment_by_category_for_appointment;
                                                        } else {
                                                            echo '0';
                                                        }
                                                        ?>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <h5><?php echo lang('total'); ?> <?php echo lang('vat'); ?></h5>
                                                    </td>
                                                    <td></td>
                                                    <td>
                                                        <?php echo $settings->currency; ?>
                                                        <?php
                                                        if (!empty($payments)) {
                                                            foreach ($payments as $payment) {
                                                                $vat[] = $payment->vat;
                                                            }
                                                            if ($paid_number > 0) {
                                                                echo array_sum($vat);
                                                            } else {
                                                                echo '0';
                                                            }
                                                        } else {
                                                            echo '0';
                                                        }
                                                        ?>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <h5><?php echo lang('total'); ?> <?php echo lang('discount'); ?></h5>
                                                    </td>
                                                    <td></td>
                                                    <td>
                                                        <?php echo $settings->currency; ?>
                                                        <?php
                                                        if (!empty($payments)) {
                                                            foreach ($payments as $payment) {
                                                                $discount[] = $payment->flat_discount;
                                                            }
                                                            if ($paid_number > 0) {
                                                                echo array_sum($discount);
                                                            } else {
                                                                echo '0';
                                                            }
                                                        } else {
                                                            echo '0';
                                                        }
                                                        ?>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>
                                                        <h5> <?php echo lang('gross_income'); ?></h5>
                                                    </td>
                                                    <td></td>
                                                    <td>
                                                        <?php echo $settings->currency; ?>
                                                        <?php
                                                        if (!empty($payments)) {
                                                            if ($paid_number > 0) {
                                                                $gross = $total_sub_total - array_sum($discount) + array_sum($vat);
                                                                echo $gross;
                                                            } else {
                                                                echo '0';
                                                            }
                                                        } else {
                                                            echo '0';
                                                        }
                                                        ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h5><?php echo lang('total'); ?> <?php echo lang('hospital_amount'); ?></h5>
                                                    </td>
                                                    <td></td>
                                                    <td>
                                                        <?php echo $settings->currency; ?>
                                                        <?php
                                                        if (!empty($payments)) {
                                                            foreach ($payments as $payment) {
                                                                $hospital_amount[] = $payment->hospital_amount;
                                                            }
                                                            if ($paid_number > 0) {
                                                                $hospital_amount = array_sum($hospital_amount);
                                                                echo $hospital_amount;
                                                            } else {
                                                                echo '0';
                                                            }
                                                        } else {
                                                            echo '0';
                                                        }
                                                        ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <h5><?php echo lang('total'); ?> <?php echo lang('doctors_amount'); ?></h5>
                                                    </td>
                                                    <td></td>
                                                    <td>
                                                        <?php echo $settings->currency; ?>
                                                        <?php
                                                        if (!empty($payments)) {
                                                            foreach ($payments as $payment) {
                                                                $doctor_amount[] = $payment->doctor_amount;
                                                            }
                                                            if ($paid_number > 0) {
                                                                $gross_doctor_amount = array_sum($doctor_amount);
                                                                echo $gross_doctor_amount;
                                                            } else {
                                                                echo '0';
                                                            }
                                                        } else {
                                                            echo '0';
                                                        }
                                                        ?>
                                                    </td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </section>




                                    <section></section>


                                    <section class="card">
                                        <header class="card-header">
                                            <h4> <?php echo lang('expense'); ?> </h4>
                                        </header>
                                        <table class="table table-striped table-advance table-hover">
                                            <thead>
                                                <tr>
                                                    <th> <?php echo lang('category'); ?></th>
                                                    <th class="hidden-phone"> <?php echo lang('amount'); ?></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($expense_categories as $category) { ?>
                                                    <tr class="">
                                                        <td><?php echo $category->category ?></td>
                                                        <td>
                                                            <?php echo $settings->currency; ?>
                                                            <?php
                                                            foreach ($expenses as $expense) {
                                                                $category_name = $expense->category;


                                                                if (($category->category == $category_name)) {
                                                                    $amount_per_category[] = $expense->amount;
                                                                }
                                                            }
                                                            if (!empty($amount_per_category)) {
                                                                $total_expense_by_category[] = array_sum($amount_per_category);
                                                                echo array_sum($amount_per_category);
                                                            } else {
                                                                echo '0';
                                                            }

                                                            $amount_per_category = NULL;
                                                            ?>
                                                        </td>
                                                    </tr>
                                                <?php } ?>

                                            </tbody>
                                        </table>
                                    </section>
                                </div>

                                <div class="col-lg-5">

                                    <section class="">
                                        <div class="weather-bg">
                                            <div class="">
                                                <div class="row badge badge-info">
                                                    <div class="col-4">
                                                       
                                                        <?php echo lang('sub_total'); ?> : <?php echo $settings->currency; ?> <?php
                                                                                            if (empty($total_sub_total)) {
                                                                                                $grototal_sub_totalss = 0;
                                                                                            }
                                                                                            echo $total_sub_total = $total_sub_total;
                                                                                            ?>
                                                    </div>
                                                    <div class="col-8">
                                                        <div class="degree">

                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>







                                    <section class="">
                                        <div class="weather-bg">
                                            <div class="">
                                                <div class="row badge badge-info">
                                                    <div class="col-xs-4">
                                                       
                                                        <?php echo lang('gross'); ?> <?php echo lang('vat'); ?> : <?php
                                                            if (empty($vat)) {
                                                                echo $vat = 0;
                                                            } else {
                                                                echo array_sum($vat);
                                                            }
                                                            ?>
                                                            <?php echo $settings->currency; ?>
                                                    </div>
                                                    <div class="col-xs-8">
                                                        <div class="degree">
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>

                                    <section class="">
                                        <div class="">
                                            <div class="">
                                                <div class="row badge badge-info">
                                                    <div class="col-xs-4">
                                                       
                                                        <?php echo lang('discount'); ?> :  <?php
                                                            if (empty($discount)) {
                                                                echo $discount = 0;
                                                            } else {
                                                                echo array_sum($discount);
                                                            }
                                                            ?>
                                                            <?php echo $settings->currency; ?>
                                                    </div>
                                                    <div class="col-xs-8">
                                                        <div class="degree">
                                                           
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>


                                    <section class="">
                                        <div class="weather-bg">
                                            <div class="">
                                                <div class="row badge badge-success">
                                                    <div class="col-xs-4">
                                                       
                                                        <?php echo lang('gross_bill'); ?> :   
                                                        <?php
                                                            if (empty($gross)) {
                                                                $gross = 0;
                                                            }
                                                            echo $gross_bill = $gross;
                                                            ?>
                                                            <?php echo $settings->currency; ?>
                                                    </div>
                                                    <div class="col-xs-8">
                                                        <div class="degree">
                                                          
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>



                                    <section class="">
                                        <div class="weather-bg">
                                            <div class="">
                                                <div class="row badge badge-secondary">
                                                    <div class="col-xs-4">
                                                       
                                                        <?php echo lang('gross_hospital_amount'); ?> :  <?php echo $settings->currency; ?>
                                                            <?php
                                                            if (!empty($payments)) {
                                                                if ($paid_number > 0) {
                                                                    $gross = $hospital_amount;
                                                                    echo $gross;
                                                                }
                                                            } elseif (!empty($payments)) {
                                                                if (($paid_number > 0)) {
                                                                    $gross = $hospital_amount;
                                                                    echo $gross;
                                                                }
                                                            } else {
                                                                echo '0';
                                                            }
                                                            ?>
                                                    </div>
                                                    <div class="col-xs-8">
                                                        <div class="degree">
                                                           
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </section>


                                    <section class="">
                                        <div class="weather-bg">
                                            <div class="">
                                                <div class="row badge badge-secondary">
                                                    <div class="col-xs-4">
                                                       
                                                        <?php echo lang('gross_doctors_commission'); ?> :  <?php echo $settings->currency; ?>
                                                            <?php
                                                            if (empty($gross_doctor_amount)) {
                                                                $gross_doctor_amount = 0;
                                                            }
                                                            if (empty($gross_doctor_amount_ot)) {
                                                                $gross_doctor_amount_ot = 0;
                                                            }
                                                            echo $doctor_gross = $gross_doctor_amount + $gross_doctor_amount_ot;
                                                            ?>
                                                    </div>
                                                    <div class="col-xs-8">
                                                        <div class="degree">
                                                           

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>




                                    <section class="">
                                        <div class="weather-bg">
                                            <div class="">
                                                <div class="row badge badge-info">
                                                    <div class="col-xs-4">
                                                       
                                                        <?php echo lang('gross_deposit'); ?> : <?php echo $settings->currency; ?>
                                                            <?php
                                                            $deposited_amount = array();
                                                            if (!empty($deposits)) {
                                                                foreach ($deposits as $deposit) {
                                                                    if (!empty($deposit->payment_id)) {
                                                                        $deposited_amount[] = $deposit->deposited_amount;
                                                                    }
                                                                }
                                                                $deposited_amount = array_sum($deposited_amount);
                                                                echo $deposited_amount;
                                                            } else {
                                                                echo '0';
                                                            }
                                                            ?>
                                                    </div>
                                                    <div class="col-xs-8">
                                                        <div class="degree">

                                                            

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>

                                    <section class="">
                                        <div class="weather-bg">
                                            <div class="">
                                                <div class="row badge badge-danger">
                                                    <div class="col-xs-4">
                                                       
                                                        <?php echo lang('gross_due'); ?> : <?php echo $settings->currency; ?>
                                                            <?php
                                                            $deposited_amount = array();
                                                            if (!empty($deposits)) {
                                                                foreach ($deposits as $deposit) {
                                                                    $deposited_amount[] = $deposit->deposited_amount;
                                                                }
                                                                if ($paid_number > 0) {
                                                                    $deposited_amount = array_sum($deposited_amount);
                                                                    echo $gross_bill - $deposited_amount;
                                                                } else {
                                                                    echo '0';
                                                                }
                                                            } else {
                                                                echo '0';
                                                            }
                                                            ?>
                                                    </div>
                                                    <div class="col-xs-8">
                                                        <div class="degree">

                                                            

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>

                                    <section class="">
                                        <div class="weather-bg">
                                            <div class="">
                                                <div class="row badge badge-danger">
                                                    <div class="col-xs-4">
                                                       
                                                        <?php echo lang('gross_expense'); ?> :  
                                                        <?php echo $settings->currency; ?>
                                                            <?php
                                                            if (!empty($total_expense_by_category)) {
                                                                echo array_sum($total_expense_by_category);
                                                            } else {
                                                                echo '0';
                                                            }
                                                            ?>
                                                    </div>
                                                    <div class="col-xs-8">
                                                        <div class="degree">
                                                           
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </section>

                                </div>
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
<!--footer start-->