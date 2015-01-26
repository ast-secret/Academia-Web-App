<div class="services form large-10 medium-9 columns">
    <?= $this->Form->create($service); ?>
    <fieldset>
        <legend><?= __('Adicionar Serviço') ?></legend>
        <?php
            echo $this->Form->input('gym_id', ['options' => $gyms]);
            echo $this->Form->input('name');
            echo $this->Form->input('description');
            echo $this->Form->input('begin_service');
            echo $this->Form->input('end_service');
            echo $this->Form->input('weekdays._ids', ['options' => $weekdays]);
        ?>
    </fieldset>
     <?= $this->Form->button('Salvar', ['class' => 'btn btn-success btn-lg']) ?>
      <?= $this->Html->link('Cancelar', ['action' => 'index'], ['class' => 'btn btn-danger']) ?>
<?= $this->Form->end() ?>
</div>
