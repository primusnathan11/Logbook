<?php if($this->session->userdata('nama_level')=='Karyawan' || $this->session->userdata('nama_level')=='Manajer IT' ){ ?>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>

<div class="panel">
	<div class="panel-heading">
        <div><h1 class="text-center">Komplain Kerusakan</h1></div><br>
        <hr class="style1">
    </div>
    <div class="panel-body">
        <form action="<?=base_url('index.php/Komplain/simpan_komplain')?>" method="POST">
            <div class="page-section">
                    <div class="row isian">
                        <div class="col-lg-5 col-md-5 col-sm-11 col-xs-12">
                        <?php
						if($this->session->userdata('nama_level') =='Manajer IT'){
                    ?>
                    <select class="form-control js-example-basic-single" name="id_karyawan" style="width:100%; border:none;" >
                        <option value="" disabled selected>-- Pilih Nama Pemilik --</option>
                        <?php                                
                            foreach ($dropdown as $row) {  
		                    echo "<option value='".$row->id_karyawan."'>".$row->nama."</option>";
		                }
                    echo"</select>"?>
                    <br>
                    <?php }?> <br>
                            <select class="form-control" name="kategori_barang" id="kategori_barang" onchange="tm_detail(this.value)">
                                <option value="" disabled selected>-- Pilih Kategori --</option>
                                <option value="Hardware">Hardware</option>
                                <option value="Software">Software</option>
                                <option value="Jaringan">Jaringan</option>
                            </select><br>
                            <select class="form-control" name="id_barang" id="id_barang" style="width:100%;">
                                <option value="" disabled selected>-- Pilih Barang --</option>
                                <?php                                
                                    foreach ($barang as $ab): ?>
                                    <option value="<?= $ab->id_barang?>">
                                    <?= $ab->nama_barang?>
                                    </option>
                                <?php endforeach ?> 
                            </select><br>
                            <textarea class="form-control" name="detail" id="" cols="34" rows="3"style="resize:vertical"></textarea><br>
                            <input type="submit" name="simpan" value="Simpan" class="btn btn-primary btn-block" style="margin-bottom:10px;">
                        </div>
                    </div>
            </div>   
        </form>
    </div>
</div>
<script>
$(document).ready(function() {
    $('.js-example-basic-single').select2({
        width:'resolve'
    });
});
    function tm_detail(kategori_barang) {
        $.getJSON("<?=base_url()?>index.php/Komplain/get_detail_kategori/"+kategori_barang,
        function(data){
            console.log(data);

            $(data).each(function(index, value){
                console.log(value.id_barang);
                    if($("#id_barang").find('option[value="'+ value.id_barang +'"]').length == 0){
                        $("#id_barang").append('<option value="'+ value.id_barang +'">'+value.nama_barang+'</option>')
                        }
                    }
                );
            }
        )
        $("#kategori_barang").change(function(){
            var kategori_brg = $(this).val()
                $("#id_barang").html("<option value=''disabled selected>-- Pilih Barang --</option>")
                    if(kategori_brg != ''){
                        $(data).each(function(index, value){
                            if(value.name == kategori_brg){
                                $("#id_barang").append('<option value="'+value.id_barang+'">'+ value.nama_barang+'</option>')
                            }
                        }
                    )
                }
            }
        )
    }
</script>
<?php } else{ redirect(base_url('index.php/Login'), 'refresh');}?>