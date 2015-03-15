<?= $this->element('Common/dashboard_breadcrumb', ['breadcrumb' => $breadcrumb]) ?>

<ul class="nav nav-tabs">
    <li
        role="presentation"
        class="<?= $filter == 1 ? 'active' : '' ?>">
        <?=
            $this->Html->link(__('Entrada'), [
                'action' => 'index',
                '?' => ['filter' => 1]
            ])
        ?>
    </li>
    <li
        role="presentation"
        class="<?= $filter == 2 ? 'active' : '' ?>">
        <?=
            $this->Html->link(__('Com estrela'), [
                'action' => 'index',
                '?' => ['filter' => 2]
            ])
        ?>
    </li>
    <li
        role="presentation"
        class="<?= $filter == 3 ? 'active' : '' ?>">
        <?=
            $this->Html->link(__('Arquivados'), [
                'action' => 'index',
                '?' => ['filter' => 3]
            ])
        ?>    
    </li>
</ul>
<br>
<div class="table-responsive">
    <table class="table table-hover">
            <?php
                $truncatePoint = 100;
            ?>
            <?php foreach ($suggestions as $suggestion): ?>
                <tr>
                    <td class="text-center" style="width: 55px;">
                        <span
                            style="cursor: pointer; margin-right: 5px"
                            title="Adiciona estrela"
                            data-toggle="tooltip" data-placement="right"
                            class="
                                text-muted
                                glyphicon
                                <?= $suggestion->is_star ? 'glyphicon-star' : 'glyphicon-star-empty' ?>
                                has-tooltip">
                        </span>

                        <span
                            style="cursor: pointer"
                            title="Arquivar"
                            data-toggle="tooltip" data-placement="right"
                            class="
                                text-muted
                                glyphicon
                                <?= $suggestion->is_read ? 'glyphicon-folder-close' : 'glyphicon-folder-open' ?>
                                has-tooltip">
                        </span>
                    </td>
                    <td style="width: 150px;">
                        <!--<?= $this->Html->link(
                            $this->Text->truncate(h($suggestion->customer->name), 20),
                            [
                                'controller' => 'customers',
                                'action' => 'view',
                                $suggestion->customer->id
                            ]
                        ) ?>-->
                        <?= $this->Text->truncate(h($suggestion->customer->name), 20) ?>
                    </td>
                    <td>
                        <?= $this->Html->link(h($this->Text->truncate(__($suggestion->text), $truncatePoint)), [
                                'controller' => 'suggestions',
                                'action' => 'view',
                                $suggestion->id
                            ]
                        ) ?>
                    </td>
                    <td class="text-center" style="width: 130px">
                        <em class="text-muted">
                            <?= h($suggestion->created->timeAgoInWords(
                                [
                                    'format' => 'dd MMM',
                                    'accuracy' => 'day',
                                    'end' => '+1 year'])) ?>
                        </em>
                    </td>
                </tr>
            <?php endforeach; ?>
    </table>
</div>
<?= $this->element('Common/paginator') ?>