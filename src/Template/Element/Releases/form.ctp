<?php
    $update = !isset($update) ? false : $update;
?>
<?= $this->Form->create($release); ?>
    <?php            
        echo $update ? $this->Form->input('id') : '';
        echo $this->Form->input('title',['label' => 'Título']);
        echo $this->Form->input('text',['label' => 'Texto', 'type' => 'textarea', 'rows' => 8]);
    ?>
    <div style="margin-top: 20px;">
        <hr>
        <?= $this->Html->link(__('Cancelar'), ['action' => 'index'], ['class' => 'btn btn-default']) ?>
        <?= $this->Form->button(__('Salvar informações'), ['class' => 'btn btn-success']) ?>
    </div>
<?= $this->Form->end() ?>