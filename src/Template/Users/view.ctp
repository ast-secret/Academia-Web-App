<div class="users form large-10 medium-9 columns">
    <h2><?= h($user->name) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Gym') ?></h6>
            <p><?= $user->has('gym') ? $this->Html->link($user->gym->name, ['controller' => 'Gyms', 'action' => 'view', $user->gym->id]) : '' ?></p>
            <h6 class="subheader"><?= __('Role') ?></h6>
            <p><?= $user->has('role') ? $this->Html->link($user->role->name, ['controller' => 'Roles', 'action' => 'view', $user->role->id]) : '' ?></p>
            <h6 class="subheader"><?= __('Name') ?></h6>
            <p><?= h($user->name) ?></p>
            <h6 class="subheader"><?= __('Username') ?></h6>
            <p><?= h($user->username) ?></p>
            <h6 class="subheader"><?= __('Password') ?></h6>
            <p><?= h($user->password) ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($user->id) ?></p>
            <h6 class="subheader"><?= __('Role') ?></h6>
            <p><?= $this->Number->format($user->role) ?></p>
        </div>
        <div class="large-2 columns dates end">
            <h6 class="subheader"><?= __('Created') ?></h6>
            <p><?= h($user->created) ?></p>
            <h6 class="subheader"><?= __('Modified') ?></h6>
            <p><?= h($user->modified) ?></p>
        </div>
    </div>
</div>
<div class="related row">
    <div class="column large-12">
    <h4 class="subheader"><?= __('Related Cards') ?></h4>
    <?php if (!empty($user->cards)): ?>
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
        <?php foreach ($user->cards as $cards): ?>
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
    <h4 class="subheader"><?= __('Related Releases') ?></h4>
    <?php if (!empty($user->releases)): ?>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?= __('Id') ?></th>
            <th><?= __('User Id') ?></th>
            <th><?= __('Title') ?></th>
            <th><?= __('Text') ?></th>
            <th><?= __('Created') ?></th>
            <th><?= __('Modified') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        <?php foreach ($user->releases as $releases): ?>
        <tr>
            <td><?= h($releases->id) ?></td>
            <td><?= h($releases->user_id) ?></td>
            <td><?= h($releases->title) ?></td>
            <td><?= h($releases->text) ?></td>
            <td><?= h($releases->created) ?></td>
            <td><?= h($releases->modified) ?></td>

            <td class="actions">
                <?= $this->Html->link(__('View'), ['controller' => 'Releases', 'action' => 'view', $releases->id]) ?>
                <?= $this->Html->link(__('Edit'), ['controller' => 'Releases', 'action' => 'edit', $releases->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['controller' => 'Releases', 'action' => 'delete', $releases->id], ['confirm' => __('Are you sure you want to delete # {0}?', $releases->id)]) ?>
            </td>
        </tr>

        <?php endforeach; ?>
    </table>
    <?php endif; ?>
    </div>
</div>
