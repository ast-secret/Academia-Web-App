<?= $this->assign('title', 'Requisitar Redefinição de Senha') ?>

<?= $this->Form->create() ?>
	<?= $this->Form->input('email', [
		'type' => 'email',
		'required' => true,
		'autocomplete' => 'off',
		'label' => false,
		'placeholder' => 'Email',
		'class' => 'input-lg',
		'autofocus' => true,
		'prepend' => '@'
	]) ?>
	<button type="submit" class="btn btn-primary btn-block btn-lg">
		Redefinir Senha
	</button>
<?= $this->Form->end() ?>