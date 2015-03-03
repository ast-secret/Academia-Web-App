<?= $this->element('common/dashboard_breadcrumb', ['breadcrumb' => $breadcrumb]); ?>

<div class="row">
<<<<<<< HEAD
    <div class="col-md-6">
        <?= $this->Element('Releases/form') ?>
=======
    <div class="col-md-6 col-sm-12">
        <?= $this->Form->create($release); ?>
            <?php            
                echo $this->Form->input('title',['label' => 'Título']);
                echo $this->Form->input('text',['label' => 'Texto']);
            ?>
            <?= $this->Html->link('Cancelar', ['action' => 'index'], ['class' => 'btn btn-danger']) ?>
            <?= $this->Form->button('Salvar', ['class' => 'btn btn-success btn-lg']) ?>
        <?= $this->Form->end() ?>
>>>>>>> 0a64914aee841e1ebe137e26f52d47c52bfc84c8
    </div>
</div>