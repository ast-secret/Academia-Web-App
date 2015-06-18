<?= $this->assign('title', ' - Fichas de exercícios de '. $customer->name) ?>

<br>
<?php 
    $this->Html->addCrumb('Clientes', ['controller' => 'Customers', 'action' => 'index']);
    $this->Html->addCrumb('Fichas de exercícios de <strong>'. $customer->name.'</strong>', null);
    echo $this->Html->getCrumbList();
?>
<br>


<?= $this->Html->link('<span class="glyphicon glyphicon-plus"></span> Nova ficha',
    ['action' => 'add', 'customer_id' => $customer->id],
    ['class' => 'btn btn-danger pull-right', 'escape' => false]
)?>
<br style="clear: both;">

<ul class="nav nav-tabs">
    <li
        role="presentation"
        class="<?= $tab == '0' ? 'active' : '' ?>">
        <?= $this->Html->link('Ativas', ['action' => 'index', 'customer_id' => $customer_id,'?' => ['tab' => '0']]) ?>
    </li>
    <li
        role="presentation"
        class="<?= $tab == '1' ? 'active' : '' ?>">
        <?= $this->Html->link('Histórico', [
            'action' => 'index',
            'customer_id' => $customer_id,
            '?' => ['tab' => '1']
        ]) ?>
    </li>
</ul>
<br>

<table class="table table-hover table-condensed table-bordered">
    <tbody>
        <?php foreach ($cards as $card): ?>
            <tr>
                <td style="width: 420px;vertical-align: middle">
                    <dl class="dl-horizontal">
                        <dt>
                            Instrutor
                        </dt>
                        <dd>
                            <?= h($card->user->name) ?>
                        </dd>
                        <dt>
                            Objetivo
                        </dt>
                        <dd>
                            <?= h($card->goal) ?>
                        </dd>
                        <dt>
                            Observação
                        </dt>
                        <dd>
                            <em class="text-muted">
                                <?= ($card->obs) ? h($card->obs) : 'Nenhuma observação' ?>
                            </em>
                        </dd>
                        <dt>
                            Validade
                        </dt>
                        <dd>
                            <?php if ($card->overdue): ?>
                                <em class="text-muted text-danger">
                                    Vencida <?= $this->Time->timeAgoInWords($card->end_date) ?>
                                </em>
                            <?php else: ?>
                                <em class="text-muted text-success">
                                    <?= $this->Time->timeAgoInWords($card->end_date) ?>
                                </em>
                            <?php endif ?>
                        </dd>
                    </dl>
                </td>
                <td>
                    <?php foreach ($card->exercises_groups as $key => $group): ?>
                        <dl>
                            <dt>
                                <?= $group->name ?>
                            </dt>
                            <?php foreach ($group->exercises as $key => $exercise): ?>
                                <dd><?= $exercise->name ?></dd>
                            <?php endforeach ?>
                        </dl>
                    <?php endforeach ?>
                    <?php if (!$card->exercises_groups): ?>
                        <p class="text-muted text-center"><em>Nenhum exercício cadastrado.</em></p>
                    <?php endif ?>
                    <p class="text-center">
                        <?= $this->Html->link('<span class="glyphicon glyphicon-cog"></span> Configurar exercícios', [
                            'action' => 'addExercises',
                            'card_id' => $card->id
                        ], [
                            'escape' => false,
                            'class' => 'btn btn-default btn-xs'
                        ]) ?>
                    </p>
                </td>
                <td style="vertical-align: middle; width: 100px;" class="text-center">
                    <?= $this->Html->link(
                            '<span class="glyphicon glyphicon-print"></span>',
                            [
                                'controller' => 'Cards',
                                'action' => 'print',
                                $card->id
                            ],
                            [
                                'escape' => false,
                                'class' => 'btn btn-default btn-xs',
                                'title' => 'Imprimir'
                            ])
                    ?>
                    <?= $this->Html->link(
                        '<span class="glyphicon glyphicon-pencil"></span>',
                        [
                            'controller' => 'Cards',
                            'action' => 'edit',
                            'card_id' => $card->id
                        ],
                        [
                            'escape' => false,
                            'class' => 'btn btn-default btn-xs',
                            'title' => 'Editar'
                        ])
                    ?>
                    <?= $this->Form->postLink(
                        '<span class="glyphicon glyphicon-remove"></span>',
                        [
                            'controller' => 'Cards',
                            'action' => 'delete',
                            'card_id' => $card->id
                        ],
                        [
                            'confirm' =>
                                'Você realmente deseja deletar esta ficha? esta ação não pode ser desfeita.',
                            'escape' => false,
                            'class' => 'btn btn-default btn-xs',
                            'title' => 'Editar'
                        ])
                    ?>
                </td>
            </tr>
        <?php endforeach; ?>
        <?php if (count($cards) == 0): ?>
            <tr>
                <td colspan="6">Nenhuma ficha cadastrada ainda.</td>
            </tr>
        <?php endif ?>
    </tbody>
</table>
    
<?= $this->element('Common/paginator') ?>