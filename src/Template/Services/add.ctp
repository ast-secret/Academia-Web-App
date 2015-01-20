<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('List Services'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Gyms'), ['controller' => 'Gyms', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Gym'), ['controller' => 'Gyms', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Lessons'), ['controller' => 'Lessons', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Lesson'), ['controller' => 'Lessons', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Weekdays'), ['controller' => 'Weekdays', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Weekday'), ['controller' => 'Weekdays', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="services form large-10 medium-9 columns">
    <?= $this->Form->create($service); ?>
    <fieldset>
        <legend><?= __('Add Service') ?></legend>
        <?php
            echo $this->Form->input('gym_id', ['options' => $gyms]);
            echo $this->Form->input('name');
            echo $this->Form->input('description');
            echo $this->Form->input('begin_service');
            echo $this->Form->input('end_service');
            echo $this->Form->input('weekdays._ids', ['options' => $weekdays]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
