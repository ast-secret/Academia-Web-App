<?= $this->assign('title', ' - Aulas') ?>

<script>
	$(function(){
		createTagsFromTimesString();
		$('#btn-add').click(function(){
			var $this = $(this);

            var $hour = $('select#hour');
            var $minute = $('select#minute');
            
            var hasError = false;
            if (!$hour.val()) {
                $hour.parent().addClass('has-error');
                hasError = true;
            } else {
                $hour.parent().removeClass('has-error');
            }
            if (!$minute.val()) {
                $minute.parent().addClass('has-error');
                hasError = true;
            } else {
                $minute.parent().removeClass('has-error');
            }

            var time = $hour.val() + ':' + $minute.val();
            
            var $timesString = $('input#times-string');
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
			return '<div style="margin-top: 8px;"><em>Nenhum horário para mostrar.</em></div>';
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
    $this->Html->addCrumb('Aulas', ['action' => 'index']);
    $this->Html->addCrumb("Horários de <strong>{$service->name}</strong>", [
    	'action' => 'times',
    	'service_id' => 1
    ], [
    	'escape' => false
    ]);
	$this->Html->addCrumb($this->weekdays->getById($this->request->weekday), null);
    echo $this->Html->getCrumbList();
?>

<hr>

<?php
	echo $this->Form->create($service, ['novalidate' => true, 'horizontal' => true]);
		echo $this->Form->input('times_string', ['type' => 'hidden']);
?>
	<div class="form-group">
		<div class="row">
			<div class="col-md-2 text-right">
				<!-- <label for="">Horários</label> -->
			</div>
			<div class="col-md-6">
				<div class="form-inline">
					<!-- SPAN necessário para colocar o .has-error individualmente -->
					<span>
		                <select id="hour" class="form-control">
		                    <option value="">
		                        Hor.
		                    </option>
		                    <?php for($i = 0; $i <= 23; $i++): ?>
		                    	<?php
		                    		// Lógica doida para que o select começo no 7 (hora mais comum de academis abrirem) para que ele não tenha que rolar muito longe para coocar hoars comuns
		                    		if ($i == 17) {
		                    			$h = 0;
		                    		} elseif ($i == 0) {
		                    			$h = $h + 7;
		                    		} else {
		                    			$h++;
		                    		}
		                    	?>
		                        <option value="<?= str_pad($h, 2, '0', STR_PAD_LEFT); ?>">
		                            <?= str_pad($h, 2, '0', STR_PAD_LEFT); ?>
		                        </option>
		                    <?php endfor ?>
		                </select>
	                </span>
	                :
	                <span>
		                <select id="minute" class="form-control">
		                    <option value="">
		                        Min.
		                    </option>
		                    <?php for($i = 0; $i <= 59; $i = $i + 5): ?>
		                        <option value="<?= str_pad($i, 2, '0', STR_PAD_LEFT); ?>">
		                            <?= str_pad($i, 2, '0', STR_PAD_LEFT); ?>
		                        </option>
		                    <?php endfor ?>
		                </select>
	                </span>
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
				<label class="control-label">Horários</label>
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