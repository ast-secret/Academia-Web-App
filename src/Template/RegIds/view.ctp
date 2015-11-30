<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Reg Id'), ['action' => 'edit', $regId->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Reg Id'), ['action' => 'delete', $regId->id], ['confirm' => __('Are you sure you want to delete # {0}?', $regId->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Reg Ids'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Reg Id'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Gyms'), ['controller' => 'Gyms', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Gym'), ['controller' => 'Gyms', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Customers'), ['controller' => 'Customers', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Customer'), ['controller' => 'Customers', 'action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="regIds view large-9 medium-8 columns content">
    <h3><?= h($regId->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Device Uuid') ?></th>
            <td><?= h($regId->device_uuid) ?></td>
        </tr>
        <tr>
            <th><?= __('Device Regid') ?></th>
            <td><?= h($regId->device_regid) ?></td>
        </tr>
        <tr>
            <th><?= __('Platform') ?></th>
            <td><?= h($regId->platform) ?></td>
        </tr>
        <tr>
            <th><?= __('Gym') ?></th>
            <td><?= $regId->has('gym') ? $this->Html->link($regId->gym->name, ['controller' => 'Gyms', 'action' => 'view', $regId->gym->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Customer') ?></th>
            <td><?= $regId->has('customer') ? $this->Html->link($regId->customer->name, ['controller' => 'Customers', 'action' => 'view', $regId->customer->id]) : '' ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($regId->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($regId->created) ?></td>
        </tr>
    </table>
</div>
