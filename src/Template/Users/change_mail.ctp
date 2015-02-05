<div class="users form large-10 medium-9 columns">
<?= $this->Form->create(); ?>
    <fieldset>
        <legend><?= __('Mudar Email') ?></legend>
        <?php
         echo $this->Form->input('mail',['label' => 'Email', 'value' => h($mail) ]);
        ?>
    </fieldset>
    <?= $this->Form->button('Salvar', ['class' => 'btn btn-success btn-lg']) ?>
    <?= $this->Html->link('Cancelar', ['action' => 'index'], ['class' => 'btn btn-danger']) ?>
<?= $this->Form->end() ?>

