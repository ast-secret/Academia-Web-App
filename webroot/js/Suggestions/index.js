$(function(){

	var ajaxInProgress = false;

	var wParent = $('div#suggestion-text').parent().width();
	$('div#suggestion-text').css('width', wParent + 'px');

	$('button#btn-arquivar').click(function(){
		var $this = $(this);

		$this.attr('disabled', true);

		var speed = 'fast'; 
		$this.parents('tr').fadeOut(speed, function(){
			var suggestionId = $this.parents('tr').attr('data-id');
			var urlToggleIsRead = $('#table').attr('data-url-toggle-is-read');	
			var value = $this.data('is-read') ? 0 : 1;

			$this.parents('tr').remove();
			var left = $('#table tbody tr').length;
			if (left === 0) {
				$('#table tbody').append('<tr><td><span class="text-muted">Nenhuma sugestão.</span></td></tr>');
			}

			ajaxInProgress = true;
			$.post(urlToggleIsRead, {id: suggestionId, add: value}, function(){
			},'json')
			.fail(function(err){
				console.log('tey');
				console.log(err);
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
	});

	$('button#btn-star').click(function(){
		var $this = $(this);

		$this.attr('disabled', true);

		var value = $this.data('has-star');
		var suggestionId = $this.parents('tr').attr('data-id');
		var urlToggleIsStar = $('#table').attr('data-url-toggle-is-star');	

		value = starSetIcon(value, $this);

		ajaxInProgress = true;
		$.post(urlToggleIsStar, {id: suggestionId, add: value}, function(){
			$this.data({'has-star': value});
		},'json')
		.fail(function(err){
			console.log(err);
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
	$(window).on('beforeunload ',function() {
	    if (ajaxInProgress) {
	    	return 'Algumas ações feitas por você nesta página ainda não terminaram de ser processadas.';
	    }
	});
});