<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('New Exercises Group'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Cards Exercises'), ['controller' => 'CardsExercises', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Cards Exercise'), ['controller' => 'CardsExercises', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="exercisesGroups index large-10 medium-9 columns">
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
            <th><?= $this->Paginator->sort('name') ?></th>
            <th><?= $this->Paginator->sort('created') ?></th>
            <th><?= $this->Paginator->sort('modified') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($exercisesGroups as $exercisesGroup): ?>
        <tr>
            <td><?= $this->Number->format($exercisesGroup->id) ?></td>
            <td><?= h($exercisesGroup->name) ?></td>
            <td><?= h($exercisesGroup->created) ?></td>
            <td><?= h($exercisesGroup->modified) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $exercisesGroup->id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $exercisesGroup->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $exercisesGroup->id], ['confirm' => __('Are you sure you want to delete # {0}?', $exercisesGroup->id)]) ?>
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
