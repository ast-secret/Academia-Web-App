<script>
    $(function(){
        var i = 0;
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

            $itemWeekdayTime = $('<li/>')
                .addClass('list-group-item')
                .html('<strong>'+ timeValue + '</strong> às <strong>' + time + '</strong> com <strong>' + duration + '</strong> minutos de duração.')
                .appendTo('#list-times');

            $inputHour = $('<input/>')
                .attr({'name': "times["+i+"][start_hour]", 'type' : 'hidden'})
                .val(time)
                .appendTo($itemWeekdayTime); 
            $inputWeekday = $('<input/>')
                .attr({'name': "times["+i+"][weekday_id]", 'type' : 'hidden'})
                .val(weekday)
                .appendTo($itemWeekdayTime); 
            $inputDuration = $('<input/>')
                .attr({'name': "times["+i+"][duration]", 'type' : 'hidden'})
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
            $(this).parent('li').fadeOut();
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
<div class="">
    <?= $this->Form->create($service); ?>
    <fieldset>
        <div class="row">
            <div class="col-md-6">
                <?php
                    echo $this->Form->input('name', ['label' => 'Nome']);
                    echo $this->Form->input('description', ['label' => 'Descrição']);
                ?>  
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-12">
                        <label for="add-weekday">Adicionar Horário</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
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
                            <input type="text" class="form-control" id="add-duration" placeholder="Em minutos">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <label for="">&nbsp;</label>
                        <button type="button" class="btn btn-primary btn-block" id="btn-add">Adicionar</button>
                    </div>
                </div>    
                <div class="row">
                    <div class="col-md-12">
                        <hr>
                        <em id="text-exercises-empty">Nenhum exercício adicionado</em>
                        <ul id="list-times" class="list-group">
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
