$(function(){
	$('#text').niceCharCounter({
        limit: 800,
        warningPercent: 10,
        warningColor: '#e67e22',
        text: '{{counter}} caractere(s) restante(s).',
        counter: '#container-counter',
	});
    $('[name="destaque"]').click(function(){
        if ($(this).prop('checked')) {
            $('#container-destaque').stop().fadeIn();
        } else {
            $('#container-destaque').stop().fadeOut();
        }
    });
});