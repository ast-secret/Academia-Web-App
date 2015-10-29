<!DOCTYPE html>
<html>
<head>
	<?= $this->Html->charset() ?>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>
		<?= $this->fetch('title') ?>
	</title>
	</title>
	<?= $this
		->Html
		->meta('icon',
			"/files/gyms/{$gym->folder_name}/favicon.ico",
			['type' => 'icon']
	) ?>

	<link href='http://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=PT+Serif' rel='stylesheet' type='text/css'>

	<?= $this->Html->css('../lib/bootstrap/dist/css/bootstrap.min.css') ?>
	<?= $this->Html->css('app.css') ?>
	<?= $this->Html->css('../files/gyms/' . $gym->folder_name . '/theme.css') ?>

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
	<body class="login-bg">
		<div class="container">
			<div class="row" style="margin-top: 70px;">
				<div class="col-md-4 col-md-offset-4">
					<div class="login-box">
						<div class="text-center" style="padding: 15px 0 15px 0;">
							<?= $this->Html->image($gym->logo_path, [
								'url' => ['action' => 'login'],
								'width' => '60%'
							]) ?>
						</div>
						<br>
						<div class="row">
							<div class="col-md-12">
								<?= $this->Flash->render(); ?>
							</div>
						</div>
						<?= $this->fetch('content') ?>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
