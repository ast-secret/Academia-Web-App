<?= $this->Html->script('../lib/niceCharCounter/dist/jquery.niceCharCounter', ['inline' => false]) ?>

<script type="text/javascript">
	$(function(){
		$('#text').niceCharCounter({
			max: 800,
			warningPercent: 10,
			warningColor: '#e67e22',
			text: "{{residual}} caractere(s) restante(s).",
			containerText: '#container-counter',
		});
	});
</script>

<?= $this->element('common/dashboard_breadcrumb', ['breadcrumb' => $breadcrumb]); ?>

<?= $this->Element('Releases/form') ?>