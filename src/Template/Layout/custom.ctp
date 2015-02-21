<!DOCTYPE html>
<html>
<head>
	<?= $this->Html->charset() ?>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>
		<?= $this->fetch('title') ?>
	</title>
	<?= $this->Html->meta('icon') ?>

	<?= $this->Html->css('../lib/bootstrap/dist/css/bootstrap.min.css') ?>
	<?= $this->Html->css('app.css') ?>

	<?= $this->Html->script('../lib/jquery/dist/jquery.min.js') ?>
	<?= $this->Html->script('../lib/jquery-ui/jquery-ui.min.js') ?>
	<?= $this->Html->script('../lib/bootstrap/dist/js/bootstrap.min.js') ?>

	<?= $this->Html->script('../lib/jquery.inputmask/dist/jquery.inputmask.bundle.min.js') ?>

	<?= $this->fetch('meta') ?>
	<?= $this->fetch('css') ?>
	<?= $this->fetch('script') ?>

	<style>
		html, body
		{
			height: 100%;
		}
		html{
			height: 100%;
		}
		body {
			min-height: 100%;
		}
		.side-menu li a{
			color: #FFF;
		}
		.side-menu li a:hover, .side-menu li a:active{
			background-color: #2980b9!important;
		}
	</style>
</head>
<body>

	<?= $this->Flash->render() ?>

	<div style="width: 20%; height: 100%; float: left; overflow: auto; background-color: #3498db;">
		<?= $this->element('side_menu') ?>		
	</div>
	<div style="width: 80%;float: left; height: 100%; overflow: auto;">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<?= $this->fetch('content') ?>
				</div>
			</div>
		</div>
	</div>

</body>
</html>
