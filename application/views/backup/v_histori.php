
<h1>Histori</h1>




<table class="table table-hover table-stripped"> 

<thead>
	
	<tr>
		
		<td>no</td><td>No Nota</td><td>nama kasir</td><td>Pembeli</td><td>total</td><td>tanggal beli</td><td></td><td></td>

	</tr>

</thead>

<tbody>
	

<?php $no = 0; foreach($ts as $ts): $no++;?>


	<tr>
		
		<td><?=$no?></td><td><?=$ts->kode_transaksi?></td><td><?=$ts->nama_user?></td><td><?=$ts->nama_pembeli?></td><td><?=$ts->total?></td><td><?=$ts->tanggal_beli?></td>

	</tr>



<?php endforeach?>


</tbody>	

</table>
