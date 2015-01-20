<div class="actions columns large-2 medium-3">
    <h3><?= __('Actions') ?></h3>
    <ul class="side-nav">
        <li><?= $this->Html->link(__('Edit Cards Exercise'), ['action' => 'edit', $cardsExercise->id]) ?> </li>
        <li><?= $this->Form->postLink(__('Delete Cards Exercise'), ['action' => 'delete', $cardsExercise->id], ['confirm' => __('Are you sure you want to delete # {0}?', $cardsExercise->id)]) ?> </li>
        <li><?= $this->Html->link(__('List Cards Exercises'), ['action' => 'index']) ?> </li>
        <li><?= $this->Html->link(__('New Cards Exercise'), ['action' => 'add']) ?> </li>
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
<div class="cardsExercises view large-10 medium-9 columns">
    <h2><?= h($cardsExercise->id) ?></h2>
    <div class="row">
        <div class="large-5 columns strings">
            <h6 class="subheader"><?= __('Exercise') ?></h6>
            <p><?= $cardsExercise->has('exercise') ? $this->Html->link($cardsExercise->exercise->name, ['controller' => 'Exercises', 'action' => 'view', $cardsExercise->exercise->id]) : '' ?></p>
            <h6 class="subheader"><?= __('Card') ?></h6>
            <p><?= $cardsExercise->has('card') ? $this->Html->link($cardsExercise->card->id, ['controller' => 'Cards', 'action' => 'view', $cardsExercise->card->id]) : '' ?></p>
            <h6 class="subheader"><?= __('Repetition') ?></h6>
            <p><?= h($cardsExercise->repetition) ?></p>
            <h6 class="subheader"><?= __('Machine') ?></h6>
            <p><?= $cardsExercise->has('machine') ? $this->Html->link($cardsExercise->machine->name, ['controller' => 'Machines', 'action' => 'view', $cardsExercise->machine->id]) : '' ?></p>
            <h6 class="subheader"><?= __('Exercises Group') ?></h6>
            <p><?= $cardsExercise->has('exercises_group') ? $this->Html->link($cardsExercise->exercises_group->name, ['controller' => 'ExercisesGroups', 'action' => 'view', $cardsExercise->exercises_group->id]) : '' ?></p>
        </div>
        <div class="large-2 columns numbers end">
            <h6 class="subheader"><?= __('Id') ?></h6>
            <p><?= $this->Number->format($cardsExercise->id) ?></p>
        </div>
        <div class="large-2 columns dates end">
            <h6 class="subheader"><?= __('Created') ?></h6>
            <p><?= h($cardsExercise->created) ?></p>
            <h6 class="subheader"><?= __('Modified') ?></h6>
            <p><?= h($cardsExercise->modified) ?></p>
        </div>
    </div>
</div>
