<?= $this->assign('title', ' - Editar usuário') ?>

<?php 
	$this->Html->addCrumb('Usuários', ['action' => 'index']);
    $this->Html->addCrumb('Editar usuário');
    echo $this->Html->getCrumbList();
?>
<br>

<?= $this->Form->create($user, ['horizontal' => true, 'novalidate' => true]); ?>
    <?php
        echo $this->Form->input('role_id', [
            'empty' => 'Selecione:',
            'label' => 'Função',
            'options' => $roles
        ]);
        // echo $this->Form->input('password', ['label' => 'Senha']);
        // echo $this->Form->input('confirm_password_add', [
        // 	'type' => 'password',
        // 	'label' => 'Confirmar Senha'
        // ]);
        echo $this->Form->input('is_active', ['label' => 'Ativo']);
    ?>
    <hr>
    <?= $this->Form->submit('Salvar Alterações', [
    	'bootstrap-type' => 'primary',
    	'class' => 'pull-right'
    ]) ?>
<?= $this->Form->end() ?>
