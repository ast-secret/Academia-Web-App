<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Time'), ['action' => 'edit', $time->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Time'), ['action' => 'delete', $time->id], ['confirm' => __('Are you sure you want to delete # {0}?', $time->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Times'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Time'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Services'), ['controller' => 'Services', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Service'), ['controller' => 'Services', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="times view large-10 medium-9 columns">
    <h2><?= h($time->id) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Service') ?></h6>
            <p><?= $time->has('service') ? $this->Html->link($time->service->name, ['controller' => 'Services', 'action' => 'view', $time->service->id]) : '' ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($time->id) ?></p>
            <h6 class="subheader"><?= __('Weekday') ?></h6>
            <p><?= $this->Number->format($time->weekday) ?></p>
        </div>
        <div class="large-2 columns dates end">
            <h6 class="subheader"><?= __('Start Hour') ?></h6>
            <p><?= h($time->start_hour) ?></p>
            <h6 class="subheader"><?= __('Created') ?></h6>
            <p><?= h($time->created) ?></p>
        </div>
    </div>
</div>
