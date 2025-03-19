// Make sure currency is defined
if (typeof currency === 'undefined') {
  var currency = '$'; // Default currency symbol
}

// Add some CSS to ensure input fields display numbers properly
$("<style>")
  .prop("type", "text/css")
  .html(`
    .item-table .item-price {
      width: 100%;
      min-width: 120px;
      text-align: right;
    }
    .item-table .item-quantity {
      width: 100%;
      text-align: center;
    }
    .item-table .item-total {
      text-align: right;
      font-weight: bold;
    }
    .item-table th {
      text-align: center;
    }
  `)
  .appendTo("head");

$(document).ready(function () {
  "use strict";
  
  // Add a click event to the multi-select options
  $(document).on('click', '.ms-list li', function() {
    // Wait a moment for the multi-select plugin to update
    setTimeout(function() {
      // Clear the existing items table
      $(".item-table tbody").empty();
      
      // Loop through all selected options and create table rows
      $.each($("select.multi-select option:selected"), function() {
        var idd = $(this).data("idd");
        var itemName = $(this).data("cat_name");
        var itemPrice = $(this).data("id");
        var qtity = $(this).data("qtity") || 1;
        
        // Create a new table row with editable fields
        var newRow = '<tr class="item-row" data-id="' + idd + '">' +
                     '<td><button type="button" class="btn btn-danger btn-sm remove-item"><i class="fa fa-times"></i></button></td>' +
                     '<td><input type="text" class="form-control item-name" name="item_name[]" value="' + itemName + '"></td>' +
                     '<td><input type="number" class="form-control item-price" name="item_price[]" value="' + itemPrice + '" step="0.01"></td>' +
                     '<td><input type="number" class="form-control item-quantity" name="quantity[]" value="' + qtity + '" min="1"></td>' +
                     '<td class="item-total">' + currency + (itemPrice * qtity).toFixed(2) + '</td>' +
                     '<input type="hidden" name="category_id[]" value="' + idd + '">' +
                     '</tr>';
        
        // Append the new row to the table
        $(".item-table tbody").append(newRow);
      });
      
      // Recalculate totals
      recalculateTotals();
    }, 100);
  });
  
  // Handle removal of items
  $(document).on("click", ".remove-item", function() {
    var row = $(this).closest("tr");
    var idd = row.data("id");
    
    // Remove the item from the multi-select
    $(".ms-list li[data-idd='" + idd + "']").click();
    
    // Remove the row
    row.remove();
    
    // Recalculate totals
    recalculateTotals();
  });
  
  // Function to recalculate totals
  function recalculateTotals() {
    var tot = 0;
    
    // Loop through all items and calculate totals
    $(".item-row").each(function() {
      var price = parseFloat($(this).find(".item-price").val()) || 0;
      var qty = parseInt($(this).find(".item-quantity").val()) || 0;
      var itemTotal = price * qty;
      $(this).find(".item-total").text(currency + itemTotal.toFixed(2));
      tot += itemTotal;
    });
    
    // Update subtotal
    $("#subtotal").val(tot.toFixed(2));
    
    // Calculate discount
    var discountPercent = parseFloat($("#dis_id_percent").val()) || 0;
    var discount = (discountPercent * tot) / 100;
    $("#dis_id").val(discount.toFixed(2));
    
    // Calculate VAT
    var vatPercent = parseFloat($("#vat").val()) || 0;
    var vat = (vatPercent * tot) / 100;
    $("#vat_amount").val(vat.toFixed(2));
    
    // Calculate gross total
    var gross = tot - discount + vat;
    $("#gross").val(gross.toFixed(2));
    
    // Calculate due
    var amountReceived = parseFloat($("#amount_received").val()) || 0;
    var due = gross - amountReceived;
    $("#due").val(due.toFixed(2));
  }
  
  // Event handlers for item name, price and quantity changes
  $(document).on("input", ".item-name, .item-price, .item-quantity", function() {
    recalculateTotals();
  });
  
  // Also trigger recalculation when discount, VAT, or amount received changes
  $("#dis_id_percent, #vat, #amount_received").on("input", function() {
    recalculateTotals();
  });
  
  // Initial setup - add a table for the items if it doesn't exist
  if ($(".item-table").length === 0) {
    var table = '<table class="table table-bordered item-table">' +
                '<thead>' +
                '<tr>' +
                '<th width="5%"></th>' +
                '<th width="30%">' + (typeof lang !== 'undefined' && lang.item_name ? lang.item_name : 'Item Name') + '</th>' +
                '<th width="25%">' + (typeof lang !== 'undefined' && lang.price ? lang.price : 'Price') + '</th>' +
                '<th width="15%">' + (typeof lang !== 'undefined' && lang.quantity ? lang.quantity : 'Quantity') + '</th>' +
                '<th width="25%">' + (typeof lang !== 'undefined' && lang.total ? lang.total : 'Total') + '</th>' +
                '</tr>' +
                '</thead>' +
                '<tbody></tbody>' +
                '</table>';
    
    // Append the table to the qfloww div
    $("#editPaymentForm .qfloww").html(table);
  }
}); 