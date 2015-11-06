<div class="paginator" style="float: left;">
    <ul class="pagination pagination-sm">
        <?= $this->Paginator->prev(
        	'<span class="glyphicon glyphicon-chevron-left"></span>',
        	['escape' => false])
        ?>
        <?= $this->Paginator->next(
        	'<span class="glyphicon glyphicon-chevron-right"></span>',
        	['escape' => false])
        ?>
    </ul>
</div>
<div style="float: left; margin-top: 28px; margin-left: 10px; font-size: 12px;">
    <?= $this->Paginator->counter('{{page}} - {{pages}} de {{count}}') ?>
</div>