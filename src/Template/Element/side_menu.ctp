<?php

$items = [
	/*[
		'label' => 'Academias',
		'controller' => 'gyms',
		'action' => 'index',
	],*/
	[
		'label' => 'Usuários',
		'controller' => 'users',
		'action' => 'index',
	],
	[
		'label' => 'Fichas',
		'controller' => 'cards',
		'action' => 'index',
	],
	[
		'label' => 'Caixa de Sugestão',
		'controller' => 'suggestions',
		'action' => 'index',
	],
	[
		'label' => 'Aulas',
		'controller' => 'services',
		'action' => 'index',
	],
	[
		'label' => 'Sala de Aula',
		'controller' => 'rooms',
		'action' => 'index',
	],
	[
		'label' => 'Serviço',
		'controller' => 'services',
		'action' => 'index',
	]/*,
	[
		'label' => 'Dias da Semana',
		'controller' => 'weekdays',
		'action' => 'index',
	]*/,
	[
		'label' => 'Comunicados',
		'controller' => 'releases',
		'action' => 'index',
	],
	[
		'label' => 'Horario e Dia dos Serviços',
		'controller' => 'Servicesweekdays',
		'action' => 'index',
	]

]
?>


<ul class="nav nav-pills nav-stacked">
	<?php foreach ($items as $item): ?>
		<li>
			<?= $this->Html->link($item['label'], ['controller' => $item['controller'], 'action' => $item['action']]) ?>
		</li>
	<?php endforeach ?>
</ul>