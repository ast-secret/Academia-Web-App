    <?= $this->Form->create($lesson); ?>
    <fieldset>
        <legend><?= __('Adicionar Aulas') ?></legend>
        <?php
            echo $this->Form->input('start_time');
            echo $this->Form->input('end_time');
            echo $this->Form->input('date');
            echo $this->Form->input('service_id', ['options' => $services]);
            echo $this->Form->input('room_id', ['options' => $rooms]);
            echo $this->Form->input('availables');
        ?>
    </fieldset>
 <?= $this->Html->link('Cancelar', ['action' => 'index'], ['class' => 'btn btn-danger']) ?>
    <?= $this->Form->button('Salvar', ['class' => 'btn btn-success btn-lg']) ?>
<?= $this->Form->end() ?>