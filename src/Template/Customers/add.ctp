<?= $this->element('Common/dashboard_breadcrumb') ?>
<div class="row">
    <div class="col-md-6">
        <?= $this->Form->create($customer); ?>
            <?= $this->element('Customers/form') ?>
            <?= $this->element('Common/form_actions', ['submitText' => 'Salvar informações']) ?>
        <?= $this->Form->end() ?>
    </div>
</div>