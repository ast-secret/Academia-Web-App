<?= $this->assign('title', ' - Exercícios') ?>

<?php 
    $this->Html->addCrumb("Clientes", ['controller' => 'Customers', 'action' => 'index']);
    $this->Html->addCrumb($card->customer->name, null);
    $this->Html->addCrumb("Fichas", [
        'action' => 'index',
        'customer_id' => $this->request['customer_id']
    ], [
        'escape' => false
    ]);
    $this->Html->addCrumb("Exercícios", null);
    echo $this->Html->getCrumbList();
?>

<br>
<br>

<div class="table-responsive">
    <table class="table table-striped table-bordered table-hover">
<!--         <thead>
            <tr>
                <th style="width: 80px;" class="text-center">
                    Colunas
                </th>            
                <th>
                    Exercícios
                </th>
                <th style="width: 50px"></th>
            </tr>
        </thead> -->
        <tbody>
            <?php foreach ($columns as $index => $column): ?>
                <tr>
                    <td style="width: 50px; text-align: center;">
                        <strong><?= $column ?></strong>
                    </td>
                    <td>
                        <?php if (isset($exercisesByColumn[$index])): ?>
                            <?php foreach ($exercisesByColumn[$index] as $exercise): ?>
                                <span class="label label-primary">
                                    <?= $exercise->name ?>
                                </span>&nbsp;
                            <?php endforeach ?>
                        <?php else: ?>
                            <small class="text-muted">
                                <em>Nenhum exercício para exibir.</em>
                            </small>
                        <?php endif ?>
                    </td>
                    <td class="text-center" style="width: 50px">
                        <?= $this->Html->link($this->Html->icon('pencil'), [
                                'action' => 'exercisesEdit',
                                'customer_id' => $card->customer_id,
                                'card_id' => $card->id,
                                'column' => $index
                            ], [
                            'escape' => false,
                            'class' => 'btn btn-default btn-xs'
                        ]) ?>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>