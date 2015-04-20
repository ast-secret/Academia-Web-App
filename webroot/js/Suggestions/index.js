$(function(){
	$('button#btn-arquivar').click(function(){
		var $this = $(this);
		var speed = 'fast'; 
		$this.parents('tr').fadeOut(speed);

		var suggestionId = $this.parents('tr').attr('data-id');
		var urlToggleIsRead = $('#table').attr('data-url-toggle-is-read');	
		var value = $this.attr('data-is-read') ? 0 : 1;

		$.post(urlToggleIsRead, {id: suggestionId, add: value}, function(){
		},'json')
		.fail(function(){
			$this.parents('tr').fadeIn(speed, function(){
				alert('Ocorreu um erro ao tentar arquivar a sugestão, por favor tente novamente.');	
			});
		});		
	});

	$('button#btn-star').click(function(){
		var $this = $(this);
		var value = $this.data('has-star');
		var suggestionId = $this.parents('tr').attr('data-id');
		var urlToggleIsStar = $('#table').attr('data-url-toggle-is-star');	

		value = starSetIcon(value, $this);

		$.post(urlToggleIsStar, {id: suggestionId, add: value}, function(){
		},'json')
		.fail(function(){
			starSetIcon(value, $this);
			alert('Ocorreu um erro ao tentar salvar a sua estrela, por favor tente novamente.');
		});

		$this.data({'has-star': value});
	});
	function starSetIcon(value, $this){
		var $span = $this.children('span');
		if (value) {
			$span.removeClass('glyphicon-star');
			$span.addClass('glyphicon-star-empty');

			$span.attr('title', 'Adicionar estrelha');

			value = 0;
		} else {
			$span.addClass('glyphicon-star');
			$span.removeClass('glyphicon-star-empty');
			
			$span.attr('title', 'Remover estrelha');
			value = 1;
		}
		return value;
	}
});