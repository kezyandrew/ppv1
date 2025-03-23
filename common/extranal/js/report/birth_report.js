"use strict";



tinymce.init({
    selector: '#editor',
    plugins: 'print preview paste importcss searchreplace autolink autosave save directionality visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons',
    menubar: 'file edit view insert format tools table help',
    toolbar: 'undo redo | bold italic underline | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl',
    branding: false,
    promotion: false
});



$(document).ready(function () {
    "use strict";
    $(".table").on("click", ".editbutton", function () {
        "use strict";
        var iid = $(this).attr('data-id');
        $('#editReportForm').trigger("reset");
        
        // Initialize Select2 properly
        $('.js-example-basic-single').select2('destroy');
        $('.js-example-basic-single').select2({
            placeholder: 'Select an option',
            allowClear: true,
            width: '100%'
        });
        
        $.ajax({
            url: 'report/editReportByJason?id=' + iid,
            method: 'GET',
            data: '',
            dataType: 'json',
            success: function (response) {
                "use strict";
                // Populate the form fields with the data returned from server
                $('#editReportForm').find('[name="id"]').val(response.report.id).end();
                $('#editReportForm').find('[name="type"]').val(response.report.report_type).end();
                $('#editReportForm').find('[name="date"]').val(response.report.date).end();
                
                // Initialize the editor with the description content
                tinymce.remove('#editor1');
                tinymce.init({
                    selector: '#editor1',
                    plugins: 'print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons',
                    menubar: 'file edit view insert format tools table help',
                    toolbar: 'undo redo | bold italic underline | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl',
                    branding: false,
                    promotion: false,
                    init_instance_callback: function (editor) {
                        editor.setContent(response.report.description);
                    }
                });
                
                // Handle doctor selection
                if (response.doctor) {
                    var doctorValue = response.report.doctor;
                    $('#editReportForm').find('[name="doctor"]').val(doctorValue).trigger('change');
                }
                
                // Handle patient selection
                if (response.patient) {
                    var patientId = response.report.patient;
                    $('#editReportForm').find('[name="patient"]').val(patientId).trigger('change');
                }
                
                $('#myModal2').modal('show');
            }
        });
    });
});

$(document).ready(function () {
    "use strict";
    var table = $('#editable-sample').DataTable({
        responsive: true,

        dom: "<'row'<'col-sm-3'l><'col-sm-5 text-center'B><'col-sm-4'f>>" +
            "<'row'<'col-sm-12'tr>>" +
            "<'row'<'col-sm-5'i><'col-sm-7'p>>",

        buttons: [
            { extend: 'copyHtml5', exportOptions: { columns: [0, 1, 2, 3], } },
            { extend: 'excelHtml5', exportOptions: { columns: [0, 1, 2, 3], } },
            { extend: 'csvHtml5', exportOptions: { columns: [0, 1, 2, 3], } },
            { extend: 'pdfHtml5', exportOptions: { columns: [0, 1, 2, 3], } },
            { extend: 'print', exportOptions: { columns: [0, 1, 2, 3], } },
        ],
        aLengthMenu: [
            [10, 25, 50, 100, -1],
            [10, 25, 50, 100, "All"]
        ],
        iDisplayLength: -1,
        "order": [[0, "desc"]],

        "language": {
            "lengthMenu": "_MENU_",
            search: "_INPUT_",
            "url": "common/assets/DataTables/languages/" + language + ".json"
        },

    });

    table.buttons().container()
        .appendTo('.custom_buttons');
});

$(document).ready(function () {
    "use strict";
    $(".flashmessage").delay(3000).fadeOut(100);
});

