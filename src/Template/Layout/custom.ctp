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

	<?= $this->fetch('meta') ?>
	<?= $this->fetch('css') ?>
	<?= $this->fetch('script') ?>
</head>
<body>
	<div class="container-fluid">
 		<div class="row">
			<div class="col-md-12">
				<?= $this->Flash->render() ?>
			</div>
		</div>
		<div class="row">
			<div class="col-md-2">
				<?= $this->element('side_menu') ?>
			</div>
			<div class="col-md-10">
				<?= $this->fetch('content') ?>		
			</div>
		</div>
	</div>
</body>
</html>
