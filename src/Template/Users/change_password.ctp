<div class="users form large-10 medium-9 columns">
<?= $this->Form->create(); ?>
    <fieldset>
        <legend><?= __('Mudar Senha') ?></legend>
        <?php
         echo $this->Form->input('current-password',['type' => 'password','label' => 'Senha Atual']);
         echo $this->Form->input('new-password',['type' => 'password','label' => 'Nova Senha']);
         echo $this->Form->input('confirm-password',['type' => 'password','label' => 'Confirma Senha']);
        ?>
    </fieldset>
    <?= $this->Form->button('Salvar', ['class' => 'btn btn-success btn-lg']) ?>
    <?= $this->Html->link('Cancelar', ['action' => 'index'], ['class' => 'btn btn-danger']) ?>
<?= $this->Form->end() ?>

