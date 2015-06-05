$(function(){

	var ajaxInProgress = false;

	$('button#btn-arquivar').click(function(){
		var $this = $(this);
		
		$this.attr('disabled', true);

		var suggestionId = $this.parent().data('suggestion-id');
		var urlToggleIsRead = $this.parent().data('url-toggle-is-read');	
		var value = $this.data('is-read');

		value = isReadToggleIcon(value, $this);

		ajaxInProgress = true;
		$.post(urlToggleIsRead, {id: suggestionId, add: value}, function(){

			$this.data('is-read', value);

		},'json')
		.fail(function(){
			$this.parents('tr').fadeIn(speed, function(){
				alert('Ocorreu um erro ao tentar arquivar a sugestão, por favor tente novamente.');	
				location.reload();
			});
		})
		.always(function(){
			$this.attr('disabled', false);
			ajaxInProgress = false;
		});	
	});

	$('button#btn-star').click(function(){
		var $this = $(this);
		
		$this.attr('disabled', true);

		var value = $this.data('has-star');
		var suggestionId = $this.parent().data('suggestion-id');
		var urlToggleIsStar = $this.parent().data('url-toggle-is-star');	

		value = starSetIcon(value, $this);

		ajaxInProgress = true;
		$.post(urlToggleIsStar, {id: suggestionId, add: value}, function(){
			$this.data({'has-star': value});
		},'json')
		.fail(function(){
			starSetIcon(value, $this);
			alert('Ocorreu um erro ao tentar salvar a sua estrela, por favor tente novamente.');
			location.reload();
		})
		.always(function(){
			$this.attr('disabled', false);
			ajaxInProgress = false;
		});	
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
	function isReadToggleIcon(value, $this){
		var $span = $this.children('span');
		if (value) {
			$span.removeClass('glyphicon-folder-close');
			$span.addClass('glyphicon-folder-open');

			$span.attr('title', 'Arquivar');

			value = 0;
		} else {
			$span.removeClass('glyphicon-folder-open');
			$span.addClass('glyphicon-folder-close');
			
			$span.attr('title', 'Desarquivar');
			value = 1;
		}
		return value;
	}

	$(window).on('beforeunload ',function() {
	    if (ajaxInProgress) {
	    	return 'Algumas ações feitas por você nesta página ainda não terminaram de ser processadas.';
	    }
	});

});