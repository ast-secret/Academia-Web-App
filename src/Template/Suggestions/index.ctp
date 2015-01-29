<hr>
    <table  class="table table-striped">
    <thead>
        <tr>
            
            <th><?= $this->Paginator->sort('text', 'Sugestão') ?></th>
            <th><?= $this->Paginator->sort('created', 'Criado em') ?></th>
            
            <th><?= $this->Paginator->sort('customer_id', 'Aluno') ?></th>
           
        </tr>
    </thead>
    <tbody>
    <?php foreach ($suggestions as $suggestion): ?>
        <tr>
            
            <td><?= h($suggestion->text) ?></td>
            <td><?= h($suggestion->created) ?></td>
           
            <td>
                <?= $suggestion->has('customer') ? $this->Html->link($suggestion->customer->name, ['controller' => 'Customers', 'action' => 'view', $suggestion->customer->id]) : '' ?>
            </td>
          
        </tr>

    <?php endforeach; ?>
    </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->prev('< ' . __('Anterior')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('Próximo') . ' >') ?>
        </ul>
        <p><?= $this->Paginator->counter() ?></p>
    </div>
</div>
