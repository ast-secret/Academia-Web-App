<?= $this->assign('title', $gym->name . ' - Entrar ') ?>

<?= $this->Form->create() ?>
	<?= $this->Form->input('username', [
		'label' => false,
		'placeholder' => 'Email',
		'class' => 'input-lg',
		'autofocus' => true,
		'prepend' => '@'
	]) ?>
	<?= $this->Form->input('password', [
		'label' => false,
		'class' => 'input-lg',
		'placeholder' => 'Senha',
		'prepend' => $this->Html->icon('lock')
	]) ?>
	<button type="submit" class="btn btn-primary btn-block btn-lg">
		Entrar
	</button>
<?= $this->Form->end() ?>

<div class="text-right" style="margin-top: 30px;">
	<small>
		<?= $this->Html->link('Esqueceu a senha?', [
			'controller' => 'Users',
			'action' => 'requestPasswordReset'
		]) ?>
	</small>
</div>