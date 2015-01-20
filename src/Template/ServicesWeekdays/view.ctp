<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Services Weekday'), ['action' => 'edit', $servicesWeekday->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Services Weekday'), ['action' => 'delete', $servicesWeekday->id], ['confirm' => __('Are you sure you want to delete # {0}?', $servicesWeekday->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Services Weekdays'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Services Weekday'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Services'), ['controller' => 'Services', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Service'), ['controller' => 'Services', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Weekdays'), ['controller' => 'Weekdays', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Weekday'), ['controller' => 'Weekdays', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="servicesWeekdays view large-10 medium-9 columns">
    <h2><?= h($servicesWeekday->id) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Service') ?></h6>
            <p><?= $servicesWeekday->has('service') ? $this->Html->link($servicesWeekday->service->name, ['controller' => 'Services', 'action' => 'view', $servicesWeekday->service->id]) : '' ?></p>
            <h6 class="subheader"><?= __('Weekday') ?></h6>
            <p><?= $servicesWeekday->has('weekday') ? $this->Html->link($servicesWeekday->weekday->id, ['controller' => 'Weekdays', 'action' => 'view', $servicesWeekday->weekday->id]) : '' ?></p>
            <h6 class="subheader"><?= __('Created') ?></h6>
            <p><?= h($servicesWeekday->created) ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($servicesWeekday->id) ?></p>
        </div>
    </div>
</div>
