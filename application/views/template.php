<!doctype html>
<html lang="en">

<head>
	<title>Republika | Laporan</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<script src="<?= base_url()?>assets/vendor/jquery/jquery.min.js"></script>
	
	<!-- VENDOR CSS -->
	<link rel="stylesheet" href="<?= base_url() ?>assets/vendor/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/vendor/font-awesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/vendor/linearicons/style.css">
	<link rel="stylesheet" href="<?= base_url() ?>assets/vendor/chartist/css/chartist-custom.css">
	<!-- MAIN CSS -->
	<link rel="stylesheet" href="<?= base_url() ?>assets/css/main.css">
	<!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
	<link rel="stylesheet" href="<?= base_url() ?>assets/css/demo.css">
	<!-- GOOGLE FONTS -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
	<!-- ICONS -->
	<link rel="icon" type="image/png" sizes="96x96" href="<?= base_url() ?>assets/gambar/icon title.png">
	<link href="https://fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet">
	<link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap.min.css" rel="stylesheet">
</head>

<body>
	<!-- WRAPPER -->
	<div id="wrapper">
		<!-- NAVBAR -->
		<nav class="navbar navbar-default navbar-fixed-top">
			
			<div class="container-fluid">
				<div class="navbar-btn">
					<button type="button" class="btn-toggle-fullwidth"><i class="fas fa-bars" style="color:white;"></i></button>
				</div>
				<div class="brand">
			<img src="<?= base_url('assets/gambar/logo1.png')?>" alt="">
			</div>
				<div id="navbar-menu" style="float:right">
					<ul class="nav navbar-nav navbar-right">
						<li class="dropdown">
							<a href="<?= base_url() ?>#" class="dropdown-toggle" data-toggle="dropdown"><img src="<?= base_url()?>assets/gambar/user.png" class="img-circle" alt="Avatar"> <span><?=$this->session->userdata('nama_user');?></span> <i class="icon-submenu lnr lnr-chevron-down"></i></a>
							<ul class="dropdown-menu">
								<li><a href="<?= base_url() ?>#"><i class="lnr lnr-user"></i> <span><?=$this->session->userdata('email')?></span></a></li>
								<li><a href="<?= base_url('index.php/Login/logout') ?>"><i class="lnr lnr-exit"></i> <span>Logout</span></a></li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</nav>
		<!-- END NAVBAR -->
		<!-- LEFT SIDEBAR -->
		<div id="sidebar-nav" class="sidebar">
				<nav>
					<ul class="nav">
					<?php $menu = $this->m_template->menu();
					 foreach($menu as $sidenav)
					 {
						echo '<li><a href="'.site_url($sidenav['link_relasi']).'">'. $sidenav['nama_menu'].'</a></li>';
					 }
					  ?>
					  
					</ul>
				</nav>
		</div>

		<!-- END LEFT SIDEBAR -->
		<!-- MAIN -->
		<div class="main">
			<!-- MAIN CONTENT -->
			<div class="main-content">
				<div class="container-fluid">
					<!-- OVERVIEW -->
					<?php 	$this->load->view($konten);		?>
				</div>
			</div>
			<!-- END MAIN CONTENT -->
		</div>
		<!-- END MAIN -->
		<div class="clearfix"></div>
		<footer>
		
		</footer>
	</div>
	<!-- END WRAPPER -->
	<!-- Javascript -->
	<script src="<?= base_url()?>assets/vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="<?= base_url()?>assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js"></script>
	<script src="<?= base_url()?>assets/vendor/jquery.easy-pie-chart/jquery.easypiechart.min.js"></script>
	<script src="<?= base_url()?>assets/vendor/chartist/js/chartist.min.js"></script>
	<script src="<?= base_url()?>assets/scripts/klorofil-common.js"></script>
</body>

</html>
