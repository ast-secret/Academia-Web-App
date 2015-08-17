<?php
    $title = 'Exercícios';
    $this->assign('title', ' - ' . $title);

    echo $this->Html->script('../lib/jquery-ui/jquery-ui.min.js', ['inline' => false]);
?>
<?php 
    $this->Html->addCrumb('Clientes', ['controller' => 'Customers', 'action' => 'index']);
    $this->Html->addCrumb('Fichas de exercícios de <strong>' . $customer->name . '</strong>', [
        'controller' => 'Cards',
        'action' => 'index',
        'customer_id' => $customer->id
    ], [
        'escape' => false
    ]);
    $this->Html->addCrumb($title);
    echo $this->Html->getCrumbList();
?>
<br>

<style>
    .wrap-sortable{
        min-height: 300px;
        position: relative;
    }
    .btn-remove-exercise{
        position:absolute; right:0; top: 0; display: none; margin-right: 15px;
        float: right;
    }
    .custom-col{
        position: relative;
        height: 100%;
        border: 1px solid #DDDDDD;
        cursor: pointer;
    }
    .custom-col:hover{
        outline: 1px solid #3498db;
    }
    .custom-col div.group{
        background-color: #ecf0f1;
        padding: 8px;
        border-bottom: 1px solid #DDDDDD;
    }
    .custom-col div.exercise, .custom-col div.group{
        padding: 8px;
        background-color: #FFF;
    }
    .custom-col div.exercise{
        padding: 8px;
        border-bottom: 1px solid #DDDDDD;
    }
    .custom-col div.group{
        text-align: center;
        font-weight: bold;
    }
    .col-selected{
        outline: 1px solid #e74c3c;
    }
</style>

<script>
    $(function(){

        $('#add-exercise').autocomplete({
            source: '../../../autocomplete/exercicios.json'
        });

        var currentCol = 0;

        $('.submit-form').click(function(){
            $('#form-exercises').submit();
        });

        $('.custom-col').click(function(){
            var $this = $(this);
            $('.custom-col').removeClass('col-selected');
            $this.addClass('col-selected');
            currentCol = $this.data('index');
            var group = $this.data('label');
            $('.label-group-name').text(group);
            $('#add-exercise').focus();
        });
        $('.wrap-sortable').sortable({
            connectWith: '.wrap-sortable',
            receive: function(event, ui){
                var $target = $(event.target);
                var index = $(event.target).parent('div').data('index');
                
                console.log(ui.item.children('.exercise-column').val(index));
            }
        }).disableSelection();

        $(document).on({
            mouseenter: function () {
                //stuff to do on mouse enter
                console.log('oi');
                $(this).find('button.btn-remove-exercise').stop().fadeIn('fast');
            },
            mouseleave: function () {
                //stuff to do on mouse leave
                $(this).find('button.btn-remove-exercise').stop().fadeOut('fast');
            }
        }, 'div.exercise');

        $(document).on('click', '.btn-remove-exercise', function(){
            var $col = $(this).parents('div.exercise');
            $col.remove();
        });
        // $(document).on('click', '.text-exercise', function(){
        //     var id = $(this).data('id');
        //     $('#text-exercise-' + id).hide();
        //     $('.btn-remove-exercise').hide();
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
        //     $('.btn-remove-exercise').show();
        // });

        $('#form-add-exercise').submit(function(event) {
            var $this = $(this);
            var $inputAddExercise = $('#add-exercise');
            var value = $inputAddExercise.val();

            var totalExercises = $('.exercise').length;
            var newId = totalExercises + 1;
            console.log(newId);

            var $col = $("div[data-index='"+currentCol+"'] .wrap-sortable");

            var $div = $('<div/>')
                .addClass('exercise')
                .appendTo($col);

            var $row = $('<div/>').addClass('row').appendTo($div);
            var $col12 = $('<div/>').addClass('col-md-12').appendTo($row);

            var $input = $('<input/>')
                .attr('id', 'input-exercise-' + newId)
                .data('id', newId)
                .attr('name', 'exercises[' + newId + '][name]')
                .attr('type', 'hidden')
                .addClass('form-control input-exercise')
                .val(value)
                .appendTo($col12);
            var $inputExerciseColumn = $('<input/>')
                .attr('name', 'exercises[' + newId + '][exercise_column]')
                .attr('type', 'hidden')
                .addClass('form-control exercise-column')
                .val(currentCol)
                .appendTo($col12);

            var $text = $('<span/>')
                .attr('id', 'text-exercise-' + newId)
                .data('id', newId)
                .addClass('text-exercise')
                .text(value)
                .appendTo($col12);

            var $btnRemove = $('<button>')
                .attr('type', 'button')
                .addClass('btn btn-default btn-remove-exercise btn-xs')
                .html('<span class="glyphicon glyphicon-remove"></span>')
                .appendTo($col12);

            $inputAddExercise.val('');

            return false;
        });
    });
</script>


    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-danger clearfix">
                <strong><span class="glyphicon glyphicon-warning-sign"></span> Atenção!</strong>
                Qualquer alteração nos exercícios só seão efetivadas clicando no botão ao lado.
                <button class="btn btn-primary pull-right submit-form" type="button">
                    Salvar alterações
                </button>
            </div>
        </div>
    </div>
        
    <form id="form-add-exercise">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <label id="label-add-exercise" for="add-exercise">Exercício</label>
                    <div class="row">
                        <div class="col-md-6">
                          <input
                                required
                                type="text"
                                class="form-control"
                                id="add-exercise"
                                placeholder="Digite o nome do exercício"
                                autocomplete="off"
                                autofocus="true">  
                        </div>
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-default">
                                Adicionar em "<strong class="label-group-name">Grupo A</strong>"
                            </button>
                        </div>
                    </div>
                    <hr>
                </div>
            </div>
        </div>
    </form>
<?= $this->Form->create($card, ['id' => 'form-exercises']) ?>
    <div class="row">
        <?php
            $columns = ['A', 'B', 'C', 'D'];
        ?>
        <?php foreach ($columns as $columnIndex => $column): ?>
            <div class="col-md-3 col-sm-4">
                <div class="custom-col <?= ($columnIndex === 0) ? 'col-selected' : '' ?>" data-index="<?= $columnIndex ?>" data-label="Grupo <?= $column ?>">
                    <div class="group">
                        Grupo <?= $column ?>
                    </div>
                    <div class="wrap-sortable">
                        <?php foreach ($card->exercises as $key => $exercise): ?>
                            <?php if ($exercise->exercise_column == $columnIndex): ?>
                                <div class="exercise">
                                    <input
                                        id="input-exercise-1"
                                        name="exercises[<?= $key ?>][name]"
                                        type="hidden"
                                        class="form-control input-exercise"
                                        value="<?= $exercise->name ?>" >
                                    <input
                                        name="exercises[<?= $key ?>][exercise_column]"
                                        type="hidden"
                                        class="form-control exercise-column"
                                        value="<?= $columnIndex ?>">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <span id="text-exercise-1" class="text-exercise">
                                                <?= $exercise->name ?>
                                            </span>

                                            <button
                                                type="button"
                                                class="btn btn-default btn-remove-exercise btn-xs">
                                                <span class="glyphicon glyphicon-remove"></span>
                                            </button>
                                        </div>
                                    </div>
                                </div> <!-- EXERCISE -->
                            <?php endif ?>
                        <?php endforeach ?>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    </div>
<?= $this->Form->end() ?>