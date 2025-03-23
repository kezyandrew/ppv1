$(document).ready(function() {
    'use strict';
    
    // Initialize DataTable
    $('#expense_vs_income_table').DataTable({
        responsive: true,
        paging: false,
        ordering: true,
        info: false,
        searching: false,
        autoWidth: false,
        language: {
            emptyTable: expense_vs_income_lang.no_data,
            info: expense_vs_income_lang.showing + " _START_ " + expense_vs_income_lang.to + " _END_ " + expense_vs_income_lang.of + " _TOTAL_ " + expense_vs_income_lang.entries,
            lengthMenu: expense_vs_income_lang.show + " _MENU_ " + expense_vs_income_lang.entries,
            search: expense_vs_income_lang.search + ":",
            paginate: {
                first: expense_vs_income_lang.first,
                last: expense_vs_income_lang.last,
                next: expense_vs_income_lang.next,
                previous: expense_vs_income_lang.previous
            }
        },
        createdRow: function(row, data, dataIndex) {
            // Add hover effect to rows
            $(row).hover(
                function() { $(this).addClass('hover-highlight'); },
                function() { $(this).removeClass('hover-highlight'); }
            );
        }
    });
    
    // Initialize tooltips
    $('[data-toggle="tooltip"]').tooltip();
    
    // Main Finance Chart
    drawFinanceChart();
    
    // Income vs Expense Distribution Chart
    drawDistributionChart();
    
    // Animate numbers on page load
    animateNumbers();
    
    // Print functionality
    $('#print').on('click', function() {
        window.print();
        return false;
    });
    
    // Export to CSV functionality
    $('#export-data').on('click', function() {
        exportTableToCSV('expense_vs_income_report.csv');
        return false;
    });
    
    // Year navigation button hover effects
    $('#prev-year, #next-year').hover(
        function() { $(this).css('opacity', '0.8'); },
        function() { $(this).css('opacity', '1'); }
    );
    
    // Initialize card animations
    initCardAnimations();
});

/**
 * Initialize hover effects and animations for cards
 */
function initCardAnimations() {
    // Add tilt effect to summary cards
    $('.small-box').on('mousemove', function(e) {
        const card = $(this);
        const cardWidth = card.width();
        const cardHeight = card.height();
        const centerX = card.offset().left + cardWidth / 2;
        const centerY = card.offset().top + cardHeight / 2;
        const mouseX = e.pageX - centerX;
        const mouseY = e.pageY - centerY;
        
        // Calculate rotation (limited to 5 degrees)
        const rotateY = Math.min(5, Math.max(-5, mouseX / (cardWidth / 20)));
        const rotateX = Math.min(5, Math.max(-5, -mouseY / (cardHeight / 20)));
        
        // Apply subtle transform
        card.css('transform', `translateY(-3px) rotateX(${rotateX}deg) rotateY(${rotateY}deg)`);
    });
    
    $('.small-box').on('mouseleave', function() {
        // Reset on mouse leave
        $(this).css('transform', '');
    });
}

/**
 * Draw the main finance chart
 */
function drawFinanceChart() {
    // Load Google Charts
    google.charts.load('current', {'packages': ['corechart']});
    google.charts.setOnLoadCallback(initChart);
    
    function initChart() {
        // Create the data table.
        let data = new google.visualization.DataTable();
        data.addColumn('string', expense_vs_income_lang.month);
        data.addColumn('number', expense_vs_income_lang.income);
        data.addColumn('number', expense_vs_income_lang.expense);
        data.addColumn('number', expense_vs_income_lang.profit);
        
        // Add data for each month
        for (let i = 0; i < chartMonths.length; i++) {
            const income = parseFloat(chartIncomes[i]);
            const expense = parseFloat(chartExpenses[i]);
            const profit = income - expense;
            data.addRow([chartMonths[i], income, expense, profit]);
        }
        
        // Set chart options
        let options = {
            title: expense_vs_income_lang.annual_financial_overview,
            titleTextStyle: {
                color: '#333',
                fontSize: 16,
                bold: true
            },
            chartArea: {
                width: '85%',
                height: '70%'
            },
            legend: {
                position: 'top',
                alignment: 'center'
            },
            colors: ['#00a65a', '#f56954', '#3c8dbc'],
            hAxis: {
                title: expense_vs_income_lang.month,
                titleTextStyle: {
                    color: '#333',
                    italic: false,
                    bold: true
                }
            },
            vAxis: {
                title: expense_vs_income_lang.amount,
                titleTextStyle: {
                    color: '#333',
                    italic: false,
                    bold: true
                },
                format: currencyFormat
            },
            animation: {
                startup: true,
                duration: 1000,
                easing: 'out'
            },
            seriesType: 'bars',
            series: {
                2: {type: 'line', lineWidth: 3, pointSize: 7}
            }
        };
        
        // Instantiate and draw the chart
        let chart = new google.visualization.ComboChart(document.getElementById('finance-chart'));
        chart.draw(data, options);
        
        // Responsive behavior
        $(window).resize(function() {
            chart.draw(data, options);
        });
    }
}

/**
 * Draw the income vs expense distribution chart
 */
function drawDistributionChart() {
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(initDistributionChart);
    
    function initDistributionChart() {
        let data = new google.visualization.DataTable();
        data.addColumn('string', expense_vs_income_lang.category);
        data.addColumn('number', expense_vs_income_lang.percentage);
        
        const totalIncome = parseFloat(totalIncomeValue);
        const totalExpense = parseFloat(totalExpenseValue);
        const totalAmount = totalIncome + totalExpense;
        
        const incomePercentage = (totalIncome / totalAmount) * 100;
        const expensePercentage = (totalExpense / totalAmount) * 100;
        
        data.addRows([
            [expense_vs_income_lang.income, incomePercentage],
            [expense_vs_income_lang.expense, expensePercentage]
        ]);
        
        let options = {
            title: expense_vs_income_lang.income_expense_distribution,
            titleTextStyle: {
                color: '#333',
                fontSize: 16,
                bold: true
            },
            slices: {
                0: { color: '#00a65a' },
                1: { color: '#f56954' }
            },
            chartArea: {
                width: '90%',
                height: '80%'
            },
            pieHole: 0.4,
            pieSliceText: 'percentage',
            pieSliceTextStyle: {
                fontSize: 14,
                color: 'white'
            },
            legend: {
                position: 'right',
                alignment: 'center',
                textStyle: {
                    fontSize: 14
                }
            },
            animation: {
                startup: true,
                duration: 1000,
                easing: 'out'
            },
            tooltip: {
                showColorCode: true,
                textStyle: {
                    color: '#000',
                    fontSize: 13
                }
            }
        };
        
        let chart = new google.visualization.PieChart(document.getElementById('distribution-chart'));
        chart.draw(data, options);
        
        // Responsive behavior
        $(window).resize(function() {
            chart.draw(data, options);
        });
    }
}

/**
 * Animate counter numbers
 */
function animateNumbers() {
    $('.animate-number').each(function() {
        const $this = $(this);
        const numText = $this.text();
        const numValue = parseFloat(numText.replace(/[^0-9.-]+/g, ''));
        
        if (!isNaN(numValue)) {
            $this.prop('Counter', 0).animate({
                Counter: numValue
            }, {
                duration: 1200,
                easing: 'swing',
                step: function(now) {
                    $this.text(formatCurrency(now));
                }
            });
        }
    });
}

/**
 * Format number as currency
 * @param {number} value - The numeric value to format
 * @returns {string} - Formatted currency string
 */
function formatCurrency(value) {
    // Use currencySymbol from the global variable 
    // which should be defined in the main PHP file
    const formatted = currencySymbol + value.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
    return formatted;
}

/**
 * Export table data to CSV file
 * @param {string} filename - The name of the CSV file
 */
function exportTableToCSV(filename) {
    let csv = [];
    const rows = document.querySelectorAll('#expense_vs_income_table tr');
    
    for (let i = 0; i < rows.length; i++) {
        const row = [], cols = rows[i].querySelectorAll('td, th');
        
        for (let j = 0; j < cols.length; j++) {
            // Get clean text content
            let cellText = cols[j].innerText.replace(/(\r\n|\n|\r)/gm, '').trim();
            
            // Check if it's currency or percentage and clean it up
            if (cellText.includes(currencySymbol)) {
                cellText = cellText.replace(currencySymbol, '');
            }
            
            // Remove icons from text
            cellText = cellText.replace(/[^\w\s.,%-]/g, '').trim();
            
            // Add the column text
            row.push('"' + cellText + '"');
        }
        csv.push(row.join(','));
    }
    
    // Create and download the CSV file
    downloadCSV(csv.join('\n'), filename);
}

/**
 * Trigger download of the CSV file in browser
 * @param {string} csv - The CSV content
 * @param {string} filename - The name of the file
 */
function downloadCSV(csv, filename) {
    const csvFile = new Blob([csv], {type: 'text/csv'});
    
    // Create a download link
    const downloadLink = document.createElement('a');
    
    // Set the file name
    downloadLink.download = filename;
    
    // Create a URL for the blob
    downloadLink.href = window.URL.createObjectURL(csvFile);
    
    // Hide the download link
    downloadLink.style.display = 'none';
    
    // Add the link to the DOM
    document.body.appendChild(downloadLink);
    
    // Click the download link
    downloadLink.click();
    
    // Remove the link from the DOM
    document.body.removeChild(downloadLink);
    
    // Display success message
    showNotification('Report exported successfully!', 'success');
}

/**
 * Show a notification message
 * @param {string} message - The message to show
 * @param {string} type - The type of notification (success, error, info)
 */
function showNotification(message, type) {
    // Create notification element
    const notification = $('<div class="notification notification-' + type + '">' + message + '</div>');
    
    // Append to body
    $('body').append(notification);
    
    // Animate in
    setTimeout(function() {
        notification.addClass('show');
    }, 100);
    
    // Animate out after 3 seconds
    setTimeout(function() {
        notification.removeClass('show');
        setTimeout(function() {
            notification.remove();
        }, 300);
    }, 3000);
}

// Add notification styles dynamically
$('<style>')
    .prop('type', 'text/css')
    .html(`
        .notification {
            position: fixed;
            bottom: 20px;
            right: 20px;
            padding: 10px 20px;
            border-radius: 4px;
            color: white;
            font-weight: 500;
            z-index: 9999;
            transform: translateY(100px);
            opacity: 0;
            transition: all 0.3s ease;
        }
        .notification.show {
            transform: translateY(0);
            opacity: 1;
        }
        .notification-success {
            background-color: #28a745;
            box-shadow: 0 2px 10px rgba(40, 167, 69, 0.3);
        }
        .notification-error {
            background-color: #dc3545;
            box-shadow: 0 2px 10px rgba(220, 53, 69, 0.3);
        }
        .notification-info {
            background-color: #17a2b8;
            box-shadow: 0 2px 10px rgba(23, 162, 184, 0.3);
        }
    `)
    .appendTo('head');

/**
 * Calculate the progress percentage
 * @param {number} current - Current value
 * @param {number} target - Target value 
 * @returns {number} - Percentage value
 */
function calculateProgress(current, target) {
    if (target <= 0) return 0;
    let percentage = (current / target) * 100;
    return Math.min(percentage, 100); // Cap at 100%
}

/**
 * Update progress bars with calculated percentages
 */
function updateProgressBars() {
    // Income progress
    const targetIncome = parseFloat(targetIncomeValue) || 1;
    const currentIncome = parseFloat(totalIncomeValue);
    const incomePercentage = calculateProgress(currentIncome, targetIncome);
    
    $('#income-progress .progress-bar').css('width', incomePercentage + '%');
    $('#income-progress-text').text(incomePercentage.toFixed(1) + '%');
    
    // Expense progress  
    const budgetExpense = parseFloat(budgetExpenseValue) || 1;
    const currentExpense = parseFloat(totalExpenseValue);
    const expensePercentage = calculateProgress(currentExpense, budgetExpense);
    
    $('#expense-progress .progress-bar').css('width', expensePercentage + '%');
    $('#expense-progress-text').text(expensePercentage.toFixed(1) + '%');
    
    // Apply color based on percentage
    if (expensePercentage > 90) {
        $('#expense-progress .progress-bar').removeClass('bg-warning bg-success').addClass('bg-danger');
    } else if (expensePercentage > 70) {
        $('#expense-progress .progress-bar').removeClass('bg-danger bg-success').addClass('bg-warning');
    } else {
        $('#expense-progress .progress-bar').removeClass('bg-danger bg-warning').addClass('bg-success');
    }
}

// Load progress bars if the element exists
if ($('#income-progress').length > 0) {
    updateProgressBars();
}

/**
 * Generate insights based on the financial data
 */
function generateInsights() {
    const $container = $('#financial-insights');
    if (!$container.length) return;
    
    // Calculate months with highest values
    let highestIncomeMonth = '';
    let highestIncomeValue = 0;
    let highestExpenseMonth = '';
    let highestExpenseValue = 0;
    
    for (let i = 0; i < chartMonths.length; i++) {
        const income = parseFloat(chartIncomes[i]);
        const expense = parseFloat(chartExpenses[i]);
        
        if (income > highestIncomeValue) {
            highestIncomeValue = income;
            highestIncomeMonth = chartMonths[i];
        }
        
        if (expense > highestExpenseValue) {
            highestExpenseValue = expense;
            highestExpenseMonth = chartMonths[i];
        }
    }
    
    // Calculate profit margin
    const totalIncome = parseFloat(totalIncomeValue);
    const totalExpense = parseFloat(totalExpenseValue);
    const profitMargin = totalIncome > 0 ? ((totalIncome - totalExpense) / totalIncome) * 100 : 0;
    
    // Create insight items
    let insights = '';
    
    // Highest income month
    insights += `
    <div class="insight-item">
        <div class="insight-icon text-success">
            <i class="fa fa-arrow-up"></i>
        </div>
        <div class="insight-content">
            <h4>${expense_vs_income_lang.highest_income_month}</h4>
            <p>${highestIncomeMonth}: ${formatCurrency(highestIncomeValue)}</p>
        </div>
    </div>
    `;
    
    // Highest expense month
    insights += `
    <div class="insight-item">
        <div class="insight-icon text-danger">
            <i class="fa fa-arrow-down"></i>
        </div>
        <div class="insight-content">
            <h4>${expense_vs_income_lang.highest_expense_month}</h4>
            <p>${highestExpenseMonth}: ${formatCurrency(highestExpenseValue)}</p>
        </div>
    </div>
    `;
    
    // Profit margin
    insights += `
    <div class="insight-item">
        <div class="insight-icon text-info">
            <i class="fa fa-chart-pie"></i>
        </div>
        <div class="insight-content">
            <h4>${expense_vs_income_lang.profit_margin}</h4>
            <p>${profitMargin.toFixed(2)}%</p>
        </div>
    </div>
    `;
    
    // Add to container
    $container.html(insights);
}

// Generate insights if container exists
if ($('#financial-insights').length > 0) {
    generateInsights();
} 