!function($) {
    var flipContact = function() {
            $('#content-block > div').each(function() {
                $(this).addClass('fadeInUp');
                $(this).toggle('display');
            }, this);
        }
    $('.flip').bind('click', flipContact);

}(window.jQuery)
