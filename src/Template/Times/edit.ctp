<?= $this->Html->script('Services/form') ?>

<?= $this->element('Common/dashboard_breadcrumb', ['breadcrumb' => $breadcrumb]) ?>

<div class="">
    <?= $this->Form->create($time); ?>
         <ul id="list-times" class="list-group">
            <?php if ($time): ?>
                <?php foreach ($time as $key => $value): ?>
                    <?php if (!$value->errors()): ?>
                        <li class="list-group-item">
                            <strong><?= $this->Weekdays->getById($value->weekday_id, $weekdays) ?></strong> às <strong><?= $value->start_hour ?></strong> com <strong><?= $value->duration ?></strong> minutos de duração.

                            <?php
                                // Hidden Fields
                                echo $this->Form->hidden("times.{$key}.id",
                                    [
                                        'value' => $value->id,
                                        'id' => 'timesId'
                                    ]);
                                echo $this->Form->hidden("times.{$key}.weekday_id",
                                    ['value' => $time->weekday_id]);
                                echo $this->Form->hidden("times.{$key}.start_hour", ['value' => $value->start_hour]);
                                echo $this->Form->hidden("times.{$key}.duration",
                                    ['value' => $value->duration]);
                            ?>

                            <button
                                type="button"
                                id="btn-deletar"
                                class="btn btn-default btn-xs pull-right"
                                style="display: none;">
                                <span class="glyphicon glyphicon-remove"></span>
                            </button>

                        </li>
                    <?php endif ?>
                <?php endforeach ?>
            <?php else: ?>
                <em id="text-exercises-empty">Nenhum exercício adicionado</em>
            <?php endif; ?>
        </ul>

        <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>


</div>
