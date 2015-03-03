<div class="users form large-10 medium-9 columns">
    <?= $this->Form->create($customer,['context' => ['validator' => 'editCustomer']]); ?>

    <fieldset>
    <fieldset>
        <legend><?= __('Editar Aluno') ?></legend>
        <?php
            echo $this->Form->input('name',['label' => 'Nome']);
            echo $this->Form->input('registration',['label' => 'Nº de Registro']);
            echo $this->Form->input('password',['label' => 'Senha']);
            echo $this->Form->input('access_key',['label' => 'Chave de Acesso']);
            echo $this->Form->Label("Status ");            
            echo $this->Form->checkbox('status', array('value' => '1',
                                'hiddenField' => true,
                            ));
             echo $this->Form->input('confirm_password',['label' => 'Senha do Administrador','type'=>'password']);
        ?>
    </fieldset>
   <?= $this->Html->link('Cancelar', ['action' => 'index'], ['class' => 'btn btn-danger']) ?>
       <?= $this->Form->button('Salvar', ['class' => 'btn btn-success btn-lg']) ?>
<?= $this->Form->end() ?>

</div>
