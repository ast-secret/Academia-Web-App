$(function(){
	$('button#toggle-filters').click(function(){
        $(this).toggleClass('active');
        $('#cont-filters').slideToggle();

        var value; 
        if ($(this).hasClass('active')) {
        	value = 1;
        } else {
        	value = 0;
        }
        $('#filters').val(value);
    });
});