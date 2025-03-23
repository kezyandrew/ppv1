$(document).ready(function () {
    "use strict";
    
    // Initialize DataTable with minimal options for a cleaner look
    var table = $('#editable-sample1').DataTable({
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
    
    // Animate numbers on page load
    animateNumbers();
    
    // Apply hover effects to table rows
    setupTableHoverEffects();
    
    // If it's the current month, set up the month progress bar
    if(is_current_month) {
        updateMonthProgress();
    }
    
    // Highlight the highest sales day
    highlightHighestDay();
    
    // Handle print button click
    $('.btn-print').on('click', function() {
        // Add a title for the print view
        var printTitle = $('<div class="print-title">')
            .html('<h1>' + $('.card-title').text() + '</h1>')
            .css({
                'text-align': 'center',
                'margin-bottom': '20px',
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
    
    // Handle export button click
    $('#export-data').on('click', function() {
        exportTableToCSV('sales_report_' + month_text + '_' + year_text + '.csv');
    });
    
    // Add hover effects to buttons
    setupButtonHoverEffects();
    
    // Set up tooltips for any elements that might need them
    $('[data-toggle="tooltip"]').tooltip();
});

// Animate numbers on page load with a counting effect
function animateNumbers() {
    $('.animate-number').each(function () {
        const $this = $(this);
        const text = $this.text();
        const currencySymbol = text.replace(/[\d.,]/g, '').trim();
        const number = parseFloat(text.replace(/[^\d.-]/g, ''));
        
        if (isNaN(number)) return;
        
        $({ value: 0 }).animate({ value: number }, {
            duration: 1000,
            easing: 'swing',
            step: function() {
                $this.text(currencySymbol + ' ' + formatNumber(this.value));
            },
            complete: function() {
                $this.text(currencySymbol + ' ' + formatNumber(number));
            }
        });
    });
}

// Set up hover effects for table rows
function setupTableHoverEffects() {
    $('#editable-sample1 tbody tr:not(.total_amount)').hover(
        function() { $(this).addClass('row-hover'); },
        function() { $(this).removeClass('row-hover'); }
    );
}

// Highlight the row with the highest sales amount
function highlightHighestDay() {
    if (highest_day > 0) {
        // Trophy icon already added in PHP, just ensuring the row is styled
        $('tr[data-day="' + highest_day + '"]').addClass('highlight-row');
    }
}

// Function to update the month progress bar for current month
function updateMonthProgress() {
    if(!is_current_month) return;
    
    const percentComplete = (current_day / days_in_month) * 100;
    
    // Update progress bar with animation
    $('.progress-bar').css({
        'transition': 'width 1.5s ease-in-out',
        'width': percentComplete + '%'
    });
    
    // Update text
    $('#progress-text').text(current_day + ' / ' + days_in_month + ' ' + lang_days);
}

// Format numbers with commas for display
function formatNumber(num) {
    return parseFloat(num).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
}

// Set up hover effects for buttons
function setupButtonHoverEffects() {
    $('.btn').hover(
        function() { $(this).addClass('btn-hover'); },
        function() { $(this).removeClass('btn-hover'); }
    );
}

// Export table data to CSV
function exportTableToCSV(filename) {
    const csv = [];
    const rows = document.querySelectorAll('#editable-sample1 tr');
    
    for (let i = 0; i < rows.length; i++) {
        const row = [], cols = rows[i].querySelectorAll('td, th');
        
        for (let j = 0; j < cols.length; j++) {
            // Clean the text: remove currency symbols, extra spaces, commas in numbers
            let text = cols[j].innerText.trim();
            
            // Remove badges and icons from date column
            if (j === 0) {
                text = text.replace(/today|current_month/i, '').trim();
                // Remove trophy icon
                text = text.replace(/🏆|trophy/i, '').trim();
            }
            
            // Handle amount column formatting
            if (j === 1 && i > 0) { // Skip header row for amount processing
                text = text.replace(currency_symbol, '').trim().replace(/,/g, '');
            }
            
            // Wrap the text in quotes and escape existing quotes
            row.push('"' + text.replace(/"/g, '""') + '"');
        }
        
        csv.push(row.join(','));
    }
    
    // Create and trigger download
    const csvFile = new Blob([csv.join('\n')], {type: 'text/csv'});
    const downloadLink = document.createElement('a');
    
    downloadLink.download = filename;
    downloadLink.href = window.URL.createObjectURL(csvFile);
    downloadLink.style.display = 'none';
    
    document.body.appendChild(downloadLink);
    downloadLink.click();
    document.body.removeChild(downloadLink);
} 