<script>
    $(function(){

        $('#add-time').inputmask({
            'mask': 'h:s',
            'clearIncomplete': true
        });
        $('#add-duration').inputmask({
            'mask': '9{+}',
            'clearIncomplete': true
        });

        $('#btn-add').click(function(){
            var $weekday = $('#add-weekday'); 
            var $time = $('#add-time');
            var $duration = $('#add-duration');

            var weekday = $weekday.val();
            var time = $time.val();
            var duration = $duration.val();

            var timeValue = $( "#add-weekday option:selected" ).text();

            if (time === ''){
                $time.parent('.form-group').addClass('has-error');
                $time.focus();
                return false;
            } else {
                $time.parent('.form-group').removeClass('has-error');
            }

           if (duration === ''){
                $duration.parent('.form-group').addClass('has-error');
                $duration.focus();
                return false;
            } else {
                $duration.parent('.form-group').removeClass('has-error');
            }

            $('#text-exercises-empty').hide();

            // Faz isso para as index nao misturarem com a carregada pelo PHP
            var fieldIndex = $('#list-times li').length;

            $itemWeekdayTime = $('<li/>')
                .addClass('list-group-item')
                .html('<strong>'+ timeValue + '</strong> às <strong>' + time + '</strong> com <strong>' + duration + '</strong> minutos de duração.')
                .appendTo('#list-times');

            $inputHour = $('<input/>')
                .attr({'name': "times["+fieldIndex+"][start_hour]", 'type' : 'hidden'})
                .val(time)
                .appendTo($itemWeekdayTime); 
            $inputWeekday = $('<input/>')
                .attr({'name': "times["+fieldIndex+"][weekday_id]", 'type' : 'hidden'})
                .val(weekday)
                .appendTo($itemWeekdayTime); 
            $inputDuration = $('<input/>')
                .attr({'name': "times["+fieldIndex+"][duration]", 'type' : 'hidden'})
                .val(duration)
                .appendTo($itemWeekdayTime); 

            $deleteButton = $('<button/>')
                .attr({type: 'button', id: 'btn-deletar',})
                .addClass('btn btn-default btn-xs pull-right')
                .css('display', 'none')
                .html('<span class="glyphicon glyphicon-remove"></span>')
                .appendTo($itemWeekdayTime);

            $time.val('').focus();
            $duration.val('');

            i++;
        });

        $(document).on('click', '#btn-deletar', function(){
            $(this).parent('li').fadeOut(function(){
                $(this).remove();
            });
        });

        $(document).on({
            mouseenter: function () {
                $(this).children('button').stop().fadeIn();
            },
            mouseleave: function () {
                $(this).children('button').stop().fadeOut();
            }
        }, 'ul#list-times li');

    });
</script>

<?= $this->element('Common/dashboard_breadcrumb', ['breadcrumb' => $breadcrumb]) ?>

<div class="">
    <?= $this->Form->create($service); ?>
    <fieldset>
        <div class="row">
            <div class="col-md-6">
                <?php
                    echo $this->Form->input('name', ['label' => 'Nome']);
                    echo $this->Form->input('description', ['label' => 'Descrição']);
                    echo $this->Form->label('Status');
                    echo $this->Form->checkbox('stats');
                ?>  
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-12">
                        <label for="add-weekday">Adicionar Horário</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <?= $this->Form->input('add-weekday', ['options' => $weekdays, 'label' => 'Dia']); ?>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group" >
                        <label for="add-time">Horário</label>
                            <input type="text" class="form-control" id="add-time">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group" >
                            <label for="add-duration">Duraçao</label>
                            <input type="text" class="form-control" id="add-duration" placeholder="Em minutos" maxlength="4">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <label for="">&nbsp;</label>
                        <div></div>
                        <button type="button" class="btn btn-primary btn-sm" id="btn-add">
                            <span class="glyphicon glyphicon-plus"></span>
                        </button>
                    </div>
                </div>    
                <div class="row">
                    <div class="col-md-12">
                        <hr>
                        <?php if (isset($service->errors()['times'])): ?>
                            <div class="alert alert-danger">
                                <span class="glyphicon glyphicon-remove-sign"></span>
                                Ocorreram erros em um ou mais horários que você inseriu.
                            </div>
                        <?php endif ?>
                        
                        <ul id="list-times" class="list-group">
                            <?php if ($service->times): ?>
                                <?php foreach ($service->times as $key => $time): ?>
                                    <?php if (!$time->errors()): ?>
                                        <li class="list-group-item">
                                            <strong><?= $this->Weekdays->getById($time->weekday_id, $weekdays) ?></strong> às <strong><?= $time->start_hour ?></strong> com <strong><?= $time->duration ?></strong> minutos de duração.

                                            <?php
                                                // Hidden Fields
                                                echo $this->Form->hidden("times.{$key}.weekday_id",
                                                    ['value' => $time->weekday_id]);
                                                echo $this->Form->hidden("times.{$key}.start_hour",
                                                    ['type' => 'text']);
                                                echo $this->Form->hidden("times.{$key}.duration",
                                                    ['value' => $time->duration]);
                                            ?>

                                            <button
                                                type="button"
                                                id="btn-deletar"
                                                class="btn btn-default btn-xs pull-right"
                                                style="display: none;">

                                                <span class="glyphicon glyphicon-remove"></span>
                                            </button>

                                        </li>
                                    <?php endif ?>
                                <?php endforeach ?>
                            <?php else: ?>
                                <em id="text-exercises-empty">Nenhum exercício adicionado</em>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>  
            </div>
        </div>
    </fieldset>
    <?= $this->Html->link('Cancelar', ['action' => 'index'], ['class' => 'btn btn-danger']) ?>    
    <?= $this->Form->button('Salvar', ['class' => 'btn btn-success btn-lg']) ?>
<?= $this->Form->end() ?>
</div>
