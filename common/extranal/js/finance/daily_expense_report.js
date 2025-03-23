$(document).ready(function () {
    "use strict";
    
    // Initialize DataTable with minimal options for a cleaner look
    var table = $('#editable-sample').DataTable({
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
    
    // Handle print button click
    $('.btn-print').on('click', function() {
        window.print();
    });
    
    // Handle export button click
    $('#export-data').on('click', function() {
        exportTableToCSV('expense_report_' + month_text + '_' + year_text + '.csv');
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
    $('#editable-sample tbody tr:not(.total_amount)').hover(
        function() { $(this).addClass('row-hover'); },
        function() { $(this).removeClass('row-hover'); }
    );
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
    const rows = document.querySelectorAll('#editable-sample tr');
    
    for (let i = 0; i < rows.length; i++) {
        const row = [], cols = rows[i].querySelectorAll('td, th');
        
        for (let j = 0; j < cols.length; j++) {
            // Clean the text: remove currency symbols, extra spaces, commas in numbers
            let text = cols[j].innerText.trim();
            
            // Remove badges and icons from date column
            if (j === 0) {
                text = text.replace(/today|current_month/i, '').trim();
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