
<div class="rooms form large-10 medium-9 columns">
    <?= $this->Form->create($room); ?>
    <fieldset>
        <legend><?= __('Add Room') ?></legend>
        <?php
            echo $this->Form->input('name');
            echo $this->Form->input('gym_id', ['options' => $gyms]);
            echo $this->Form->input('description');
        ?>
    </fieldset>
    <?= $this->Form->button('Salvar', ['class' => 'btn btn-success btn-lg']) ?>
      <?= $this->Html->link('Cancelar', ['action' => 'index'], ['class' => 'btn btn-danger']) ?>
<?= $this->Form->end() ?>
</div>
