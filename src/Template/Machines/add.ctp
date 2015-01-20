<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('List Machines'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Gyms'), ['controller' => 'Gyms', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Gym'), ['controller' => 'Gyms', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Cards Exercises'), ['controller' => 'CardsExercises', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Cards Exercise'), ['controller' => 'CardsExercises', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="machines form large-10 medium-9 columns">
    <?= $this->Form->create($machine); ?>
    <fieldset>
        <legend><?= __('Add Machine') ?></legend>
        <?php
            echo $this->Form->input('gym_id', ['options' => $gyms]);
            echo $this->Form->input('name');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
