<?php
    $title = 'Exercícios';
    $this->assign('title', ' - ' . $title);

    // Adiciona os JS's da página
    echo $this->Html->script('../lib/jquery-ui/jquery-ui.min.js', ['inline' => false]);
    echo $this->Html->script('Exercises/add_exercises', ['inline' => false]);

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
    <div class="row">
        <div class="col-md-12">
            <div class="alert alert-warning clearfix">
                <strong><span class="glyphicon glyphicon-warning-sign"></span> Atenção!</strong>
                Qualquer alteração nos exercícios só será efetivada clicando no botão ao lado.
                <button class="btn btn-default pull-right submit-form" type="button">
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