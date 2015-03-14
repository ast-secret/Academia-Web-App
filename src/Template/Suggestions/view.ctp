<?= $this->element('Common/dashboard_breadcrumb', ['breadcrumb' => $breadcrumb]) ?>

<br style="clear: both;">

<?= $this->Html->link($suggestion->customer->name, ['controller' => 'customers', 'action' => 'view', $suggestion->customer->id]) ?>
<br>
<small>
	<em class="text-muted">
		<?= h($suggestion->created->timeAgoInWords(['format' => 'dd/M/Y','end' => '+1 year'])) ?>
	</em>
</small>

<div class="row" style="margin-top: 15px;">
    <div class="col-md-8">
        <p class="text-default">
            <?= h($suggestion->text) ?>
        </p>
    </div>
</div>
