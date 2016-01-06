<?= $this->assign('title', ' - Exercícios') ?>

<?php 
    $this->Html->addCrumb('Exercícios');
    echo $this->Html->getCrumbList();
?>

<div class="row row-add-button">
    <div class="col-md-12">
        <?= $this->Html->link('Criar Exercício',
            [
                'action' => 'add'
            ],
            [
                'class' => 'btn btn-danger pull-right',
                'escape' => false
            ]
        ) ?>  
    </div>
</div>

<div class="table-responsive">
    <table class="table table-striped table-condensed table-bordered table-hover">
        <thead>
            <tr>
                <th>
                    Exercício
                </th>
                <th style="width: 100px" class="text-center"></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($exercisesSuggestions as $exercise): ?>
                <tr>        
                    <td><?= h($exercise->name) ?></td>
                    <td class="text-center">                
                        <?= $this->Html->link('<span class="glyphicon glyphicon-pencil"></span>',
                            ['action' => 'edit', $exercise->id],
                            [
                                'escape' => false,
                                'class' => 'btn btn-default btn-xs',
                                'title' => 'Editar'
                            ]
                        ) ?>
                        <?= $this->Form->postLink($this->Html->icon('remove'),
                            ['action' => 'delete', $exercise->id],
                            [
                                'escape' => false,
                                'title' => 'Deletar',
                                'class' => 'btn btn-default btn-xs',
                                'confirm' => 'Você realmente deseja deletar este exercício? Esta ação não poderá ser desfeita.'
                            ]
                        ) ?>
                    </td>
                </tr>
            <?php endforeach; ?>
            <?php if ($exercisesSuggestions->isEmpty()): ?>
                <tr>
                    <td colspan="5">
                        Nenhum exercício para exibir.
                    </td>
                </tr>
            <?php endif ?>
        </tbody>
    </table>
</div>

<?= $this->element('Common/paginator') ?>
