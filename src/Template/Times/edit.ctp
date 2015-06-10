<script>
    $(function(){
        createTagsFromTimesString();
        $('button#add-time').click(function(){
            var $this = $(this);
            var weekday = $this.data('weekday');

            var $wrapper = $this.parents('#times-wrap');

            var $hour = $('select#hour[data-weekday="'+weekday+'"]');
            var $minute = $('select#minute[data-weekday="'+weekday+'"]');
            
            var hasError = false;
            if (!$hour.val()) {
                $hour.parent('.form-group').addClass('has-error');
                hasError = true;
            } else {
                $hour.parent('.form-group').removeClass('has-error');
            }
            if (!$minute.val()) {
                $minute.parent('.form-group').addClass('has-error');
                hasError = true;
            } else {
                $minute.parent('.form-group').removeClass('has-error');
            }


            var time = $hour.val() + ':' + $minute.val();
            
            var $timesString = $('input#times-string[data-weekday="'+weekday+'"]');
            var timesArray = $timesString.val().split(';');

            if ($.inArray(time, timesArray) >= 0) {
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
            $minute.val('');
            return false;
        });
        
        function addTag(value, weekday)
        {
            var $timesContainer = $('div#times-container[data-weekday="'+weekday+'"]');
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

        function createTagsFromTimesString()
        {
            $('input#times-string').each(function(){
                var $this = $(this);
                var weekday = $this.data('weekday');
                var value = $this.val();
                var timesArray = value.split(';');

                var $timesContainer = $('div#times-container[data-weekday="'+weekday+'"]');

                $timesContainer.html('');

                $.each(timesArray, function(index, val) {
                    if (val) {
                        addTag(val, weekday);   
                    }
                     
                });
            });
        }
        $(document).on('click', '.tag-remove', function(){
            var $this = $(this);
        
            var weekday = $this.parents('#times-container').data('weekday');
            
            var value = $this.parent().data('value');

            var $timesString = $('input#times-string[data-weekday="'+weekday+'"]');

            var timesArray = $timesString.val().split(';');
            console.log(timesArray);
            var index = timesArray.indexOf(value);
            timesArray.splice(index, 1);
            console.log(timesArray);

            $timesString.val(timesArray.join(';'));

            $(this).parent().remove();
        });
    });
</script>
<?php
$this->assign('title', ' - Configuração de horários');

echo '<br>';
$this->Html->addCrumb('Aulas', ['controller' => 'services', 'action' => 'index']);
$this->Html->addCrumb('Configurações de horários para <strong>' . h($service->name) . '</strong>');
echo $this->Html->getCrumbList();


$weekdays = $this->Weekdays->getAll();
?>

<?= $this->Form->create($service) ?>

<div class="row">
    <div class="col-md-12">
        <div class="alert alert-danger clearfix">
            <button class="btn btn-success pull-right" type="submit">
                Salvar alterações
            </button>
            <strong><span class="glyphicon glyphicon-warning-sign"></span> Atenção!</strong>
            <p>Qualquer alteração de horário só será efetivada clicando no botão ao lado.</p>
        </div>
    </div>
</div>

    <?php foreach ($weekdays as $weekday): ?>
        <div class="row">
        <div class="col-md-12">
            <div class="well well-sm">
            <h5>
                <?= $weekday['name'] ?>
            </h5>
            <div class="row">
                <div class="col-md-3">
                    <div id="times-wrap" data-weekday="<?= $weekday['id']?>" class="form-inline">
                        <input
                            type="hidden"
                            id="times-string"
                            value="<?= (isset($service->times_string[$weekday['id']])) ? $service->times_string[$weekday['id']] : '' ?>"
                            name="times_string[<?= $weekday['id'] ?>]"
                            data-weekday="<?= $weekday['id'] ?>">
                        <div class="form-group">
                            <?= $this->Form->input('hour', [
                                'empty' => 'hor',
                                'label' => false,
                                'type' => 'hour',
                                'data-weekday' => $weekday['id'],
                                'class' => 'form-control input-sm',
                                'templates' =>
                                ['inputContainer' => '{{content}}']])
                            ?>
                        </div>
                        <div class="form-group">
                            <label>:</label>
                            <?= $this->Form->input('minute', [
                                'empty' => 'min',
                                'label' => false,
                                'type' => 'minute',
                                'data-weekday' => $weekday['id'],
                                'class' => 'form-control input-sm',
                                'templates' =>
                                ['inputContainer' => '{{content}}']])
                            ?>
                            <button
                                type="button"
                                class="btn btn-success btn-sm"
                                id="add-time" data-weekday="<?= $weekday['id'] ?>">
                                <span class="glyphicon glyphicon-plus"></span>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-md-9" id="times-container" data-weekday="<?= $weekday['id'] ?>">
                </div>
            </div>
            </div>
        </div>
        </div>
    <?php endforeach ?>

<?= $this->Form->end() ?>