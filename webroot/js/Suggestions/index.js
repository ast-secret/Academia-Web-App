$(function(){
	$('button#btn-arquivar').click(function(){
		$(this).parents('tr').fadeOut();
	});

	$('button#btn-star').click(function(){
		var $this = $(this);
		var value = $this.data('has-star');

		var $span = $this.children('span');
		if (value) {
			$span.removeClass('glyphicon-star');
			$span.addClass('glyphicon-star-empty');

			$span.attr('title', 'Remover estrelha');

			value = 0;
		} else {
			$span.addClass('glyphicon-star');
			$span.removeClass('glyphicon-star-empty');
			
			$span.attr('title', 'Adicionar estrelha');
			value = 1;
		}

		$this.data({'has-star': value});
	});
});