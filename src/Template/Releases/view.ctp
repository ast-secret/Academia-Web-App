<?= $this->element('Common/dashboard_breadcrumb', ['breadcrumb' => $breadcrumb]) ?>

<br style="clear: both;">

<?= $this->Html->link(h($release->user->name), ['controller' => 'users', 'action' => 'view', $release->user->id]) ?>
<br>
<small>
    <em class="text-muted">
        <?= $release->created->timeAgoInWords(['format' => 'dd/M/Y', 'accuracy' => 'day', 'end' => '+1 month']) ?>
    </em>
</small>

<div class="row" style="margin-top: 15px;">
    <div class="col-md-8">
        <p class="text-default">
            <?= h($release->text) ?>
        </p>
    </div>
</div>
