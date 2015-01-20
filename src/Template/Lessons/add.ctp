<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('List Lessons'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Services'), ['controller' => 'Services', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Service'), ['controller' => 'Services', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Rooms'), ['controller' => 'Rooms', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Room'), ['controller' => 'Rooms', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="lessons form large-10 medium-9 columns">
    <?= $this->Form->create($lesson); ?>
    <fieldset>
        <legend><?= __('Add Lesson') ?></legend>
        <?php
            echo $this->Form->input('start_time');
            echo $this->Form->input('end_time');
            echo $this->Form->input('date');
            echo $this->Form->input('service_id', ['options' => $services]);
            echo $this->Form->input('room_id', ['options' => $rooms]);
            echo $this->Form->input('availables');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
