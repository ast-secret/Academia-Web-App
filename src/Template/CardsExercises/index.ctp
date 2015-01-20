<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('New Cards Exercise'), ['action' => 'add']) ?></li>
        <li><?= $this->Html->link(__('List Exercises'), ['controller' => 'Exercises', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Exercise'), ['controller' => 'Exercises', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Cards'), ['controller' => 'Cards', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Card'), ['controller' => 'Cards', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Machines'), ['controller' => 'Machines', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Machine'), ['controller' => 'Machines', 'action' => 'add']) ?> </li>
        <li><?= $this->Html->link(__('List Exercises Groups'), ['controller' => 'ExercisesGroups', 'action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Exercises Group'), ['controller' => 'ExercisesGroups', 'action' => 'add']) ?> </li>
    </ul>
</div>
<div class="cardsExercises index large-10 medium-9 columns">
    <table cellpadding="0" cellspacing="0">
    <thead>
        <tr>
            <th><?= $this->Paginator->sort('id') ?></th>
            <th><?= $this->Paginator->sort('exercise_id') ?></th>
            <th><?= $this->Paginator->sort('card_id') ?></th>
            <th><?= $this->Paginator->sort('repetition') ?></th>
            <th><?= $this->Paginator->sort('created') ?></th>
            <th><?= $this->Paginator->sort('modified') ?></th>
            <th><?= $this->Paginator->sort('machine_id') ?></th>
            <th class="actions"><?= __('Actions') ?></th>
        </tr>
    </thead>
    <tbody>
    <?php foreach ($cardsExercises as $cardsExercise): ?>
        <tr>
            <td><?= $this->Number->format($cardsExercise->id) ?></td>
            <td>
                <?= $cardsExercise->has('exercise') ? $this->Html->link($cardsExercise->exercise->name, ['controller' => 'Exercises', 'action' => 'view', $cardsExercise->exercise->id]) : '' ?>
            </td>
            <td>
                <?= $cardsExercise->has('card') ? $this->Html->link($cardsExercise->card->id, ['controller' => 'Cards', 'action' => 'view', $cardsExercise->card->id]) : '' ?>
            </td>
            <td><?= h($cardsExercise->repetition) ?></td>
            <td><?= h($cardsExercise->created) ?></td>
            <td><?= h($cardsExercise->modified) ?></td>
            <td>
                <?= $cardsExercise->has('machine') ? $this->Html->link($cardsExercise->machine->name, ['controller' => 'Machines', 'action' => 'view', $cardsExercise->machine->id]) : '' ?>
            </td>
            <td class="actions">
                <?= $this->Html->link(__('View'), ['action' => 'view', $cardsExercise->id]) ?>
                <?= $this->Html->link(__('Edit'), ['action' => 'edit', $cardsExercise->id]) ?>
                <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $cardsExercise->id], ['confirm' => __('Are you sure you want to delete # {0}?', $cardsExercise->id)]) ?>
            </td>
        </tr>

    <?php endforeach; ?>
    </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
