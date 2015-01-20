<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('List Cards Exercises'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Exercises'), ['controller' => 'Exercises', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Exercise'), ['controller' => 'Exercises', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Cards'), ['controller' => 'Cards', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Card'), ['controller' => 'Cards', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Machines'), ['controller' => 'Machines', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Machine'), ['controller' => 'Machines', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Exercises Groups'), ['controller' => 'ExercisesGroups', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Exercises Group'), ['controller' => 'ExercisesGroups', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="cardsExercises form large-10 medium-9 columns">
    <?= $this->Form->create($cardsExercise); ?>
    <fieldset>
        <legend><?= __('Add Cards Exercise') ?></legend>
        <?php
            echo $this->Form->input('exercise_id', ['options' => $exercises]);
            echo $this->Form->input('card_id', ['options' => $cards]);
            echo $this->Form->input('repetition');
            echo $this->Form->input('machine_id', ['options' => $machines]);
            echo $this->Form->input('exercises_group_id', ['options' => $exercisesGroups]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
