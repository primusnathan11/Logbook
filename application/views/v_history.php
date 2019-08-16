<?php if($this->session->userdata('nama_level')=='Manajer IT' ){ ?>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/jq-3.3.1/jszip-2.5.0/dt-1.10.18/af-2.3.3/b-1.5.6/b-colvis-1.5.6/b-flash-1.5.6/b-html5-1.5.6/b-print-1.5.6/cr-1.5.0/fc-3.2.5/fh-3.1.4/kt-2.5.0/r-2.2.2/rg-1.1.0/rr-1.2.4/sc-2.0.0/sl-1.3.0/datatables.min.css"/>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs/jq-3.3.1/jszip-2.5.0/dt-1.10.18/af-2.3.3/b-1.5.6/b-colvis-1.5.6/b-flash-1.5.6/b-html5-1.5.6/b-print-1.5.6/cr-1.5.0/fc-3.2.5/fh-3.1.4/kt-2.5.0/r-2.2.2/rg-1.1.0/rr-1.2.4/sc-2.0.0/sl-1.3.0/datatables.min.js"></script>

<div class="panel">
		<div class="panel-heading">
        <h2 class="display-4">History Laporan </h2>
		 <br>
		 <hr class="style1">
		 <br>
		</div>
			<div class="panel-body">
			<table class="table table-hover" id="myTable" style="width:100%;">
			    <thead>
					<tr> 
                        <th>No</th>
                        <th>ID Laporan</th>
                        <th>Nama Pemilik</th>
                        <th>Nama Teknisi</th>
                        <th>Waktu</th>
                        <th>Status</th>
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
                    <?= $dt_kom->id_activity ?>
                    </td>
                    <td> 
						<?= $this->m_komplain->userSpesifik($dt_kom->id_karyawan)->nama; ?>
					</td>
                    <td>
						<?= $dt_kom->nama_teknisi ?>
					</td>
                    <td>
						<?= $dt_kom->waktu ?>
					</td>
                    <td>
						<?= $dt_kom->status ?>
					</td>
					
				</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>

<script>
$(document).ready(function() {
    $('#myTable').DataTable( {
        
		responsive: {
            details: {
                display: $.fn.dataTable.Responsive.display.modal( {
                    header: function ( row ) {
                        var data = row.data();
                        return 'Detail Laporan '+data[1]+' ';
                    }
                } ),
                renderer: $.fn.dataTable.Responsive.renderer.tableAll( {
                    tableClass: 'table'
                } )
            }
        },

		"language": {
            "lengthMenu": "Menampilkan _MENU_ data per halaman",
            "zeroRecords": "Maaf kami tidak dapat menemukan yang ingin anda cari",
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