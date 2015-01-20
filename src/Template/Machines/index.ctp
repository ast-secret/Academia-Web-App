<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('New Machine'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Gyms'), ['controller' => 'Gyms', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Gym'), ['controller' => 'Gyms', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Cards Exercises'), ['controller' => 'CardsExercises', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Cards Exercise'), ['controller' => 'CardsExercises', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="machines index large-10 medium-9 columns">
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
            <th><?= $this->Paginator->sort('gym_id') ?></th>
            <th><?= $this->Paginator->sort('name') ?></th>
            <th><?= $this->Paginator->sort('created') ?></th>
            <th><?= $this->Paginator->sort('modified') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($machines as $machine): ?>
        <tr>
            <td><?= $this->Number->format($machine->id) ?></td>
            <td>
                <?= $machine->has('gym') ? $this->Html->link($machine->gym->name, ['controller' => 'Gyms', 'action' => 'view', $machine->gym->id]) : '' ?>
            </td>
            <td><?= h($machine->name) ?></td>
            <td><?= h($machine->created) ?></td>
            <td><?= h($machine->modified) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $machine->id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $machine->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $machine->id], ['confirm' => __('Are you sure you want to delete # {0}?', $machine->id)]) ?>
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
</div>
