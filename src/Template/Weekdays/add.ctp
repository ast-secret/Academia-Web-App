<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('List Weekdays'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Services'), ['controller' => 'Services', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Service'), ['controller' => 'Services', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="weekdays form large-10 medium-9 columns">
    <?= $this->Form->create($weekday); ?>
    <fieldset>
        <legend><?= __('Add Weekday') ?></legend>
        <?php
            echo $this->Form->input('weekday');
            echo $this->Form->input('services._ids', ['options' => $services]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
