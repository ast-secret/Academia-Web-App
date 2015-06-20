<?php

$items = [
	[
		'label' => 'Clientes',
		'controller' => 'Customers',
		'action' => 'index',
	],
	[
		'label' => 'Aulas',
		'controller' => 'Services',
		'action' => 'index',
	],
	[
		'label' => 'Comunicados',
		'controller' => 'Releases',
		'action' => 'index',
	],
	[
		'label' => 'Caixa de Sugestões',
		'controller' => 'Suggestions',
		'action' => 'index',
	],
	[
		'label' => 'Usuários',
		'controller' => 'Users',
		'action' => 'index',
	],
]
?>

<div style="padding-top: 10px;padding-bottom: 10px;">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-12">
				<h4 style="color: #FFF;">
					<?= ucwords(str_replace('-', ' ', $this->request->params['gym_slug'])) ?>
				</h4>
			</div>
		</div>
	</div>
</div>

<div style="margin-bottom: 20px; background-color: #2980b9; padding-top: 10px; padding-bottom: 10px;">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-10">
				<div class="media">
					<div class="media-left">
						<?= $this->Html->image('avatar.jpg',
							['class' => 'media-object img-circle', 'width' => '40px', 'style' => 'margin-right: 5px;'])
						?>
					</div>
					<div class="media-body">
						<span class="" style="color: #FFF;">
							<strong><?= $loggedinUser['name'] ?></strong>
							<br>
							<em>
								<small>
									<?= $loggedinUser['role']['name'] ?>
								</small>
							</em>
						</span>
					</div>
				</div>
			</div>	
			<div class="col-md-2 text-center">
				<button data-toggle="dropdown"
					class="dropdown-toggle  pull-right" style="color: white; margin-top: 10px; background: none; border: 0;">
					<span
						class="glyphicon glyphicon-chevron-down">
					</span>
				</button>

				<ul class="dropdown-menu dropdown-menu-right" role="menu">
					<li role="presentation" class="dropdown-header">brad-pitt@gmail.com</li>
					
					<li role="presentation"><a role="menuitem" tabindex="-1" href="#">Configurações de perfil</a></li>
					<li role="presentation">
						<?= $this->Html->link('Configurações de conta', ['controller' => 'users', 'action' => 'change_password'], ['role' => 'menuitem', 'tabindex' => -1]) ?>
					</li>
					<li role="presentation" class="divider"></li>
					<li role="presentation">
						<!-- <a role="menuitem" tabindex="-1" href="#">Sair</a> -->
						<?= $this->Html->link('Sair', ['controller' => 'users', 'action' => 'logout']) ?>
					</li>
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