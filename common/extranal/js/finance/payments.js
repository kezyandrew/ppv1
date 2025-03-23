"use strict";
$(document).ready(function () {
  // Toast notifications setup
  toastr.options = {
    closeButton: true,
    progressBar: true,
    showMethod: 'slideDown',
    timeOut: 4000,
    positionClass: 'toast-top-right'
  };

  // Fade out flash messages
  $(".flashmessage").delay(3000).fadeOut(100);

  // Initialize date filter button functionality
  $("#date_filter_btn").on('click', function() {
    const date_from = $("#date_from").val();
    const date_to = $("#date_to").val();
    
    if (date_from !== '' && date_to !== '') {
      refreshDataTable(date_from, date_to);
    } else {
      toastr.warning('Please select both start and end dates');
    }
  });

  // Action button hover effects
  $(document).on('mouseenter', '.action-btn', function() {
    $(this).addClass('shadow-sm');
  }).on('mouseleave', '.action-btn', function() {
    $(this).removeClass('shadow-sm');
  });

  // Initialize DataTable
  initDataTable();

  // Handle Edit Button Click
  $(document).on('click', '.editbutton', function() {
    const payment_id = $(this).data('id');
    
    // Show loading in modal
    $('#editPaymentModal').modal('show');
    $('.modal-body').html('<div class="d-flex justify-content-center"><div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div></div>');
    
    // Load payment data
    $.ajax({
      url: 'finance/editPayment?id=' + payment_id,
      method: 'GET',
      dataType: 'html',
      success: function(response) {
        $('.modal-body').html(response);
        // Reinitialize select2 and other components
        $('.select2').select2();
        $('.default-date-picker').datepicker({
          format: 'dd-mm-yyyy',
          autoclose: true
        });
      },
      error: function() {
        $('.modal-body').html('<div class="alert alert-danger">Error loading payment data</div>');
      }
    });
  });

  // Handle Delete Button Click
  $(document).on('click', '.delete_button', function() {
    const payment_id = $(this).data('id');
    $('#deletePaymentModal').modal('show');
    
    // Configure delete confirmation button
    $('#confirmDeletePayment').data('id', payment_id);
  });

  // Handle Delete Confirmation
  $('#confirmDeletePayment').on('click', function() {
    const payment_id = $(this).data('id');
    
    $.ajax({
      url: 'finance/delete?id=' + payment_id,
      method: 'GET',
      success: function(response) {
        $('#deletePaymentModal').modal('hide');
        if (response.success) {
          toastr.success('Payment deleted successfully');
          $('#editable-sample3').DataTable().ajax.reload();
        } else {
          toastr.error(response.message || 'Error deleting payment');
        }
      },
      error: function() {
        $('#deletePaymentModal').modal('hide');
        toastr.error('Error deleting payment');
      }
    });
  });
});

// Function to initialize DataTable
function initDataTable() {
  var date_to = $("#date_to").val();
  var date_from = $("#date_from").val();
  var table = $("#editable-sample3").DataTable({
    responsive: true,
    processing: true,
    serverSide: true,
    searchable: true,
    ajax: {
      url: "finance/getPayment?start_date=" + date_from + "&end_date=" + date_to,
      type: "POST",
    },
    scroller: {
      loadingIndicator: true,
    },
    dom:
      "<'row mb-1'<'col-md-3'l><'col-sm-5 text-center'B><'col-sm-4'f>>" +
      "<'row'<'col-sm-12'tr>>" +
      "<'row'<'col-sm-5'i><'col-sm-7'p>>",
    buttons: [
      {
        extend: "copyHtml5",
        className: 'btn-outline-primary btn-sm',
        exportOptions: { columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11] },
      },
      {
        extend: "excelHtml5",
        className: 'btn-outline-primary btn-sm',
        exportOptions: { columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11] },
      },
      {
        extend: "csvHtml5",
        className: 'btn-outline-primary btn-sm',
        exportOptions: { columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11] },
      },
      {
        extend: "pdfHtml5",
        className: 'btn-outline-primary btn-sm',
        exportOptions: { columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11] },
      },
      {
        extend: "print",
        className: 'btn-outline-primary btn-sm',
        exportOptions: { columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11] },
      },
    ],
    aLengthMenu: [
      [10, 25, 50, 100, -1],
      [10, 25, 50, 100, "All"],
    ],
    iDisplayLength: 100,
    order: [[0, "desc"]],
    language: {
      lengthMenu: "_MENU_",
      search: "_INPUT_",
      url: "common/assets/DataTables/languages/" + language + ".json",
    },
    columnDefs: [
      {
        targets: -1,
        orderable: false,
        className: 'text-center',
        render: function(data, type, row) {
          return `
            <div class="d-flex justify-content-center">
              <a href="finance/invoice?id=${row[0]}" class="action-btn action-btn-info me-1" data-toggle="tooltip" title="View">
                <i class="fas fa-eye"></i>
              </a>
              <button class="action-btn action-btn-primary me-1 editbutton" data-id="${row[0]}" data-toggle="tooltip" title="Edit">
                <i class="fas fa-edit"></i>
              </button>
              <button class="action-btn action-btn-danger delete_button" data-id="${row[0]}" data-toggle="tooltip" title="Delete">
                <i class="fas fa-trash-alt"></i>
              </button>
            </div>
          `;
        }
      }
    ],
    drawCallback: function() {
      $('[data-toggle="tooltip"]').tooltip();
    }
  });
  table.buttons().container().appendTo(".custom_buttons");
}

// Function to refresh DataTable with new date filters
function refreshDataTable(date_from, date_to) {
  $('#editable-sample3').DataTable().destroy();
  
  var table = $('#editable-sample3').DataTable({
    responsive: true,
    processing: true,
    serverSide: true,
    searchable: true,
    ajax: {
      url: "finance/getPayment?start_date=" + date_from + "&end_date=" + date_to,
      type: 'POST',
    },
    scroller: {
      loadingIndicator: true
    },
    dom: "<'row mb-1'<'col-md-3'l><'col-sm-5 text-center'B><'col-sm-4'f>>" +
        "<'row'<'col-sm-12'tr>>" +
        "<'row'<'col-sm-5'i><'col-sm-7'p>>",
    buttons: [{
            extend: 'copyHtml5', className: 'btn-outline-primary btn-sm',
            exportOptions: {
                columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11],
            }
        },
        {
            extend: 'excelHtml5', className: 'btn-outline-primary btn-sm',
            exportOptions: {
                columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11],
            }
        },
        {
            extend: 'csvHtml5', className: 'btn-outline-primary btn-sm',
            exportOptions: {
                columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11],
            }
        },
        {
            extend: 'pdfHtml5', className: 'btn-outline-primary btn-sm',
            exportOptions: {
                columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11],
            }
        },
        {
            extend: 'print', className: 'btn-outline-primary btn-sm',
            exportOptions: {
                columns: [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11],
            }
        },
    ],
    aLengthMenu: [
        [10, 25, 50, 100, -1],
        [10, 25, 50, 100, "All"]
    ],
    iDisplayLength: 100,
    order: [[0, "desc"]],
    language: {
        lengthMenu: "_MENU_",
        search: "_INPUT_",
        url: "common/assets/DataTables/languages/" + language + ".json"
    },
    columnDefs: [
      {
        targets: -1,
        orderable: false,
        className: 'text-center',
        render: function(data, type, row) {
          return `
            <div class="d-flex justify-content-center">
              <a href="finance/invoice?id=${row[0]}" class="action-btn action-btn-info me-1" data-toggle="tooltip" title="View">
                <i class="fas fa-eye"></i>
              </a>
              <button class="action-btn action-btn-primary me-1 editbutton" data-id="${row[0]}" data-toggle="tooltip" title="Edit">
                <i class="fas fa-edit"></i>
              </button>
              <button class="action-btn action-btn-danger delete_button" data-id="${row[0]}" data-toggle="tooltip" title="Delete">
                <i class="fas fa-trash-alt"></i>
              </button>
            </div>
          `;
        }
      }
    ],
    drawCallback: function() {
      $('[data-toggle="tooltip"]').tooltip();
    }
  });
  
  table.buttons().container().appendTo('.custom_buttons');
  
  // Show success message
  toastr.success('Data filtered successfully');
}


