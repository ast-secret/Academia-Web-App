<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $lessonsHasUser->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $lessonsHasUser->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Lessons Has Users'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Lessons'), ['controller' => 'Lessons', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Lesson'), ['controller' => 'Lessons', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="lessonsHasUsers form large-10 medium-9 columns">
    <?= $this->Form->create($lessonsHasUser); ?>
    <fieldset>
        <legend><?= __('Edit Lessons Has User') ?></legend>
        <?php
            echo $this->Form->input('lessons_id', ['options' => $lessons]);
            echo $this->Form->input('users_id', ['options' => $users]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
