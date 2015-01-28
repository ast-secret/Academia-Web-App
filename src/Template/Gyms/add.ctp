<?= $this->Form->create($gym, ['templates' => $bootstrapFormTemplate]); ?>
    <fieldset>
        <legend><?= __('Adicionar academia') ?></legend>
        <?php
            echo $this->Form->input('name',['label' => 'Nome']);
            echo $this->Form->input('description',['label' => 'Descrição']);
            echo $this->Form->input('address',['label' => 'Endereço']);
            echo $this->Form->input('cover_img',['label' => 'Imagem Cover ??']);
            echo $this->Form->input('logo_img',['label' => 'Logo da Academia']);
        ?>
    </fieldset>
    <?= $this->Form->button('Salvar', ['class' => 'btn btn-success btn-lg']) ?>
    <?= $this->Html->link('Cancelar', ['action' => 'index'], ['class' => 'btn btn-danger']) ?>
<?= $this->Form->end() ?>
