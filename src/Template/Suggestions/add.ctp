<?= $this->Form->create($suggestion); ?>
    <fieldset>
        <legend><?= __('Adicionar Sugestão') ?></legend>
        <?php
            echo $this->Form->input('text');
            echo $this->Form->input('customer_id');
        ?>
    </fieldset>    
    <?= $this->Form->button('Salvar', ['class' => 'btn btn-success btn-lg']) ?>
     <?= $this->Html->link('Cancelar', ['action' => 'index'], ['class' => 'btn btn-danger']) ?>
    <?= $this->Form->end() ?>

