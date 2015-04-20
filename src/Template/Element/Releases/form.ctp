<?php
    $update = !isset($update) ? false : $update;
?>
<?= $this->Form->create($release); ?>
    <div class="row">
        <div class="col-md-12">
            <?= $this->Form->input('text',['label' => 'Texto', 'type' => 'textarea', 'rows' => 8, 'maxlength' => false]) ?>  
            <p id="container-counter" class="help-block"></p>
            <hr>
            <?= $this->Form->input('is_active', ['label' => 'Publicar']) ?>  

        </div>
    </div>

    <hr>
    <div class="row" style="margin-top: 20px;">
        <div class="col-md-6">
            <?= $this->Html->link(__('Cancelar'), ['action' => 'index'], ['class' => 'btn btn-default']) ?>
        </div>
        <div class="col-md-6 text-right">
            <?= $this->Form->button(__('Salvar informações'), ['class' => 'btn btn-success']) ?>
        </div>
    </div>
<?= $this->Form->end() ?>