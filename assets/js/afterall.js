window.onload = function () { //$(window).load(function () {//
    $('.page-loader-wrapper').fadeOut();
    
    $('[data-toggle="tooltip"]').tooltip({
        container: 'body'
    });

    $.AdminBSB.select.activate();
}