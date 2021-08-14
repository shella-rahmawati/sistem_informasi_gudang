<?php include 'head.php'; ?>

<!--<body onload="print()">-->
<body>
<center>
<table>
<tr>
<td>
	<img src="dist/img/logo1.png" style="width: 100px; height: 100px;">
</td>
<td width="5%"></td>
<td>
	<center>
	<h3>CV. Greenlife Tirta Sentosa Sidoarjo</h3>
	<p>Laporan Produk Keluar-Masuk Gudang<br/>Industri Pengolahan & Aneka Industri | Dsn Semawut RT. 11 RW.04 Ds. Balongbendo Kec. Balongbendo Kab. Sidoarjo<br/><b>No Telp. +623199892231 | Email : greennirmala@gmail.com</b></p>
	</center>
</td>
</tr>
</table>
</center>
	<hr/>
	<center>
	<?php 
	$dd = $this->db->query("SELECT * FROM tb_barang_keluar JOIN tb_produk WHERE tb_barang_keluar.id_transaksi='$id_transaksi' AND tb_barang_keluar.id_produk=tb_produk.id_produk")->row();
	 ?>
		<table width="100%">
		<tr>
			<td width="10%">ID Transaksi</td>
			<td width="40%">: <?php echo $dd->id_transaksi; ?></td>
			<td width="10%">Petugas</td>
			<td width="40%">: <?=$this->session->userdata('namalengkap')?></td>
		</tr>
		<tr>
			<td width="10%">ID Produk</td>
			<td>: <?php echo $dd->id_produk; ?></td>
			<td width="10%">Nama Produk</td>
			<td>: <?php echo $dd->nama_produk; ?></td>
			<td></td>
		</tr>
	</table></center><br/>

	<table border="1" class="table table-bordered table-striped">
	<thead>
	    <tr>
	      <th>Transaksi</th>
	      <th>Tgl Masuk</th>
	      <th>Tgl Keluar</th>
	      <th>Lokasi</th>
	      <th>Produk</th>
      	  <th>Oleh</th>
	      <th>Satuan</th>
	      <th>Jum</th>
	    </tr>
    </thead>
	<tbody>
		<tr>
	        <td><?=$dd->id_transaksi?></td>
	        <td><?=$dd->tanggal_masuk?></td>
	        <td><?=$dd->tanggal_keluar?></td>
	        <td><?=$dd->lokasi?></td>
	        <td><?=$dd->nama_produk?></td>
	    	<td><?=$dd->petugas?></td>
	        <td><?=$dd->satuan?></td>
	        <td><?=$dd->jumlah?></td>
	    </tr>
	</tbody>
	</table><br/><br><br>
	<p style="text-align: right;">
		Persetujuan,
		<br><br><br><br>
		<b>Agus Salim</b>
	</p>
</body>
</html>