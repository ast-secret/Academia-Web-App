<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('New Services Weekday'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Services'), ['controller' => 'Services', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Service'), ['controller' => 'Services', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Weekdays'), ['controller' => 'Weekdays', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Weekday'), ['controller' => 'Weekdays', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="servicesWeekdays index large-10 medium-9 columns">
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
            <th><?= $this->Paginator->sort('service_id') ?></th>
            <th><?= $this->Paginator->sort('weekday_id') ?></th>
            <th><?= $this->Paginator->sort('created') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($servicesWeekdays as $servicesWeekday): ?>
        <tr>
            <td><?= $this->Number->format($servicesWeekday->id) ?></td>
            <td>
                <?= $servicesWeekday->has('service') ? $this->Html->link($servicesWeekday->service->name, ['controller' => 'Services', 'action' => 'view', $servicesWeekday->service->id]) : '' ?>
            </td>
            <td>
                <?= $servicesWeekday->has('weekday') ? $this->Html->link($servicesWeekday->weekday->id, ['controller' => 'Weekdays', 'action' => 'view', $servicesWeekday->weekday->id]) : '' ?>
            </td>
            <td><?= h($servicesWeekday->created) ?></td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $servicesWeekday->id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $servicesWeekday->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $servicesWeekday->id], ['confirm' => __('Are you sure you want to delete # {0}?', $servicesWeekday->id)]) ?>
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
