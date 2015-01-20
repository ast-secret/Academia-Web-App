<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $exercise->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $exercise->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Exercises'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Cards'), ['controller' => 'Cards', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Card'), ['controller' => 'Cards', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="exercises form large-10 medium-9 columns">
    <?= $this->Form->create($exercise); ?>
    <fieldset>
        <legend><?= __('Edit Exercise') ?></legend>
        <?php
            echo $this->Form->input('name');
            echo $this->Form->input('cards._ids', ['options' => $cards]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
