<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Reg Id'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Gyms'), ['controller' => 'Gyms', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Gym'), ['controller' => 'Gyms', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Customers'), ['controller' => 'Customers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Customer'), ['controller' => 'Customers', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="regIds index large-9 medium-8 columns content">
    <h3><?= __('Reg Ids') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
            <tr>
                <th><?= $this->Paginator->sort('id') ?></th>
                <th><?= $this->Paginator->sort('device_uuid') ?></th>
                <th><?= $this->Paginator->sort('device_regid') ?></th>
                <th><?= $this->Paginator->sort('platform') ?></th>
                <th><?= $this->Paginator->sort('created') ?></th>
                <th><?= $this->Paginator->sort('gym_id') ?></th>
                <th><?= $this->Paginator->sort('customer_id') ?></th>
                <th class="actions"><?= __('Actions') ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($regIds as $regId): ?>
            <tr>
                <td><?= $this->Number->format($regId->id) ?></td>
                <td><?= h($regId->device_uuid) ?></td>
                <td><?= h($regId->device_regid) ?></td>
                <td><?= h($regId->platform) ?></td>
                <td><?= h($regId->created) ?></td>
                <td><?= $regId->has('gym') ? $this->Html->link($regId->gym->name, ['controller' => 'Gyms', 'action' => 'view', $regId->gym->id]) : '' ?></td>
                <td><?= $regId->has('customer') ? $this->Html->link($regId->customer->name, ['controller' => 'Customers', 'action' => 'view', $regId->customer->id]) : '' ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $regId->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $regId->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $regId->id], ['confirm' => __('Are you sure you want to delete # {0}?', $regId->id)]) ?>
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
