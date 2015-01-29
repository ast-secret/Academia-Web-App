<div class="users form large-10 medium-9 columns">
    <?= $this->Form->create($user, ['templates' => $bootstrapFormTemplate]); ?>

        <fieldset>
            <legend><?= __('Adicionar usuário') ?></legend>
            <?php
                echo $this->Form->input('name',['label' => 'Nome']);
                echo $this->Form->input('username',['label' => 'Login']);
                echo $this->Form->input('password',['label' => 'Senha']);
                echo $this->Form->input('password',['label' => 'Confirmar Senha']);
                echo $this->Form->input('role_id', ['options' => $roles, 'label' => 'Acesso']);
            ?>
        </fieldset>
          <?= $this->Form->button('Salvar', ['class' => 'btn btn-success btn-lg']) ?>
    <?= $this->Html->link('Cancelar', ['action' => 'index'], ['class' => 'btn btn-danger']) ?>
<?= $this->Form->end() ?>

</div>
