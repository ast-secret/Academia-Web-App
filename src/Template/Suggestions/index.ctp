<?= $this->Html->script('Suggestions/index', ['inline' => false]) ?>
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
            <?php if (count($suggestions) > 0): ?>
                <?php foreach ($suggestions as $suggestion): ?>
                    <tr>
                        <td class="text-center" style="width: 55px;">
                            <button
                                id="btn-star"
                                type="button"
                                class="btn-clean"
                                data-has-star="<?= $suggestion->is_star ?>"
                                style="cursor: pointer; margin-right: 5px">
                                <span
                                    title="<?= $suggestion->is_star ? 'Remover estrela' : 'Adicionar estrela' ?>"
                                    class="
                                        text-muted
                                        glyphicon
                                        <?= $suggestion->is_star ? 'glyphicon-star' : 'glyphicon-star-empty' ?>">
                                </span>
                            </button>
                            
                            <button
                                type="button"
                                id="btn-arquivar"
                                class="btn-clean"
                                style="cursor: pointer">
                                <span
                                    title="Arquivar"
                                    class="
                                        text-muted
                                        glyphicon
                                        <?= $suggestion->is_read ? 'glyphicon-folder-close' : 'glyphicon-folder-open' ?>">
                                </span>
                            </button>
                        </td>
                        <td style="width: 150px;">
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
            <?php else: ?>
                <tr>
                    <td colspan="4"><em class="text-muted">Nenhuma sugestão.</em></td>
                </tr>
            <?php endif ?>                
    </table>
</div>
<?= $this->element('Common/paginator') ?>