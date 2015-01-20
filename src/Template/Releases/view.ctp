<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Release'), ['action' => 'edit', $release->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Release'), ['action' => 'delete', $release->id], ['confirm' => __('Are you sure you want to delete # {0}?', $release->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Releases'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Release'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Users'), ['controller' => 'Users', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New User'), ['controller' => 'Users', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="releases view large-10 medium-9 columns">
    <h2><?= h($release->title) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('User') ?></h6>
            <p><?= $release->has('user') ? $this->Html->link($release->user->name, ['controller' => 'Users', 'action' => 'view', $release->user->id]) : '' ?></p>
            <h6 class="subheader"><?= __('Title') ?></h6>
            <p><?= h($release->title) ?></p>
            <h6 class="subheader"><?= __('Text') ?></h6>
            <p><?= h($release->text) ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($release->id) ?></p>
        </div>
        <div class="large-2 columns dates end">
            <h6 class="subheader"><?= __('Created') ?></h6>
            <p><?= h($release->created) ?></p>
            <h6 class="subheader"><?= __('Modified') ?></h6>
            <p><?= h($release->modified) ?></p>
        </div>
    </div>
</div>
