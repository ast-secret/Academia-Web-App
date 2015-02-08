<div class="users form large-10 medium-9 columns">
    <?= $this->Form->create($release); ?>
    <fieldset>
        <legend><?= __('Editar Comunicado') ?></legend>
        <?php
            echo $this->Form->input('title',['label' => 'Título']);
            echo $this->Form->input('text',['label' => 'Texto']);
        ?>
    </fieldset>
    <?= $this->Html->link('Cancelar', ['action' => 'index'], ['class' => 'btn btn-danger']) ?>
    <?= $this->Form->button('Salvar', ['class' => 'btn btn-success btn-lg']) ?>
    <?= $this->Form->end() ?>
</div>
