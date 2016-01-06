<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('Edit Exercises Suggestion'), ['action' => 'edit', $exercisesSuggestion->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Exercises Suggestion'), ['action' => 'delete', $exercisesSuggestion->id], ['confirm' => __('Are you sure you want to delete # {0}?', $exercisesSuggestion->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Exercises Suggestions'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Exercises Suggestion'), ['action' => 'add']) ?> </li>
    </ul>
</nav>
<div class="exercisesSuggestions view large-9 medium-8 columns content">
    <h3><?= h($exercisesSuggestion->id) ?></h3>
    <table class="vertical-table">
        <tr>
            <th><?= __('Name') ?></th>
            <td><?= h($exercisesSuggestion->name) ?></td>
        </tr>
        <tr>
            <th><?= __('Id') ?></th>
            <td><?= $this->Number->format($exercisesSuggestion->id) ?></td>
        </tr>
        <tr>
            <th><?= __('Is Active') ?></th>
            <td><?= $this->Number->format($exercisesSuggestion->is_active) ?></td>
        </tr>
        <tr>
            <th><?= __('Created') ?></th>
            <td><?= h($exercisesSuggestion->created) ?></td>
        </tr>
        <tr>
            <th><?= __('Modified') ?></th>
            <td><?= h($exercisesSuggestion->modified) ?></td>
        </tr>
    </table>
</div>
