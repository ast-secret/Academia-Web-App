<?= $this->assign('title', ' - Editar Exercícios') ?>

<script>
	$(function(){
		
        //createTagsFromTimesString();

		$('#btn-add').click(function(){
			var $this = $(this);

            var $exercise = $('input#exercise');
            
            var hasError = false;
            if (!$exercise.val()) {
                $exercise.parent().addClass('has-error');
                hasError = true;
            } else {
                $exercise.parent().removeClass('has-error');
            }
            
            var $exercisesString = $('input#exercises-string');
            var timesArray = $timesString.val().split(';');

            if ($.inArray(time, timesArray) >= 0) {
            	$hour.parent().addClass('has-error');
            	$minute.parent().addClass('has-error');
            	console.log('tou');
                hasError = true;
            }

            if (hasError) {
                return false;
            }

            timesArray.push(time);
            timesArray.sort();
            $timesString.val(timesArray.join(';'));

            createTagsFromTimesString();

            $hour.val('');
            $hour.focus();
            $minute.val('');
		});
        function createTagsFromTimesString()
        {
            var value = $('input#times-string').val();
            var timesArray = value.split(';');

            var $timesContainer = $('div#times-container');

            $timesContainer.html('');
        	if (value.length <= 1) {
            	$('div#times-container').html(getEmptyText());
            }

            $.each(timesArray, function(index, val) {
                if (val) {
                    addTag(val, $timesContainer);
                    console.log(val);
                }
                 
            });
        }
        function getEmptyText()
        {
			return '<div style="margin-top: 8px;"><em>Nenhum exercício para mostrar.</em></div>';
        }
        function addTag(value, $timesContainer)
        {
            $tag = getTagElement(value);
            $timesContainer.append($tag);
        }
        function getTagElement(value){
            $close = $('<span/>').html('&times;').addClass('tag-remove');
            $element = $('<span/>')
                .addClass('label label-primary tag pull-left clearfix')
                .data({'value': value})
                .text(value)
                .append($close);
            return $element;
        }
        $('select#hour, select#minute').change(function(){
            var $this = $(this);
            var value = $this.val();
            if (value) {
                $this.parent().removeClass('has-error');
            }
        });
		$(document).on('click', 'span.tag-remove', function(){
            var $this = $(this);
            
            var value = $this.parent().data('value');

            var $timesString = $('input#times-string');

            var timesArray = $timesString.val().split(';');
            var index = timesArray.indexOf(value);
            timesArray.splice(index, 1);

            $timesString.val(timesArray.join(';'));

            $this.parent().remove();
            if (timesArray.length <= 1) {
            	if (timesArray.length === 0 || timesArray[0] === "") {
            		$('div#times-container').html(getEmptyText());	
            	}
            }
        });
	});
</script>

<?php 
    $this->Html->addCrumb("Clientes", ['controller' => 'Customers', 'action' => 'index']);
    $this->Html->addCrumb("Fichas de Exercícios de <strong>{$card->customer->name}</strong>", [
        'action' => 'index',
        'customer_id' => $this->request['customer_id']
    ], [
        'escape' => false
    ]);
    $this->Html->addCrumb("Exercícios", [
        'action' => 'exercises',
        'customer_id' => $this->request['customer_id'],
        'card_id' => $this->request['card_id']
    ]);
    $this->Html->addCrumb("Exercícios da coluna <strong>{$columns[$this->request['column']]}</strong>",
     null,
     [
        'escape' => false
    ]);
    echo $this->Html->getCrumbList();
?>

<hr>

<?php
	echo $this->Form->create($card, ['novalidate' => true, 'horizontal' => true]);
		echo $this->Form->input('exercises_string', ['type' => 'text']);
        echo $this->Form->input('column', ['type' => 'text', 'value' => $this->request['column']]);
?>
	<div class="form-group">
		<div class="row">
			<div class="col-md-2 text-right">
				<!-- <label for="">Horários</label> -->
			</div>
			<div class="col-md-6">
				<div class="form-inline">
                    <input
                        id="exercise"
                        type="text"
                        placeholder="Exercício"
                        class="form-control">
	                <button type="button" id="btn-add" class="btn btn-primary">
	                	Adicionar
	                </button>
	            </div>
			</div>
		</div>
	</div>
	<div class="form-group">
		<div class="row">
			<div class="col-md-2 text-right">
				<label class="control-label">Exercícios</label>
			</div>
			<div class="col-md-6">
	        	<div id="times-container" style="margin-top: 4px;"></div>
			</div>
			
		</div>
<!-- 		<div class="row">
			<div class="col-md-6 col-md-offset-2">
	        	<p class="help-block">Horário de início das aulas</p>
			</div>
		</div> -->
	</div>
	<hr>
<?php
		echo $this->Form->submit('Salvar Alterações');
	echo $this->Form->end();
?>