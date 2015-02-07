<div class="rooms form large-10 medium-9 columns">
    <?= $this->Form->create(); ?>
    <fieldset>
        <legend><?= __('Adicionar Sala') ?></legend>
        <?php
            echo $this->Form->input('name', ['label' => 'Nome']);
            
            echo $this->Form->input('description', ['label' => 'Descrição']);
        ?>
    </fieldset>
    <?= $this->Form->button('Salvar', ['class' => 'btn btn-success btn-lg']) ?>
      <?= $this->Html->link('Cancelar', ['action' => 'index'], ['class' => 'btn btn-danger']) ?>
<?= $this->Form->end() ?>
</div>
