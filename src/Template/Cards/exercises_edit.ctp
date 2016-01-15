<?= $this->assign('title', ' - Editar Exercícios') ?>
<?= $this->Html->script('../lib/jquery-ui/jquery-ui.min.js', ['inline' => false]) ?>
<script>
	$(function(){
		var $exercise = $('#exercise');
        var $repetition = $('#repetition');
        
        var $panelExercisesUl = $('.panel-exercises ul');

        var $exercisesString = $('input#exercises-string');

        $('.panel-exercises ul').sortable({
            axis: 'y',
            containment: '.panel-exercises-containment',
            update: function(){
                createStringFromTags();
            }
        });

        var autocompleteUrl = $('input#exercise').data('autocomplete-url');
        $('input#exercise').autocomplete({
            source: autocompleteUrl
        });

        createTagsFromString();
        $('input#exercise, input#repetition').keydown(function(event){
            if(event.keyCode == 13) {
                addExercise();
                event.preventDefault();
                return false;
            }
        });
        $('#btn-add').click(function(){
            addExercise();
        });

        $(document).on({
            mouseenter: function () {
                //stuff to do on mouse enter
                $(this).find('button.btn-remove').stop().fadeIn('fast');
            },
            mouseleave: function () {
                //stuff to do on mouse leave
                $(this).find('button.btn-remove').stop().fadeOut('fast');
            }
        }, 'div.panel-exercises ul li');

		function addExercise(fromAutocomplete) {

            fromAutocomplete = (typeof fromAutocomplete == 'undefined') ? false : true;
            console.log(fromAutocomplete);

            var $exercise = $('input#exercise');
            var $repetition = $('input#repetition');

            var exercise = $exercise.val();

            var repetition = $repetition.val();
            // var completeValue = exercise + '|#|' + repetition;
            var completeValue = exercise;
            
            var hasError = false;
            if (!fromAutocomplete) {
                if (!exercise) {
                    $exercise.parent().addClass('has-error');
                    hasError = true;
                } else {
                    $exercise.parent().removeClass('has-error');
                }

                // if(!repetition) {
                //     $repetition.parent().addClass('has-error');
                //     hasError = true;
                // } else {
                //     $repetition.parent().removeClass('has-error');
                // }
            }
            
            var $exercisesString = $('input#exercises-string');
            var exercisesArray = $exercisesString.val().split(';');

            if ($.inArray(completeValue.trim(), exercisesArray) >= 0) {
            	$exercise.parent().addClass('has-error');
                hasError = true;
            }

            if (hasError) {
                if (!exercise) {
                    $exercise.focus();    
                } else if (!repetition) {
                    $repetition.focus();
                }
                return false;
            }

            exercisesArray.push(completeValue);
            //exercisesArray.sort();
            $exercisesString.val(exercisesArray.join(';'));

            createTagsFromString();

            $exercise.val('');
            $exercise.focus();
		}
        function createStringFromTags()
        {
            var $lis = $panelExercisesUl.children('li');
            var exercises = [];
            $lis.each(function(key, value){
                exercises.push($(value).text());
            });
            $exercisesString.val(exercises.join(';'));
        }
        function createTagsFromString()
        {
            var value = $('input#exercises-string').val();
            var exercisesArray = value.split(';');

            $('#empty').html('');
            $panelExercisesUl.html('');

        	if (value.length <= 1) {
            	$panelExercisesUl.append($('<li/>').addClass('list-group-item').html(getEmptyText()));
            }

            $.each(exercisesArray, function(index, val) {
                if (val) {
                    addItem(val);
                }
                 
            });
        }
        function getEmptyText()
        {
			return '<div style="margin-top: 8px;"><em>Nenhum exercício para mostrar.</em></div>';
        }
        function addItem(value)
        {
            $tag = getItemElement(value);
            $panelExercisesUl.parent().show();
            $panelExercisesUl.append($tag);
            $tag.fadeIn('fast')   ; 
        }
        function getItemElement(value){
            // var valueEscaped = value.replace('|#|', ' ');
            var valueEscaped = value;
            $close = $('<button/>')
                .attr('type', 'button')
                .css('display', 'none')
                .html('<span class="glyphicon glyphicon-remove"></span>')
                .addClass('btn btn-default btn-xs btn-remove pull-right');
            $element = $('<li/>')
                .addClass("list-group-item")
                .css('display', 'none')
                .data({'value': valueEscaped})
                .text(valueEscaped)
                .append($close);
            return $element;
        }

		$(document).on('click', 'button.btn-remove', function(){
            var $this = $(this);
            
            var value = $this.parent().data('value');

            var exercisesArray = $exercisesString.val().split(';');
            var index = exercisesArray.indexOf(value);
            exercisesArray.splice(index, 1);

            $exercisesString.val(exercisesArray.join(';'));

            $this.parent().fadeOut('fast', function(){
                $(this).remove();
                if (exercisesArray.length <= 1) {
                    if (exercisesArray.length === 0 || exercisesArray[0] === "") {
                        $panelExercisesUl
                            .append($('<li/>').addClass('list-group-item').html(getEmptyText()));
                    }
                }
            });
        });
	});
</script>

<?php 
    $this->Html->addCrumb("Clientes", [
        'controller' => 'Customers',
        'action' => 'index'
    ]);
    $this->Html->addCrumb($card->customer->name, null);
    $this->Html->addCrumb("Fichas", [
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
    $this->Html->addCrumb("Editar exercícios da coluna <strong>{$columns[$this->request['column']]}</strong>",
     null,
     [
        'escape' => false
    ]);
    echo $this->Html->getCrumbList();
?>

<br>
<br>

<?php
	echo $this->Form->create($card, ['novalidate' => true, 'horizontal' => true]);
		echo $this->Form->input('exercises_string', ['type' => 'hidden']);
        echo $this->Form->input('column', ['type' => 'hidden', 'value' => $this->request['column']]);
?>
	<div class="row">
		<div class="col-md-offset-2 col-md-5">
			<div class="row">
                <div class="col-md-8">
                    <!-- Span para aplicar a calsse has error nos campos individuais -->
                    <span>
                        <input
                            autocomplete="off"
                            data-autocomplete-url="<?= $this->Url->build(['controller' => 'ExercisesSuggestions','action' => 'index', '_ext' => 'json']) ?>"
                            id="exercise"
                            type="text"
                            placeholder="Exercício"
                            class="form-control">
                    </span>
                    <!-- Span para aplicar a calsse has error nos campos individuais -->
                    <!-- <span>
                        <input
                            autocomplete="off"
                            id="repetition"
                            type="text"
                            placeholder="Repetição"
                            class="form-control">
                    </span> -->
                </div>
                <div class="col-md-4">
                    <button type="button" id="btn-add" class="btn btn-primary btn-block">
                        Adicionar
                    </button>
                </div>
            </div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-offset-2 col-md-5">
            <!-- Este .panel-exercises-containment serve para funcionar o drag quando tem apenas
            dois itens -->
            <div class="panel-exercises-containment" style="overflow: hidden;position: relative;">
                <div class="panel panel-default panel-exercises" style="margin-top: 10px; margin-bottom: 10px!important;">
                    <div class="panel-heading">
                        Exercícios
                    </div>                    
                    <ul class="list-group"></ul>
                </div>            
            </div>
		</div>
   </div>
	<hr>
<?php
		echo $this->Form->submit('Salvar Alterações');
	echo $this->Form->end();
?>