<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $servicesWeekday->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $servicesWeekday->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Services Weekdays'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Services'), ['controller' => 'Services', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Service'), ['controller' => 'Services', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Weekdays'), ['controller' => 'Weekdays', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Weekday'), ['controller' => 'Weekdays', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="servicesWeekdays form large-10 medium-9 columns">
    <?= $this->Form->create($servicesWeekday); ?>
    <fieldset>
        <legend><?= __('Edit Services Weekday') ?></legend>
        <?php
            echo $this->Form->input('service_id', ['options' => $services]);
            echo $this->Form->input('weekday_id', ['options' => $weekdays]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
