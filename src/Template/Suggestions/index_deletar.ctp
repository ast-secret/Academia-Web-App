<?= $this->element('Common/dashboard_breadcrumb', ['breadcrumb' => $breadcrumb]) ?>

<ul class="list-group">
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
                <?= $this->Html->link($suggestion->customer->name, ['controller' => 'customers', 'action' => 'view', $suggestion->customer->id]) ?>
                <br>
                <small>
                    <em class="text-muted">
                        <?= h($suggestion->created->timeAgoInWords(['format' => 'dd/M/Y','end' => '+1 year'])) ?>
                    </em>
                </small>
                <p style="margin-top: 15px" class="text-default"><?= h($this->Text->truncate(__($suggestion->text), $truncatePoint)) ?></p>
                
                <?php if (isset($suggestion->text[$truncatePoint])): ?>
                    <div class="text-center" style="margin-top: 20px;">
                        <small>
                            <?= $this->Html->link(
                                '<span class="glyphicon glyphicon-fullscreen"></span>&nbsp;Visualizar texto completo',
                                ['action' => 'view', $suggestion->id],
                                ['escape' => false]
                            ) ?>
                            <a href="#">
                                
                            </a>
                        </small>
                    </div>
                <?php endif ?>
            </li>
        <?php endforeach; ?>
</ul>

<?= $this->element('Common/paginator') ?>