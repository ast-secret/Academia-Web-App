<div class="row">
    <div class="col-md-5">
        <?php
            echo $this->Form->input('username',['label' => 'Email']);
            echo $this->Form->input('name',['label' => 'Nome']);
            echo $this->Form->input('role_id', [
                'empty' => 'Selecione:',
                'options' => $roles, 'label' => 'Função'
            ]);
            echo $this->Form->input('password', ['label' => 'Senha']);
            echo $this->Form->input('confirm_password', ['type' => 'password', 'label' => 'Confirmar Senha']);
            
            echo $this->Form->Label("Status ");
            echo $this->Form->checkbox('stats', [
                'value' => '1',
                'hiddenField' => true,
            ]);
        ?>
    </div>
</div>