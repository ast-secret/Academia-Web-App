<?= $this->Element('Common/dashboard_breadcrumb', ['breadcrumb' => $breadcrumb]) ?>

<?= $this->Form->create($user); ?>
    <?= $this->Element('Users/form') ?>
    <hr>
    <?= $this->Html->link('Cancelar', ['action' => 'index'], ['class' => 'btn btn-default']) ?>
    <?= $this->Form->button('Salvar informações', ['class' => 'btn btn-success btn-success']) ?>
<?= $this->Form->end() ?>
