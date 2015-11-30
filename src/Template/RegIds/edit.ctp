<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $regId->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $regId->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Reg Ids'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Gyms'), ['controller' => 'Gyms', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Gym'), ['controller' => 'Gyms', 'action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Customers'), ['controller' => 'Customers', 'action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('New Customer'), ['controller' => 'Customers', 'action' => 'add']) ?></li>
    </ul>
</nav>
<div class="regIds form large-9 medium-8 columns content">
    <?= $this->Form->create($regId) ?>
    <fieldset>
        <legend><?= __('Edit Reg Id') ?></legend>
        <?php
            echo $this->Form->input('device_uuid');
            echo $this->Form->input('device_regid');
            echo $this->Form->input('platform');
            echo $this->Form->input('gym_id', ['options' => $gyms]);
            echo $this->Form->input('customer_id', ['options' => $customers, 'empty' => true]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
