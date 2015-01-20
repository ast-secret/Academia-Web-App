<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Suggestion'), ['action' => 'edit', $suggestion->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Suggestion'), ['action' => 'delete', $suggestion->id], ['confirm' => __('Are you sure you want to delete # {0}?', $suggestion->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Suggestions'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Suggestion'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Customers'), ['controller' => 'Customers', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Customer'), ['controller' => 'Customers', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="suggestions view large-10 medium-9 columns">
    <h2><?= h($suggestion->id) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Text') ?></h6>
            <p><?= h($suggestion->text) ?></p>
            <h6 class="subheader"><?= __('Customer') ?></h6>
            <p><?= $suggestion->has('customer') ? $this->Html->link($suggestion->customer->name, ['controller' => 'Customers', 'action' => 'view', $suggestion->customer->id]) : '' ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($suggestion->id) ?></p>
        </div>
        <div class="large-2 columns dates end">
            <h6 class="subheader"><?= __('Created') ?></h6>
            <p><?= h($suggestion->created) ?></p>
            <h6 class="subheader"><?= __('Modified') ?></h6>
            <p><?= h($suggestion->modified) ?></p>
        </div>
    </div>
</div>
