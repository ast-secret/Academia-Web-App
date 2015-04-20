<?= $this->Element('Common/dashboard_breadcrumb', ['breadcrumb' => $breadcrumb]) ?>

<?= $this->Form->create($user); ?>
    <?= $this->Element('Users/form') ?>
    <hr>
    <?= $this->element('Common/form_actions', ['submitText' => 'Salvar Informações']) ?>
<?= $this->Form->end() ?>
