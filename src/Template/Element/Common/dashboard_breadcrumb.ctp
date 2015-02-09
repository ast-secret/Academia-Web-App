<div class="text-center" style="border-bottom: #eee solid 1px; margin-bottom: 30px;">
    <div class="pull-left">
        <?php if (isset($breadcrumb['parents'])): ?>
            <?php foreach ($breadcrumb['parents'] as $item): ?>
                <?= $this->Html->link($item['label'], $item['url']) ?> / 
            <?php endforeach ?>
        <?php endif ?>
    </div>
    <h3><?= $breadcrumb['active'] ?></h3>
</div>