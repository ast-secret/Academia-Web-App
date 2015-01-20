<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('List Phones'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Gyms'), ['controller' => 'Gyms', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Gym'), ['controller' => 'Gyms', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="phones form large-10 medium-9 columns">
    <?= $this->Form->create($phone); ?>
    <fieldset>
        <legend><?= __('Add Phone') ?></legend>
        <?php
            echo $this->Form->input('gym_id', ['options' => $gyms]);
            echo $this->Form->input('name');
            echo $this->Form->input('phone');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
