<br>
<?php 
	$this->Html->addCrumb('Usuários', ['action' => 'index']);
    $this->Html->addCrumb('Criar usuário');
    echo $this->Html->getCrumbList();
?>
<br>

<?= $this->Form->create($user, ['novalidate' => true]); ?>

<div class="row">
    <div class="col-md-5">
        <?php
            echo $this->Form->input('username',['label' => 'Email']);
        ?>
        <?php
            echo $this->Form->input('name',['label' => 'Nome']);
            echo $this->Form->input('role_id', [
                'empty' => 'Selecione:',
                'label' => 'Função',
                'options' => $roles
            ]);
            echo $this->Form->input('password', ['label' => 'Senha']);
            echo $this->Form->input('confirm_password_add', [
            	'type' => 'password',
            	'label' => 'Confirmar Senha'
            ]);
        ?>
    </div>
</div>

    <hr>
    <?= $this->element('Common/form_actions', ['submitText' => 'Criar usuário']) ?>
<?= $this->Form->end() ?>
