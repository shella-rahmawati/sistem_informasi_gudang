<?php include 'head.php'; ?>

<body onload="print()">
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
		<table width="100%">
		<tr>
			<td width="10%">Petugas</td>
			<td width="50%">: <?=$this->session->userdata('namalengkap')?></td>
			<td width="10%">Tanggal</td>
			<td width="50%">: <?=date("d/m/Y");?></td>
		</tr>
		<tr>
			<td width="10%">Jabatan</td>
			<td>: Staff Gudang</td>
			<td width="10%">Jenis Laporan</td>
			<td>: Transaksi Produk Keluar Gudang</td>
			<td></td>
		</tr>
	</table></center><br/>

	<table border="1" class="table table-bordered table-striped">
	<thead>
    <tr>
      <th>No</th>
      <th>Transaksi</th>
      <th>Tgl Masuk</th>
      <th>Tgl Keluar</th>
      <th>Lokasi</th>
      <th>Produk</th>
      <th>Oleh</th>
      <th>Satuan</th>
      <th>Jum</th>
      <!-- <th></th> -->
    </tr>
    </thead>
	<tbody>
	<tr>
	  <?php if(is_array($list_data)){ ?>
	  <?php $no = 1;?>
	  <?php foreach($list_data as $dd): ?>
	    <td><?=$no?></td>
	    <td><?=$dd->id_transaksi?></td>
	    <td><?=$dd->tanggal_masuk?></td>
	    <td><?=$dd->tanggal_keluar?></td>
	    <td><?=$dd->lokasi?></td>
	    <td><?=$dd->nama_produk?></td>
	    <td><?=$dd->petugas?></td>
	    <td><?=$dd->satuan?></td>
	    <td><?=$dd->jumlah?></td>
	</tr>
	<?php $no++; ?>
	<?php endforeach;?>
	<?php }else { ?>
	    <td colspan="7" align="center"><strong>Data Kosong</strong></td>
	<?php } ?>
	</tbody>
	</table><br/><br><br>
	<p style="text-align: right;margin-right: 5%;">
		Persetujuan,
		<br><br><br><br>
		<b>( <u>Agus Salim</u> )</b>
	</p>
</body>
</html>