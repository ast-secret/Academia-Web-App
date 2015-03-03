<?= $this->element('Common/dashboard_breadcrumb', ['breadcrumb' => $breadcrumb]) ?>

<br style="clear: both;">

<!-- <table class="table table-hover table-condensed table-bordered"> -->
<ul class="list-group">
<!--     <thead>
        <tr>
            
            <th><?= __('Sugestões') ?></th>
            <th></th>
           
        </tr>
    </thead> -->
        <?php
            /**
             * Diz com quantos caracteres o texto será truncado, serve tb para mostrar o botão 
             * "mostrar mais"
             * @var integer
             */
            $truncatePoint = 400;
        ?>
        <?php foreach ($suggestions as $suggestion): ?>
            <li class="list-group-item">
                Por <?= $this->Html->link($suggestion->customer->name, ['controller' => 'customers', 'action' => 'view', $suggestion->customer->id]) ?> em <strong><?= h($suggestion->created->format('d \d\e M')) ?></strong>
                <br><br>
                <p><?= h($this->Text->truncate(__($suggestion->text), $truncatePoint)) ?></p>
                
                <?php if (isset($suggestion->text[$truncatePoint])): ?>
                    <div class="text-center" style="margin-top: 20px;">
                        <small>
                            <a href="#">
                                <span class="glyphicon glyphicon-fullscreen"></span>&nbsp;Visualizar texto completo
                            </a>
                        </small>
                    </div>
                <?php endif ?>
            </li>
        <?php endforeach; ?>
</ul>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('Anterior')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('Próximo') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
