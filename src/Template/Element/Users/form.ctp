<div class="row">
    <div class="col-md-5">
        <?php
            echo $this->Form->input('username',['label' => 'Email']);
        ?>
        <?php
            echo $this->Form->input('name',['label' => 'Nome']);
            echo $this->Form->input('role_id', [
                'empty' => 'Selecione:',
                'options' => $roles, 'label' => 'Função'
            ]);
            echo $this->Form->input('password', ['label' => 'Senha']);
            echo $this->Form->input('confirm_password', ['type' => 'password', 'label' => 'Confirmar Senha']);
            
            echo $this->Form->Label("Ativo");
            echo $this->Form->checkbox('is_active', [
                'value' => '1',
                'hiddenField' => true,
            ]);
        ?>
        <!-- <hr>
        <div class="well">
            <?= $this->Form->input('user_password_confirm', ['label' => false]) ?>
            <p class="help-block">
                <strong><?= explode(' ', $nameLoggedinUser)[0] ?></strong>, por segurança você precisa confirmar a sua senha para criar o usuário.
            </p>
        </div> -->
    </div>
</div>