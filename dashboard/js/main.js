(function($) {

	"use strict";

	var fullHeight = function() {

		$('.js-fullheight').css('height', $(window).height());
		$(window).resize(function(){
			$('.js-fullheight').css('height', $(window).height());
		});

	};
	fullHeight();

	$('#sidebarCollapse').on('click', function () {
      $('#sidebar').toggleClass('active');
  });

})(jQuery);


//admin deleting button
$('.delete-admin').click(function(){
    swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover this option!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          swal("Your file has been deleted!", {
            icon: "success",
          });
          const id = $(this).data('id');
          $.post('api.php',{'delete-admin':id}).then(res=>{
             console.log(res)
              $('#'+id+'-meal').addClass("display");  
          })
         $('#'+id+'-meal').addClass("display"); 
         console.log('hey') 
        
        } else {
          swal("Your file is safe!");
        }
      });
})




