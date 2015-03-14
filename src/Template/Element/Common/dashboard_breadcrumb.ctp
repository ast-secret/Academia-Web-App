<div class="text-center custom-breadcrumb" style="">
    <div class="pull-left">
        <?php if (isset($breadcrumb['parents'])): ?>
            <?php foreach ($breadcrumb['parents'] as $item): ?>
                <?= $this->Html->link($item['label'], $item['url']) ?> / 
            <?php endforeach ?>
        <?php endif ?>
    </div>
    <span class="custom-breadcrumb-active">
    	<?= $breadcrumb['active'] ?>
    </span>
</div>