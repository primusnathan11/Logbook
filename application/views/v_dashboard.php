	<!-- ALL USER -->
					
	<div class="panel panel-headline">
		<div class="panel-heading">
			<h3 class="panel-title">Welcome back,  <?=$this->session->userdata('nama')?></h3>
			<p class="panel-subtitle"><?php echo date('D, d M Y') ?></p>
		</div>
	</div>
	<!-- end-all-user -->
	
	<!-- TEKNISI -->
	<?php if($this->session->userdata('nama_level')=='Teknisi'){?>
		<div class="panel panel-headline">
			<div class="panel-heading">
				<div class="row">
					<div class="col-md-6">
						<a href="<?= base_url('index.php/Laporan')?>">
							<div class="metric">
								<span class="icon">
								<i class="fas fa-clipboard"></i>
								</span> 
								<p>
									<span class="number"><?= $notif?></span>
									<span class="title">Komplain baru</span>
								</p>
							</div>
						</a>
					</div>

					<div class="col-md-6">
						<a href="<?= base_url('index.php/Laporan_teknisi')?>">
							<div class="metric">
								<span class="icon"><i class="fa fa-wrench"></i></span>
								<p>
									<span class="number"><?= $task ?></span>
									<span class="title">Dalam Proses</span>
								</p>
							</div>
						</a>
					</div>
												
				</div>
			</div>
		</div>
	<?php }?>
	<!-- END TEKNISI -->

	<!-- KARYAWAN -->
	<?php if($this->session->userdata('nama_level')=='Karyawan'){ ?>
		<div class="panel panel-headline">
			<div class="panel-heading">
				<div class="row">			
					<div class="col-md-4">
						<a href="<?= base_url('index.php/Laporan_karyawan')?>">
							<div class="metric">
								<span class="icon">
								<i class="far fa-paper-plane"></i>
									</i>
								</span> 
								<p>
									<span class="number"><?= $komplain?></span>
									<span class="title">Menunggu dikerjakan</span>
								</p>
							</div>
						</a>
					</div>
					<div class="col-md-4">
						<a href="<?= base_url('index.php/Laporan_karyawan')?>">
							<div class="metric">
								<span class="icon">
								<i class="fas fa-wrench"></i>
									</i>
								</span> 
								<p>
									<span class="number"><?= $kardone?></span>
									<span class="title">Sedang dikerjakan</span>
								</p>
							</div>
						</a>
					</div>
					<div class="col-md-4">
						<a href="<?= base_url('index.php/Laporan_karyawan')?>">
							<div class="metric">
								<span class="icon">
								<i class="far fa-check-circle"></i>
									</i>
								</span> 
								<p>
									<span class="number"><?= $karsel?></span>
									<span class="title">Selesai dikerjakan</span>
								</p>
							</div>
						</a>
					</div>
				</div>
			</div>
		</div>
	<?php } ?>
	<!-- END KARYAWAN -->

	<!-- MANAJER -->
	<?php if($this->session->userdata('nama_level')=='Manajer IT'){ ?>
		<div class="panel panel-headline">
			<div class="panel-heading">
				<div class="row">
					<div class="col-md-4">
						<a href="<?= base_url('index.php/User')?>">
							<div class="metric">
								<span class="icon">
									<i class="fa fa-user">
									</i>
								</span> 
								<p>
									<span class="number"><?= $karyawan?></span>
									<span class="title">Data User</span>
								</p>
							</div>
						</a>
					</div>
					<div class="col-md-4">
						<a href="<?= base_url('index.php/Barang')?>">
							<div class="metric">
								<span class="icon">
									<i class="fa fa-suitcase"></i>
								</span> 
								<p>
									<span class="number"><?= $things?></span>
									<span class="title">Data Barang</span>
								</p>
							</div>
						</a>
					</div>
					<div class="col-md-4">
						<a href="<?= base_url('index.php/Laporan')?>">
							<div class="metric">
								<span class="icon">
									<i class="fas fa-file-alt"></i>
								</span> 
								<p>
									<span class="number"><?= $activity?></span>
									<span class="title">Data Laporan</span>
								</p>
							</div>
						</a>
					</div>
				</div>
			</div>
		</div>
	<?php } ?>
	<!-- END MANAJER -->