<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Lessons Has User'), ['action' => 'edit', $lessonsHasUser->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Lessons Has User'), ['action' => 'delete', $lessonsHasUser->id], ['confirm' => __('Are you sure you want to delete # {0}?', $lessonsHasUser->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Lessons Has Users'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Lessons Has User'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Lessons'), ['controller' => 'Lessons', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Lesson'), ['controller' => 'Lessons', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="lessonsHasUsers view large-10 medium-9 columns">
    <h2><?= h($lessonsHasUser->id) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Lesson') ?></h6>
            <p><?= $lessonsHasUser->has('lesson') ? $this->Html->link($lessonsHasUser->lesson->id, ['controller' => 'Lessons', 'action' => 'view', $lessonsHasUser->lesson->id]) : '' ?></p>
            <h6 class="subheader"><?= __('User') ?></h6>
            <p><?= $lessonsHasUser->has('user') ? $this->Html->link($lessonsHasUser->user->name, ['controller' => 'Users', 'action' => 'view', $lessonsHasUser->user->id]) : '' ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($lessonsHasUser->id) ?></p>
        </div>
        <div class="large-2 columns dates end">
            <h6 class="subheader"><?= __('Created') ?></h6>
            <p><?= h($lessonsHasUser->created) ?></p>
        </div>
    </div>
</div>
