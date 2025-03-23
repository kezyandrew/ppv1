// Monthly Finance Report JavaScript
$(document).ready(function() {
    'use strict';
    
    // Initialize DataTable for better data handling
    if ($.fn.DataTable.isDataTable('#monthly-report-table')) {
        $('#monthly-report-table').DataTable().destroy();
    }
    
    const dataTable = $('#monthly-report-table').DataTable({
        "paging": false,
        "ordering": false,
        "info": false,
        "searching": false,
        "responsive": true,
        "autoWidth": false,
        "language": {
            "emptyTable": "No data available for this year"
        },
        "columnDefs": [
            { className: "dt-body-left", targets: 0 },
            { className: "dt-body-right", targets: 1 }
        ],
        "initComplete": function() {
            // Highlight the row with the highest amount
            highlightHighestValue();
            
            // Also highlight current month for current year
            highlightCurrentMonth();
        }
    });

    // Function to highlight the row with the highest value
    function highlightHighestValue() {
        let maxVal = 0;
        let maxRow = null;
        
        // Skip the last row (total)
        $('#monthly-report-table tbody tr:not(:last-child)').each(function() {
            const amountText = $(this).find('td:last-child').text().replace(/[^0-9.]/g, '');
            const amount = parseFloat(amountText);
            
            if (!isNaN(amount) && amount > maxVal) {
                maxVal = amount;
                maxRow = $(this);
            }
        });
        
        if (maxRow && maxVal > 0) {
            maxRow.find('td:first-child').append(' <i class="fas fa-crown text-warning ml-1" title="Highest Sales Month"></i>');
        }
    }
    
    // Function to highlight current month
    function highlightCurrentMonth() {
        const currentDate = new Date();
        const currentMonth = currentDate.getMonth();
        const currentYear = currentDate.getFullYear();
        
        // Check if we're viewing the current year
        if ($('.badge.badge-primary:contains("current_year")').length > 0) {
            // We're in current year view, highlight current month
            const $currentMonthRow = $('#monthly-report-table tbody tr').eq(currentMonth);
            if ($currentMonthRow.length) {
                $currentMonthRow.addClass('current-month-pulse');
                
                // Scroll to current month if needed
                if ($currentMonthRow.offset() && $('#monthly-report-table').offset()) {
                    const tableTop = $('#monthly-report-table').offset().top;
                    const rowTop = $currentMonthRow.offset().top;
                    if (rowTop > window.innerHeight) {
                        $('html, body').animate({
                            scrollTop: rowTop - (window.innerHeight / 2)
                        }, 500);
                    }
                }
            }
        }
    }

    // Responsive behavior for the chart
    $(window).on('resize', function() {
        if (window.chart && typeof window.chart.draw === 'function') {
            window.chart.draw(window.chartData, window.chartOptions);
        }
    });
    
    // Print button enhancements
    $('.btn-print').on('click', function(e) {
        e.preventDefault();
        
        // Add print title
        const year = $('.card-title').text().split(' ')[0];
        const $title = $('<div class="print-title">')
            .text(year + ' Hospital Sales Report')
            .css({
                'text-align': 'center',
                'font-size': '22px',
                'font-weight': 'bold',
                'margin-bottom': '20px'
            })
            .prependTo('body');
            
        window.print();
        
        // Remove the title after printing
        setTimeout(function() {
            $title.remove();
        }, 100);
    });
    
    // Animate numbers on page load
    animateNumbers();
    
    function animateNumbers() {
        $('.animate-number').each(function() {
            const $this = $(this);
            const text = $this.text();
            const currency = text.replace(/[0-9.,]/g, '').trim();
            const finalValue = parseFloat(text.replace(/[^0-9.]/g, ''));
            
            if (isNaN(finalValue)) return;
            
            $({ countValue: 0 }).animate({
                countValue: finalValue
            }, {
                duration: 1000,
                easing: 'swing',
                step: function() {
                    $this.text(currency + ' ' + formatCurrency(this.countValue));
                },
                complete: function() {
                    $this.text(currency + ' ' + formatCurrency(finalValue));
                }
            });
        });
    }
    
    // Format currency values
    function formatCurrency(value) {
        return value.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
    }
    
    // Year navigation buttons hover effect
    $('.btn-success, .btn-warning, .btn-secondary, .btn-primary').hover(
        function() {
            $(this).addClass('shadow-sm');
        },
        function() {
            $(this).removeClass('shadow-sm');
        }
    );
    
    // Add export functionality
    if ($('#export-data').length > 0) {
        $('#export-data').on('click', function() {
            const year = $('.card-title').text().split(' ')[0];
            exportTableToCSV(`monthly_sales_report_${year}.csv`);
        });
    }
    
    // Year progress animation
    if ($('.progress-bar').length > 0) {
        $('.progress-bar').css('width', '0%');
        setTimeout(function() {
            $('.progress-bar').each(function() {
                const width = $(this).attr('aria-valuenow') + '%';
                $(this).animate({
                    width: width
                }, 1000, 'swing');
            });
        }, 500);
    }
    
    // Helper function to export table data to CSV
    function exportTableToCSV(filename) {
        const csv = [];
        const rows = document.querySelectorAll('#monthly-report-table tr');
        
        for (let i = 0; i < rows.length; i++) {
            const row = [], cols = rows[i].querySelectorAll('td, th');
            
            for (let j = 0; j < cols.length; j++) {
                // Clean the text content (remove currency symbols, etc.)
                let data = cols[j].textContent.trim();
                data = data.replace(/\s+/g, ' '); // Replace multiple spaces with one
                data = data.replace(/"/g, '""'); // Escape quotes
                row.push('"' + data + '"');
            }
            
            csv.push(row.join(','));
        }
        
        // Download CSV file
        downloadCSV(csv.join('\n'), filename);
    }
    
    function downloadCSV(csv, filename) {
        const csvFile = new Blob([csv], {type: 'text/csv'});
        const downloadLink = document.createElement('a');
        
        downloadLink.download = filename;
        downloadLink.href = window.URL.createObjectURL(csvFile);
        downloadLink.style.display = 'none';
        
        document.body.appendChild(downloadLink);
        downloadLink.click();
        document.body.removeChild(downloadLink);
    }
    
    // Add a "Current Year Only" mode toggle
    // This could be controlled by a URL parameter or local storage
    function checkYearOnlyMode() {
        // Check if we have a URL parameter for year-only mode
        const urlParams = new URLSearchParams(window.location.search);
        if (urlParams.has('year_only') && urlParams.get('year_only') === 'true') {
            // We're in year-only mode, hide previous years data
            applyYearOnlyMode();
        }
    }
    
    function applyYearOnlyMode() {
        // This would hide previous years data if implemented
        // For now, we'll just focus on current year by default
    }
    
    // Execute on load
    checkYearOnlyMode();
}); 

// Add CSS for pulsing current month
document.addEventListener('DOMContentLoaded', function() {
    const style = document.createElement('style');
    style.textContent = `
        .current-month-pulse {
            animation: pulseBg 2s infinite;
        }
        
        @keyframes pulseBg {
            0% { background-color: rgba(40, 167, 69, 0.1); }
            50% { background-color: rgba(40, 167, 69, 0.3); }
            100% { background-color: rgba(40, 167, 69, 0.1); }
        }
    `;
    document.head.appendChild(style);
}); 