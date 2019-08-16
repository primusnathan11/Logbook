<!doctype html>
<html lang="en" class="fullscreen-bg">

<head>
	<title>Republika | Logbook</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<!-- VENDOR CSS -->
	<link rel="stylesheet" href="<?=base_url()?>assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?=base_url()?>assets/vendor/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?=base_url()?>assets/vendor/linearicons/style.css">
	<!-- MAIN CSS -->
	<link rel="stylesheet" href="<?=base_url()?>assets/css/main.css">
	<!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
	<link rel="stylesheet" href="<?=base_url()?>assets/css/demo.css">
	<!-- GOOGLE FONTS -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
	<!-- ICONS -->
	<link rel="icon" type="image/png" sizes="96x96" href="<?=base_url()?>assets/gambar/icon title.png">
	<link href="https://fonts.googleapis.com/css?family=Great+Vibes" rel="stylesheet">
</head>

<body>
	<!-- WRAPPER -->
	<div id="wrapper">
		<div class="vertical-align-wrap">
			<div class="vertical-align-middle">
				<div class="auth-box ">
					<div class="left">
						<div class="content" style="width:300px;">
							
							<?php
								$notif = $this->session->flashdata('notif');
								if($notif != NULL){
									echo '
										<div class="alert alert-danger">'.$notif.'</div>
									';
								}
							?>
							<form class="form-auth-small" action="<?= base_url('index.php/login/cek_login')?>" method="post">
							<div class="header"><p class="lead">Login to your account</p>
							</div>
								<div class="form-group">
									<input type="email" class="form-control" placeholder="Email"  name="email">
								</div>
								<div class="form-group">
									<input type="password" class="form-control"  placeholder="Password" name="password">
								</div>
								
								<input type="submit" name="submit" value="Login"  class="btn btn-primary btn-lg btn-block">
								<div class="bottom">
									
								</div>
							</form>
						</div>
					</div>
					<div class="right">
						<div class="overlay"></div>
						<div class="content text">
							<h1 class="heading">Republika | Pelaporan Barang Rusak</h1>

						</div>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</div>
	<!-- END WRAPPER -->
</body>

</html>
