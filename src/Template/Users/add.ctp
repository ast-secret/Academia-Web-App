<div class="">
    <?= $this->Form->create($user, ['templates' => $formTemplates]); ?>

        <fieldset>
            <legend><?= __('Adicionar usuário') ?></legend>
            <?php
                echo $this->Form->input('gym_id', ['options' => $gyms]);
                echo $this->Form->input('role_id', ['options' => $roles]);
                echo $this->Form->input('name');
                echo $this->Form->input('username');
                echo $this->Form->input('password');
            ?>
        </fieldset>
        <?= $this->Html->link('Cancelar', ['action' => 'index'], ['class' => 'btn btn-danger']) ?>
        <button type="submit" class="btn btn-success btn-lg">Salvar</button>
    <?= $this->Form->end() ?>
</div>
