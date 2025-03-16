<li class="nav-item menu-open">
    <a class="nav-link" href="home">
        <i class="nav-icon fas fa-th"></i>
        <p><?php echo lang('dashboard'); ?></p>
    </a>
</li>
<?php if ($this->ion_auth->in_group('admin')) { ?>
    <?php if (in_array('department', $this->modules)) { ?>
        <li class="nav-item">
            <a class="nav-link" href="department">
                <i class="nav-icon fas fa-sitemap"></i>
                <p><?php echo lang('departments'); ?></p>
            </a>
        </li>
    <?php } ?>
<?php } ?>
<?php if ($this->ion_auth->in_group(array('admin'))) { ?>
    <?php if (in_array('doctor', $this->modules)) { ?>
        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="nav-icon fa fa-user-md"></i>
                <p><?php echo lang('doctor'); ?><i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item"><a class="nav-link" href="doctor"><i class="nav-icon far fa-circle"></i>
                        <p> <?php echo lang('list_of_doctors'); ?></p>
                    </a></li>
                <li class="nav-item"><a class="nav-link" href="appointment/treatmentReport"><i class="nav-icon far fa-circle"></i>
                        <p> <?php echo lang('treatment_history'); ?></p>
                    </a></li>
                <li class="nav-item"><a class="nav-link" href="doctorvisit"><i class="nav-icon far fa-circle"></i>
                        <p> <?php echo lang('doctor_visit'); ?></p>
                    </a></li>
            </ul>
        </li>
    <?php } ?>
<?php } ?>
<?php if ($this->ion_auth->in_group(array('admin', 'Accountant', 'Nurse', 'Doctor', 'Laboratorist', 'Receptionist'))) { ?>
    <?php if (in_array('patient', $this->modules)) { ?>
        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="nav-icon far fa-user"></i>
                <p><?php echo lang('patient'); ?><i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item"><a class="nav-link" href="patient"><i class="nav-icon far fa-circle"></i>
                        <p><?php echo lang('patient_list'); ?></p>
                    </a></li>

                <?php if ($this->ion_auth->in_group(array('admin', 'Accountant', 'Doctor', 'Receptionist'))) { ?>
                    <li class="nav-item"><a class="nav-link" href="patient/patientPayments"><i class="nav-icon far fa-circle"></i>
                            <p><?php echo lang('payments'); ?></p>
                        </a></li>
                <?php } ?>
                <?php if (!$this->ion_auth->in_group(array('Accountant', 'Receptionist'))) { ?>
                    <li class="nav-item"><a class="nav-link" href="patient/caseList"><i class="nav-icon far fa-circle"></i>
                            <p><?php echo lang('case'); ?> <?php echo lang('manager'); ?></p>
                        </a></li>
                    <li class="nav-item"><a class="nav-link" href="patient/documents"><i class="nav-icon far fa-circle"></i>
                            <p><?php echo lang('documents'); ?></p>
                        </a></li>
                <?php } ?>
            </ul>
        </li>
    <?php } ?>
<?php } ?>


<?php if ($this->ion_auth->in_group(array('admin', 'Nurse', 'Receptionist'))) { ?>
    <?php if (in_array('appointment', $this->modules)) { ?>
        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="nav-icon far fa-clock"></i>
                <p><?php echo lang('schedule'); ?><i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item"><a class="nav-link" href="schedule"><i class="nav-icon far fa-circle"></i>
                        <p><?php echo lang('all'); ?> <?php echo lang('schedule'); ?></p>
                    </a></li>
                <li class="nav-item"><a class="nav-link" href="schedule/allHolidays"><i class="nav-icon far fa-circle"></i>
                        <p><?php echo lang('holidays'); ?></p>
                    </a></li>
            </ul>
        </li>
    <?php } ?>
<?php } ?>

<?php if ($this->ion_auth->in_group(array('Doctor'))) { ?>
    <?php if (in_array('appointment', $this->modules)) { ?>
        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="nav-icon far fa-clock"></i>
                <p><?php echo lang('schedule'); ?><i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item"><a class="nav-link" href="schedule/timeSchedule"><i class="nav-icon far fa-circle"></i>
                        <p><?php echo lang('all'); ?> <?php echo lang('schedule'); ?></p>
                    </a></li>
                <li class="nav-item"><a class="nav-link" href="schedule/holidays"><i class="nav-icon far fa-circle"></i>
                        <p><?php echo lang('holidays'); ?></p>
                    </a></li>
            </ul>
        </li>
    <?php } ?>
<?php } ?>

<?php if ($this->ion_auth->in_group(array('admin', 'Doctor', 'Nurse', 'Receptionist'))) { ?>
    <?php if (in_array('appointment', $this->modules)) { ?>
        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="nav-icon far fa-calendar-check"></i>
                <p><?php echo lang('appointment'); ?><i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item"><a class="nav-link" href="appointment"><i class="nav-icon far fa-circle"></i>
                        <p><?php echo lang('all'); ?> <?php echo lang('appointments'); ?></p>
                    </a></li>
                <li class="nav-item"><a class="nav-link" href="appointment/addNewView"><i class="nav-icon far fa-circle"></i>
                        <p><?php echo lang('add'); ?> <?php echo lang('appointment'); ?></p>
                    </a></li>
                <li class="nav-item"><a class="nav-link" href="appointment/todays"><i class="nav-icon far fa-circle"></i>
                        <p><?php echo lang('todays'); ?></p>
                    </a></li>
                <li class="nav-item"><a class="nav-link" href="appointment/upcoming"><i class="nav-icon far fa-circle"></i>
                        <p><?php echo lang('upcoming'); ?></p>
                    </a></li>
                <li class="nav-item"><a class="nav-link" href="appointment/calendar"><i class="nav-icon far fa-circle"></i>
                        <p><?php echo lang('calendar'); ?></p>
                    </a></li>
                <li class="nav-item"><a class="nav-link" href="appointment/request"><i class="nav-icon far fa-circle"></i>
                        <p><?php echo lang('request'); ?></p>
                    </a></li>
            </ul>
        </li>
    <?php } ?>
<?php } ?>

<?php if ($this->ion_auth->in_group(array(''))) { ?>
    <?php if (in_array('appointment', $this->modules)) { ?>
        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="nav-icon fas fa-headphones"></i>
                <p><?php echo lang('live'); ?> <?php echo lang('meetings'); ?><i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
                <?php if (!$this->ion_auth->in_group(array('Patient'))) { ?>
                    <li class="nav-item"><a class="nav-link" href="meeting/addNewView"><i class="nav-icon fas fa-plus-circle"></i>
                            <p><?php echo lang('create'); ?> <?php echo lang('meeting'); ?></p>
                        </a></li>
                <?php } ?>
                <li class="nav-item"><a class="nav-link" href="meeting"><i class="nav-icon far fa-video"></i>
                        <p><?php echo lang('live'); ?> <?php echo lang('now'); ?></p>
                    </a></li>
                <li class="nav-item"><a class="nav-link" href="meeting/upcoming"><i class="nav-icon far fa-circle"></i>
                        <p><?php echo lang('upcoming'); ?> <?php echo lang('meetings'); ?></p>
                    </a></li>
                <li class="nav-item"><a class="nav-link" href="meeting/previous"><i class="nav-icon far fa-circle"></i>
                        <p><?php echo lang('previous'); ?> <?php echo lang('meetings'); ?></p>
                    </a></li>
            </ul>
        </li>
    <?php } ?>
<?php } ?>



<?php if ($this->ion_auth->in_group(array(''))) { ?>
    <?php if (in_array('appointment', $this->modules)) { ?>
        <li class="nav-item"><a class="nav-link" href="meeting"><i class="nav-icon fas fa-headphones"></i>
                <p><?php echo lang('join_live'); ?></p>
            </a></li>
    <?php } ?>
<?php } ?>

<?php if ($this->ion_auth->in_group(array('Patient'))) { ?>
    <?php if (in_array('appointment', $this->modules)) { ?>
        <li class="nav-item"><a class="nav-link" href="appointment/myAppointments"><i class="nav-icon fas fa-calendar"></i>
                <p><?php echo lang('all'); ?> <?php echo lang('appointments'); ?></p>
            </a>
        </li>
        <li class="nav-item"><a class="nav-link" href="appointment/myTodays"><i class="nav-icon fas fa-headphones"></i>
                <p><?php echo lang('todays'); ?> <?php echo lang('appointment'); ?></p>
            </a>
        </li>
    <?php } ?>
    <?php if (in_array('notice', $this->modules)) { ?>
        <li class="nav-item"><a class="nav-link" href="notice"><i class="nav-icon fas fa-bell"></i>
                <p><?php echo lang('notice'); ?></p>
            </a></li>
    <?php } ?>
<?php } ?>






<?php if ($this->ion_auth->in_group('admin')) { ?>
    <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="nav-icon fas fa-users"></i>
            <p><?php echo lang('human_resources'); ?><i class="right fas fa-angle-left"></i></p>
        </a>
        <ul class="nav nav-treeview">
            <?php if (in_array('nurse', $this->modules)) { ?>
                <li class="nav-item"><a class="nav-link" href="nurse"><i class="nav-icon far fa-circle"></i>
                        <p><?php echo lang('nurse'); ?></p>
                    </a></li>
            <?php } ?>
            <?php if (in_array('pharmacist', $this->modules)) { ?>
                <li class="nav-item"><a class="nav-link" href="pharmacist"><i class="nav-icon far fa-circle"></i>
                        <p><?php echo lang('pharmacist'); ?></p>
                    </a></li>
            <?php } ?>
            <?php if (in_array('laboratorist', $this->modules)) { ?>
                <li class="nav-item"><a class="nav-link" href="laboratorist"><i class="nav-icon far fa-circle"></i>
                        <p><?php echo lang('laboratorist'); ?></p>
                    </a></li>
            <?php } ?>
            <?php if (in_array('accountant', $this->modules)) { ?>
                <li class="nav-item"><a class="nav-link" href="accountant"><i class="nav-icon far fa-circle"></i>
                        <p><?php echo lang('accountant'); ?></p>
                    </a></li>
            <?php } ?>
            <?php if (in_array('receptionist', $this->modules)) { ?>
                <li class="nav-item"><a class="nav-link" href="receptionist"><i class="nav-icon far fa-circle"></i>
                        <p><?php echo lang('receptionist'); ?></p>
                    </a></li>
            <?php } ?>
        </ul>
    </li>
<?php } ?>

<!-- NEW ADDITIONS -->
<?php if ($this->ion_auth->in_group(array('Accountant', 'Receptionist', 'Nurse', 'Laboratorist', 'Pharmacist', 'Doctor'))) { ?>
    <?php if (in_array('attendance', $this->modules)) { ?>
        <li class="nav-item">
            <a class="nav-link" href="attendance">
                <i class="nav-icon far fa-bell-slash"></i>
                <p><?php echo lang('attendance'); ?></p>
            </a>
        </li>

    <?php } ?>
    <?php if (in_array('leave', $this->modules)) { ?>
        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="nav-icon far fa-bell-slash"></i>
                <p><?php echo lang('leave'); ?><i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
                <?php if (in_array('leave', $this->modules)) { ?>
                    <li class="nav-item"><a class="nav-link" href="leave"><i class="nav-icon far fa-circle"></i>
                            <p><?php echo lang('leave'); ?></p>
                        </a></li>
                <?php } ?>
            </ul>
        </li>
    <?php } ?>
    <?php if (in_array('payroll', $this->modules)) { ?>
        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="nav-icon fas fa-money-check"></i>
                <p><?php echo lang('payroll'); ?><i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
                <?php if (in_array('payroll', $this->modules)) { ?>
                    <li class="nav-item"><a class="nav-link" href="payroll/employeePayroll"><i class="nav-icon far fa-circle"></i>
                            <p><?php echo lang('payroll'); ?></p>
                        </a></li>
                <?php } ?>
            </ul>
        </li>
    <?php } ?>
    <?php if (in_array('notice', $this->modules)) { ?>
        <li class="nav-item">
            <a class="nav-link" href="notice">
                <i class="nav-icon fas fa-bell"></i>
                <p><?php echo lang('notice'); ?></p>
            </a>
        </li>
    <?php } ?>
<?php } ?>


<?php if ($this->ion_auth->in_group('admin')) { ?>
    <?php if (in_array('finance', $this->modules)) { ?>
        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="nav-icon fas fa-money-check"></i>
                <p>
                    <?php echo lang('financial_activities'); ?>
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item"><a class="nav-link" href="finance/addPaymentView"><i class="nav-icon far fa-circle"></i>
                        <p><?php echo lang('add_payment'); ?></p>
                    </a></li>
                <li class="nav-item"><a class="nav-link" href="finance/payment"><i class="nav-icon far fa-circle"></i>
                        <p><?php echo lang('payments'); ?></p>
                    </a></li>
                <li class="nav-item"><a class="nav-link" href="finance/draftPayment"><i class="nav-icon far fa-circle"></i>
                        <p><?php echo lang('draft_payments'); ?></p>
                    </a></li>
                <li class="nav-item"><a class="nav-link" href="finance/dueCollection"><i class="nav-icon far fa-circle"></i>
                        <p><?php echo lang('due_collection'); ?></p>
                    </a></li>
                <!-- <li class="nav-item"><a  href="finance/addPaymentView"><i class="nav-icon fas fa-plus-circle"></i><p></p><?php echo lang('add_payment'); ?></a></li> -->
                <li class="nav-item"><a class="nav-link" href="finance/paymentCategory"><i class="nav-icon far fa-circle"></i>
                        <p><?php echo lang('payment_procedures'); ?></p>
                    </a></li>
                <li class="nav-item"><a class="nav-link" href="finance/category"><i class="nav-icon far fa-circle"></i>
                        <p><?php echo lang('payment_categories'); ?></p>
                    </a></li>
                <li class="nav-item"><a class="nav-link" href="finance/expense"><i class="nav-icon far fa-circle"></i>
                        <p><?php echo lang('expense'); ?></p>
                    </a></li>
                <li class="nav-item"><a class="nav-link" href="finance/addExpenseView"><i class="nav-icon far fa-circle"></i>
                        <p><?php echo lang('add_expense'); ?></p>
                    </a></li>
                <li class="nav-item"><a class="nav-link" href="finance/expenseCategory"><i class="nav-icon far fa-circle"></i>
                        <p><?php echo lang('expense_categories'); ?></p>
                    </a></li>


            </ul>
        </li>
    <?php } ?>
<?php } ?>

<?php if ($this->ion_auth->in_group('Receptionist')) { ?>
    <?php if (in_array('appointment', $this->modules)) { ?>
        <li class="nav-item">
            <a class="nav-link" href="appointment/calendar">
                <i class="nav-icon far fa-calendar"></i>
                <p> <?php echo lang('calendar'); ?> </p>
            </a>
        </li>
    <?php } ?>
    <?php if (in_array('finance', $this->modules)) { ?>
        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="nav-icon fas fa-money-check"></i>
                <p><?php echo lang('financial_activities'); ?><i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item"><a class="nav-link" href="finance/payment"><i class="nav-icon far fa-circle"></i>
                        <p><?php echo lang('payments'); ?></p>
                    </a></li>
                <li class="nav-item"><a class="nav-link" href="finance/addPaymentView"><i class="nav-icon far fa-circle"></i>
                        <p><?php echo lang('add_payment'); ?></p>
                    </a></li>
                <li class="nav-item"><a class="nav-link" href="finance/dueCollection"><i class="nav-icon far fa-circle"></i>
                        <p><?php echo lang('due_collection'); ?></p>
                    </a></li>
            </ul>
        </li>
    <?php } ?>
<?php } ?>



<?php if ($this->ion_auth->in_group(array('admin', 'Pharmacist'))) { ?>
    <?php if (in_array('prescription', $this->modules)) { ?>
        <li class="nav-item">
            <a class="nav-link" href="prescription/all">
                <i class="nav-icon fas fa-prescription"></i>
                <p>
                    <?php echo lang('prescription'); ?>
                </p>
            </a>
        </li>
    <?php } ?>
<?php } ?>

<?php
if ($this->ion_auth->in_group(array('Receptionist'))) {
?>
    <?php if (in_array('lab', $this->modules)) { ?>
        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="nav-icon fa fa-flask"></i>
                <p>
                    <?php echo lang('labs'); ?>
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item"><a class="nav-link" href="lab/testStatus"><i class="nav-icon far fa-circle"></i>
                        <p><?php echo lang('lab_tests'); ?></p>
                    </a></li>
                <li class="nav-item"><a class="nav-link" href="lab"><i class="nav-icon far fa-circle"></i>
                        <p><?php echo lang('lab_reports'); ?></p>
                    </a></li>
                <li class="nav-item"><a class="nav-link" href="lab/reportDelivery"><i class="nav-icon far fa-circle"></i>
                        <p><?php echo lang('report') . " " . lang('delivery');; ?></p>
                    </a></li>
            </ul>
        </li>
    <?php } ?>
<?php
}
?>

<?php
if ($this->ion_auth->in_group(array('Accountant', 'Receptionist'))) {
?>
    <?php if (in_array('finance', $this->modules)) { ?>
        <li class="nav-item">
            <a class="nav-link" href="finance/UserActivityReport">
                <i class="nav-icon fas fa-file"></i>
                <p><?php echo lang('user_activity_report'); ?></p>
            </a>
        </li>
    <?php } ?>
<?php
}
?>


<?php if ($this->ion_auth->in_group(array('Doctor'))) { ?>
    <?php if (in_array('prescription', $this->modules)) { ?>
        <li class="nav-item">
            <a class="nav-link" href="prescription">
                <i class="nav-icon fas fa-prescription"></i>
                <p><?php echo lang('prescription'); ?></p>
            </a>
        </li>
    <?php } ?>
<?php } ?>



<?php if ($this->ion_auth->in_group(array('admin', 'Doctor', 'Laboratorist'))) { ?>
    <?php if (in_array('lab', $this->modules)) { ?>
        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="nav-icon fa fa-flask"></i>
                <p><?php echo lang('labs'); ?><i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item"><a class="nav-link" href="lab/testStatus"><i class="nav-icon far fa-circle"></i>
                        <p><?php echo lang('lab_tests'); ?></p>
                    </a></li>
                <li class="nav-item"><a class="nav-link" href="lab"><i class="nav-icon far fa-circle"></i>
                        <p><?php echo lang('lab_reports'); ?></p>
                    </a></li>
                <li class="nav-item"><a class="nav-link" href="lab/reportDelivery"><i class="nav-icon far fa-circle"></i>
                        <p><?php echo lang('report') . " " . lang('delivery'); ?></p>
                    </a></li>
                <li class="nav-item"><a class="nav-link" href="lab/template"><i class="nav-icon far fa-circle"></i>
                        <p><?php echo lang('template'); ?></p>
                    </a></li>
                <li class="nav-item"><a class="nav-link" href="macro"><i class="nav-icon far fa-circle"></i>
                        <p><?php echo lang('macro'); ?></p>
                    </a></li>
            </ul>
        </li>
    <?php } ?>
<?php } ?>
<?php if ($this->ion_auth->in_group(array('admin'))) { ?>
    <?php if (in_array('bed', $this->modules)) { ?>
        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="nav-icon fas fa-procedures"></i>
                <p><?php echo lang('bed'); ?><i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item"><a class="nav-link" href="bed/bedAllotment"><i class=" nav-icon far fa-circle"></i>
                        <p><?php echo lang('all_admissions'); ?></p>
                    </a></li>
                <li class="nav-item"><a class="nav-link" href="bed/addAllotmentView"><i class="nav-icon far fa-circle"></i>
                        <p><?php echo lang('add_admission'); ?></p>
                    </a></li>
                <li class="nav-item"><a class="nav-link" href="bed"><i class="nav-icon far fa-circle"></i>
                        <p><?php echo lang('bed_list'); ?></p>
                    </a></li>
                <li class="nav-item"><a class="nav-link" href="bed/addBedView"><i class="nav-icon far fa-circle"></i>
                        <p><?php echo lang('add_bed'); ?></p>
                    </a></li>
                <li class="nav-item"><a class="nav-link" href="bed/bedCategory"><i class="nav-icon far fa-circle"></i>
                        <p><?php echo lang('bed_category'); ?></p>
                    </a></li>
                <li class="nav-item"><a class="nav-link" href="pservice"><i class="nav-icon far fa-circle"></i>
                        <p><?php echo lang('patient'); ?> <?php echo lang('service'); ?></p>
                    </a></li>
            </ul>
        </li>
    <?php } ?>
<?php } ?>
<?php if ($this->ion_auth->in_group(array('admin', 'Pharmacist'))) { ?>
    <?php if (in_array('pharmacy', $this->modules)) { ?>
        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="nav-icon fas fa-capsules"></i>
                <p><?php echo lang('pharmacy'); ?><i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
                <?php if (!$this->ion_auth->in_group(array('Pharmacist'))) { ?>
                    <li class="nav-item"><a class="nav-link" href="finance/pharmacy/home"><i class="nav-icon far fa-circle"></i>
                            <p><?php echo lang('dashboard'); ?></p>
                        </a></li>
                <?php } ?>
                <li class="nav-item"><a class="nav-link" href="finance/pharmacy/payment"><i class="nav-icon far fa-circle"></i>
                        <p><?php echo lang('sales'); ?></p>
                    </a></li>
                <li class="nav-item"><a class="nav-link" href="finance/pharmacy/addPaymentView"><i class="nav-icon far fa-circle"></i>
                        <p><?php echo lang('add_new_sale'); ?></p>
                    </a></li>
                <li class="nav-item"><a class="nav-link" href="finance/pharmacy/expense"><i class="nav-icon far fa-circle"></i>
                        <p><?php echo lang('expense'); ?></p>
                    </a></li>
                <li class="nav-item"><a class="nav-link" href="finance/pharmacy/addExpenseView"><i class="nav-icon far fa-circle"></i>
                        <p><?php echo lang('add_expense'); ?></p>
                    </a></li>
                <li class="nav-item"><a class="nav-link" href="finance/pharmacy/expenseCategory"><i class="nav-icon far fa-circle"></i>
                        <p><?php echo lang('expense_categories'); ?></p>
                    </a></li>
                <?php if ($this->ion_auth->in_group(array('admin', 'Pharmacist'))) { ?>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <i class="nav-icon far fa-circle"></i>
                            <p><?php echo lang(''); ?> <?php echo lang('report'); ?><i class="right fas fa-angle-left"></i></p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item"><a class="nav-link" href="finance/pharmacy/financialReport"><i class="nav-icon far fa-circle"></i>
                                    <p><?php echo lang('pharmacy'); ?> <?php echo lang('report'); ?></p>
                                </a></li>
                            <li class="nav-item"><a class="nav-link" href="finance/pharmacy/monthly"><i class="nav-icon far fa-circle"></i>
                                    <p><?php echo lang('monthly_sales'); ?></p>
                                </a></li>
                            <li class="nav-item"><a class="nav-link" href="finance/pharmacy/daily"><i class="nav-icon far fa-circle"></i>
                                    <p><?php echo lang('daily_sales'); ?></p>
                                </a></li>
                            <li class="nav-item"><a class="nav-link" href="finance/pharmacy/monthlyExpense"><i class="nav-icon far fa-circle"></i>
                                    <p><?php echo lang('monthly_expense'); ?></p>
                                </a></li>
                            <li class="nav-item"><a class="nav-link" href="finance/pharmacy/dailyExpense"><i class="nav-icon far fa-circle"></i>
                                    <p><?php echo lang('daily_expense'); ?></p>
                                </a></li>

                        </ul>
                    </li>
                <?php } ?>
            </ul>
        </li>
    <?php } ?>
<?php } ?>
<?php if ($this->ion_auth->in_group(array('admin'))) { ?>
    <?php if (in_array('medicine', $this->modules)) { ?>
        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="nav-icon fas  fa-medkit"></i>
                <p><?php echo lang('medicine'); ?><i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item"><a class="nav-link" href="medicine"><i class="nav-icon far fa-circle"></i>
                        <p><?php echo lang('medicine_list'); ?></p>
                    </a></li>
                <li class="nav-item"><a class="nav-link" href="medicine/addMedicineView"><i class="nav-icon far fa-circle"></i>
                        <p><?php echo lang('add_medicine'); ?></p>
                    </a></li>
                <li class="nav-item"><a class="nav-link" href="medicine/medicineCategory"><i class="nav-icon far fa-circle"></i>
                        <p><?php echo lang('medicine_category'); ?></p>
                    </a></li>
                <li class="nav-item"><a class="nav-link" href="medicine/addCategoryView"><i class="nav-icon far fa-circle"></i>
                        <p><?php echo lang('add_medicine_category'); ?></p>
                    </a></li>
                <li class="nav-item"><a class="nav-link" href="medicine/medicineStockAlert"><i class="nav-icon far fa-circle"></i>
                        <p><?php echo lang('medicine_stock_alert'); ?></p>
                    </a></li>

            </ul>
        </li>
    <?php } ?>
<?php } ?>
<?php if ($this->ion_auth->in_group(array('admin', 'Laboratorist'))) { ?>
    <?php if (in_array('donor', $this->modules)) { ?>
        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="nav-icon fas fa-hand-holding-water"></i>
                <p><?php echo lang('donor') ?><i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item"><a class="nav-link" href="donor"><i class="nav-icon far fa-circle"></i>
                        <p><?php echo lang('donor_list'); ?></p>
                    </a></li>
                <li class="nav-item"><a class="nav-link" href="donor/addDonorView"><i class="nav-icon far fa-circle"></i>
                        <p><?php echo lang('add_donor'); ?></p>
                    </a></li>
                <li class="nav-item"><a class="nav-link" href="donor/bloodBank"><i class="nav-icon far fa-circle"></i>
                        <p><?php echo lang('blood_bank'); ?></p>
                    </a></li>
            </ul>
        </li>
    <?php } ?>
<?php } ?>
<?php if ($this->ion_auth->in_group(array('admin', 'Nurse', 'Accountant', 'Pharmacist', 'Doctor', 'Laboratorist', 'Receptionist'))) { ?>
    <?php if (in_array('file', $this->modules)) { ?>
        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="nav-icon far fa-clock"></i>
                <p><?php echo lang('file_manager'); ?><i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item"><a class="nav-link" href="file"><i class="nav-icon far fa-circle"></i>
                        <p><?php echo lang('all'); ?> <?php echo lang('file'); ?></p>
                    </a></li>
                <li class="nav-item"><a class="nav-link" href="file/addNewView"><i class="nav-icon far fa-circle"></i>
                        <p><?php echo lang('add_file'); ?></p>
                    </a></li>
            </ul>
        </li>
    <?php } ?>
<?php } ?>
<?php if ($this->ion_auth->in_group(array('admin', 'Nurse', 'Laboratorist', 'Doctor'))) { ?>
    <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="nav-icon fas fa-file-medical-alt"></i>
            <p><?php echo lang('report'); ?><i class="right fas fa-angle-left"></i></p>
        </a>
        <ul class="nav nav-treeview">
            <?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                <?php if (in_array('finance', $this->modules)) { ?>
                    <li class="nav-item"><a class="nav-link" href="finance/financialReport"><i class="nav-icon far fa-circle"></i>
                            <p><?php echo lang('financial_report'); ?></p>
                        </a></li>
                    <li class="nav-item"> <a class="nav-link" href="finance/AllUserActivityReport"> <i class="nav-icon far fa-circle"></i>
                            <p><?php echo lang('user_activity_report'); ?></p>
                        </a></li>
                <?php } ?>
            <?php } ?>
            <?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                <?php if (in_array('finance', $this->modules)) { ?>
                    <li class="nav-item"><a class="nav-link" href="finance/doctorsCommission"><i class="nav-icon far fa-circle"></i>
                            <p><?php echo lang('doctors_commission'); ?></p>
                        </a></li>
                    <li class="nav-item"><a class="nav-link" href="finance/monthly"><i class="nav-icon far fa-circle"></i>
                            <p><?php echo lang('monthly_sales'); ?></p>
                        </a></li>
                    <li class="nav-item"><a class="nav-link" href="finance/daily"><i class="nav-icon far fa-circle"></i>
                            <p><?php echo lang('daily_sales'); ?></p>
                        </a></li>
                    <li class="nav-item"><a class="nav-link" href="finance/monthlyExpense"><i class="nav-icon far fa-circle"></i>
                            <p><?php echo lang('monthly_expense'); ?></p>
                        </a></li>
                    <li class="nav-item"><a class="nav-link" href="finance/dailyExpense"><i class="nav-icon far fa-circle"></i>
                            <p><?php echo lang('daily_expense'); ?></p>
                        </a></li>
                    <li class="nav-item"><a class="nav-link" href="finance/expenseVsIncome"><i class="nav-icon far fa-circle"></i>
                            <p><?php echo lang('expense_vs_income'); ?></p>
                        </a></li>
                <?php } ?>
            <?php } ?>
            <?php if (in_array('report', $this->modules)) { ?>
                <li class="nav-item"><a class="nav-link" href="report/birth"><i class="nav-icon far fa-circle"></i>
                        <p><?php echo lang('birth_report'); ?></p>
                    </a></li>
                <li class="nav-item"><a class="nav-link" href="report/operation"><i class="nav-icon far fa-circle"></i>
                        <p><?php echo lang('operation_report'); ?></p>
                    </a></li>
                <li class="nav-item"><a class="nav-link" href="report/expire"><i class="nav-icon far fa-circle"></i>
                        <p><?php echo lang('expire_report'); ?></p>
                    </a></li>
            <?php } ?>
        </ul>
    </li>
<?php } ?>
<?php if ($this->ion_auth->in_group(array('admin'))) { ?>
    <?php if (in_array('notice', $this->modules)) { ?>
        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="nav-icon fas fa-bell"></i>
                <p><?php echo lang('notice'); ?><i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item"><a class="nav-link" href="notice"><i class="nav-icon far fa-circle"></i>
                        <p><?php echo lang('notice'); ?></p>
                    </a></li>
                <li class="nav-item"><a class="nav-link" href="notice/addNewView"><i class="nav-icon far fa-circle"></i>
                        <p><?php echo lang('add_new'); ?></p>
                    </a></li>
            </ul>
        </li>
    <?php } ?>
<?php } ?>
<?php if ($this->ion_auth->in_group(array('admin'))) { ?>
    <?php if (in_array('email', $this->modules)) { ?>
        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="nav-icon far fa-envelope"></i>
                <p>
                    <?php echo lang('email'); ?>
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>

            <ul class="nav nav-treeview">
                <li class="nav-item"><a class="nav-link" href="email/autoEmailTemplate"><i class="nav-icon far fa-circle"></i>
                        <p><?php echo lang('autoemailtemplate'); ?></p>
                    </a></li>
                <li class="nav-item"><a class="nav-link" href="email/sendView"><i class="nav-icon far fa-circle"></i>
                        <p><?php echo lang('new'); ?></p>
                    </a></li>
                <li class="nav-item"><a class="nav-link" href="email/sent"><i class="nav-icon far fa-circle"></i>
                        <p><?php echo lang('sent'); ?></p>
                    </a></li>
                <?php
                if ($this->ion_auth->in_group(array('admin'))) {
                    $mail_setting = $this->email_model->getHospitalEmailSettings();
                    foreach ($mail_setting as $email_set) {
                        if ($email_set->type == 'Smtp') {
                            $email_id = $email_set->id;
                        }
                    }
                ?>
                    <li class="nav-item"><a class="nav-link" href="email/settings?id=<?php echo $email_id; ?>"><i class="nav-icon far fa-circle"></i>
                            <p><?php echo lang('settings'); ?></p>
                        </a></li>
                <?php } ?>
            </ul>
        </li>
    <?php } ?>
<?php } ?>
<?php if ($this->ion_auth->in_group(array('admin'))) { ?>
    <?php if (in_array('sms', $this->modules)) { ?>
        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="nav-icon fas fa-sms"></i>
                <p><?php echo lang('sms'); ?><i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item"><a class="nav-link" href="sms/autoSMSTemplate"><i class="nav-icon far fa-circle"></i>
                        <p><?php echo lang('autosmstemplate'); ?></p>
                    </a></li>
                <li class="nav-item"><a class="nav-link" href="sms/sendView"><i class="nav-icon far fa-circle"></i>
                        <p><?php echo lang('write_message'); ?></p>
                    </a></li>
                <li class="nav-item"><a class="nav-link" href="sms/sent"><i class="nav-icon far fa-circle"></i>
                        <p><?php echo lang('sent_messages'); ?></p>
                    </a></li>
                <?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                    <li class="nav-item"><a class="nav-link" href="sms"><i class="nav-icon far fa-circle"></i>
                            <p><?php echo lang('sms_settings'); ?></p>
                        </a></li>
                <?php } ?>
            </ul>
        </li>
    <?php } ?>
<?php } ?>
<?php if ($this->ion_auth->in_group(array('admin'))) { ?>
    <?php if (in_array('payroll', $this->modules)) { ?>
        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="nav-icon fas fa-money-check"></i>
                <p><?php echo lang('payroll'); ?><i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
                <?php if (in_array('payroll', $this->modules)) { ?>
                    <li class="nav-item"><a class="nav-link" href="payroll"><i class="nav-icon far fa-circle"></i>
                            <p><?php echo lang('payroll'); ?></p>
                        </a></li>
                <?php } ?>
                <?php if (in_array('payroll', $this->modules)) { ?>
                    <li class="nav-item"><a class="nav-link" href="payroll/salary"><i class="nav-icon far fa-circle"></i>
                            <p><?php echo lang('salary'); ?></p>
                        </a></li>
                <?php } ?>
            </ul>
        </li>
<?php
    }
}
?>
<?php if ($this->ion_auth->in_group(array('admin'))) { ?>
    <?php if (in_array('attendance', $this->modules)) { ?>
        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="nav-icon far fa-bell-slash"></i>
                <p><?php echo lang('attendance'); ?><i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">

                <li class="nav-item"><a class="nav-link" href="attendance"><i class="nav-icon far fa-circle"></i>
                        <p><?php echo lang('attendance'); ?></p>
                    </a></li>


                <li class="nav-item"><a class="nav-link" href="attendance/report"><i class="nav-icon far fa-circle"></i>
                        <p><?php echo lang('attendance'); ?> <?php echo lang('report'); ?></p>
                    </a></li>


            </ul>
        </li>
<?php
    }
}
?>
<?php if ($this->ion_auth->in_group(array('admin'))) { ?>
    <?php if (in_array('leave', $this->modules)) { ?>
        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="nav-icon far fa-bell-slash"></i>
                <p><?php echo lang('leave'); ?><i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
                <?php if (in_array('leave', $this->modules)) { ?>
                    <li class="nav-item"><a class="nav-link" href="leave"><i class="nav-icon far fa-circle"></i>
                            <p><?php echo lang('leave'); ?></p>
                        </a></li>
                <?php } ?>
                <?php if (in_array('leave', $this->modules)) { ?>
                    <li class="nav-item"><a class="nav-link" href="leave/leaveType"><i class="nav-icon far fa-circle"></i>
                            <p><?php echo lang('leave_type'); ?></p>
                        </a></li>
                <?php } ?>
            </ul>
        </li>
<?php
    }
}
?>
<?php if ($this->ion_auth->in_group(array('admin', 'Nurse', 'Accountant', 'Pharmacist', 'Doctor', 'Laboratorist', 'Receptionist'))) { ?>
    <?php if (in_array('chat', $this->modules)) { ?>
        <li class="nav-item">
        <li class="nav-item"><a class="nav-link" href="chat"><i class="nav-icon far fa-comment"></i>
                <p><?php echo lang('chat'); ?></p>
                <p id="chatCount">0</p>
            </a></li>
        </li>
        <script src="common/js/jquery.js"></script>
        <script src="common/extranal/js/chat.js"></script>
    <?php } ?>
<?php } ?>
<?php if ($this->ion_auth->in_group(array('admin'))) { ?>
    <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="nav-icon fas fa-globe"></i>
            <p><?php echo lang('website'); ?><i class="right fas fa-angle-left"></i></p>
        </a>
        <?php

        $hospital_username = $this->db->get_where('hospital', array('id' => $this->session->userdata('hospital_id')))->row()->username;
        if (empty($hospital_username)) {
            $hospital_username = '';
        }

        ?>
        <ul class="nav nav-treeview">
            <li class="nav-item"><a class="nav-link" href='site/<?php echo $hospital_username ?>' target="_blank"><i class="nav-icon far fa-circle"></i>
                    <p><?php echo lang('visit_site'); ?></p>
                </a></li>
            <li class="nav-item"><a class="nav-link" href="site/settings"><i class="nav-icon far fa-circle"></i>
                    <p><?php echo lang('website_settings'); ?></p>
                </a></li>
            <li class="nav-item"><a class="nav-link" href="site/review"><i class="nav-icon far fa-circle"></i>
                    <p><?php echo lang('reviews'); ?></p>
                </a></li>
            <li class="nav-item"><a class="nav-link" href="site/gridsection"><i class="nav-icon far fa-circle"></i>
                    <p><?php echo lang('gridsections'); ?></p>
                </a></li>
            <li class="nav-item"><a class="nav-link" href="site/gallery"><i class="nav-icon far fa-circle"></i>
                    <p><?php echo lang('gallery'); ?></p>
                </a></li>
            <li class="nav-item"><a class="nav-link" href="site/slide"><i class="nav-icon far fa-circle"></i>
                    <p><?php echo lang('slides'); ?></p>
                </a></li>
            <li class="nav-item"><a class="nav-link" href="site/service"><i class="nav-icon far fa-circle"></i>
                    <p><?php echo lang('services'); ?></p>
                </a></li>
            <li class="nav-item"><a class="nav-link" href="site/featured"><i class="nav-icon far fa-circle"></i>
                    <p><?php echo lang('featured_doctors'); ?></p>
                </a></li>
        </ul>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="nav-icon fas fa-cog"></i>
            <p><?php echo lang('settings'); ?><i class="right fas fa-angle-left"></i></p>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item"><a class="nav-link" href="settings"><i class="nav-icon far fa-circle"></i>
                    <p><?php echo lang('system_settings'); ?></p>
                </a></li>
            <li class="nav-item"><a class="nav-link" href="pgateway"><i class="nav-icon far fa-circle"></i>
                    <p><?php echo lang('payment_gateway'); ?></p>
                </a></li>
            <li class="nav-item"><a class="nav-link" href="settings/language"><i class="nav-icon far fa-circle"></i>
                    <p><?php echo lang('language'); ?></p>
                </a></li>
            <?php if ($this->ion_auth->in_group(array('admin'))) { ?>
                <li class="nav-item"><a class="nav-link" href="import"><i class="nav-icon far fa-circle"></i>
                        <p><?php echo lang('bulk'); ?> <?php echo lang('import'); ?></p>
                    </a></li>
            <?php } ?>
            <!-- <li class="nav-item"><a class="nav-link" href="logs"><i class="nav-icon far fa-history"></i><p></p><?php echo lang('login_logs'); ?></a></li> -->
        </ul>
    </li>
<?php } ?>
<?php if ($this->ion_auth->in_group('Accountant')) { ?>
    <?php if (in_array('finance', $this->modules)) { ?>
        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="nav-icon far fa-money-bill-alt"></i>
                <p><?php echo lang('payments'); ?><i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a class="nav-link" href="finance/payment">
                        <i class="nav-icon far fa-circle"></i>
                        <p> <?php echo lang('payments'); ?> </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="finance/addPaymentView">
                        <i class="nav-icon far fa-circle"></i>
                        <p> <?php echo lang('add_payment'); ?> </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="finance/dueCollection"><i class="nav-icon far fa-circle"></i>
                        <p> <?php echo lang('due_collection'); ?> </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="finance/paymentCategory">
                        <i class="nav-icon far fa-circle"></i>
                        <p> <?php echo lang('payment_procedures'); ?> </p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="finance/expense">
                <i class="nav-icon fas fa-money-check"></i>
                <p> <?php echo lang('expense'); ?> </p>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="finance/addExpenseView">
                <i class="nav-icon fas fa-plus-circle"></i>
                <p> <?php echo lang('add_expense'); ?> </p>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="finance/expenseCategory">
                <i class="nav-icon far fa-edit"></i>
                <p> <?php echo lang('expense_categories'); ?> </p>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="finance/doctorsCommission">
                <i class="nav-icon far fa-edit"></i>
                <p> <?php echo lang('doctors_commission'); ?> </p>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="finance/financialReport">
                <i class="nav-icon fas fa-book"></i>
                <p> <?php echo lang('financial_report'); ?> </p>
            </a>
        </li>
    <?php } ?>
<?php } ?>
<?php if ($this->ion_auth->in_group('Pharmacist')) { ?>
    <?php if (in_array('medicine', $this->modules)) { ?>
        <li class="nav-item">
            <a class="nav-link" href="medicine">
                <i class="nav-icon fas fa-medkit"></i>
                <p> <?php echo lang('medicine_list'); ?> </p>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="medicine/addMedicineView">
                <i class="nav-icon fas fa-plus-circle"></i>
                <p> <?php echo lang('add_medicine'); ?> </p>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="medicine/medicineCategory">
                <i class="nav-icon fas fa-medkit"></i>
                <p> <?php echo lang('medicine_category'); ?> </p>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="medicine/addCategoryView">
                <i class="nav-icon fas fa-plus-circle"></i>
                <p> <?php echo lang('add_medicine_category'); ?> </p>
            </a>
        </li>
    <?php } ?>
<?php } ?>
<?php if ($this->ion_auth->in_group('Nurse')) { ?>
    <?php if (in_array('bed', $this->modules)) { ?>
        <li class="nav-item">
            <a class="nav-link" href="bed">
                <i class="nav-icon fas fa-procedures"></i>
                <p> <?php echo lang('bed_list'); ?> </p>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="bed/bedCategory">
                <i class="nav-icon far fa-edit"></i>
                <p> <?php echo lang('bed_category'); ?> </p>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="bed/bedAllotment">
                <i class="nav-icon fas fa-plus-circle"></i>
                <p> <?php echo lang('bed_allotments'); ?> </p>
            </a>
        </li>
    <?php } ?>
    <?php if (in_array('donor', $this->modules)) { ?>
        <li class="nav-item">
            <a class="nav-link" href="donor">
                <i class="nav-icon fas fa-medkit"></i>
                <p> <?php echo lang('donor'); ?> </p>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="donor/bloodBank">
                <i class="nav-icon fas fa-tint"></i>
                <p> <?php echo lang('blood_bank'); ?> </p>
            </a>
        </li>
    <?php } ?>
<?php } ?>
<?php if ($this->ion_auth->in_group('Patient')) { ?>
    <?php if (in_array('lab', $this->modules)) { ?>
        <li class="nav-item">
            <a class="nav-link" href="lab/myLab">
                <i class="nav-icon fas fa-file-medical-alt"></i>
                <p> <?php echo lang('diagnosis'); ?> <?php echo lang('reports'); ?> </p>
            </a>
        </li>
    <?php } ?>
    <?php if (in_array('appointment', $this->modules)) { ?>
        <li class="nav-item">
            <a class="nav-link" href="patient/calendar">
                <i class="nav-icon far fa-calendar"></i>
                <p> <?php echo lang('appointment'); ?> <?php echo lang('calendar'); ?> </p>
            </a>
        </li>
    <?php } ?>
    <?php if (in_array('patient', $this->modules)) { ?>
        <li class="nav-item">
            <a class="nav-link" href="patient/myCaseList">
                <i class="nav-icon fas fa-file-medical"></i>
                <p> <?php echo lang('cases'); ?> </p>
            </a>
        </li>
    <?php } ?>
    <?php if (in_array('prescription', $this->modules)) { ?>
        <li class="nav-item">
            <a class="nav-link" href="patient/myPrescription">
                <i class="nav-icon fas fa-prescription"></i>
                <p> <?php echo lang('prescription'); ?> </p>
            </a>
        </li>
    <?php } ?>
    <?php if (in_array('patient', $this->modules)) { ?>
        <li class="nav-item">
            <a class="nav-link" href="patient/myDocuments">
                <i class="nav-icon fas fa-file-upload"></i>
                <p> <?php echo lang('documents'); ?> </p>
            </a>
        </li>
    <?php } ?>
    <?php if (in_array('finance', $this->modules)) { ?>
        <li class="nav-item">
            <a class="nav-link" href="patient/myPaymentHistory">
                <i class="nav-icon far fa-money-bill-alt"></i>
                <p> <?php echo lang('payment'); ?> </p>
            </a>
        </li>
    <?php } ?>
    <?php if (in_array('report', $this->modules)) { ?>
        <li class="nav-item">
            <a class="nav-link" href="report/myreports">
                <i class="nav-icon fas fa-file-medical-alt"></i>
                <p> <?php echo lang('other'); ?> <?php echo lang('reports'); ?> </p>
            </a>
        </li>
    <?php } ?>
    <?php if (in_array('donor', $this->modules)) { ?>
        <li class="nav-item">
            <a class="nav-link" href="donor">
                <i class="nav-icon far fa-user"></i>
                <p><?php echo lang('donor'); ?></p>
            </a>
        </li>
    <?php } ?>
<?php } ?>
<?php if ($this->ion_auth->in_group('im')) { ?>
    <li class="nav-item">
        <a class="nav-link" href="patient/addNewView">
            <i class="nav-icon far fa-user"></i>
            <p> <?php echo lang('add_patient'); ?> </p>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="finance/addPaymentView">
            <i class="nav-icon far fa-user"></i>
            <p> <?php echo lang('add_payment'); ?> </p>
        </a>
    </li>
<?php } ?>
<?php if (!$this->ion_auth->in_group(array('admin', 'Patient', 'superadmin'))) { ?>
    <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="nav-icon far fa-envelope"></i>
            <p>
                <?php echo lang('email'); ?>
                <i class="right fas fa-angle-left"></i>
            </p>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item"><a class="nav-link" href="email/sendView"><i class="nav-icon far fa-circle"></i>
                    <p><?php echo lang('new'); ?></p>
                </a></li>
        </ul>
    </li>
<?php } ?>
<?php if ($this->ion_auth->in_group('superadmin')) { ?>
    <?php if (in_array('superadmin', $this->super_modules)) { ?>
        <li class=" nav-item">
            <a class="nav-link" href="superadmin">
                <i class="nav-icon fas fa-users"></i>
                <p><?php echo lang('superadmin'); ?></p>
            </a>
        </li>
    <?php } ?>
    <?php if (in_array('hospital', $this->super_modules)) { ?>
        <li class="nav-item">
            <a class="nav-link" href="hospital">
                <i class="nav-icon fas fa-sitemap"></i>
                <p><?php echo lang('all_hospitals'); ?></p>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="hospital/addNewView">
                <i class="nav-icon fas fa-plus-circle"></i>
                <p><?php echo lang('create_new_hospital'); ?></p>
            </a>
        </li>
    <?php } ?>
    <?php if (in_array('package', $this->super_modules)) { ?>
        <li class="nav-item">
            <a class="nav-link" href="hospital/package">
                <i class="nav-icon fas fa-sitemap"></i>
                <p><?php echo lang('packages'); ?></p>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="hospital/package/addNewView">
                <i class="nav-icon fas fa-plus-circle"></i>
                <p><?php echo lang('add_new_package'); ?></p>
            </a>
        </li>
    <?php } ?>
    <?php if (in_array('request', $this->super_modules)) { ?>
        <li class="nav-item">
            <a class="nav-link" href="request">
                <i class="nav-icon fas fa-sitemap"></i>
                <p><?php echo lang('registration_from_website'); ?></p>
            </a>
        </li>
    <?php } ?>
    <?php if (in_array('systems', $this->super_modules)) { ?>
        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="nav-icon far fa-file-excel"></i>
                <p><?php echo lang('report'); ?><i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item"><a class="nav-link" href="systems/activeHospitals"><i class="nav-icon far fa-circle"></i>
                        <p><?php echo lang('active_hospitals'); ?></p>
                    </a></li>
                <li class="nav-item"><a class="nav-link" href="systems/inactiveHospitals"><i class="nav-icon far fa-circle"></i>
                        <p><?php echo lang('inactive_hospitals'); ?></p>
                    </a></li>
                <li class="nav-item"><a class="nav-link" href="systems/expiredHospitals"><i class="nav-icon far fa-circle"></i>
                        <p><?php echo lang('license_expire_hospitals'); ?></p>
                    </a></li>
                <li class="nav-item"><a class="nav-link" href="systems/registeredPatient"><i class="nav-icon far fa-circle"></i>
                        <p><?php echo lang('registered_patient'); ?></p>
                    </a></li>
                <li class="nav-item"><a class="nav-link" href="systems/registeredDoctor"><i class="nav-icon far fa-circle"></i>
                        <p><?php echo lang('registered_doctor'); ?></p>
                    </a></li>
                <li class="nav-item"><a class="nav-link" href="hospital/reportSubscription"><i class="nav-icon far fa-circle"></i>
                        <p><?php echo lang('subscription_report'); ?></p>
                    </a></li>
            </ul>
        </li>
    <?php } ?>
    <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="nav-icon fas fa-cogs"></i>
            <p><?php echo lang('website'); ?><i class="right fas fa-angle-left"></i></p>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item"><a class="nav-link" href="frontend" target="_blank"><i class="nav-icon far fa-circle"></i>
                    <p><?php echo lang('visit_site'); ?></p>
                </a></li>
            <li class="nav-item"><a class="nav-link" href="frontend/settings"><i class="nav-icon far fa-circle"></i>
                    <p><?php echo lang('website_settings'); ?></p>
                </a></li>
            <?php if (in_array('slide', $this->super_modules)) { ?>
                <li class="nav-item"><a class="nav-link" href="slide"><i class="nav-icon far fa-circle"></i>
                        <p><?php echo lang('slides'); ?></p>
                    </a></li>
            <?php } ?>
            <?php if (in_array('service', $this->super_modules)) { ?>
                <li class="nav-item"><a class="nav-link" href="service"><i class="nav-icon far fa-circle"></i>
                        <p><?php echo lang('services'); ?></p>
                    </a></li>
            <?php } ?>
        </ul>
    </li>
<?php } ?>
<?php if ($this->ion_auth->in_group(array('superadmin'))) { ?>
    <?php if (in_array('email', $this->super_modules)) { ?>
        <li class="nav-item">
            <a class="nav-link" href="#">
                <i class="nav-icon far fa-envelope"></i>
                <p><?php echo lang('email'); ?><i class="right fas fa-angle-left"></i></p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item"><a class="nav-link" href="email/superadminSendView"><i class="nav-icon far fa-circle"></i>
                        <p><?php echo lang('new'); ?></p>
                    </a></li>
                <li class="nav-item"><a class="nav-link" href="email/sent"><i class="nav-icon far fa-circle"></i>
                        <p><?php echo lang('sent'); ?></p>
                    </a></li>

                <li class="nav-item"><a class="nav-link" href="email/emailSettings"><i class="nav-icon far fa-circle"></i>
                        <p><?php echo lang('settings'); ?></p>
                    </a></li>
                <li class="nav-item"><a class="nav-link" href="email/contactEmailSettings"><i class="nav-icon far fa-circle"></i>
                        <p><?php echo lang('contact'); ?> <?php echo lang('email'); ?></p>
                    </a></li>
            </ul>
        </li>
    <?php } ?>
<?php } ?>
<?php if ($this->ion_auth->in_group(array('superadmin'))) { ?>
    <li class="nav-item"><a class="nav-link" href="settings"><i class="nav-icon fas fa-cog"></i>
            <p><?php echo lang('system_settings'); ?></p>
        </a></li>
    <li class="nav-item"><a class="nav-link" href="settings/googleReCaptcha"><i class="nav-icon fas fa-cog"></i>Google reCAPTCHA</a></li>
    <?php if (in_array('pgateway', $this->super_modules)) { ?>
        <li class="nav-item"><a class="nav-link" href="pgateway"><i class="nav-icon far fa-credit-card"></i>
                <p><?php echo lang('payment_gateway'); ?></p>
            </a></li>
    <?php } ?>
    <li class="nav-item"><a class="nav-link" href="settings/language"><i class="nav-icon fas fa-language"></i>
            <p><?php echo lang('language'); ?></p>
        </a></li>
    <!-- <li class="nav-item"><a class="nav-link" href="settings/verifyPurchase"><i class="nav-icon far fa-arrow-right"></i> <p></p> <?php echo lang('purchase_code'); ?></a></li> -->
<?php } ?>
<?php if ($this->ion_auth->in_group(array('admin'))) { ?>
    <li class="nav-item">
        <a class="nav-link" href="#">
            <i class="nav-icon fas fa-history"></i>
            <p><?php echo lang('logs'); ?><i class="right fas fa-angle-left"></i></p>
        </a>
        <ul class="nav nav-treeview">
            <li class="nav-item"><a class="nav-link" href="transactionLogs"><i class="nav-icon far fa-circle"></i>
                    <p><?php echo lang('transaction_logs'); ?></p>
                </a></li>
            <li class="nav-item"><a class="nav-link" href="logs"><i class="nav-icon far fa-circle"></i>
                    <p><?php echo lang('user'); ?> <?php echo lang('login_logs'); ?></p>
                </a></li>
        </ul>
    </li>
<?php } ?>
<li class="nav-item">
    <a class="nav-link" href="profile">
        <i class="nav-icon fas fa-user"></i>
        <p> <?php echo lang('profile'); ?> </p>
    </a>
</li>
<?php if ($this->ion_auth->in_group('admin')) { ?>
    <li class="nav-item">
        <a class="nav-link" href="settings/subscription">
            <i class="nav-icon far fa-user"></i>
            <p> <?php echo lang('subscription'); ?> </p>
        </a>
    </li>
<?php } ?>

<li class="nav-item">
    <a class="nav-link" href="auth/logout">
        <i class="nav-icon fas fa-sign-out-alt"></i>
        <p> <?php echo lang('log_out'); ?> </p>
    </a>
</li>