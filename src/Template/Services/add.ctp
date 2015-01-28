<div class="services form large-10 medium-9 columns">
    <?= $this->Form->create($service, ['templates' => $bootstrapFormTemplate]); ?>
    <fieldset>
        <legend><?= __('Adicionar Serviço') ?></legend>
        <?php
            echo $this->Form->input('name', ['label' => 'Nome']);
            echo $this->Form->input('description', ['label' => 'Descrição']);
            /*echo $this->Form->input('begin_service', ['label' => 'Inicio']);
            echo $this->Form->input('end_service', ['label' => 'Termino']);
            echo $this->Form->input('weekdays._ids', ['options' => $weekdays, 'label' => 'Dias da Semana']);*/
        ?>
    </fieldset>
     <?= $this->Form->button('Salvar', ['class' => 'btn btn-success btn-lg']) ?>
      <?= $this->Html->link('Cancelar', ['action' => 'index'], ['class' => 'btn btn-danger']) ?>
<?= $this->Form->end() ?>
</div>
