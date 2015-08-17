<?= $this->assign('title', ' - Editar Usuário') ?>

<?php 
	$this->Html->addCrumb('Usuários', ['action' => 'index']);
    $this->Html->addCrumb('Editar Usuário');
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
    <?= $this->Form->submit('Salvar Alterações') ?>
<?= $this->Form->end() ?>
