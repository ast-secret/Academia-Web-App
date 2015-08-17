<?= $this->assign('title', ' - Criar Usuário') ?>

<?php 
	$this->Html->addCrumb('Usuários', ['action' => 'index']);
    $this->Html->addCrumb('Criar usuário');
    echo $this->Html->getCrumbList();
?>
<br>

<?= $this->Form->create($user, ['horizontal' => true, 'novalidate' => true]); ?>
    <?php
        echo $this->Form->input('name',['label' => 'Nome']);
        echo $this->Form->input('username',['label' => 'Email']);
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
    <hr>
    <?= $this->Form->submit('Criar Usuário') ?>
<?= $this->Form->end() ?>
