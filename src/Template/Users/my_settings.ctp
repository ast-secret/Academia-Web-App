<?= $this->assign('title', ' - Configurações de conta') ?>

<br>
<?php 
	$this->Html->addCrumb('Configurações de conta');
	echo $this->Html->getCrumbList();
?>


<br style="clear: both;">

<ul class="nav nav-tabs">
    <li class="active">
        <?= $this->Html->link('Conta', ['action' => 'my_settings']) ?>
    </li>
    <li>
        <?= $this->Html->link('Senha', [
        	'action' => 'my_password_settings'
        ]) ?>
    </li>
</ul>

<br>
<br>

<?php
	echo $this->Form->create($user, ['novalidate' => true, 'horizontal' => true]);
		echo $this->Form->input('name', ['label' => 'Nome']);
		echo $this->Form->input('username', ['label' => 'Email']);

		echo $this->Form->input('is_active', ['label' => 'Ativo', 'type' => 'checkbox']);

		echo '<hr>';
		echo $this->Form->input('current_password_confirm', [
			'type' => 'password',
			'label' => 'Senha',
			'help' => 'Confirme a sua senha atual para alterar os dados acima'
		]);

		echo $this->Form->submit('Salvar alterações');
	echo $this->Form->end();
?>	