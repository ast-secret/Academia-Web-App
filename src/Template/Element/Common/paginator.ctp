<div class="paginator">
    <ul class="pagination pagination-sm">
        <?= $this->Paginator->prev(
        	'<span class="glyphicon glyphicon-chevron-left"></span>',
        	['escape' => false])
        ?>
        <?= $this->Paginator->numbers() ?>
        <?= $this->Paginator->next(
        	'<span class="glyphicon glyphicon-chevron-right"></span>',
        	['escape' => false])
        ?>
    </ul>
</div>