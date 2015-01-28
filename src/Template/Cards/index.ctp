<?= $this->Html->link('Adicionar Ficha', ['action' => 'add'], ['class' => 'btn btn-primary'])?>
<hr>
<table class="table table-striped">
<thead>
    <tr>
        <th><?= $this->Paginator->sort('customer.name', 'Aluno') ?></th>
        <th><?= $this->Paginator->sort('user.name', 'Instrutor') ?></th>
        <th>Validade</th>
        <th class="actions"></th>
    </tr>
</thead>
<tbody>
<?php foreach ($cards as $card): ?>
    <tr>
        <td>
            <?= h($card->customer->name) ?>
        </td>
        <td>
            <?= $card->has('user') ? $this->Html->link($card->user->name, ['controller' => 'Users', 'action' => 'view', $card->user->id]) : '' ?>
        </td>
        <td>Vence em 30 Dias</td>
        <td>
            <?= $this->Html->link(
                '<span class="glyphicon glyphicon-eye-open"></span>',
                ['action' => 'view', $card->id],
                [
                    'escape' => false,
                    'class' => 'btn btn-default btn-xs',
                    'title' => 'Ver Ficha'

                ])
            ?>
            <?= $this->Html->link(
                '<span class="glyphicon glyphicon-align-justify"></span>',
                ['action' => 'view'],
                [
                    'escape' => false,
                    'class' => 'btn btn-default btn-xs',
                    'title' => 'Ver histórico de fichas'

                ])
            ?>
        </td>
    </tr>

<?php endforeach; ?>
</tbody>
</table>
<div class="paginator">
    <ul class="pagination">
        <?= $this->Paginator->prev('< ' . __('previous')) ?>
        <?= $this->Paginator->numbers() ?>
        <?= $this->Paginator->next(__('next') . ' >') ?>
    </ul>
    <p><?= $this->Paginator->counter() ?></p>
</div>
