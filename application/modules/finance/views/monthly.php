<!--sidebar end-->
<!--main content start-->
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<link href="common/extranal/css/finance/monthly.css" rel="stylesheet">

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><i class="fa fa-money-bill-wave"></i> <?php echo date('Y', $first_minute) . ' ' . lang('hospital') . ' ' . lang('sales_report'); ?>
                        <?php if(isset($is_current_year) && $is_current_year): ?>
                            <span class="badge badge-primary ml-2"><?php echo lang('current_year'); ?></span>
                        <?php endif; ?>
                    </h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="home"><?php echo lang('home') ?></a></li>
                        <li class="breadcrumb-item active"> <?php echo date('Y', $first_minute) . ' ' . lang('hospital') . ' ' . lang('sales_report'); ?></li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title"><i class="fas fa-chart-line mr-2"></i><?php echo date('Y', $first_minute) . ' ' . lang('hospital') . ' ' . lang('sales_report'); ?>
                                <?php if(isset($is_current_year) && $is_current_year): ?>
                                    <span class="badge badge-primary ml-2"><?php echo lang('current_year'); ?></span>
                                <?php endif; ?>
                            </h3>
                            <?php
                            $currently_processing_year = date('Y', $first_minute);
                            $next_year = $currently_processing_year + 1;
                            $previous_year = $currently_processing_year - 1;
                            ?>

                            <div class="float-right no-print mr-1">
                                <a class="btn btn-sm btn-secondary no-print float-right btn-print" title="<?php echo lang('print'); ?>"> <i class="fa fa-print"></i> </a>
                            </div>

                            <div class="float-right no-print mr-1">
                                <button id="export-data" class="btn btn-sm btn-info no-print float-right" title="<?php echo lang('export'); ?>">
                                    <i class="fa fa-file-export"></i> <?php echo lang('export'); ?>
                                </button>
                            </div>

                            <div class="float-right no-print mr-1">
                                <a href="finance/monthly?year=<?php echo $next_year; ?>">
                                    <button id="" title="<?php echo lang('next'); ?>" class="btn btn-success btn-sm">
                                        <i class="fa fa-arrow-right"></i> <?php echo lang('next_year'); ?>
                                    </button>
                                </a>
                            </div>

                            <div class="float-right no-print mr-1">
                                <a href="finance/monthly?year=<?php echo $previous_year; ?>">
                                    <button id="" title="<?php echo lang('previous'); ?>" class="btn btn-warning btn-sm">
                                        <i class="fa fa-arrow-left"></i> <?php echo lang('previous_year'); ?>
                                    </button>
                                </a>
                            </div>
                            
                            <?php if(isset($is_current_year) && !$is_current_year): ?>
                            <div class="float-right no-print mr-1">
                                <a href="finance/monthly">
                                    <button title="<?php echo lang('current_year'); ?>" class="btn btn-primary btn-sm">
                                        <i class="fa fa-calendar-day"></i> <?php echo lang('current_year'); ?>
                                    </button>
                                </a>
                            </div>
                            <?php endif; ?>
                        </div>
                        <!-- /.card-header -->
                        
                        <!-- Chart Section -->
                        <div class="card-body">
                            <?php if(isset($is_current_year) && $is_current_year): ?>
                            <div class="alert alert-info">
                                <i class="fa fa-info-circle"></i> <?php echo lang('viewing_current_year_data'); ?>
                                <?php echo lang('showing_data_for'); ?> <strong><?php echo date('Y'); ?></strong>
                            </div>
                            <?php endif; ?>
                            
                            <div class="chart-container">
                                <div id="monthlyChart" style="width: 100%; height: 300px;"></div>
                            </div>
                            
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover" id="monthly-report-table">
                                    <thead>
                                        <tr>
                                            <th class="w-50"><?php echo lang('month'); ?></th>
                                            <th><?php echo lang('amount'); ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $total_amount = array();
                                        $months_array = array();
                                        $amounts_array = array();
                                        
                                        for ($month = 1; $month <= 12; $month++) {
                                            $time = mktime(12, 0, 0, $month, 1, $year);
                                            $month_name = date('F', $time);
                                            $this_month = date('m', time());
                                            $this_year = date('Y', time());
                                            
                                            $is_current_month = ($month == $this_month && $year == $this_year);
                                            $row_class = $is_current_month ? 'current-month' : '';
                                            
                                            if (!empty($all_payments[date('m-Y', $time)])) {
                                                $amount = $all_payments[date('m-Y', $time)];
                                            } else {
                                                $amount = 0;
                                            }
                                            
                                            // Store for chart
                                            $months_array[] = lang($month_name);
                                            $amounts_array[] = $amount;
                                        ?>
                                            <tr class="<?php echo $row_class; ?>">
                                                <td>
                                                    <?php 
                                                    echo lang($month_name);
                                                    if ($is_current_month) {
                                                        echo ' <span class="badge badge-success">' . lang('current') . '</span>';
                                                    }
                                                    ?>
                                                </td>
                                                <td class="animate-number"><?php echo $settings->currency; ?> <?php echo number_format($amount, 2, '.', ','); ?></td>
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
                                            <td class="animate-number"><?php echo $settings->currency; ?> <?php echo number_format($total_amount, 2, '.', ','); ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            
                            <!-- Summary Cards -->
                            <div class="row mt-4 no-print">
                                <div class="col-md-4">
                                    <div class="small-box bg-info">
                                        <div class="inner">
                                            <h3 class="animate-number"><?php echo $settings->currency; ?> <?php echo number_format($total_amount, 2, '.', ','); ?></h3>
                                            <p><?php echo lang('total') . ' ' . lang('sales'); ?> (<?php echo $year; ?>)</p>
                                        </div>
                                        <div class="icon">
                                            <i class="fas fa-shopping-cart"></i>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="small-box bg-success">
                                        <div class="inner">
                                            <?php 
                                            // Calculate average monthly sales
                                            $average_sales = !empty($total_amount) ? $total_amount / 12 : 0;
                                            ?>
                                            <h3 class="animate-number"><?php echo $settings->currency; ?> <?php echo number_format($average_sales, 2, '.', ','); ?></h3>
                                            <p><?php echo lang('average') . ' ' . lang('monthly') . ' ' . lang('sales'); ?></p>
                                        </div>
                                        <div class="icon">
                                            <i class="fas fa-chart-line"></i>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-4">
                                    <div class="small-box bg-warning">
                                        <div class="inner">
                                            <?php 
                                            // Find highest sales month
                                            $max_amount = 0;
                                            $max_month = '';
                                            
                                            for ($month = 1; $month <= 12; $month++) {
                                                $time = mktime(12, 0, 0, $month, 1, $year);
                                                if (!empty($all_payments[date('m-Y', $time)])) {
                                                    $amount = $all_payments[date('m-Y', $time)];
                                                    if ($amount > $max_amount) {
                                                        $max_amount = $amount;
                                                        $max_month = date('F', $time);
                                                    }
                                                }
                                            }
                                            ?>
                                            <h3><?php echo lang($max_month); ?></h3>
                                            <p><?php echo lang('highest') . ' ' . lang('sales') . ' ' . lang('month'); ?></p>
                                        </div>
                                        <div class="icon">
                                            <i class="fas fa-trophy"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <?php if(isset($is_current_year) && $is_current_year): ?>
                            <!-- Current Year Progress -->
                            <div class="row mt-4 no-print">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <h3 class="card-title"><?php echo lang('year_progress'); ?></h3>
                                        </div>
                                        <div class="card-body">
                                            <?php
                                            // Calculate year progress
                                            $current_day = date('z'); // Day of year (0-365)
                                            $year_days = date('L') ? 366 : 365; // Check if leap year
                                            $progress = round(($current_day / $year_days) * 100);
                                            ?>
                                            <div class="progress">
                                                <div class="progress-bar bg-success" role="progressbar" style="width: <?php echo $progress; ?>%" 
                                                     aria-valuenow="<?php echo $progress; ?>" aria-valuemin="0" aria-valuemax="100">
                                                    <?php echo $progress; ?>%
                                                </div>
                                            </div>
                                            <p class="text-muted mt-2">
                                                <i class="fa fa-calendar-check"></i> <?php echo lang('day'); ?> <?php echo $current_day; ?> <?php echo lang('of'); ?> <?php echo $year_days; ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>
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

<!-- Chart Initialization -->
<script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
        var data = google.visualization.arrayToDataTable([
            ['Month', 'Sales'],
            <?php
            for ($i = 0; $i < 12; $i++) {
                echo "['" . $months_array[$i] . "', " . $amounts_array[$i] . "],";
            }
            ?>
        ]);

        var options = {
            title: '<?php echo date('Y', $first_minute) . ' ' . lang('monthly') . ' ' . lang('sales'); ?>',
            curveType: 'function',
            legend: { position: 'bottom' },
            colors: ['#007bff'],
            chartArea: {width: '80%', height: '70%'},
            hAxis: {
                title: '<?php echo lang('month'); ?>',
                titleTextStyle: {color: '#333'}
            },
            vAxis: {
                title: '<?php echo lang('amount') . ' (' . $settings->currency . ')'; ?>',
                minValue: 0,
                titleTextStyle: {color: '#333'},
                format: 'currency'
            },
            animation: {
                startup: true,
                duration: 1000,
                easing: 'out'
            },
            backgroundColor: { fill:'transparent' }
        };

        window.chartData = data;
        window.chartOptions = options;
        window.chart = new google.visualization.AreaChart(document.getElementById('monthlyChart'));
        window.chart.draw(data, options);
        
        // Redraw chart on window resize
        window.addEventListener('resize', function() {
            window.chart.draw(data, options);
        });
    }
</script>

<!--main content end-->
<!--footer start-->
<!--footer end-->
</section>

<!-- js placed at the end of the document so the pages load faster -->
<script src="common/js/codearistos.min.js"></script>
<script src="common/extranal/js/finance/monthly_report.js"></script>
</body>
</html>