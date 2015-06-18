<?php
    $title = 'Configurar exercícios';
    $this->assign('title', ' - ' . $title)
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

        $('input#add-group').keypress(function(event){
            var $this = $(this);
            if (event.keyCode == 13) {
                var value = $(this).val();

                var $table = $this.parents('table');
                var $groups = $('#group-row');
                var $lastGroup = $($groups[$groups.length - 1]);
                var lastGroupId = $lastGroup.data('id');

                var $col = $('<div/>').addClass('col-md-4');
                var $panel = $('<div/>').addClass('panel panel-default').appendTo($col);
                var $panelHeading = $('<div/>')
                    .addClass('panel panel-heading')
                    .text(value)
                    .appendTo($panel);
                $('#row-container-groups').append($col);
                // var groupId = $table.prev('#group-row').data('id');
                // var $trs = $table.find('tr');
                // var totalTRs = $trs.length;
                // var $lastTR = $($trs[totalTRs-1]);
                // var lastTRId = $lastTR.data('exercise-id');
                
                // var $tr = $('<tr/>');
                // var $td = $('<td/>').text(value).appendTo($tr);
                // var $inputExerciseName = $('<input/>')
                //     .attr('name', 'exercises_groups['+groupId+'][exercises]['+(lastTRId + 1)+'][name]').val(value)
                //     .appendTo($td);
                // var $inputExerciseRepetition = $('<input/>')
                //     .attr('name', 'exercises_groups['+groupId+'][exercises]['+(lastTRId + 1)+'][repetition]').val(value)
                //     .appendTo($td);

                // var $tdRemove = $('<td/>').text('remove').appendTo($tr);
                // $table.append($tr);
                return false;
            }
        });

        $('input#add-exercise').keypress(function(event){
            var $this = $(this);
            if (event.keyCode == 13) {
                var value = $(this).val();

                var $table = $this.parents('table');
                var groupId = $table.prev('#group-row').data('id');
                var $trs = $table.find('tr');
                var totalTRs = $trs.length;
                var $lastTR = $($trs[totalTRs-1]);
                var lastTRId = $lastTR.data('exercise-id');
                
                var $tr = $('<tr/>');
                var $td = $('<td/>').text(value).appendTo($tr);
                var $inputExerciseName = $('<input/>')
                    .attr('name', 'exercises_groups['+groupId+'][exercises]['+(lastTRId + 1)+'][name]').val(value)
                    .appendTo($td);
                var $inputExerciseRepetition = $('<input/>')
                    .attr('name', 'exercises_groups['+groupId+'][exercises]['+(lastTRId + 1)+'][repetition]').val(value)
                    .appendTo($td);

                var $tdRemove = $('<td/>').text('remove').appendTo($tr);
                $table.append($tr);
                return false;
            }
        });
    });
</script>

<div class="row">
    <div class="col-md-6">
        <input type="text" class="form-control" placeholder="Adicionar Grupo" id="add-group">
    </div>
</div>

<?php
    echo $this->Form->create($card, [
        'novalidate' => true,
        'horizontal' => true]);
?>
<div class="row" id="row-container-groups">
    <?php $i = 0; ?>
    <?php foreach ($card->exercises_groups as $keyGroup => $group): ?>
        <div class="col-md-4">
            <div class="panel panel-default">
                <div class="panel-heading" id="group-row" data-id="<?= $i ?>">
                    <?= $group->name ?>
                    <?= $this->Form->input('exercises_groups.'.$i.'.id', [
                     'value' => $group->id]) ?>
                    <?= $this->Form->input('exercises_groups.'.$i.'.name', [
                     'value' => $group->name]) ?>
                </div>
                <table class="table">
                    <tbody>
                        <tr>
                            <td>
                                <input
                                    id="add-exercise"
                                    type="text"
                                    placeholder="Adicionar Exercício"
                                    class="form-control">
                            </td>
                        </tr>
                        <?php $j = 0; ?>
                        <?php foreach ($group->exercises as $keyExercise => $exercise): ?>
                            <tr data-exercise-id="<?= $j ?>">
                                <td>
                                    <?= $exercise->name ?>
                                    <?= $this->Form->input('exercises_groups.'.$i.'.exercises.'.$j.'.id',
                                        ['value' => $exercise->id]) ?>
                                    <?= $this->Form->input('exercises_groups.'.$i.'.exercises.'.$j.'.name',
                                        ['value' => $exercise->name]) ?>
                                    <?= $this->Form->input('exercises_groups.'.$i.'.exercises.'.$j.'.repetition',
                                        ['value' => $exercise->repetition]) ?>
                                </td>
                                <td>
                                    <button class="btn btn-default btn-xs">
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
    <?php endforeach ?>
</div>
<?php
        echo $this->Form->submit('Salvar exercícios');
    echo $this->Form->end();
?>  