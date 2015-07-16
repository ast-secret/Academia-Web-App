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
        cursor: pointer;
    }
    .custom-col:hover{
        outline: 2px solid #3498db;
    }
    .custom-col div.exercise, .custom-col div.group{
        padding: 8px;
        border-top: 1px solid #EEE;
        border-bottom: 1px solid #EEE;
    }
    .custom-col div.group{
        text-align: center;
        font-weight: bold;
    }
    .col-selected{
        outline: 2px solid #3498db;
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
            var group = $this.data('label');
            $('#label-add-exercise strong').text(group);
            $('#add-exercise').focus();
        });
        $('.custom-col').sortable({
            connectWith: '.custom-col',
            cancel: '.group',
            receive: function(event, ui){
                var $target = $(event.target);
                var index = $(event.target).data('index');
                
                console.log(ui.item.children('.exercise-column').val(index));
            }
        }).disableSelection();

        $(document).on('click', '.btn-remove', function(){
            var $col = $(this).parents('div.exercise');
            $col.remove();
        });
        // $(document).on('click', '.text-exercise', function(){
        //     var id = $(this).data('id');
        //     $('#text-exercise-' + id).hide();
        //     $('.btn-remove').hide();
        //     $('#input-exercise-' + id).show().focus();
        // });
        // $(document).on('click', '.input-exercise', function(event){
        //     return false;
        // });
        // $(document).on('blur', '.input-exercise', function(){
        //     var $this = $(this);
        //     var id = $this.data('id');
        //     $this.hide();
        //     $('#text-exercise-' + id).text($this.val()).show();
        //     $('.btn-remove').show();
        // });

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
                    .attr('type', 'hidden')
                    .addClass('form-control exercise-column')
                    .val(currentCol)
                    .appendTo($div);
                var $inputExerciseOrder = $('<input/>')
                    .attr('name', 'exercises[' + newId + '][exercise_order]')
                    .attr('type', 'text')
                    .css('display', 'none')
                    .addClass('form-control')
                    .val(1)
                    .appendTo($div);

                var $row = $('<div/>').addClass('row').appendTo($div);
                var $col1 = $('<div/>').addClass('col-md-8').appendTo($row);
                var $col2 = $('<div/>').addClass('col-md-4').appendTo($row);
                var $text = $('<span/>')
                    .attr('id', 'text-exercise-' + newId)
                    .data('id', newId)
                    .addClass('text-exercise')
                    .text(value)
                    .appendTo($col1);

                var $btnRemove = $('<button>')
                    .attr('type', 'button')
                    .addClass('btn btn-default btn-remove btn-xs pull-right')
                    .html('<span class="glyphicon glyphicon-remove"></span>')
                    .appendTo($col2);

                $this.val('');

                return false;
            }
            
        });
    });
</script>

<?= $this->Form->create($card) ?>
    <div class="well clearfix">

        <strong>Atenção!</strong>
        <br>
        Todas as alterações feitas só serão salvas ao clicar no botão ao lado.
        <br class="clearfix">
        <br>
<?= $this->Form->submit('Salvar Alterações', ['bootstrap-type' => 'primary', 'class' => '']) ?>            
    </div>
    
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label id="label-add-exercise" for="add-exercise">Adicionar exercício em <strong>Grupo A</strong></label>
                <input
                    type="text"
                    class="form-control"
                    id="add-exercise"
                    placeholder="Digite o nome do exercício em pressione ""enter"""
                    autocomplete="off"
                    autofocus="true">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2 col-sm-4">
            <div class="custom-col col-selected" data-index="1" data-label="Grupo A">
                <div class="group">
                    Grupo A
                </div>
            </div>
        </div>
        <div class="col-md-2 col-sm-4">
            <div class="custom-col" data-index="2" data-label="Grupo B">
                <div class="group">
                    Grupo B
                </div>
            </div>
        </div>
        <div class="col-md-2 col-sm-4">
            <div class="custom-col" data-index="3" data-label="Grupo C">
                <div class="group">
                    Grupo C
                </div>
            </div>
        </div>
        <div class="col-md-2 col-sm-4">
            <div class="custom-col" data-index="4" data-label="Grupo D">
                <div class="group">
                    Grupo D
                </div>
            </div>
        </div>
        <div class="col-md-2 col-sm-4">
            <div class="custom-col" data-index="5" data-label="Grupo E">
                <div class="group">
                    Grupo E
                </div>
            </div>
        </div>
    </div>
<?= $this->Form->end() ?>