$(document).ready(function(){
    $('button.sidebarToggleBtn').click(function(){
        var $button = $(this);
        var $span = $button.find('span');

        //check if the currect text is close menu
        if($span.text().trim() === 'Close Menu'){
            $span.text('Open Menu');
        }
        else {
            $span.text("Close Menu");
        }

        $(this).find('i').toggleClass('fa-times fa-bars');
    });
    if($(window).width() >= 930) {
        $('button.sidebarToggleBtn').click(function(){
            $('.mainSidebar').toggleClass('show', 1000);
            $('main.main').toggleClass('full', 1200);
        });
    };
    if($(window).width() <= 929) {
        $('button.sidebarToggleBtnMobile').click(function(){
            var $button = $(this);
            var $span = $button.find('span');

            //check if the currect text is close menu
            if($span.text().trim() === 'Open Menu'){
                $span.text('Close Menu');
            }
            else {
                $span.text("Open Menu");
            }
            $(this).find('i').toggleClass('fa-times fa-bars');
            $('.mainSidebar').toggleClass('show', 1200);
            //$('main.main').toggleClass('full', 1200);
        });
       $('.mainSidebar').removeClass('show');
       $('main.main').toggleClass('full', 1200);
    }

    //Confirm delete button popup
    $('.confirm-delete-btn').click(function(event){
        var form = $(this).closest("form");
        var name = $(this).data('name');
        event.preventDefault();
        swal({
            title: 'Are you sure you want to delete this?',
            text: 'If you delete this it will be gone forever',
            icon: 'warning',
            type: 'warning',
            buttons: ["Cancel", "Confirm"],
            dangerMode: true,
            closeOnEsc: true,
            confirmButtonText: 'Yes, delete it'
        }).then((willDelete) =>{
            if(willDelete) {
                form.submit();
            }
        });
    });

    //Initiate DT



});
