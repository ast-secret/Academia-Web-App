<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('New Lesson'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Services'), ['controller' => 'Services', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Service'), ['controller' => 'Services', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Rooms'), ['controller' => 'Rooms', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Room'), ['controller' => 'Rooms', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="lessons index large-10 medium-9 columns">
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
            <th><?= $this->Paginator->sort('start_time') ?></th>
            <th><?= $this->Paginator->sort('end_time') ?></th>
            <th><?= $this->Paginator->sort('date') ?></th>
            <th><?= $this->Paginator->sort('service_id') ?></th>
            <th><?= $this->Paginator->sort('room_id') ?></th>
            <th><?= $this->Paginator->sort('availables') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($lessons as $lesson): ?>
        <tr>
            <td><?= $this->Number->format($lesson->id) ?></td>
            <td><?= h($lesson->start_time) ?></td>
            <td><?= h($lesson->end_time) ?></td>
            <td><?= h($lesson->date) ?></td>
            <td>
                <?= $lesson->has('service') ? $this->Html->link($lesson->service->name, ['controller' => 'Services', 'action' => 'view', $lesson->service->id]) : '' ?>
            </td>
            <td>
                <?= $lesson->has('room') ? $this->Html->link($lesson->room->name, ['controller' => 'Rooms', 'action' => 'view', $lesson->room->id]) : '' ?>
            </td>
            <td><?= $this->Number->format($lesson->availables) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $lesson->id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $lesson->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $lesson->id], ['confirm' => __('Are you sure you want to delete # {0}?', $lesson->id)]) ?>
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
