<?php if($this->session->userdata('nama_level')=='Teknisi' || $this->session->userdata('nama_level')=='Manajer IT' ){ ?>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/jq-3.3.1/jszip-2.5.0/dt-1.10.18/af-2.3.3/b-1.5.6/b-colvis-1.5.6/b-flash-1.5.6/b-html5-1.5.6/b-print-1.5.6/cr-1.5.0/fc-3.2.5/fh-3.1.4/kt-2.5.0/r-2.2.2/rg-1.1.0/rr-1.2.4/sc-2.0.0/sl-1.3.0/datatables.min.css"/>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs/jq-3.3.1/jszip-2.5.0/dt-1.10.18/af-2.3.3/b-1.5.6/b-colvis-1.5.6/b-flash-1.5.6/b-html5-1.5.6/b-print-1.5.6/cr-1.5.0/fc-3.2.5/fh-3.1.4/kt-2.5.0/r-2.2.2/rg-1.1.0/rr-1.2.4/sc-2.0.0/sl-1.3.0/datatables.min.js"></script>
<div class="panel">
	<div class="panel-heading">
    <h2 class="display-4">Barang </h2>
		 <br>
		 <hr class="style1">
         <br>
         <a href="#tambah" class="btn btn-primary" data-toggle="modal"><span class=""></span><i class="fas fa-plus"></i> Tambah Barang</a><br> 
	</div>
	<div class="panel-body">
        <?php if($this->session->flashdata('pesan')!=null): ?>
            <div class= "alert alert-success"><?= $this->session->flashdata('pesan');?></div>
        <?php endif?>
        <?php if($this->session->flashdata('gagal')!=null): ?>
            <div class= "alert alert-danger"><?= $this->session->flashdata('gagal');?></div>
        <?php endif?>
		<table class="table table-striped" id="TabelBarang" style="width:100%;">
			<thead>
				<tr>
                    <th>No</th>
                    <th>Id Barang</th>
                    <th>Nama Barang</th>
                    <th>Kategori Barang</th>
                    <th style="cursor:default"></th>
				</tr>
			</thead>
			<tbody>
                <?php
                    $no=1;
                    foreach($barang as $dt){
                ?>
                <tr>
                    <td><?php echo $no; $no++; ?></td>
                    <td><?php echo $dt->id_barang ?></td>
                    <td><?php echo $dt->nama_barang ?></td>
                    <td><?php echo $dt->kategori_barang ?></td>
                    <td>
                        <a id="edit" href="#update_barang" class="btn btn-warning" data-dismiss="modal"data-toggle="modal" onclick="tm_detail('<?php echo ($dt->id_barang)?>')">Edit</a> 
                        <a href="<?php echo base_url().'/index.php/Barang/delete_barang/'.$dt->id_barang ?>"
                         class="btn btn-danger" data-toggle="modal" onclick="return confirm('Anda yakin akan menghapus barang ini?');">Delete</a></td>
                    </td>
                </tr>
		        <?php } ?>
			</tbody>
		</table>						
    </div>
</div>
        
            <!-- Tambah Barang -->
            <div class="modal fade" id="tambah" data-keyboard="false" data-backdrop="static">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <h4 class="modal-title" id="myModalLabel">Tambah Barang</h4>
                        </div>
                        <div class="modal-body">
                            <form action="<?=base_url('index.php/Barang/simpan_barang')?>" method="post">
                                Kategori Barang
                                <select name="kategori_barang" class="form-control" autofocus="autofocus">
                                    <option value="" disabled selected>Pilih Kategori</option>
                                    <option value="Hardware">Hardware</option>
                                    <option value="Software">Software</option>
                                    <option value="Jaringan">Jaringan</option>
                                </select><br>
                                Nama Barang
                                <input type="text" name="nama_barang" class="form-control" ><br>
                                <div class="modal-footer">
                                    <a href=""><input type="submit" name="simpan" value="Simpan" class="btn btn-primary"></a>
                                </div>
                            </form>
                            <!-- <button type="button" class="btn btn-info" data-dismiss="modal">Close</button> -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- Edit Barang -->
            <div class="modal fade" id="update_barang" data-keyboard="false" data-backdrop="static">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <h4 class="modal-title" id="myModalLabel">Edit Barang</h4>
                        </div>
                        <div class="modal-body">
                            <form action="<?=base_url('index.php/Barang/update_barang')?>" method="post">
                                <input type="hidden" id="id_barang" name="id_barang">
                                Nama Barang
                                <input id="nama_barang" type="text" name="nama_barang" class="form-control"><br>
                                Kategori Barang
                                <select id="kategori_barang" name="kategori_barang" class="form-control">
                                    <option value="Hardware">Hardware</option>
                                    <option value="Software">Software</option>
                                    <option value="Jaringan">Jaringan</option>
                                 </select><br>
                                <div class="modal-footer">
                                    <input type="submit" name="simpan" value="Simpan" class="btn btn-primary">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
</div>

<script>

function tm_detail(id_barang) {
  $.getJSON("<?=base_url()?>index.php/Barang/get_detail_barang/"+id_barang,function(data){
    console.log(data);
    $("#id_barang").val(data['id_barang'])
    $("#nama_barang").val(data['nama_barang']);
    $("#kategori_barang").val(data['kategori_barang']);
  });
}
$(document).ready(function() {
    $('#TabelBarang').DataTable( {
        
		responsive: {
            details: {
                display: $.fn.dataTable.Responsive.display.modal( {
                    header: function ( row ) {
                        var data = row.data();
                        return 'Detail '+data[2]+' ';
                    }
                } ),
                renderer: $.fn.dataTable.Responsive.renderer.tableAll( {
                    tableClass: 'table'
                } )
            }
        },
        "columnDefs": [
    { "orderable": false, "targets": 4,
      "searchable":false, "targets":4
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