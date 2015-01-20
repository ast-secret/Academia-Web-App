<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Customer'), ['action' => 'edit', $customer->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Customer'), ['action' => 'delete', $customer->id], ['confirm' => __('Are you sure you want to delete # {0}?', $customer->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Customers'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Customer'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Cards'), ['controller' => 'Cards', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Card'), ['controller' => 'Cards', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Suggestions'), ['controller' => 'Suggestions', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Suggestion'), ['controller' => 'Suggestions', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="customers view large-10 medium-9 columns">
    <h2><?= h($customer->name) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Name') ?></h6>
            <p><?= h($customer->name) ?></p>
            <h6 class="subheader"><?= __('Registration') ?></h6>
            <p><?= h($customer->registration) ?></p>
            <h6 class="subheader"><?= __('Password') ?></h6>
            <p><?= h($customer->password) ?></p>
            <h6 class="subheader"><?= __('Access Key') ?></h6>
            <p><?= h($customer->access_key) ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($customer->id) ?></p>
        </div>
        <div class="large-2 columns dates end">
            <h6 class="subheader"><?= __('Created') ?></h6>
            <p><?= h($customer->created) ?></p>
            <h6 class="subheader"><?= __('Modified') ?></h6>
            <p><?= h($customer->modified) ?></p>
        </div>
    </div>
</div>
<div class="related row">
    <div class="column large-12">
    <h4 class="subheader"><?= __('Related Cards') ?></h4>
    <?php if (!empty($customer->cards)): ?>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?= __('Id') ?></th>
            <th><?= __('User Id') ?></th>
            <th><?= __('Start Date') ?></th>
            <th><?= __('End Date') ?></th>
            <th><?= __('Goal') ?></th>
            <th><?= __('Created') ?></th>
            <th><?= __('Modified') ?></th>
            <th><?= __('Customer Id') ?></th>
            <th><?= __('Obs') ?></th>
            <th><?= __('Current') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        <?php foreach ($customer->cards as $cards): ?>
        <tr>
            <td><?= h($cards->id) ?></td>
            <td><?= h($cards->user_id) ?></td>
            <td><?= h($cards->start_date) ?></td>
            <td><?= h($cards->end_date) ?></td>
            <td><?= h($cards->goal) ?></td>
            <td><?= h($cards->created) ?></td>
            <td><?= h($cards->modified) ?></td>
            <td><?= h($cards->customer_id) ?></td>
            <td><?= h($cards->obs) ?></td>
            <td><?= h($cards->current) ?></td>

            <td class="actions">
                <?= $this->Html->link(__('View'), ['controller' => 'Cards', 'action' => 'view', $cards->id]) ?>
                <?= $this->Html->link(__('Edit'), ['controller' => 'Cards', 'action' => 'edit', $cards->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Cards', 'action' => 'delete', $cards->id], ['confirm' => __('Are you sure you want to delete # {0}?', $cards->id)]) ?>
            </td>
        </tr>

        <?php endforeach; ?>
    </table>
    <?php endif; ?>
    </div>
</div>
<div class="related row">
    <div class="column large-12">
    <h4 class="subheader"><?= __('Related Suggestions') ?></h4>
    <?php if (!empty($customer->suggestions)): ?>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?= __('Id') ?></th>
            <th><?= __('Text') ?></th>
            <th><?= __('Created') ?></th>
            <th><?= __('Modified') ?></th>
            <th><?= __('Customer Id') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        <?php foreach ($customer->suggestions as $suggestions): ?>
        <tr>
            <td><?= h($suggestions->id) ?></td>
            <td><?= h($suggestions->text) ?></td>
            <td><?= h($suggestions->created) ?></td>
            <td><?= h($suggestions->modified) ?></td>
            <td><?= h($suggestions->customer_id) ?></td>

            <td class="actions">
                <?= $this->Html->link(__('View'), ['controller' => 'Suggestions', 'action' => 'view', $suggestions->id]) ?>
                <?= $this->Html->link(__('Edit'), ['controller' => 'Suggestions', 'action' => 'edit', $suggestions->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Suggestions', 'action' => 'delete', $suggestions->id], ['confirm' => __('Are you sure you want to delete # {0}?', $suggestions->id)]) ?>
            </td>
        </tr>

        <?php endforeach; ?>
    </table>
    <?php endif; ?>
    </div>
</div>
