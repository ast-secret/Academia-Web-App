<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Weekday'), ['action' => 'edit', $weekday->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Weekday'), ['action' => 'delete', $weekday->id], ['confirm' => __('Are you sure you want to delete # {0}?', $weekday->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Weekdays'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Weekday'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Services'), ['controller' => 'Services', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Service'), ['controller' => 'Services', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="weekdays view large-10 medium-9 columns">
    <h2><?= h($weekday->id) ?></h2>
    <div class="row">
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($weekday->id) ?></p>
            <h6 class="subheader"><?= __('Weekday') ?></h6>
            <p><?= $this->Number->format($weekday->weekday) ?></p>
        </div>
        <div class="large-2 columns dates end">
            <h6 class="subheader"><?= __('Created') ?></h6>
            <p><?= h($weekday->created) ?></p>
            <h6 class="subheader"><?= __('Modified') ?></h6>
            <p><?= h($weekday->modified) ?></p>
        </div>
    </div>
</div>
<div class="related row">
    <div class="column large-12">
    <h4 class="subheader"><?= __('Related Services') ?></h4>
    <?php if (!empty($weekday->services)): ?>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?= __('Id') ?></th>
            <th><?= __('Gym Id') ?></th>
            <th><?= __('Name') ?></th>
            <th><?= __('Description') ?></th>
            <th><?= __('Begin Service') ?></th>
            <th><?= __('End Service') ?></th>
            <th><?= __('Created') ?></th>
            <th><?= __('Modified') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        <?php foreach ($weekday->services as $services): ?>
        <tr>
            <td><?= h($services->id) ?></td>
            <td><?= h($services->gym_id) ?></td>
            <td><?= h($services->name) ?></td>
            <td><?= h($services->description) ?></td>
            <td><?= h($services->begin_service) ?></td>
            <td><?= h($services->end_service) ?></td>
            <td><?= h($services->created) ?></td>
            <td><?= h($services->modified) ?></td>

            <td class="actions">
                <?= $this->Html->link(__('View'), ['controller' => 'Services', 'action' => 'view', $services->id]) ?>
                <?= $this->Html->link(__('Edit'), ['controller' => 'Services', 'action' => 'edit', $services->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Services', 'action' => 'delete', $services->id], ['confirm' => __('Are you sure you want to delete # {0}?', $services->id)]) ?>
            </td>
        </tr>

        <?php endforeach; ?>
    </table>
    <?php endif; ?>
    </div>
</div>
