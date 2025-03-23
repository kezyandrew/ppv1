$(document).ready(function () {
    "use strict";
    
    // Initialize DataTable with modern styling
    $('#editable-sample1').DataTable({
        responsive: true,
        paging: false,
        ordering: false,
        info: false,
        searching: false,
        autoWidth: false,
        language: {
            emptyTable: "No data available"
        }
    });
    
    // Initialize tooltips
    $('[data-toggle="tooltip"]').tooltip();
    
    // Draw Google Charts
    google.charts.load('current', {
        'packages': ['corechart', 'bar'],
        'language': 'en'
    });
    
    google.charts.setOnLoadCallback(function() {
        drawExpenseChart();
        drawQuarterlyChart();
        drawTrendChart();
    });
    
    // Function to draw the main expense chart
    function drawExpenseChart() {
        // Create the data table
        var data = new google.visualization.DataTable();
        data.addColumn('string', lang_month);
        data.addColumn('number', lang_expense);
        
        // Add rows from the PHP data
        var rows = [];
        for (var i = 0; i < chartMonths.length; i++) {
            rows.push([chartMonths[i], parseFloat(chartExpenses[i])]);
        }
        data.addRows(rows);
        
        // Define chart options
        var options = {
            title: lang_expense + ' ' + lang_for + ' ' + yearValue,
            titleTextStyle: {
                color: '#333',
                fontSize: 16,
                bold: true
            },
            height: 450,
            legend: { position: 'top' },
            hAxis: {
                title: lang_month,
                titleTextStyle: {color: '#333', italic: false, bold: true}
            },
            vAxis: {
                title: lang_expense,
                titleTextStyle: {color: '#333', italic: false, bold: true},
                format: currency_symbol + ' #,###'
            },
            colors: ['#e74c3c'],
            animation: {
                startup: true,
                duration: 1200,
                easing: 'out'
            },
            chartArea: {
                width: '85%',
                height: '70%'
            },
            bar: { groupWidth: '70%' },
            series: {
                0: { targetAxisIndex: 0 }
            },
            annotations: {
                textStyle: {
                    fontSize: 12,
                    color: '#555'
                }
            }
        };
        
        // Create and draw the chart
        var chart = new google.visualization.ColumnChart(document.getElementById('expense-chart'));
        chart.draw(data, options);
        
        // Make chart responsive
        $(window).resize(function() {
            chart.draw(data, options);
        });
    }
    
    // Function to draw the quarterly breakdown chart
    function drawQuarterlyChart() {
        // Create the data table
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Quarter');
        data.addColumn('number', lang_expense);
        
        // Add rows from the quarterly data
        data.addRows([
            [lang_first_quarter, quarterlyData[0]],
            [lang_second_quarter, quarterlyData[1]],
            [lang_third_quarter, quarterlyData[2]],
            [lang_fourth_quarter, quarterlyData[3]]
        ]);
        
        // Define chart options
        var options = {
            pieHole: 0.4,
            colors: ['#3f51b5', '#4caf50', '#ff9800', '#e74c3c'],
            chartArea: {
                width: '90%',
                height: '80%'
            },
            legend: {
                position: 'bottom',
                alignment: 'center'
            },
            pieSliceText: 'percentage',
            tooltip: {
                showColorCode: true,
                text: 'percentage',
                trigger: 'selection'
            },
            animation: {
                startup: true,
                duration: 1200,
                easing: 'out'
            }
        };
        
        // Create and draw the chart
        var chart = new google.visualization.PieChart(document.getElementById('quarterly-chart'));
        chart.draw(data, options);
        
        // Make chart responsive
        $(window).resize(function() {
            chart.draw(data, options);
        });
    }
    
    // Function to draw the trend chart
    function drawTrendChart() {
        // Create the data table
        var data = new google.visualization.DataTable();
        data.addColumn('string', lang_month);
        data.addColumn('number', lang_expense);
        
        // Add rows from the PHP data
        var rows = [];
        for (var i = 0; i < chartMonths.length; i++) {
            rows.push([chartMonths[i], parseFloat(chartExpenses[i])]);
        }
        data.addRows(rows);
        
        // Define chart options
        var options = {
            curveType: 'function',
            legend: { position: 'none' },
            colors: ['#e74c3c'],
            pointSize: 6,
            lineWidth: 3,
            chartArea: {
                width: '85%',
                height: '80%'
            },
            hAxis: {
                textPosition: 'out',
                slantedText: true,
                slantedTextAngle: 30
            },
            vAxis: {
                format: currency_symbol + ' #,###',
                minValue: 0
            },
            animation: {
                startup: true,
                duration: 1500,
                easing: 'out'
            }
        };
        
        // Create and draw the chart
        var chart = new google.visualization.LineChart(document.getElementById('trend-chart'));
        chart.draw(data, options);
        
        // Make chart responsive
        $(window).resize(function() {
            chart.draw(data, options);
        });
    }
    
    // Animate table rows with a subtle fade-in effect
    $('.table tbody tr').each(function(index) {
        $(this).css({
            'opacity': 0,
            'transform': 'translateY(20px)'
        });
        
        var delay = 100 + (index * 50);
        var $this = $(this);
        
        setTimeout(function() {
            $this.css({
                'transition': 'all 0.5s ease',
                'opacity': 1,
                'transform': 'translateY(0)'
            });
        }, delay);
    });
    
    // Animate numbers for better visual feedback
    animateNumbers();
    
    function animateNumbers() {
        $('.animate-number').each(function() {
            var $this = $(this);
            var text = $this.text();
            
            // Extract the currency symbol and number
            var matches = text.match(/([^\d]+)([\d,\.]+)/);
            if (!matches) return;
            
            var currency = matches[1];
            var number = parseFloat(matches[2].replace(/,/g, ''));
            
            // Start from zero and count up with a spring effect
            $({ Counter: 0 }).animate({ Counter: number }, {
                duration: 1500,
                easing: 'easeOutExpo',
                step: function() {
                    $this.text(currency + ' ' + numberWithCommas(this.Counter.toFixed(2)));
                }
            });
        });
    }
    
    // Custom easing functions for smoother animations
    $.extend($.easing, {
        easeOutExpo: function (x, t, b, c, d) {
            return (t==d) ? b+c : c * (-Math.pow(2, -10 * t/d) + 1) + b;
        }
    });
    
    // Format number with commas for thousands
    function numberWithCommas(x) {
        return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }
    
    // Print functionality with improved layout
    $('.btn-print').on('click', function() {
        // Add a title for the print view
        var printTitle = $('<div class="print-title">')
            .html('<h1>' + yearValue + ' ' + lang_expense + ' ' + lang_for + '</h1>')
            .css({
                'text-align': 'center',
                'margin-bottom': '30px',
                'font-size': '24px',
                'font-weight': 'bold',
                'display': 'none'
            });
        
        $('body').prepend(printTitle);
        printTitle.show();
        
        window.print();
        
        // Remove the print title after printing
        setTimeout(function() {
            printTitle.remove();
        }, 100);
    });
    
    // Export to CSV with enhanced formatting
    $('#export-data').on('click', function() {
        exportTableToCSV(yearValue + '_expense_report.csv');
    });
    
    // Function to export the table data to CSV
    function exportTableToCSV(filename) {
        // Get the table
        var $table = $('#editable-sample1');
        
        // Prepare CSV data
        var rows = [];
        
        // Add title row
        rows.push('"' + yearValue + ' ' + lang_expense + ' ' + lang_for + '"');
        rows.push(''); // Empty row for spacing
        
        // Get table header
        var headerRow = [];
        $table.find('thead th').each(function() {
            headerRow.push('"' + $(this).text().trim() + '"');
        });
        rows.push(headerRow.join(','));
        
        // Get table data
        $table.find('tbody tr').each(function() {
            if ($(this).hasClass('total_amount')) return; // Skip total row, will add it last
            
            var row = [];
            $(this).find('td').each(function(i) {
                // Clean the data - remove badges and format
                var $cell = $(this).clone();
                $cell.find('.badge, i').remove();
                var cellText = $cell.text().trim();
                
                if (i === 1) { // Assuming the expense amount is in the second column
                    cellText = cellText.replace(/[^\d.,]/g, '');
                }
                row.push('"' + cellText + '"');
            });
            rows.push(row.join(','));
        });
        
        // Add total row
        var totalRow = [];
        $table.find('.total_amount td').each(function(i) {
            var cellText = $(this).text().trim();
            if (i === 1) { // Assuming the expense amount is in the second column
                cellText = cellText.replace(/[^\d.,]/g, '');
            }
            totalRow.push('"' + cellText + '"');
        });
        rows.push(totalRow.join(','));
        
        // Add quarterly summary
        rows.push(''); // Empty row for spacing
        rows.push('"' + lang_quarterly_breakdown + '"');
        rows.push('"' + lang_first_quarter + '","' + numberWithCommas(quarterlyData[0].toFixed(2)) + '"');
        rows.push('"' + lang_second_quarter + '","' + numberWithCommas(quarterlyData[1].toFixed(2)) + '"');
        rows.push('"' + lang_third_quarter + '","' + numberWithCommas(quarterlyData[2].toFixed(2)) + '"');
        rows.push('"' + lang_fourth_quarter + '","' + numberWithCommas(quarterlyData[3].toFixed(2)) + '"');
        
        // Download CSV file
        downloadCSV(rows.join('\n'), filename);
    }
    
    // Function to download CSV
    function downloadCSV(csv, filename) {
        var csvFile;
        var downloadLink;
        
        // Create CSV file
        csvFile = new Blob([csv], {type: "text/csv;charset=utf-8"});
        
        // Create download link
        downloadLink = document.createElement("a");
        
        // File name
        downloadLink.download = filename;
        
        // Create a link to the file
        downloadLink.href = window.URL.createObjectURL(csvFile);
        
        // Make link hidden
        downloadLink.style.display = "none";
        
        // Add the link to DOM
        document.body.appendChild(downloadLink);
        
        // Click download link
        downloadLink.click();
        
        // Remove link from DOM
        document.body.removeChild(downloadLink);
        
        // Show success notification
        showNotification('Data exported successfully!', 'success');
    }
    
    // Add hover effects to buttons for better interaction
    $('.btn').hover(
        function() {
            $(this).css('transform', 'translateY(-3px)');
        },
        function() {
            $(this).css('transform', 'translateY(0)');
        }
    );
    
    // Function to show notifications
    function showNotification(message, type) {
        // Create notification element
        var notification = $('<div class="custom-notification ' + type + '">')
            .text(message)
            .css({
                'position': 'fixed',
                'top': '20px',
                'right': '20px',
                'z-index': '9999',
                'padding': '12px 20px',
                'background-color': type === 'success' ? '#4caf50' : '#f44336',
                'color': 'white',
                'border-radius': '4px',
                'box-shadow': '0 4px 8px rgba(0,0,0,0.1)',
                'opacity': '0',
                'transform': 'translateY(-20px)',
                'transition': 'all 0.3s ease'
            });
        
        // Add to body
        $('body').append(notification);
        
        // Animate in
        setTimeout(function() {
            notification.css({
                'opacity': '1',
                'transform': 'translateY(0)'
            });
        }, 10);
        
        // Animate out after delay
        setTimeout(function() {
            notification.css({
                'opacity': '0',
                'transform': 'translateY(-20px)'
            });
            
            // Remove after animation
            setTimeout(function() {
                notification.remove();
            }, 300);
        }, 3000);
    }
}); 