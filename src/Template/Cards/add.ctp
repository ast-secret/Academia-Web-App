
<script>
    $(function(){

        var groupAutoId = 0;

        $(document).on('keydown', 'input#add-exercise', function(e){
            var keyCode = e.which;
            if (keyCode == 13) {
                e.preventDefault();
            }
        });
        $(document).on('keyup', 'input#add-exercise', function(e){
            var keyCode = e.which;
            var $this = $(this);
            if (keyCode == 13) {
                if ($this.val() !== '') {
                    addExercise($this);
                    $this.val('');
                }
                
                return false;
            }
        });

        $(document).on('keydown', 'input#add-group', function(e){
            var keyCode = e.which;
            if (keyCode == 13) {
                e.preventDefault();
            }
        });
        $(document).on('keyup', 'input#add-group', function(e){
            var keyCode = e.which;
            var $this = $(this);
            if (keyCode == 13) {
                if ($this.val() !== '') {
                    addGroup($this);
                    $this.val('');
                }
                
                return false;
            }
        });

        $(document).on({
            mouseenter: function () {
                $(this).children('button#btn-remove-exercise').stop().fadeIn('fast');
            },
            mouseleave: function () {
                $(this).children('button#btn-remove-exercise').stop().fadeOut('fast');
            }
        }, 'li#exercise');

        $(document).on('click', 'button#btn-remove-exercise', function(){
            $(this).parent('li').remove();
        });

        function addGroup($this)
        {
            var colSize = 12;
            var placeholder = 'Adicionar exercício...';

            var $col = $('<div/>').addClass('col-md-' + colSize);

            var $panel = $('<div/>')
                .addClass('panel panel-default')
                .attr({id: 'exercises-group'})
                .appendTo($col);

            var $panelHeading = $('<div/>')
                .addClass('panel-heading')
                .append($this.val())
                .appendTo($panel);

            var $body = $('<div/>')
                .addClass('panel-body')
                .appendTo($panel);

            var $listGroup = $('<ul/>')
                .addClass('list-group')
                .attr({id: 'list-group-exercises'})
                .appendTo($panel);

            var $inputGroupHidden = $('<input/>')
                .attr(
                    {
                        name: "exercises_groups[" + groupAutoId + "][name]",
                        type: 'hidden',
                        'data-group-id': groupAutoId,
                    })
                .val($this.val())
                .appendTo($panelHeading);

            // var $listGroupItemInput = $('<li/>')
            //     .addClass('list-group-item')
            //     .attr({id: 'item-add-exercise'})
            //     .appendTo($listGroup);

            var $input = $('<input>')
                .addClass('form-control')
                .attr(
                    {
                        type: 'text',
                        id: 'add-exercise',
                        placeholder: placeholder
                    }
                )
                .appendTo($body);

            $col.appendTo('#wrap-groups');

            groupAutoId++;
        }
        function addExercise($this)
        {
            var $group = $this
                .parents('div#exercises-group')
                .children('ul#list-group-exercises');

            var groupId = $this.parent('div.panel-body').prev('div.panel-heading').children('input').attr('data-group-id');

            var $exercise = $('<li/>')
                .attr('id', 'exercise')
                .addClass('list-group-item')
                .text($this.val())
                .appendTo($group);

            var $exerciseInputHidden = $('<input/>')
                .val($this.val())
                .attr({name: "exercises_groups["+groupId+"][exercises][][name]", type: 'hidden'})
                .appendTo($exercise);

            var $btnRemove = $('<button/>')
                .attr({id: 'btn-remove-exercise', type: 'button'})
                .css('display', 'none')
                .addClass('btn btn-default btn-xs pull-right')
                .append('<span class="glyphicon glyphicon-remove"></span>').appendTo($exercise);

            $('ul#list-group-exercises').sortable({
                axis: 'y',
            });
        }
    });
</script>

<?= $this->Form->create($card, ['templates' => $bootstrapFormTemplate]); ?>
<fieldset>
    <legend><?= __("Criar ficha para Daniel")  ?></legend>
    <div class="row">
        <div class="col-md-6">
            <?php
                echo $this->Form->input('end_date', ['label' => 'Data de vencimento']);
                echo $this->Form->input('goal', ['label' => 'Objetivo']);
                echo $this->Form->input('obs', ['label' => 'Observação']);
            ?>            
        </div>
        <div class="col-md-5 col-md-offset-1">
            <div class="row">
                <div class="col-md-12">
                    <label for="">Adicionar um grupo de exercícios</label>
                    <input type="text" class="form-control" placeholder="Adicionar grupo" id="add-group">
                </div>
            </div>

            <br>

            <div class="row" id="wrap-groups">
            </div>            
        </div>
    </div>

</fieldset>
<button type="submit" class="btn btn-danger btn-xs">Cancelar</button>
<button type="submit" class="btn btn-success">Salvar</button>
<?= $this->Form->end() ?>