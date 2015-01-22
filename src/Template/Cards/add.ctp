<?= $this->Form->create($card, ['templates' => $formTemplates]); ?>
<fieldset>
    <legend><?= __('Adicionar ficha') ?></legend>
    <?php
        echo $this->Form->input('user_id', ['options' => $users]);
        echo $this->Form->input('start_date');
        echo $this->Form->input('end_date');
        echo $this->Form->input('goal');
        echo $this->Form->input('customer_id', ['options' => $customers]);
        echo $this->Form->input('obs');
        echo $this->Form->input('current');
        echo $this->Form->input('exercises._ids', ['options' => $exercises]);
    ?>
</fieldset>
 <?= $this->Form->button('Salvar', ['class' => 'btn btn-success btn-lg']) ?>
 <?= $this->Html->link('Cancelar', ['action' => 'index'], ['class' => 'btn btn-danger']) ?>
   <?= $this->Form->end() ?>