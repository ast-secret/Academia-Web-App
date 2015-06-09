<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('New Time'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Services'), ['controller' => 'Services', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Service'), ['controller' => 'Services', 'action' => 'add']) ?></li>
    </ul>
</div>
<div class="times index large-10 medium-9 columns">
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
            <th><?= $this->Paginator->sort('weekday') ?></th>
            <th><?= $this->Paginator->sort('service_id') ?></th>
            <th><?= $this->Paginator->sort('start_hour') ?></th>
            <th><?= $this->Paginator->sort('created') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($times as $time): ?>
        <tr>
            <td><?= $this->Number->format($time->id) ?></td>
            <td><?= $this->Number->format($time->weekday) ?></td>
            <td>
                <?= $time->has('service') ? $this->Html->link($time->service->name, ['controller' => 'Services', 'action' => 'view', $time->service->id]) : '' ?>
            </td>
            <td><?= h($time->start_hour) ?></td>
            <td><?= h($time->created) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $time->id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $time->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $time->id], ['confirm' => __('Are you sure you want to delete # {0}?', $time->id)]) ?>
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
