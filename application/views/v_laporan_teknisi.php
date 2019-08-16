<?php if($this->session->userdata('nama_level')=='Teknisi' || $this->session->userdata('nama_level')=='Manajer IT' ){ ?>
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/jq-3.3.1/jszip-2.5.0/dt-1.10.18/af-2.3.3/b-1.5.6/b-colvis-1.5.6/b-flash-1.5.6/b-html5-1.5.6/b-print-1.5.6/cr-1.5.0/fc-3.2.5/fh-3.1.4/kt-2.5.0/r-2.2.2/rg-1.1.0/rr-1.2.4/sc-2.0.0/sl-1.3.0/datatables.min.css"/>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs/jq-3.3.1/jszip-2.5.0/dt-1.10.18/af-2.3.3/b-1.5.6/b-colvis-1.5.6/b-flash-1.5.6/b-html5-1.5.6/b-print-1.5.6/cr-1.5.0/fc-3.2.5/fh-3.1.4/kt-2.5.0/r-2.2.2/rg-1.1.0/rr-1.2.4/sc-2.0.0/sl-1.3.0/datatables.min.js"></script>
<div class="panel">
		<div class="panel-heading">
		<h2 class="display-4">Tugas Anda </h2>
		 <br>
		 <hr class="style1">
		 <br>
		</div>
			<div class="panel-body">
			<table class="table table-striped table-hover" id="LaporanTeknisi" style="width:100%;">
			    <thead>
					<tr> 
                        <th>No</th>
                        <th>Nama Barang</th>
                        <th>Status Pengerjaan</th>
                        <th>Nama Pelapor</th>
                        <th>Nama Teknisi</th>
                        <th>Detail Masalah</th>
                        <th>Tanggal Laporan</th>
						<th>Tanggal Selesai</th>
						<th>Keterangan</th>
						<?php
						if($this->session->userdata('nama_level') =='Teknisi'){
						?>
						<th style="cursor:default;">
						</th>
						<?php
						}
						?>
					</tr>
				</thead>
				<tbody>
        <?php $no=1; ?>
				<?php 
                foreach ($list as $dt_kom) : ?>
				<tr>
					<td>
						<?= $no++ ?>
					</td>

                    <td>
						<?= $dt_kom->nama_barang ?>
					</td>

					<td>
						<?= $dt_kom->status ?>
					</td>

					<td>
						<?= $dt_kom->nama ?>
					</td>
					
					<td>
						<?= $dt_kom->nama_teknisi ?>
					</td>
					
					<td>
						<?= $dt_kom->detail ?>
					</td>
					
					<td>
						<?= $dt_kom->tgl_activity ?>
					</td>
					
					<td>
						<?= $dt_kom->tgl_selesai ?>
					</td>
				
					<td>
						<?= $dt_kom->keterangan ?>
					</td>
					<?php if($this->session->userdata('nama_level') =='Teknisi'){?>
					<td>
					<?php if($dt_kom->status =="Sedang Dikerjakan"){?>	
					<a href="#selesai" class="btn btn-primary selesai" data-toggle="modal" data-dismiss="" onclick="selesai(<?php echo $dt_kom->id_activity ?>)" data-id="<?php echo $dt_kom->id_activity ?>">Selesai</a>
					<?php } ?>
					</td>
					<?php
					}
					?>
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>
          <?php if($this->session->flashdata('pesan')!=null): ?>
          <div class= "alert alert-success"><?= $this->session->flashdata('pesan');?></div>
          <?php endif?>                        

		  <div class="modal fade" id="selesai">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Keterangan Kerusakan</h4>
      </div>
      <div class="modal-body">
        <form id="form_selesai" action="" method="POST">
				<textarea name="keterangan" class="form-control"  placeholder="Isi Keterangan Kerusakan..."></textarea>
      </div>
      <div class="modal-footer">
	  <input type="submit" name="simpan" value="Simpan" class="btn btn-primary">
	  </form>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script>
	function selesai(dataID){
	$('.modal').modal('hide');
	$('#form_selesai').attr('action','<?php echo base_url()."index.php/Komplain/selesai_komplain/"?>'+dataID)

	}

$(document).ready(function() {
    $('#LaporanTeknisi').DataTable({
		responsive: {
            details: {
                display: $.fn.dataTable.Responsive.display.modal( {
                    header: function ( row ) {
                        var data = row.data();
                        return 'Detail Kerusakan '+data[1]+' ';
                    }
                } ),
                renderer: $.fn.dataTable.Responsive.renderer.tableAll( {
                    tableClass: 'table'
                } )
            }
        },
        "columnDefs": [
    { "orderable": false, "targets": 9,
	"searchable":false, "targets":9
	}
  ],
		"language": {
            "lengthMenu": "Menampilkan _MENU_ data per halaman",
            "zeroRecords": "Tidak ada data",
            "info": "Halaman ke _PAGE_ dari _PAGES_",
			"search":         "Cari:",
			"thousands":	".",
            "infoEmpty": "Tidak ada data",
            "infoFiltered": "(ditemukan dari _MAX_ data)",
			"paginate": {
        "first":      "Pertama",
        "last":       "Terakhir",
        "next":       "Selanjutnya",
        "previous":   "Sebelumnya"
    },
        }
    } );
} );
</script>
<?php } else{
	redirect(base_url('index.php/Login'), 'refresh');}?>