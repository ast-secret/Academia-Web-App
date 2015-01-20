<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Exercises Group'), ['action' => 'edit', $exercisesGroup->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Exercises Group'), ['action' => 'delete', $exercisesGroup->id], ['confirm' => __('Are you sure you want to delete # {0}?', $exercisesGroup->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Exercises Groups'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Exercises Group'), ['action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Cards Exercises'), ['controller' => 'CardsExercises', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Cards Exercise'), ['controller' => 'CardsExercises', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="exercisesGroups view large-10 medium-9 columns">
    <h2><?= h($exercisesGroup->name) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Name') ?></h6>
            <p><?= h($exercisesGroup->name) ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($exercisesGroup->id) ?></p>
        </div>
        <div class="large-2 columns dates end">
            <h6 class="subheader"><?= __('Created') ?></h6>
            <p><?= h($exercisesGroup->created) ?></p>
            <h6 class="subheader"><?= __('Modified') ?></h6>
            <p><?= h($exercisesGroup->modified) ?></p>
        </div>
    </div>
</div>
<div class="related row">
    <div class="column large-12">
    <h4 class="subheader"><?= __('Related CardsExercises') ?></h4>
    <?php if (!empty($exercisesGroup->cards_exercises)): ?>
    <table cellpadding="0" cellspacing="0">
        <tr>
            <th><?= __('Id') ?></th>
            <th><?= __('Exercise Id') ?></th>
            <th><?= __('Card Id') ?></th>
            <th><?= __('Repetition') ?></th>
            <th><?= __('Created') ?></th>
            <th><?= __('Modified') ?></th>
            <th><?= __('Machine Id') ?></th>
            <th><?= __('Exercises Group Id') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
        <?php foreach ($exercisesGroup->cards_exercises as $cardsExercises): ?>
        <tr>
            <td><?= h($cardsExercises->id) ?></td>
            <td><?= h($cardsExercises->exercise_id) ?></td>
            <td><?= h($cardsExercises->card_id) ?></td>
            <td><?= h($cardsExercises->repetition) ?></td>
            <td><?= h($cardsExercises->created) ?></td>
            <td><?= h($cardsExercises->modified) ?></td>
            <td><?= h($cardsExercises->machine_id) ?></td>
            <td><?= h($cardsExercises->exercises_group_id) ?></td>

            <td class="actions">
                <?= $this->Html->link(__('View'), ['controller' => 'CardsExercises', 'action' => 'view', $cardsExercises->id]) ?>
                <?= $this->Html->link(__('Edit'), ['controller' => 'CardsExercises', 'action' => 'edit', $cardsExercises->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['controller' => 'CardsExercises', 'action' => 'delete', $cardsExercises->id], ['confirm' => __('Are you sure you want to delete # {0}?', $cardsExercises->id)]) ?>
            </td>
        </tr>

        <?php endforeach; ?>
    </table>
    <?php endif; ?>
    </div>
</div>
