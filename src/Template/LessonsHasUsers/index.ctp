<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('New Lessons Has User'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Lessons'), ['controller' => 'Lessons', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Lesson'), ['controller' => 'Lessons', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="lessonsHasUsers index large-10 medium-9 columns">
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('lessons_id') ?></th>
            <th><?= $this->Paginator->sort('users_id') ?></th>
            <th><?= $this->Paginator->sort('id') ?></th>
            <th><?= $this->Paginator->sort('created') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($lessonsHasUsers as $lessonsHasUser): ?>
        <tr>
            <td>
                <?= $lessonsHasUser->has('lesson') ? $this->Html->link($lessonsHasUser->lesson->id, ['controller' => 'Lessons', 'action' => 'view', $lessonsHasUser->lesson->id]) : '' ?>
            </td>
            <td>
                <?= $lessonsHasUser->has('user') ? $this->Html->link($lessonsHasUser->user->name, ['controller' => 'Users', 'action' => 'view', $lessonsHasUser->user->id]) : '' ?>
            </td>
            <td><?= $this->Number->format($lessonsHasUser->id) ?></td>
            <td><?= h($lessonsHasUser->created) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $lessonsHasUser->id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $lessonsHasUser->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $lessonsHasUser->id], ['confirm' => __('Are you sure you want to delete # {0}?', $lessonsHasUser->id)]) ?>
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
