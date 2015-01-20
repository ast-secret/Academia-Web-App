<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $card->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $card->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Cards'), ['action' => 'index']) ?></li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Customers'), ['controller' => 'Customers', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Customer'), ['controller' => 'Customers', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Exercises'), ['controller' => 'Exercises', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Exercise'), ['controller' => 'Exercises', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="cards form large-10 medium-9 columns">
    <?= $this->Form->create($card); ?>
    <fieldset>
        <legend><?= __('Edit Card') ?></legend>
        <?php
            echo $this->Form->input('user_id', ['options' => $users]);
            echo $this->Form->input('start_date');
            echo $this->Form->input('end_date');
            echo $this->Form->input('goal');
            echo $this->Form->input('customer_id', ['options' => $customers]);
            echo $this->Form->input('obs');
            echo $this->Form->input('current');
            echo $this->Form->input('exercises._ids', ['options' => $exercises]);
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
