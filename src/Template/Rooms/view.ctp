<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Room'), ['action' => 'edit', $room->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Room'), ['action' => 'delete', $room->id], ['confirm' => __('Are you sure you want to delete # {0}?', $room->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Rooms'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Room'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Gyms'), ['controller' => 'Gyms', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Gym'), ['controller' => 'Gyms', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Lessons'), ['controller' => 'Lessons', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Lesson'), ['controller' => 'Lessons', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="rooms view large-10 medium-9 columns">
    <h2><?= h($room->name) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Name') ?></h6>
            <p><?= h($room->name) ?></p>
            <h6 class="subheader"><?= __('Gym') ?></h6>
            <p><?= $room->has('gym') ? $this->Html->link($room->gym->name, ['controller' => 'Gyms', 'action' => 'view', $room->gym->id]) : '' ?></p>
            <h6 class="subheader"><?= __('Description') ?></h6>
            <p><?= h($room->description) ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($room->id) ?></p>
        </div>
        <div class="large-2 columns dates end">
            <h6 class="subheader"><?= __('Modified') ?></h6>
            <p><?= h($room->modified) ?></p>
            <h6 class="subheader"><?= __('Created') ?></h6>
            <p><?= h($room->created) ?></p>
        </div>
    </div>
</div>
<div class="related row">
    <div class="column large-12">
    <h4 class="subheader"><?= __('Related Lessons') ?></h4>
    <?php if (!empty($room->lessons)): ?>
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
        <?php foreach ($room->lessons as $lessons): ?>
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
