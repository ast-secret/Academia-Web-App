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
			<strong>Validade: </strong> <?= $card->end_date_in_words ?>
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
</table>
	<?php $columnName = ['A', 'B', 'C', 'D', 'E', 'F'] ?>
	
	<div class="row">
		<?php foreach ($exercisesByGroup as $group => $exercises): ?>
			<div class="col-md-3" >
				<div style="background-color: #EEE;padding: 8px;">
					<strong>Grupo <?= $columnName[$group] ?></strong>
				</div>
				<?php foreach ($exercises as $exercise): ?>
					<div style="padding: 8px;">
						<?= $exercise->name ?>
					</div>
				<?php endforeach ?>
			</div>
		<?php endforeach ?>
	</div>