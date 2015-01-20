<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Card'), ['action' => 'edit', $card->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Card'), ['action' => 'delete', $card->id], ['confirm' => __('Are you sure you want to delete # {0}?', $card->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Cards'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Card'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Customers'), ['controller' => 'Customers', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Customer'), ['controller' => 'Customers', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Exercises'), ['controller' => 'Exercises', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Exercise'), ['controller' => 'Exercises', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="cards view large-10 medium-9 columns">
    <h2><?= h($card->id) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('User') ?></h6>
            <p><?= $card->has('user') ? $this->Html->link($card->user->name, ['controller' => 'Users', 'action' => 'view', $card->user->id]) : '' ?></p>
            <h6 class="subheader"><?= __('Start Date') ?></h6>
            <p><?= h($card->start_date) ?></p>
            <h6 class="subheader"><?= __('End Date') ?></h6>
            <p><?= h($card->end_date) ?></p>
            <h6 class="subheader"><?= __('Goal') ?></h6>
            <p><?= h($card->goal) ?></p>
            <h6 class="subheader"><?= __('Customer') ?></h6>
            <p><?= $card->has('customer') ? $this->Html->link($card->customer->name, ['controller' => 'Customers', 'action' => 'view', $card->customer->id]) : '' ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($card->id) ?></p>
            <h6 class="subheader"><?= __('Current') ?></h6>
            <p><?= $this->Number->format($card->current) ?></p>
        </div>
        <div class="large-2 columns dates end">
            <h6 class="subheader"><?= __('Created') ?></h6>
            <p><?= h($card->created) ?></p>
            <h6 class="subheader"><?= __('Modified') ?></h6>
            <p><?= h($card->modified) ?></p>
        </div>
    </div>
    <div class="row texts">
        <div class="columns large-9">
            <h6 class="subheader"><?= __('Obs') ?></h6>
            <?= $this->Text->autoParagraph(h($card->obs)); ?>

        </div>
    </div>
</div>
<div class="related row">
    <div class="column large-12">
    <h4 class="subheader"><?= __('Related Exercises') ?></h4>
    <?php if (!empty($card->exercises)): ?>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?= __('Id') ?></th>
            <th><?= __('Name') ?></th>
            <th><?= __('Created') ?></th>
            <th><?= __('Modified') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        <?php foreach ($card->exercises as $exercises): ?>
        <tr>
            <td><?= h($exercises->id) ?></td>
            <td><?= h($exercises->name) ?></td>
            <td><?= h($exercises->created) ?></td>
            <td><?= h($exercises->modified) ?></td>

            <td class="actions">
                <?= $this->Html->link(__('View'), ['controller' => 'Exercises', 'action' => 'view', $exercises->id]) ?>
                <?= $this->Html->link(__('Edit'), ['controller' => 'Exercises', 'action' => 'edit', $exercises->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Exercises', 'action' => 'delete', $exercises->id], ['confirm' => __('Are you sure you want to delete # {0}?', $exercises->id)]) ?>
            </td>
        </tr>

        <?php endforeach; ?>
    </table>
    <?php endif; ?>
    </div>
</div>
