<?= $this->assign('title', ' - Configurações de senha') ?>

<?php 
	$this->Html->addCrumb('Configurações de senha');
	echo $this->Html->getCrumbList();
?>


<br style="clear: both;">

<ul class="nav nav-tabs">
    <li>
        <?= $this->Html->link('Conta', ['action' => 'mySettings']) ?>
    </li>
    <li class="active">
        <?= $this->Html->link('Senha', [
        	'action' => 'myPasswordSettings'
        ]) ?>
    </li>
</ul>

<br>
<br>

<?php
	echo $this->Form->create($user, ['novalidate' => true, 'horizontal' => true]);
		echo $this->Form->input('new_password', ['label' => 'Nova Senha', 'type' => 'password']);
		echo $this->Form->input('confirm_new_password', [
			'label' => 'Confirmar nova senha',
			'type' => 'password'
		]);

		echo '<hr>';
		echo $this->Form->input('current_password', [
			'type' => 'password',
			'label' => 'Senha',
			'help' => 'Confirme a sua senha atual para alterá-la'
		]);
		echo '<hr>';
		echo $this->Form->submit('Salvar alterações');
	echo $this->Form->end();
?>	