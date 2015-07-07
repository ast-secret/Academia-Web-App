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

<script>
    $(function(){

        $('table tbody').sortable({
            axis: 'y'
        });

        $(document).on('keypress', '#my-form input', function(event){
            if (event.keyCode == 13) {
                return false;
            }
        });

        $(document).on('click', '#btn-remove', function(){
            var $this = $(this);
            var exerciseId = $this.data('id');
            if (confirm('Você realmente deseja remover este exercício?')) {
                var $row = $this.parents('tr').fadeOut('fast', function(){
                    $(this).remove();
                    if (exerciseId) {
                        var exercisesToDelete = $('#exercises-to-delete').val();
                        exercisesToDelete = exercisesToDelete.split(';');
                        exercisesToDelete.push(exerciseId);
                        $('#exercises-to-delete').val(exercisesToDelete.join(';'));
                    }
                });
            }
        });

        $(document).on('click', '#btn-remove-group', function(){
            var $this = $(this);
            
            var $panel = $this.parents('.panel');
            var totalExercises = $panel.find('table tbody tr').length - 1;
            var groupId = $this.data('id');

            console.log(groupId);
            if (confirm('Você realmente deseja remover este grupo e seu(s) '+totalExercises+' exercício(s)?')) {
                $panel.fadeOut('fast', function() {
                    $this.remove();
                    if (groupId) {
                        var groupsToDelete = $('#groups-to-delete').val();
                        groupsToDelete = groupsToDelete.split(';');
                        groupsToDelete.push(groupId);
                        $('#groups-to-delete').val(groupsToDelete.join(';'));
                    }
                });
            }
        });

        $(document).on('click', '#span-exercise', function(){
            var $this = $(this);
            var $input = $this.siblings('#input-exercise');
            $input.attr('type', 'text').focus();
            $this.hide();
        });
        $(document).on('blur', '#input-exercise', function(){
            var $this = $(this);
            var $span = $this.siblings('#span-exercise');

            $this.attr('type', 'hidden');
            $span.text($this.val()).show();
        });

        $(document).on('click', '#span-group', function(){
            var $this = $(this);
            var $input = $this.siblings('#input-group');

            $input.attr('type', 'text').focus();
            $this.hide();
        });
        $(document).on('blur', '#input-group', function(){
            var $this = $(this);
            var $span = $this.siblings('#span-group');

            $this.attr('type', 'hidden');
            $span.text($this.val()).show();
        });

        $('input#add-group').keypress(function(event){
            var $this = $(this);
            if (event.keyCode == 13) {
                var value = $(this).val();

                if (!value) {
                    $this.parent('.form-group').addClass('has-error');
                    return false;
                }

                var $groups = $('div#group-row');
                var groupsTotal = $groups.length;
                var newGroupIndex = groupsTotal + 1;

                var $row = $('<div/>').addClass('row');
                var $col = $('<div/>').addClass('col-md-12').appendTo($row);
                var $panel = $('<div/>').addClass('panel panel-default').appendTo($col);
                var $panelHeading = $('<div/>')
                    .addClass('panel-heading')
                    .attr('id', 'group-row')
                    .data('id', newGroupIndex)
                    .appendTo($panel);

                var $rowHeading = $('<div/>').addClass('row').appendTo($panelHeading);
                var $colText = $('<div/>').addClass('col-md-10').appendTo($rowHeading);
                var $colBtn = $('<div/>').addClass('col-md-2').appendTo($rowHeading);

                var $spanGroup = $('<span/>')
                    .text(value)
                    .attr('id', 'span-group')
                    .appendTo($colText);
                    
                $('#row-container-groups').append($row);

                var $input = $('<input/>')
                    .attr('name', 'exercises_groups[' + newGroupIndex + '][name]')
                    .attr('type', 'hidden')
                    .attr('autocomplete', 'off')
                    .attr('id', 'input-group')
                    .addClass('form-control')
                    .val(value)
                    .appendTo($colText);


                var $btnRemoveGroup = $('<button/>')
                    .attr('id', 'btn-remove-group')
                    .attr('type', 'button')
                    .data('id', 0)
                    .addClass('btn btn-default btn-xs pull-right')
                    .append('<span class="glyphicon glyphicon-remove">')
                    .appendTo($colBtn);

                var $table = $('<table/>')
                    .addClass('table')
                    .appendTo($panel);
                var $tbody = $('<tbody/>')
                    .appendTo($table);
                var $tr = $('<tr/>').appendTo($tbody);
                var $td = $('<td/>').appendTo($tr);

                var $inputAddExercise = $('<input/>')
                    .attr('id', 'add-exercise')
                    .attr('autocomplete', 'off')
                    .attr('placeholder', 'Adicionar exercício')
                    .attr('colspan', 2)
                    .addClass('form-control')
                    .appendTo($td);

                $this.val('');
                return false;
            } else {
                $this.parent('.form-group').removeClass('has-error');
            }
        });

        $(document).on('keypress', 'input#add-exercise', function(event){
            var $this = $(this);
            if (event.keyCode == 13) {
                var value = $(this).val();

                if (!value) {
                    $this.parent('.form-group').addClass('has-error');
                    return false;
                }

                var $table = $this.parents('table');
                var $tbody = $table.children('tbody');
                var groupIndex = $table.prev('#group-row').data('id');
                var $trs = $tbody.find('tr');
                var totalExercises = $trs.length - 2; // -1 pq a linha de add exercicio nao conta e o outro -1 pq quero saber a index logo começa do zero e não do 1
                var newExerciseIndex = totalExercises + 1;
                
                var $tr = $('<tr/>')
                    .attr('id', 'row-exercise')
                    .data('exercise-id', newExerciseIndex)
                    .appendTo($tbody);
                var $td = $('<td/>').appendTo($tr);

                var $spanExercise = $('<span/>')
                    .attr('id', 'span-exercise')
                    .text(value)
                    .appendTo($td);

                var $inputExerciseName = $('<input/>')
                    .attr('name', 'exercises_groups['+groupIndex+'][exercises]['+(newExerciseIndex)+'][name]').val(value)
                    .attr('id', 'input-exercise')
                    .attr('type', 'hidden')
                    .addClass('form-control')
                    .appendTo($td);

                var $tdRemove = $('<td/>')
                    .addClass('text-center')
                    .css('width', '50px')
                    .css('vertical-align', 'middle')
                    .appendTo($tr);

                var $btnRemove = $('<button/>')
                    .attr('id', 'btn-remove')
                    .attr('type', 'button')
                    .data('id', 0)
                    .addClass('btn btn-default btn-xs')
                    .html('<span class="glyphicon glyphicon-remove"></span>')
                    .appendTo($tdRemove);

                $this.val('');

                return false;
            } else {
                $this.parent('.form-group').removeClass('has-error');
            }
        });
    });
</script>

<?php
    echo $this->Form->create($card, [
        'id' => 'my-form',
        'novalidate' => true,
        'templates' => [
            'inputContainer' => '{{content}}'
        ]
    ]);
        echo $this->Form->input('groups_to_delete', ['type' => 'hidden']);
        echo $this->Form->input('exercises_to_delete', ['type' => 'hidden']);
?>
<div class="row">
    <div class="col-md-12">
        <div class="alert alert-danger clearfix">
            <button class="btn btn-success pull-right" type="submit">
                Salvar alterações
            </button>
            <strong>
                <span class="glyphicon glyphicon-warning-sign"></span> Atenção!
            </strong>
            <p>Qualquer informação alterada nesta página inclusive exclusão de exercícios e grupos só serão salvas clicando no botão ao lado.</p>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-7 col-md-offset-2">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group well">
                    <?= $this->Form->input('obs', [
                        'label' => 'Observação',
                        'type' => 'textarea',
                        'placeholder' => 'Texto...'
                    ]) ?>
                    <span class="help-block">
                        Indique aqui como o aluno deverá usar os grupos de exercício ficha.
                    </span>
                </div>

                <h4>Exercícios</h4>
                <hr>

                <div class="form-group well">
                    <input
                        type="text"
                        class="form-control input-lg"
                        placeholder="Adicionar grupo"
                        id="add-group">
                    <p class="help-block">
                        Digite o nome do grupo e pressione "Enter" para adicionar
                    </p>
                </div>
            </div>
        </div>
        <br>
        <div id="row-container-groups">
            <?php $i = 0; ?>
            <?php foreach ($card->exercises_groups as $keyGroup => $group): ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading" id="group-row" data-id="<?= $i ?>">
                                <div class="row">
                                    <div class="col-md-10">
                                        <span id="span-group">
                                            <?= $group->name ?>
                                        </span>
                                        <?= $this->Form->input('exercises_groups.'.$i.'.id', [
                                         'value' => $group->id]) ?>
                                        <?= $this->Form->input('exercises_groups.'.$i.'.name', [
                                            'id' => 'input-group',
                                            'value' => $group->name,
                                            'type' => 'hidden'
                                        ]) ?>  
                                    </div>
                                    <div class="col-md-2">
                                        <button
                                            class="btn btn-default btn-xs pull-right"
                                            data-id="<?= $group->id ?>"
                                            type="button" id="btn-remove-group">
                                            <span class="glyphicon glyphicon-remove"></span>
                                        </button>  
                                    </div>
                                </div>
                            </div>
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td colspan="2" style="vertical-align: middle">
                                            <div class="form-group">
                                                <input
                                                    id="add-exercise"
                                                    type="text"
                                                    placeholder="Adicionar exercício"
                                                    autocomplete="off"
                                                    class="form-control">
                                            </div>
                                        </td>
                                    </tr>
                                    <?php $j = 0; ?>
                                    <?php foreach ($group->exercises as $keyExercise => $exercise): ?>
                                        <tr id="row-exercise" data-exercise-id="<?= $j ?>">
                                            <td>
                                                <span id="span-exercise"><?= $exercise->name ?></span>
                                                <?= $this->Form->input('exercises_groups.'.$i.'.exercises.'.$j.'.id',
                                                    ['value' => $exercise->id]) ?>
                                                <?= $this->Form->input('exercises_groups.'.$i.'.exercises.'.$j.'.name',
                                                    [
                                                        'id' => 'input-exercise',
                                                        'value' => $exercise->name,
                                                        'type' => 'hidden',
                                                        'label' => false
                                                    ])
                                                ?>
                                            </td>
                                            <td style="width: 50px;vertical-align: middle; text-align: center;">
                                                <button
                                                    data-id="<?= $exercise->id ?>"
                                                    type="button"
                                                    class="btn btn-default btn-xs"
                                                    id="btn-remove">
                                                    <span class="glyphicon glyphicon-remove"></span>
                                                </button>
                                            </td>
                                        </tr>
                                        <?php $j++; ?>
                                    <?php endforeach ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <?php $i++; ?>
                </div>
            <?php endforeach ?>
        </div>
    </div>

</div>
<?php
    echo $this->Form->end();
?>  

<br>