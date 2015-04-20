<?= $this->Element('Common/dashboard_breadcrumb', ['breadcrumb' => $breadcrumb]) ?>

<?= $this->Form->create($user); ?>
    <?= $this->Element('Users/form') ?>
    <hr>
    <?= $this->Form->input('id') ?>
    <?= $this->element('Common/form_actions', ['submitText' => 'Salvar Alterações']) ?>
<?= $this->Form->end() ?>
