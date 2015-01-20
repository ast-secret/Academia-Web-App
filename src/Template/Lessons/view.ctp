<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Lesson'), ['action' => 'edit', $lesson->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Lesson'), ['action' => 'delete', $lesson->id], ['confirm' => __('Are you sure you want to delete # {0}?', $lesson->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Lessons'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Lesson'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Services'), ['controller' => 'Services', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Service'), ['controller' => 'Services', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Rooms'), ['controller' => 'Rooms', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Room'), ['controller' => 'Rooms', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="lessons view large-10 medium-9 columns">
    <h2><?= h($lesson->id) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Service') ?></h6>
            <p><?= $lesson->has('service') ? $this->Html->link($lesson->service->name, ['controller' => 'Services', 'action' => 'view', $lesson->service->id]) : '' ?></p>
            <h6 class="subheader"><?= __('Room') ?></h6>
            <p><?= $lesson->has('room') ? $this->Html->link($lesson->room->name, ['controller' => 'Rooms', 'action' => 'view', $lesson->room->id]) : '' ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($lesson->id) ?></p>
            <h6 class="subheader"><?= __('Availables') ?></h6>
            <p><?= $this->Number->format($lesson->availables) ?></p>
        </div>
        <div class="large-2 columns dates end">
            <h6 class="subheader"><?= __('Start Time') ?></h6>
            <p><?= h($lesson->start_time) ?></p>
            <h6 class="subheader"><?= __('End Time') ?></h6>
            <p><?= h($lesson->end_time) ?></p>
            <h6 class="subheader"><?= __('Date') ?></h6>
            <p><?= h($lesson->date) ?></p>
            <h6 class="subheader"><?= __('Created') ?></h6>
            <p><?= h($lesson->created) ?></p>
            <h6 class="subheader"><?= __('Modified') ?></h6>
            <p><?= h($lesson->modified) ?></p>
        </div>
    </div>
</div>
