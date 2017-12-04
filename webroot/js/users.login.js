$(function() {
    //on mobile we can not use :hover
    $('#logo').on('mouseenter click', function (){
        $('.login').addClass('active');
    });
});
