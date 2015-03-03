<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('List Times'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Services'), ['controller' => 'Services', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Service'), ['controller' => 'Services', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Weekdays'), ['controller' => 'Weekdays', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Weekday'), ['controller' => 'Weekdays', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="times form large-10 medium-9 columns">
    <?= $this->Form->create($time); ?>
    <fieldset>
        <legend><?= __('Add Time') ?></legend>
        <?php
            echo $this->Form->input('service_id', ['options' => $services]);
            echo $this->Form->input('weekday_id', ['options' => $weekdays]);
            echo $this->Form->input('start_hour');
            echo $this->Form->input('duration');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>

<div>
    <?= $this->element('Releases/form') ?>
</div>
