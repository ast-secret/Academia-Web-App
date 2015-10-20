<?= $this->assign('title', 'Requisitar Redefinição de Senha') ?>

<?= $this->Form->create($user) ?>
	<?= $this->Form->input('new_password', [
		'type' => 'password',
		'required' => true,
		'autocomplete' => 'off',
		'label' => false,
		'placeholder' => 'Nova Senha',
		'class' => 'input-lg',
		'autofocus' => true,
		'prepend' => $this->Html->icon('lock')
	]) ?>
	<?= $this->Form->input('confirm_new_password', [
		'type' => 'password',
		'required' => true,
		'autocomplete' => 'off',
		'label' => false,
		'placeholder' => 'Confirmar Nova Senha',
		'class' => 'input-lg',
		'autofocus' => true,
		'prepend' => $this->Html->icon('lock')
	]) ?>
	<button type="submit" class="btn btn-primary btn-block btn-lg">
		Redefinir Senha
	</button>
<?= $this->Form->end() ?>