"use strict";

$(document).ready(function () {
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
    
    // Add hover effect to table rows
    $('#editable-sample tbody').on('mouseenter', 'tr', function() {
        $(this).addClass('highlight');
    }).on('mouseleave', 'tr', function() {
        $(this).removeClass('highlight');
    });
    
    // Toggle between table and grid view
    $('#viewToggleBtn').on('click', function() {
        $('#doctorTableView, #doctorGridView').toggleClass('d-none');
        
        if($('#doctorGridView').hasClass('d-none')) {
            $(this).html('<i class="fa fa-th-large me-1"></i> Grid View');
        } else {
            $(this).html('<i class="fa fa-list me-1"></i> Table View');
            
            // Animate grid items when switching to grid view
            $('.doctor-card').each(function(index) {
                $(this).css({opacity: 0, transform: 'translateY(20px)'});
                $(this).delay(index * 100).animate({
                    opacity: 1,
                    transform: 'translateY(0)'
                }, 300);
            });
        }
    });
    
    // Filter functionality
    $('#doctorFilterInput').on('keyup', function() {
        var value = $(this).val().toLowerCase();
        
        // Filter table rows
        $("#editable-sample tbody tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
        
        // Filter grid cards
        $(".doctor-card").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
        });
    });
    
    // Button hover effects
    $('.btn').hover(
        function() { $(this).addClass('shadow-sm'); },
        function() { $(this).removeClass('shadow-sm'); }
    );
    
    // Department filter
    $('#departmentFilter').on('change', function() {
        var department = $(this).val();
        
        if(department === 'all') {
            // Show all doctors
            $("#editable-sample tbody tr").show();
            $(".doctor-card").show();
        } else {
            // Filter table rows
            $("#editable-sample tbody tr").filter(function() {
                $(this).toggle($(this).find('td:nth-child(5)').text().trim() === department);
            });
            
            // Filter grid cards
            $(".doctor-card").filter(function() {
                $(this).toggle($(this).find('.doctor-department').text().trim() === department);
            });
        }
    });
    
    // Enhanced modal effects
    $('.modal').on('show.bs.modal', function () {
        $(this).find('.modal-dialog').css({
            transform: 'scale(0.8)'
        });
        setTimeout(() => {
            $(this).find('.modal-dialog').css({
                transform: 'scale(1)'
            });
        }, 200);
    });
    
    // Smooth scrolling
    $('a[href*="#"]:not([href="#"])').click(function() {
        if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
            var target = $(this.hash);
            target = target.length ? target : $('[name=' + this.hash.slice(1) + ']');
            if (target.length) {
                $('html, body').animate({
                    scrollTop: target.offset().top - 80
                }, 500);
                return false;
            }
        }
    });
    
    // Mobile swipe detection for doctor cards
    if ('ontouchstart' in window) {
        let touchStartX = 0;
        let touchEndX = 0;
        
        $('.doctor-card').on('touchstart', function(e) {
            touchStartX = e.changedTouches[0].screenX;
        });
        
        $('.doctor-card').on('touchend', function(e) {
            touchEndX = e.changedTouches[0].screenX;
            handleSwipe($(this));
        });
        
        function handleSwipe(element) {
            const threshold = 50;
            
            if (touchStartX - touchEndX > threshold) {
                // Swiped left - show edit button
                element.find('.edit-action').addClass('active');
            }
            
            if (touchEndX - touchStartX > threshold) {
                // Swiped right - show info button
                element.find('.info-action').addClass('active');
            }
            
            // Reset after 3 seconds
            setTimeout(() => {
                element.find('.edit-action, .info-action').removeClass('active');
            }, 3000);
        }
    }
    
    // Custom function to populate grid view
    window.populateGridView = function(data) {
        var gridContainer = $('.doctor-grid');
        gridContainer.empty();
        
        if (!data || data.length === 0) {
            gridContainer.html('<div class="col-12 text-center mt-5"><p>No doctors found</p></div>');
            return;
        }
        
        data.forEach(function(doctor) {
            // Clone the template
            var card = $('#doctorCardTemplate .doctor-card').clone();
            
            // Set data attributes
            card.attr('data-id', doctor[0]); // ID is usually the first column
            
            // Set content
            card.find('.doctor-name').text(doctor[1]); // Name
            card.find('.doctor-department').text(doctor[4]); // Department
            card.find('.doctor-email').text(doctor[2]); // Email
            card.find('.doctor-phone').text(doctor[3]); // Phone
            
            // Set image if available
            var imgUrl = doctor[7] || 'uploads/cardiology-patient-icon-vector-6244713.jpg';
            card.find('.doctor-img').attr('src', imgUrl);
            
            // Set up button actions
            card.find('.info-btn').attr('data-id', doctor[0]);
            card.find('.edit-btn').attr('data-id', doctor[0]);
            card.find('.delete-doctor').attr('href', 'doctor/delete?id=' + doctor[0]);
            
            // Add to grid
            gridContainer.append(card);
        });
        
        // Add click handlers for the new cards
        $('.doctor-card .info-btn').on('click', function() {
            var doctorId = $(this).closest('.doctor-card').attr('data-id');
            $('.inffo[data-id="' + doctorId + '"]').trigger('click');
        });
        
        $('.doctor-card .edit-btn').on('click', function() {
            var doctorId = $(this).closest('.doctor-card').attr('data-id');
            $('.editbutton[data-id="' + doctorId + '"]').trigger('click');
        });
    };
    
    // Toast notifications function
    window.showToast = function(message, type) {
        Swal.fire({
            toast: true,
            position: 'top-end',
            icon: type,
            title: message,
            showConfirmButton: false,
            timer: 3000
        });
    };
    
    // Confirm Delete
    $(document).on("click", ".delete-doctor", function(e) {
        e.preventDefault();
        const url = $(this).attr('href');
        
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#dc3545',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = url;
            }
        });
    });
}); 