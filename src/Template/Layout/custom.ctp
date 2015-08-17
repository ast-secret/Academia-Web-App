<!DOCTYPE html>
<html>
<head>
	<?= $this->Html->charset() ?>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>
		<?= ucwords(str_replace('-', ' ', $this->request->params['gym_slug'])) . $this->fetch('title') ?>
	</title>
	<?= $this->Html->meta('icon') ?>

	<!-- <link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=PT+Serif' rel='stylesheet' type='text/css'> -->

	<?= $this->Html->css('../lib/bootstrap/dist/css/bootstrap.min.css') ?>
	<?= $this->Html->css('app.css') ?>

	<?= $this->Html->script('../lib/jquery/dist/jquery.min.js') ?>
	<?= $this->Html->script('../lib/jquery-ui/jquery-ui.min.js') ?>
	<?= $this->Html->script('../lib/bootstrap/dist/js/bootstrap.min.js') ?>

	<?= $this->Html->script('../lib/jquery.inputmask/dist/jquery.inputmask.bundle.min.js') ?>

	<?= $this->Html->script('common.js') ?>

	<?= $this->fetch('meta') ?>
	<?= $this->fetch('css') ?>
	<?= $this->fetch('script') ?>

	<script>
		$(function(){
			$('.has-tooltip').tooltip();
		});
	</script>
</head>
<body>

	<div class="hidden-md hidden-lg">
		<?= $this->element('top_menu') ?>
	</div>

	<div class="page-wrap">
		<div class="col-left hidden-xs hidden-sm">
			<?= $this->element('side_menu') ?>
		</div>
		<div class="col-right">
			<div class="container-fluid">
				<div class="row">
					<div class="col-md-12">
						<?= $this->fetch('content') ?>			
					</div>
				</div>
			</div>
		</div>
	</div>

</body>
</html>
