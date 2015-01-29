<div class="users form large-10 medium-9 columns">
<?= $this->Form->create($user, ['templates' => $bootstrapFormTemplate]); ?>
    <fieldset>
        <legend><?= __('Mudar Senha') ?></legend>
        <?php
            echo $this->Form->input('password',['label' => 'Senha Atual']);          
            echo $this->Form->input('password',['label' => 'Senha Nova']);          
            echo $this->Form->input('password',['label' => 'Confirmar Senha']);          
        ?>
    </fieldset>
    <?= $this->Form->button('Salvar', ['class' => 'btn btn-success btn-lg']) ?>
    <?= $this->Html->link('Cancelar', ['action' => 'index'], ['class' => 'btn btn-danger']) ?>
<?= $this->Form->end() ?>
