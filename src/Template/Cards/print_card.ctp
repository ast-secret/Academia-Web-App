<?= $this->assign('title', ' - Fichas de exercícios de ' . $card->customer->name) ?>

<table class="table table-condensed">
	<tr>
		<td>
			<strong>Nome: </strong> <?= $card->customer->name ?>
		</td>
	</tr>
	<tr>
		<td>
			<strong>Objetivo: </strong> <?= $card->goal ?>
		</td>
	</tr>
	<tr>
		<td>
			<strong>Validade: </strong> <?= $this->Time->timeAgoInWords($card->end_date) ?>
		</td>
	</tr>
	<tr>
		<td>
			<strong>Instrutor: </strong> <?= $card->user->name ?>
		</td>
	</tr>
	<?php if ($card->obs): ?>
		<tr>
			<td>
				<p class="text-center" style="padding: 15px;">
					<em><?= $card->obs ?></em>
				</p>
			</td>
		</tr>
	<?php endif ?>
	<?php foreach ($card->exercises_groups as $group): ?>
		<tr style="background-color: #EEE;">
			<td>
				<strong><?= $group->name ?></strong>
			</td>
		</tr>
		<?php foreach ($group->exercises as $exercise): ?>
			<tr>
				<td>
					<?= $exercise->name ?>
				</td>
			</tr>
		<?php endforeach ?>
	<?php endforeach ?>
</table>