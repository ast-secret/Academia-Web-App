<?= $this->assign('title', ' - Editar usuário') ?>

<br>
<?php 
	$this->Html->addCrumb('Usuários', ['action' => 'index']);
    $this->Html->addCrumb('Editar usuário');
    echo $this->Html->getCrumbList();
?>
<br>

<?= $this->Form->create($user, ['novalidate' => true]); ?>
	<div class="row">
	    <div class="col-md-6">
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
	    </div>
	</div>
    <hr>
    <?= $this->Form->submit('Salvar alterações') ?>
<?= $this->Form->end() ?>
