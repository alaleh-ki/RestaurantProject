$('.scrollmenu a').click(function(){
    $('.scrollmenu a').removeClass('active')
   $(this).addClass('active');
});

$('.add').click(function(){
    const id = $(this).data('id');
    //first part - algo & db changes
    $.post('api.php',{'id':id}).then(res=>{
    if($('#'+id).length <1 ){
 var html = '<div class="row">'+
            '<div class="col-6 quantity mt-3" id="'+id+'" > '+
            ' <span>quantity:</span> <p>1</p>'+
            '</div>'+
            '<div class="col-6 mt-3 delete-col">'+
            '<button class="btn btn-sm btn-danger delete" onclick="deleteMenu(this)" data-delete="'+id+'" id="'+id+'-d">'+
            '<i class="fa fa-minus" aria-hidden="true"></i>'+
            '</button>'+
            '</div>'+
            '</div>'
            ;
         $('[data-id = '+id+']').closest('.content').append(html);

        

         
        }
        else {
            $('#'+id).find('p').html(parseFloat($('#'+id).find('p').html())+1)
        }



//span for the cart icon 
        if($('.span').length<1){
             var html = '  <span class="pl-2 span" style="color:var(--global);">1</span>' ;
            $('.cart-icon').append(html);
        }else{
         $('.span').html(parseFloat($('.span').html())+1)   
          }
    })

    //showing quantity and delete button when u add(if they r not showing)
    if($('#'+id).hasClass("display")){
        $('#'+id).removeClass( "display" )
        $('#'+id+'-d').removeClass( "display" )
    }
    if($('.cart_active').hasClass('display')){
      $('.cart_active').removeClass('display')
      $('.span').removeClass('display')
    }

    //cart button 
    if($('.cart_active').length<1){
    var html = 
    '<button class="fixed-bottom float-right btn cart_active m-3">'+
    '<i class="fa fa fa-shopping-cart"></i>'+
    '<span class="pl-2 new-span">1</span>'+
    ' </button>';
    $('.cart-fixed').append(html);
    }else{
        
        $('.new-span').html(parseFloat($('.new-span').html())+1)
    }

});



//delete button
function deleteMenu(elem){
    const id = $(elem).data('delete');
    //first part - algo & db changes
    $.post('api.php',{'delete':id}).then(res=>{
    var quantity =parseFloat($('#'+id).find('p').html());
    
//deleting on the page manually
    if(!$('#'+id).length <1 && quantity > 1 ){
$('#'+id).find('p').html(quantity-1)

    }else if(!$('#'+id).length <1 && quantity == 1 ){

    // algo & db changes
    $.post('api.php',{'delete':id}).then(res=>{
     $('#'+id).find('p').html(quantity-1)

     //display none for when u delete the last one
  $('#'+id).addClass("display");
  $('#'+id+'-d').addClass("display");
        })
    }
    //deleting from nav-cart span
    $('.span').html(parseFloat($('.span').html())-1)

    //deleting from cart button span
    $('.new-span').html(parseFloat($('.new-span').html())-1)
    if(parseFloat($('.new-span').html()) == 0){
        $('.cart_active').addClass("display");
        $('.span').addClass("display");
    }
})
}



//deleting from cart page
$('.delete-cart').click(function(){
    const id = $(this).data('delete');
    //first part - algo & db changes
    $.post('api.php',{'delete':id}).then(res=>{
    var quantity =parseFloat($('#'+id+'-d-meal').find('.quantity').html());
    
//deleting on the page manually
$('#'+id+'-d-meal').find('.quantity').html(quantity-1)

 if(quantity == 1 ){
    // algo & db changes
    $.post('api.php',{'delete':id}).then(res=>{
     $('#'+id+'-d-meal').find('.quantity').html(quantity-1)

     //display none for when u delete the last one
  $('#'+id+'-d-meal').addClass("display");
        })
    }
    //deleting from nav-cart span
    $('.span').html(parseFloat($('.span').html())-1)

    if(parseFloat($('.span').html()) == 0){
    $('.span').addClass("display");}
})
})


//cart page add button
$('.add-cart').click(function(){
    const id = $(this).data('id');
    //first part - algo & db changes
    $.post('api.php',{'id':id}).then(res=>{

 var quantity =parseFloat($('#'+id+'-d-meal').find('.quantity').html());
    $('#'+id+'-d-meal').find('.quantity').html(quantity+1)

//span for the cart icon 

         $('.span').html(parseFloat($('.span').html())+1)   
          
    })


});



//admin deleting button
$('.delete-admin').click(function(){
    swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover this item!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          swal("The item has been deleted!", {
            icon: "success",
          });
          const id = $(this).data('id');
          $.post('api.php',{'delete-category':id}).then(res=>{
             console.log(res)
              $('#'+id+'-meal').addClass("display");  
          })
         $('#'+id+'-meal').addClass("display"); 
         console.log('hey') 
        
        } else {
          swal("The item is safe!");
        }
      });
})




//edit page
var frm = $('#edit-form');
frm.submit(function (e) {
    e.preventDefault();
  const formData = new FormData(e.target);
  const formProps = Object.fromEntries(formData);
  var submit = JSON.stringify(formProps);
 $.post('api.php',{submit}).then(res=>{
    console.log(res)
if(res[0]==1){
  swal("Good job!", "Edited successfully!", "success")
.then((value) => {
  window.location.replace("http://localhost/restaurant/index.php");
});
}else{
    var errors=JSON.parse(res);
    $.each(errors, function( index, value ) {
        if(!value==""){
            console.log(index)
            $('#'+index).html(value)
        }
      });
}
res=null;
submit=null;
    });
});




//add page
var form = $('#add-pruduct');
form.submit(function (e) {
    e.preventDefault();

  const formData = new FormData(e.target);
  const formProps = Object.fromEntries(formData);
  var add = JSON.stringify(formProps);
 // frm.attr('action')
 $.post('api.php',{add}).then(res=>{
    console.log(res)
if(res[0]==1){
  swal("Good job!", "Added successfully!", "success")
.then((value) => {
  window.location.replace("http://localhost/restaurant/index.php");
});
}else{
    var errors=JSON.parse(res);
    $.each(errors, function( index, value ) {
        if(!value==""){
            console.log(index)
            $('#'+index).html(value)
        }
      });
}
res=null;
add=null;

    });
});


//add category page
var form = $('#add-category');
form.submit(function (e) {
    e.preventDefault();
  const formData = new FormData(e.target);
  const formProps = Object.fromEntries(formData);
  var addCategory = JSON.stringify(formProps);
  console.log(addCategory)
  $.post('http://localhost/restaurant/api.php',{addCategory}).then(res=>{
    console.log(res)
if(res[0]==1){
  swal("Good job!", "Added successfully!", "success")
.then((value) => {
  window.location.replace("http://localhost/restaurant/index.php");
});
}else{
    var errors=JSON.parse(res);
    $.each(errors, function( index, value ) {
        if(!value==""){
            console.log(index)
            $('#'+index).html(value)
        }
      });
}
res=null;
addCategory=null;

    });
});



//delete category
$('.delete-category').click(function(){
    swal({
        title: "Are you sure?",
        text: "Once deleted, you will not be able to recover this item!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          swal("The item has been deleted!", {
            icon: "success",
          });
          const id = $(this).data('id');
          $.post('http://localhost/restaurant/api.php',{'delete-category':id}).then(res=>{
             console.log(res)
              $('#'+id+'-category').addClass("display");  
          })
        
        } else {
          swal("The item is safe!");
        }
      });
})


//delete category
$('.signout').click(function(){
  console.log('clicked')
        const id = $(this).data('id');
        $.post('http://localhost/restaurant/api.php',{'signout':id}).then(res=>{
          window.location.replace("http://localhost/restaurant/signIn.php");
        })
    });



//live search

    function liveSearch(elem){
      var input = $(elem).val();
      if(input != ""){
        $.ajax({
          url:"api.php",
          method:"POST",
          data:{input:input},
          success:function(data){
            var results = data;
            console.log(results)
            $('#search_result').html(data);
            if($("#search_result").hasClass("display")){
              $("#search_result").removeClass( "display" )
           $('#search_result').html(data);
            }
          }
        })
        
      }else{
        
        $("#search_result").addClass("display"); 
      }
   

    }
