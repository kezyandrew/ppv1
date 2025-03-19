"use strict";
// var myEditor;
// var myEditor2;
// $(document).ready(function () {

//     ClassicEditor
//             .create(document.querySelector('#editor'))
//             .then(editor => {
//                 editor.ui.view.editable.element.style.height = '200px';
//                 myEditor = editor;
//             })
//             .catch(error => {
//                 console.error(error);
//             });
//     ClassicEditor
//             .create(document.querySelector('#editor1'))
//             .then(editor => {
//                 editor.ui.view.editable.element.style.height = '200px';
//                 myEditor2 = editor;
//             })
//             .catch(error => {
//                 console.error(error);
//             });

// });

tinymce.init({
    selector: '#editor', 
    plugins: 'print preview paste importcss searchreplace autolink autosave save directionality visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons',
    menubar: 'file edit view insert format tools table help',
    toolbar: 'undo redo | bold italic underline | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl',
    branding: false,
    promotion: false,
    height: 250
});
$(document).ready(function () {
    "use strict";
    
    // Animate table rows when page loads
    setTimeout(function() {
        $('#editable-sample tbody tr').each(function(index) {
            $(this).css('opacity', 0);
            $(this).delay(index * 100).animate({
                opacity: 1,
                top: 0
            }, 300);
        });
    }, 300);
    
    $(".table").on("click", ".editbutton", function () {
        "use strict";

        var iid = $(this).attr('data-id');
        $.ajax({
            url: 'department/editDepartmentByJason?id=' + iid,
            method: 'GET',
            data: '',
            dataType: 'json',
            success: function (response) {
                "use strict";
                $('#departmentEditForm').find('[name="id"]').val(response.department.id).end();
                $('#departmentEditForm').find('[name="name"]').val(response.department.name).end();
            //    myEditor2.setData(response.department.description);
            tinymce.remove('#editor1');
            tinymce.init({
                selector: '#editor1',
                plugins: 'print preview paste importcss searchreplace autolink autosave save directionality code visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap quickbars emoticons',
                menubar: 'file edit view insert format tools table help',
                toolbar: 'undo redo | bold italic underline | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor codesample | ltr rtl',
                branding: false,
                promotion: false,
                height: 250,
                init_instance_callback: function (editor) {
                    // editor.setContent();
                    editor.setContent(response.department.description);
                }
            });
                $('#myModal2').modal('show');
            }
        })
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
            {
                extend: 'copyHtml5',
                exportOptions: {columns: [0, 1]},
                className: 'btn btn-outline-primary btn-sm me-1'
            },
            {
                extend: 'excelHtml5',
                exportOptions: {columns: [0, 1]},
                className: 'btn btn-outline-primary btn-sm me-1'
            },
            {
                extend: 'csvHtml5',
                exportOptions: {columns: [0, 1]},
                className: 'btn btn-outline-primary btn-sm me-1'
            },
            {
                extend: 'pdfHtml5',
                exportOptions: {columns: [0, 1]},
                className: 'btn btn-outline-primary btn-sm me-1'
            },
            {
                extend: 'print',
                exportOptions: {columns: [0, 1]},
                className: 'btn btn-outline-primary btn-sm'
            },
        ],
        aLengthMenu: [
            [10, 25, 50, 100, -1],
            [10, 25, 50, 100, "All"]
        ],
        iDisplayLength: 10,
        "order": [[0, "desc"]],
        "language": {
            "lengthMenu": "_MENU_ records per page",
            "zeroRecords": "No departments found",
            "info": "Showing _START_ to _END_ of _TOTAL_ departments",
            "infoEmpty": "No departments available",
            "infoFiltered": "(filtered from _MAX_ total records)",
            search: "_INPUT_",
            searchPlaceholder: "Search...",
            "url": "common/assets/DataTables/languages/" + language + ".json"
        },
        "columnDefs": [
            {
                "targets": [2], // Options column
                "orderable": false,
            },
        ],
        "drawCallback": function(settings) {
            // Add hover effects to buttons on table redraw
            $('.btn').hover(
                function() { $(this).addClass('shadow-sm'); },
                function() { $(this).removeClass('shadow-sm'); }
            );
        }
    });
    table.buttons().container().appendTo('.custom_buttons');

    // Confirm Delete
    $(".btn-outline-danger").on("click", function(e) {
        if (!confirm('Are you sure you want to delete this department?')) {
            e.preventDefault();
        }
    });
    
    // Add hover effect to table rows
    $('#editable-sample tbody').on('mouseenter', 'tr', function() {
        $(this).addClass('highlight');
    }).on('mouseleave', 'tr', function() {
        $(this).removeClass('highlight');
    });
});

$(document).ready(function () {
    "use strict";
    $(".flashmessage").delay(3000).fadeOut(100);
    
    // Toast notifications
    function showToast(message, type) {
        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: type,
            title: message,
            showConfirmButton: false,
            timer: 3000
        });
    }
});

