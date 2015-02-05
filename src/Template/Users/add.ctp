<div class="">
    <?= $this->Form->create($user); ?>

        <fieldset>
            <legend><?= __('Adicionar usuário') ?></legend>
            <?php
                echo $this->Form->input('name',['label' => 'Nome']);
                echo $this->Form->input('username',['label' => 'Login']);
                echo $this->Form->input('password',['label' => 'Senha']);
                echo $this->Form->input('confirm_password',['type' => 'password','label' => 'Confirmar Senha']);
                echo $this->Form->input('role_id', ['options' => $roles, 'label' => 'Função']);
                echo $this->Form->Label("Status ");            
                echo $this->Form->checkbox('stats',array('value'=>'1', 'hiddenField'=>'0'));
            ?>
        </fieldset>
          <?= $this->Form->button('Salvar', ['class' => 'btn btn-success btn-lg']) ?>
    <?= $this->Html->link('Cancelar', ['action' => 'index'], ['class' => 'btn btn-danger']) ?>
<?= $this->Form->end() ?>

</div>
