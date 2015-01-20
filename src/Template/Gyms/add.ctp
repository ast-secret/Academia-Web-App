<?= $this->Form->create($gym); ?>
    <fieldset>
        <legend><?= __('Adicionar academia') ?></legend>
        <?php
            echo $this->Form->input('name');
            echo $this->Form->input('description');
            echo $this->Form->input('address');
            echo $this->Form->input('cover_img', ['type' => 'date']);
            echo $this->Form->input('logo_img');
        ?>
    </fieldset>
    <?= $this->Html->link('Cancelar', ['action' => 'index'], ['class' => 'btn btn-danger']) ?>
    <?= $this->Form->button('Salvar', ['class' => 'btn btn-success btn-lg']) ?>
<?= $this->Form->end() ?>
