<?php if($this->session->userdata('nama_level')=='Manajer IT' ){ ?>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs/jq-3.3.1/jszip-2.5.0/dt-1.10.18/af-2.3.3/b-1.5.6/b-colvis-1.5.6/b-flash-1.5.6/b-html5-1.5.6/b-print-1.5.6/cr-1.5.0/fc-3.2.5/fh-3.1.4/kt-2.5.0/r-2.2.2/rg-1.1.0/rr-1.2.4/sc-2.0.0/sl-1.3.0/datatables.min.css"/>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/bs/jq-3.3.1/jszip-2.5.0/dt-1.10.18/af-2.3.3/b-1.5.6/b-colvis-1.5.6/b-flash-1.5.6/b-html5-1.5.6/b-print-1.5.6/cr-1.5.0/fc-3.2.5/fh-3.1.4/kt-2.5.0/r-2.2.2/rg-1.1.0/rr-1.2.4/sc-2.0.0/sl-1.3.0/datatables.min.js"></script>
<div class="panel">
	<div class="panel-heading">
    <h2 class="display-4">User </h2>
		 <br>
		 <hr class="style1">
         <br>
         <a href="#tambah" class="btn btn-primary" data-toggle="modal"><span class=""></span><i class="fas fa-plus"></i> Tambah User</a><br>
	</div>
	<div class="panel-body">
        <?php if($this->session->flashdata('pesan')!=null): ?>
            <div class= "alert alert-danger"><?= $this->session->flashdata('pesan');?></div>
        <?php endif?>
        <?php if($this->session->flashdata('gagal')!=null): ?>
            <div class= "alert alert-danger"><?= $this->session->flashdata('gagal');?></div>
        <?php endif?>
		<table class="table table-hover" id="TabelUser" style="width:100%;">
			<thead>
				<tr>
                    <th>No</th>
                    <th>Nama User</th>
                    <th>Id User</th>
                    <th>Alamat Email</th>
                    <th>Jenis Kelamin</th>
                    <th>No Telepon</th>
                    <th>Jabatan</th>
                    <th style="cursor:default"> </th>
				</tr>
			</thead>
			<tbody>
                <?php
                    $no=1;
                    foreach($user as $dt){
                ?>
                <tr>
                    <td><?php echo $no; $no++; ?></td>
                    <td><?php echo $dt->nama ?></td>
                    <td><?php echo $dt->id_karyawan ?></td>
                    <td><?php echo $dt->email ?></td>
                    <td><?php echo $dt->jenis_kelamin ?></td>
                    <td><?php echo $dt->no_telepon ?></td>
                    <td><?php echo $dt->nama_level ?></td>
                    <td>
                        <a href="#update_user" class="btn btn-warning" data-toggle="modal" data-dismiss="modal" onclick="tm_detail('<?php echo ($dt->id_karyawan)?>')">Edit</a> 
                        <a href="<?php echo base_url().'index.php/User/delete_user/'.$dt->id_karyawan ?>"
                         class="btn btn-danger" data-toggle="modal" onclick="return confirm('Anda yakin akan menghapus user ini?');">Delete</a></td>
                    </td>
                </tr>
		        <?php } ?>
			</tbody>
		</table>						
    </div>
</div>
        
            <!-- Tambah User -->
            <div class="modal fade" id="tambah" data-keyboard="false" data-backdrop="static">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <h4 class="modal-title" id="myModalLabel">Tambah User</h4>
                        </div>
                        <div class="modal-body">
                            <form action="<?=base_url('index.php/User/simpan_user')?>" method="post">
                                Nama User
                                <input type="text" name="nama" class="form-control" autofocus="autofocus"><br>
                                Alamat Email
                                <input type="text" name="email" class="form-control"><br>
                                Password
                                <input type="password" name="password" class="form-control"><br>
                                Jabatan
                                <select name="nama_level" class="form-control" autofocus="autofocus">
                                    <option value="" disabled selected>Pilih Jabatan</option>
                                    <?php 
				                    foreach ($level as $dt_level) : ?>
                                    <option value="
                                        <?= $dt_level->id_level ?>">
                                        <?= $dt_level->nama_level ?>
                                        </option>
				                    <?php endforeach ?>
                                </select>
                                <br>
                                Jenis Kelamin
                                <select name="jenis_kelamin" class="form-control">
                                 <option value="" disabled selected>Pilih Jenis Kelamin</option>
                                    <option value="Laki-laki">Laki-laki</option>
                                    <option value="Perempuan">Perempuan</option>
                                </select> <br>
                                No Telepon <br>
                                <input type="number" class="form-control" name="no_telepon">
                                <div class="modal-footer">
                                    <a href=""><input type="submit" name="simpan" value="Simpan" class="btn btn-primary"></a>
                                </div>
                            </form>
                            <!-- <button type="button" class="btn btn-info" data-dismiss="modal">Close</button> -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- Edit User -->
            <div class="modal fade" id="update_user" data-keyboard="false" data-backdrop="static">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                            <h4 class="modal-title" id="myModalLabel">Update User</h4>
                        </div>
                        <div class="modal-body">
                            <form action="<?=base_url('index.php/User/update_user')?>" method="post">
                                <input type="hidden" id="id_karyawan" name="id_karyawan">
                                Nama User
                                <input id="nama" type="text" name="nama" class="form-control"><br>
                                Alamat Email
                                <input id="email" type="email" name="email" class="form-control"><br>
                                Password
                                <input id="password" type="password" name="password" class="form-control"><br>
                                Jabatan
                                <select id="nama_level" name="nama_level" class="form-control">
                                    <?php 
				                    foreach ($level as $dt_level) : ?>
                                    <option value="
                                        <?= $dt_level->id_level ?>">
                                        <?= $dt_level->nama_level ?>
                                        </option>
				                    <?php endforeach ?>
                                </select>
                                <br>
                                No Telepon <br>
                                <input type="number" class="form-control" name="no_telepon" id="no_telepon">
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

function tm_detail(id_karyawan) {
    $.getJSON("<?=base_url()?>index.php/User/get_detail_user/"+id_karyawan,function(data){
    console.log(data);
    $("#id_karyawan").val(data['id_karyawan']);
    $("#nama").val(data['nama']);
    $("#email").val(data['email']);
    $("#password").val(data['password']);
    $("#no_telepon").val(data['no_telepon']);
    $("#nama_level").val(data['nama_level']);
  });
}
$(document).ready(function() {
    $('#TabelUser').DataTable( {
        
		responsive: {
            details: {
                display: $.fn.dataTable.Responsive.display.modal( {
                    header: function ( row ) {
                        var data = row.data();
                        return 'Detail User '+data[1]+' ';
                    }
                } ),
                renderer: $.fn.dataTable.Responsive.renderer.tableAll( {
                    tableClass: 'table'
                } )
            }
        },
        "columnDefs": [
    { "orderable": false, "targets": 7,
      "searchable":false, "targets":7 
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
