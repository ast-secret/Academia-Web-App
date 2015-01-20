<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Service'), ['action' => 'edit', $service->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Service'), ['action' => 'delete', $service->id], ['confirm' => __('Are you sure you want to delete # {0}?', $service->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Services'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Service'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Gyms'), ['controller' => 'Gyms', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Gym'), ['controller' => 'Gyms', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Lessons'), ['controller' => 'Lessons', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Lesson'), ['controller' => 'Lessons', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Weekdays'), ['controller' => 'Weekdays', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Weekday'), ['controller' => 'Weekdays', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="services view large-10 medium-9 columns">
    <h2><?= h($service->name) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Gym') ?></h6>
            <p><?= $service->has('gym') ? $this->Html->link($service->gym->name, ['controller' => 'Gyms', 'action' => 'view', $service->gym->id]) : '' ?></p>
            <h6 class="subheader"><?= __('Name') ?></h6>
            <p><?= h($service->name) ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($service->id) ?></p>
        </div>
        <div class="large-2 columns dates end">
            <h6 class="subheader"><?= __('Begin Service') ?></h6>
            <p><?= h($service->begin_service) ?></p>
            <h6 class="subheader"><?= __('End Service') ?></h6>
            <p><?= h($service->end_service) ?></p>
            <h6 class="subheader"><?= __('Created') ?></h6>
            <p><?= h($service->created) ?></p>
            <h6 class="subheader"><?= __('Modified') ?></h6>
            <p><?= h($service->modified) ?></p>
        </div>
    </div>
    <div class="row texts">
        <div class="columns large-9">
            <h6 class="subheader"><?= __('Description') ?></h6>
            <?= $this->Text->autoParagraph(h($service->description)); ?>

        </div>
    </div>
</div>
<div class="related row">
    <div class="column large-12">
    <h4 class="subheader"><?= __('Related Lessons') ?></h4>
    <?php if (!empty($service->lessons)): ?>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?= __('Id') ?></th>
            <th><?= __('Start Time') ?></th>
            <th><?= __('End Time') ?></th>
            <th><?= __('Date') ?></th>
            <th><?= __('Service Id') ?></th>
            <th><?= __('Room Id') ?></th>
            <th><?= __('Availables') ?></th>
            <th><?= __('Created') ?></th>
            <th><?= __('Modified') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        <?php foreach ($service->lessons as $lessons): ?>
        <tr>
            <td><?= h($lessons->id) ?></td>
            <td><?= h($lessons->start_time) ?></td>
            <td><?= h($lessons->end_time) ?></td>
            <td><?= h($lessons->date) ?></td>
            <td><?= h($lessons->service_id) ?></td>
            <td><?= h($lessons->room_id) ?></td>
            <td><?= h($lessons->availables) ?></td>
            <td><?= h($lessons->created) ?></td>
            <td><?= h($lessons->modified) ?></td>

            <td class="actions">
                <?= $this->Html->link(__('View'), ['controller' => 'Lessons', 'action' => 'view', $lessons->id]) ?>
                <?= $this->Html->link(__('Edit'), ['controller' => 'Lessons', 'action' => 'edit', $lessons->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Lessons', 'action' => 'delete', $lessons->id], ['confirm' => __('Are you sure you want to delete # {0}?', $lessons->id)]) ?>
            </td>
        </tr>

        <?php endforeach; ?>
    </table>
    <?php endif; ?>
    </div>
</div>
<div class="related row">
    <div class="column large-12">
    <h4 class="subheader"><?= __('Related Weekdays') ?></h4>
    <?php if (!empty($service->weekdays)): ?>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?= __('Id') ?></th>
            <th><?= __('Weekday') ?></th>
            <th><?= __('Created') ?></th>
            <th><?= __('Modified') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        <?php foreach ($service->weekdays as $weekdays): ?>
        <tr>
            <td><?= h($weekdays->id) ?></td>
            <td><?= h($weekdays->weekday) ?></td>
            <td><?= h($weekdays->created) ?></td>
            <td><?= h($weekdays->modified) ?></td>

            <td class="actions">
                <?= $this->Html->link(__('View'), ['controller' => 'Weekdays', 'action' => 'view', $weekdays->id]) ?>
                <?= $this->Html->link(__('Edit'), ['controller' => 'Weekdays', 'action' => 'edit', $weekdays->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Weekdays', 'action' => 'delete', $weekdays->id], ['confirm' => __('Are you sure you want to delete # {0}?', $weekdays->id)]) ?>
            </td>
        </tr>

        <?php endforeach; ?>
    </table>
    <?php endif; ?>
    </div>
</div>
