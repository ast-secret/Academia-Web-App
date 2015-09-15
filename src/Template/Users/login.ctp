<?= $this->assign('title', $gym->name . ' - Entrar ') ?>

<div class="" style="border: 1px solid #E7E7E7; border-radius: 6px; padding: 30px;">
	<div class="text-center" style="margin-bottom: 40px;">
		<?= $this->Html->image('logo.png', ['height' => 100]) ?>
	</div>
	<?= $this->Form->create() ?>
		<?= $this->Form->input('username', [
			'label' => false,
			'placeholder' => 'Email',
			'class' => '',
			'autofocus' => true
		]) ?>
		<?= $this->Form->input('password', [
			'label' => false,
			'placeholder' => 'Senha',
			'class' => ''
		]) ?>
		<button type="submit" class="btn btn-default btn-block">
			Entrar
		</button>
	<?= $this->Form->end() ?>

	<div class="text-right" style="margin-top: 30px;">
		<small>
			<a href="#">
				Esqueceu a sua senha?
			</a>
		</small>
	</div>
</div>