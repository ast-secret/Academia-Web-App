<script type="text/javascript">
	$(function(){
		$('button#resize-full').click(function(){
			var $this = $(this);
			var $element = $this.parents('tr').next('tr#more');

			$element.stop().toggle();
			var newClass = $element.is(':visible') ? 
				'glyphicon glyphicon-resize-small' :
				'glyphicon glyphicon-resize-full';
			$this.children('span').removeClass().addClass(newClass);	
			
		});
	});
</script>
<?= $this->Html->link('Adicionar Ficha', ['action' => 'add', $customer_id], ['class' => 'btn btn-primary'])?>
<hr>
<table class="table table-hover table-bordered">
	<thead>
		<tr>
			<th>#</th>
			<th>
				Instrutor responsável
			</th>
			<th>Objetivo</th>
			<th>Observação</th>
			<th>Validade</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		<?php $i = 0; ?>
		<?php foreach ($cards as $key => $card): ?>
			<?php if ($i == 1): ?>
				<tr class="active">
					<td colspan="7">
						<h4>Histórico</h4>
					</td>
				</tr>
			<?php endif ?>
			<tr class="<?= $i > 0 ? 'danger' : '' ?>">
				<td><?= $card->id ?></td>
				<td>
					<?= $card->user->name ?>
				</td>
				<td>
					<?= $card->goal ?>
				</td>
				<td>
					<?php if ($card->obs): ?>
						 <?= $card->obs ?>
					<?php else: ?>
						<em>Nenhuma observação a fazer</em>
					<?php endif ?>
				</td>
				<td><em>Faltam 4 dias para o vencimento</em></td>
				<td class="text-center">
					<?= $this->Html->link(
						'<span class="glyphicon glyphicon-eye-open"></span>',
						['action' => 'view', $card->id],
						['class' => 'btn btn-default btn-xs', 'escape' => false]) ?>
					<?= $this->Html->link(
						'<span class="glyphicon glyphicon-pencil"></span>',
						['action' => 'edit'],
						['class' => 'btn btn-default btn-xs', 'escape' => false]) ?>

					<button type="button" class="btn btn-default btn-xs" id="resize-full">
						<span class="glyphicon glyphicon-resize-full"></span>
					</button>
				</td>
			</tr>
			<?php if ($card->exercises_groups): ?>	
				<tr id="more" style="display: none;" class="<?= $i > 0 ? 'danger' : '' ?>">
					<td colspan="7">
						<div class="row">
							<?php foreach ($card->exercises_groups as $group): ?>
								<div class="col-md-4">
									<h4>
										<?= $group->name ?>
									</h4>
									<?php foreach ($group->exercises as $exercise): ?>
										<span class="label label-primary"><?= $exercise->name ?></span>
									<?php endforeach ?>
								</div>
							<?php endforeach ?>
						</div>
					</td>
				</tr>
			<?php else: ?>
				<tr id="more" style="display: none;" class="<?= $i === 0 ? 'danger' : '' ?>">
					<td colspan="7">
						<em>Sem exercícios cadastrados</em>
					</td>	
				</tr>
			<?php endif ?>
			<?php $i++; ?>
		<?php endforeach ?>
	</tbody>
</table>