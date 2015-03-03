<div class="users form large-10 medium-9 columns">
<?= $this->Form->create($user, [
    'context' => [
        'validator' => 'EditUser'
    ]
]); ?>
    <fieldset>
        <legend><?= __('Editar Usuário') ?></legend>
        <?php
            echo $this->Form->input('name', ['label' => 'Nome']);
            echo $this->Form->input('username', ['label' => 'Usuário']);
            echo $this->Form->input('password', ['label' => 'Senha']);
            echo $this->Form->input('role_id', ['options' => $roles, 'label' => 'Função']);
             echo $this->Form->Label("Status ");            
                echo $this->Form->checkbox('stats', array('value' => '1',
                                'hiddenField' => true,
                            ));
            echo $this->Form->input('confirm_password_user_master',['type' => 'password','label' => 'Confirmar Senha']);    
        ?>
    </fieldset>
    <?= $this->Html->link('Cancelar', ['action' => 'index'], ['class' => 'btn btn-danger']) ?>
       <?= $this->Form->button('Salvar', ['class' => 'btn btn-success btn-lg']) ?>
<?= $this->Form->end() ?>

</div>
