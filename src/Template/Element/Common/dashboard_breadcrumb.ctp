<div class="text-center" style="border-bottom: #eee solid 1px; margin-bottom: 30px;">
    <div class="pull-left">
        <?php if ($breadcrumb['root']): ?>
            <?php foreach ($breadcrumb['root'] as $item): ?>
                <?= $this->Html->link($item['label'], $item['url']) ?> / 
            <?php endforeach ?>
        <?php endif ?>
    </div>
    <h3><?= $breadcrumb['active'] ?></h3>
</div>