// Language variables for translations
var lang_edit = "Edit";
var lang_delete = "Delete";
var lang_submitting = "Submitting...";

$(document).ready(function () {
  "use strict";
  
  // Track if table is in grid or list view
  let isGridView = false;
  
  // Initialize Select2 for doctor dropdown
  $("#adoctors, #adoctors1").select2({
    placeholder: select_doctor,
    allowClear: true,
    ajax: {
      url: "doctor/getDoctorInfo",
      type: "post",
      dataType: "json",
      delay: 250,
      data: function (params) {
        return {
          searchTerm: params.term // search term
        };
      },
      processResults: function (response) {
        return {
          results: response
        };
      },
      cache: true
    }
  });
  
  // Handle edit button click
  $(".table").on("click", ".editbutton", function () {
    var iid = $(this).attr("data-id");
    $("#editDoctorvisitForm").trigger("reset");
    
    // Add loading indicator
    $("#editDoctorvisitForm").append('<div class="overlay"><i class="fa fa-refresh fa-spin"></i></div>');
    
    $.ajax({
      url: "doctorvisit/editDoctorvisitByJason?id=" + iid,
      method: "GET",
      data: "",
      dataType: "json",
      success: function (response) {
        // Remove loading indicator
        $("#editDoctorvisitForm .overlay").remove();
        
        // Populate the form fields with the data returned from server
        $("#editDoctorvisitForm").find('[name="id"]').val(response.doctorvisit.id).end();
        $("#editDoctorvisitForm")
          .find('[name="visit_description"]')
          .val(response.doctorvisit.visit_description)
          .end();
        $("#editDoctorvisitForm")
          .find('[name="visit_charges"]')
          .val(response.doctorvisit.visit_charges)
          .end();
        $("#editDoctorvisitForm")
          .find('[name="status"]')
          .val(response.doctorvisit.status)
          .trigger("change");
          
        // Clear previous options and add the correct option for doctor
        $("#adoctors1").empty();
        var option = new Option(
          response.doctor.name + " - " + response.doctor.id,
          response.doctor.id,
          true,
          true
        );
        $("#adoctors1").append(option).trigger("change");
        
        // Show the modal with a fade effect
        $("#myModal2").modal("show");
      },
      error: function() {
        // Handle error
        $("#editDoctorvisitForm .overlay").remove();
        alert("Failed to get doctor visit information. Please try again.");
      }
    });
  });
  
  // Initialize DataTables
  var table = $("#editable-sample").DataTable({
    responsive: true,
    processing: true,
    serverSide: true,
    searchable: true,
    ajax: {
      url: "doctorvisit/getDoctorvisitList",
      type: "POST",
    },
    scroller: {
      loadingIndicator: true,
    },
    dom:
      "<'row'<'col-sm-3'l><'col-sm-5 text-center'B><'col-sm-4'f>>" +
      "<'row'<'col-sm-12'tr>>" +
      "<'row'<'col-sm-5'i><'col-sm-7'p>>",
    buttons: [
      { 
        extend: 'copyHtml5', 
        exportOptions: { columns: [0, 1, 2, 3, 4] },
        className: 'btn btn-outline-primary btn-sm me-1'
      },
      { 
        extend: 'excelHtml5', 
        exportOptions: { columns: [0, 1, 2, 3, 4] },
        className: 'btn btn-outline-primary btn-sm me-1'
      },
      { 
        extend: 'csvHtml5', 
        exportOptions: { columns: [0, 1, 2, 3, 4] },
        className: 'btn btn-outline-primary btn-sm me-1'
      },
      { 
        extend: 'pdfHtml5', 
        exportOptions: { columns: [0, 1, 2, 3, 4] },
        className: 'btn btn-outline-primary btn-sm me-1'
      },
      { 
        extend: 'print', 
        exportOptions: { columns: [0, 1, 2, 3, 4] },
        className: 'btn btn-outline-primary btn-sm'
      },
    ],
    aLengthMenu: [
      [10, 25, 50, 100, -1],
      [10, 25, 50, 100, "All"],
    ],
    iDisplayLength: 10,
    order: [[0, "desc"]],
    columnDefs: [
      {
        targets: [4],
        render: function(data, type, row) {
          if (data === 'active') {
            return '<span class="badge badge-active"><i class="fa fa-check-circle me-1"></i> ' + data + '</span>';
          } else {
            return '<span class="badge badge-inactive"><i class="fa fa-times-circle me-1"></i> ' + data + '</span>';
          }
        }
      },
      {
        targets: [5],
        width: "15%",
        className: "text-center",
        render: function(data, type, row) {
          var editBtn = '<button type="button" class="btn btn-outline-primary btn-sm editbutton btn-action" data-id="' + row[0] + '"><i class="fa fa-edit"></i> ' + lang_edit + '</button> ';
          var deleteBtn = '<a class="btn btn-outline-danger btn-sm delete-visit btn-action" href="doctorvisit/delete?id=' + row[0] + '" onclick="return confirm(\'Are you sure you want to delete this item?\');"><i class="fa fa-trash"></i> ' + lang_delete + '</a>';
          return editBtn + deleteBtn;
        }
      }
    ],
    language: {
      lengthMenu: "_MENU_ records per page",
      zeroRecords: "No doctor visits found",
      info: "Showing _START_ to _END_ of _TOTAL_ visits",
      infoEmpty: "No visits available",
      infoFiltered: "(filtered from _MAX_ total visits)",
      search: "_INPUT_",
      searchPlaceholder: "Search...",
      url: "common/assets/DataTables/languages/" + language + ".json",
    },
    drawCallback: function() {
      // Add animation to newly added rows
      $(".dataTable tbody tr").css('opacity', 0);
      $(".dataTable tbody tr").each(function(index) {
        $(this).delay(index * 50).animate({opacity: 1}, 300);
      });
      
      // Add hover effect to buttons
      $('.btn').hover(
        function() { $(this).addClass('shadow-sm'); },
        function() { $(this).removeClass('shadow-sm'); }
      );
    }
  });
  
  // Place the Datatable buttons in the custom buttons area if it exists
  table.buttons().container().appendTo('.custom_buttons');
  
  // Dismiss message after delay
  $(".flashmessage").delay(3000).fadeOut(500);
  
  // Initialize modal animations
  $("#myModal, #myModal2").on('show.bs.modal', function() {
    $(this).find('.modal-dialog').css({
      transform: 'scale(0.9)',
      opacity: 0
    });
    setTimeout(function() {
      $(this).find('.modal-dialog').css({
        transform: 'scale(1)',
        opacity: 1,
        transition: 'all 0.3s ease'
      });
    }, 50);
  });
  
  // Show success alerts after form submissions
  $("form").on('submit', function() {
    // Add loading spinner
    var submitBtn = $(this).find('[type="submit"]');
    var originalText = submitBtn.html();
    submitBtn.html('<i class="fa fa-spin fa-spinner me-1"></i> ' + lang_submitting);
    submitBtn.prop('disabled', true);
    
    // Reset button after 2 seconds (form will likely be submitted by then)
    setTimeout(function() {
      submitBtn.html(originalText);
      submitBtn.prop('disabled', false);
    }, 2000);
  });
  
  // Mobile-responsive design adjustments
  function adjustForMobile() {
    if (window.innerWidth < 768) {
      // Mobile adjustments
      $('.btn-sm').addClass('btn-xs');
    } else {
      // Desktop view
      $('.btn-xs').removeClass('btn-xs');
    }
  }
  
  // Run once on page load
  adjustForMobile();
  
  // Run on window resize
  $(window).resize(function() {
    adjustForMobile();
  });
});
  