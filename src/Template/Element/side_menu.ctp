<?php

$items = [
	/*[
		'label' => 'Academias',
		'controller' => 'gyms',
		'action' => 'index',
	],*/
	[
		'label' => 'Aulas',
		'controller' => 'services',
		'action' => 'index',
	],
	[
		'label' => 'Usuários',
		'controller' => 'users',
		'action' => 'index',
	],
	[
		'label' => 'Caixa de Sugestão',
		'controller' => 'suggestions',
		'action' => 'index',
	],
	[
		'label' => 'Salas',	
		'controller' => 'rooms',
		'action' => 'index',
	],
	[
		'label' => 'Comunicados',
		'controller' => 'releases',
		'action' => 'index',
	],
]
?>

<div style="padding-top: 10px;padding-bottom: 10px;">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<h4 style="color: #FFF;">Konen</h4>
			</div>
		</div>
	</div>
</div>

<div style="margin-bottom: 20px; background-color: #2980b9; padding-top: 10px; padding-bottom: 10px;">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
			<?= $this->Html->image('avatar.jpg',
				['class' => 'media-object img-circle', 'width' => '40', 'style' => 'margin-right: 5px;'])
			?>
	<span class="" style="color: #FFF;"><strong>Brad Pitt</strong> <em><small>Professor</small></em></span>

	<button data-toggle="dropdown"
		class="dropdown-toggle  pull-right" style="color: white; margin-top: 10px; background: none; border: 0;">
		<span
			class="glyphicon glyphicon-chevron-down">
		</span>
	</button>

	<ul class="dropdown-menu dropdown-menu-right" role="menu">
		<li role="presentation" class="dropdown-header">brad-pitt@gmail.com</li>
		
		<li role="presentation"><a role="menuitem" tabindex="-1" href="#">Configurações de perfil</a></li>
		<li role="presentation"><a role="menuitem" tabindex="-1" href="#">Configurações de conta</a></li>
		<li role="presentation" class="divider"></li>
		<li role="presentation"><a role="menuitem" tabindex="-1" href="#">Sair</a></li>
	</ul>		
			</div>
		</div>
	</div>
</div>

<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			<ul class="side-menu nav nav-pills nav-stacked">
				<?php foreach ($items as $item): ?>
					<li>
						<?= $this->Html->link($item['label'], ['controller' => $item['controller'], 'action' => $item['action']]) ?>
					</li>
				<?php endforeach ?>
			</ul>
		</div>
	</div>
</div>