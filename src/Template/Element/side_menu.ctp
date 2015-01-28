<?php

$items = [
	[
		'label' => 'Academias',
		'controller' => 'gyms',
		'action' => 'index',
	],
	[
		'label' => 'Usuários',
		'controller' => 'users',
		'action' => 'index',
	],
	[
		'label' => 'Fichas',
		'controller' => 'cards',
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