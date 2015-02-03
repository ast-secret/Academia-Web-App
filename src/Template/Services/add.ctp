<script>
    $(function(){
        var i = 0;
        $('#btn-add').click(function(){
            var $weekday = $('#add-weekday'); 
            var $time = $('#add-time');

            var weekday = $weekday.val();
            var time = $time.val();

            var timeValue = $( "#add-weekday option:selected" ).text();

            if (time === ''){
                $time.parent('.form-group').addClass('has-error');
                $time.focus();
                return false;
            } else {
                $time.parent('.form-group').removeClass('has-error');
            }

            $itemWeekdayTime = $('<li/>')
                .addClass('list-group-item')
                .text(timeValue + ' às ' + time)
                .appendTo('#list-times');

            $inputHour = $('<input/>')
                .attr({'name': "times["+i+"][start_hour]"})
                .val(time)
                .appendTo($itemWeekdayTime); 
            $inputWeekday = $('<input/>')
                .attr({'name': "times["+i+"][weekday_id]"})
                .val(weekday)
                .appendTo($itemWeekdayTime); 
            $inputDuration = $('<input/>')
                .attr({'name': "times["+i+"][duration]"})
                .val(10)
                .appendTo($itemWeekdayTime); 

            $time.val('').focus();

            i++;
        });
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
                        <label for="">Adicionar Horário</label>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <?= $this->Form->input('add-weekday', ['options' => $weekdays, 'label' => false]); ?>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group" >
                            <input type="text" class="form-control" id="add-time">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <button type="button" class="btn btn-primary btn-block" id="btn-add">Adicionar</button>
                    </div>
                </div>    
                <div class="row">
                    <div class="col-md-12">
                        <div class="well" id="container-times">
                            <ul id="list-times" class="list-group">
                                
                            </ul>
                        </div>
                    </div>
                </div>  
            </div>
        </div>
    </fieldset>
    <?= $this->Html->link('Cancelar', ['action' => 'index'], ['class' => 'btn btn-danger']) ?>    
    <?= $this->Form->button('Salvar', ['class' => 'btn btn-success btn-lg']) ?>
<?= $this->Form->end() ?>
</div>
