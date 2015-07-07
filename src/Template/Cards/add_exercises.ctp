<?php
    $title = 'Configurar exercícios';
    $this->assign('title', ' - ' . $title);

    echo $this->Html->script('../lib/jquery-ui/jquery-ui.min.js', ['inline' => false]);
?>

<br>
<?php 
    $this->Html->addCrumb('Clientes', ['controller' => 'Customers', 'action' => 'index']);
    $this->Html->addCrumb('Fichas de exercícios', [
        'controller' => 'Cards',
        'action' => 'index',
        'customer_id' => $customer->id
    ]);
    $this->Html->addCrumb($title);
    echo $this->Html->getCrumbList();
?>
<br>

<style>
    .custom-col{
        min-height: 400px;
        border: 1px solid #EEE;
    }
    .custom-col div{
        padding: 8px;
        border-top: 1px solid #EEE;
        border-bottom: 1px solid #EEE;
    }
    .col-selected{
        border: 1px solid red;
    }
</style>

<script>
    $(function(){
        var currentCol = 1;
        $('.custom-col').click(function(){
            var $this = $(this);
            $('.custom-col').removeClass('col-selected');
            $this.addClass('col-selected');
            currentCol = $this.data('index');
            //$('#add-exercise').focus();
        });
        $('.custom-col').sortable({
            connectWith: '.custom-col'
        });

        $(document).on('click', '.btn-remove', function(){
            var $col = $(this).parent('div');
            $col.remove();
        });
        $(document).on('click', '.text-exercise', function(){
            var id = $(this).data('id');
            $('#text-exercise-' + id).hide();
            $('.btn-remove').hide();
            $('#input-exercise-' + id).show().focus();
        });
        $(document).on('click', '.input-exercise', function(event){
            return false;
        });
        $(document).on('blur', '.input-exercise', function(){
            var $this = $(this);
            var id = $this.data('id');
            $this.hide();
            $('#text-exercise-' + id).text($this.val()).show();
            $('.btn-remove').show();
        });

        $('#add-exercise').keydown(function(event) {
            var $this = $(this);
            var value = $this.val();
            if (event.keyCode == 13) {

                var totalExercises = $('.exercise').length;
                var newId = totalExercises + 1;

                var $col = $("div[data-index='"+currentCol+"']");

                var $div = $('<div/>')
                    .addClass('exercise')
                    .appendTo($col);

                var $input = $('<input/>')
                    .attr('id', 'input-exercise-' + newId)
                    .data('id', newId)
                    .attr('name', 'exercises[' + newId + '][name]')
                    .attr('type', 'text')
                    .css('display', 'none')
                    .addClass('form-control input-exercise')
                    .val(value)
                    .appendTo($div);
                var $inputExerciseColumn = $('<input/>')
                    .attr('name', 'exercises[' + newId + '][exercise_column]')
                    .attr('type', 'text')
                    .css('display', 'none')
                    .addClass('form-control')
                    .val(1)
                    .appendTo($div);
                var $inputExerciseOrder = $('<input/>')
                    .attr('name', 'exercises[' + newId + '][exercise_order]')
                    .attr('type', 'text')
                    .css('display', 'none')
                    .addClass('form-control')
                    .val(1)
                    .appendTo($div);

                var $text = $('<span/>')
                    .attr('id', 'text-exercise-' + newId)
                    .data('id', newId)
                    .addClass('text-exercise')
                    .text(value)
                    .appendTo($div);

                var $btnRemove = $('<button>')
                    .attr('type', 'button')
                    .addClass('btn btn-default btn-remove')
                    .html('<span class="glyphicon glyphicon-remove"></span>')
                    .appendTo($div);

                $this.val('');

                return false;
            }
            
        });
    });
</script>

<?= $this->Form->create($card) ?>
    <?= $this->Form->submit('Salvar') ?>
    <div class="row">
        <div class="col-md-4">
            <input type="text" class="form-control" id="add-exercise" autocomplete="off" autofocus="true">
        </div>
    </div>
    <div class="row">
        <div class="col-md-2 col-sm-2">
            <div class="custom-col col-selected" data-index="1">
            </div>
        </div>
        <div class="col-md-2 col-sm-2">
            <div class="custom-col" data-index="2">
            </div>
        </div>
    </div>
<?= $this->Form->end() ?>