<div class="users form large-10 medium-9 columns">
    <?= $this->Form->create($release, ['templates' => $bootstrapFormTemplate]); ?>

    <fieldset>
        <legend><?= __('Adicionar Comunicado') ?></legend>
        <?php            
            echo $this->Form->input('title',['label' => 'Título']);
            echo $this->Form->input('text',['label' => 'Texto']);
        ?>
    </fieldset>
    <?= $this->Form->button('Salvar', ['class' => 'btn btn-success btn-lg']) ?>
     <?= $this->Html->link('Cancelar', ['action' => 'index'], ['class' => 'btn btn-danger']) ?>
    <?= $this->Form->end() ?>
