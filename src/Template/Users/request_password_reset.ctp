<?= $this->assign('title', 'Requisitar Redefinição de Senha') ?>

<div class="text-center" style="margin-bottom: 40px;">
	<?= $this->Html->image($logoPath, ['height' => 100, 'url' => ['action' => 'login']]) ?>
</div>

<div class="row">
	<div class="col-md-12">
		<?= $this->Flash->render(); ?>
	</div>
</div>

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