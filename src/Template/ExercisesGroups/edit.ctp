<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $exercisesGroup->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $exercisesGroup->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Exercises Groups'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Cards Exercises'), ['controller' => 'CardsExercises', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Cards Exercise'), ['controller' => 'CardsExercises', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="exercisesGroups form large-10 medium-9 columns">
    <?= $this->Form->create($exercisesGroup); ?>
    <fieldset>
        <legend><?= __('Edit Exercises Group') ?></legend>
        <?php
            echo $this->Form->input('name');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
