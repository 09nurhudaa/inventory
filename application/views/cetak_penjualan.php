<!DOCTYPE html>
<html>

<head>
	<base href="<?php echo base_url() ?>">
	<title>Cetak Struk transaksi</title>
	<link rel="stylesheet" type="text/css" href="assets/bootflat-admin/css/bootstrap.min.css">
</head>

<body>
	<div class="container">
		<center>
			<h4>PT. GRIDER INDONESIA</h4>
			<p>Jl. abc</p>
			<p>Telp. (021)-888888</p>
		</center>
		<?php
		$rs = $data->row();
		?>
		<div class="row">
			<div class="col-md-12">
				<table class="table">
					<tr>
						<th>Kode transaksi</th>
						<th>:</th>
						<td><?php echo $rs->kode_keluar; ?></td>
						<!-- <th>Nama Pelanggan</th>
					<th>:</th>
					<td><?php echo $rs->nama_pelanggan; ?></td> -->
					</tr>
					<tr>
						<th>Tgl transaksi</th>
						<th>:</th>
						<td><?php echo $rs->tgl_keluar; ?></td>
						<th>Total Harga</th>
						<th>:</th>
						<td>Rp. <?php echo number_format($rs->total_harga); ?></td>
					</tr>
				</table>
			</div>
			<div class="col-md-12">
				<table class="table table-bordered" style="margin-bottom: 10px">
					<thead>
						<tr>
							<th>
								<center>No.</center>
							</th>
							<th>
								<center>No. Permintaan</center>
							</th>
							<th>
								<center>Nama Proyek</center>
							</th>
							<th>
								<center>Lokasi</center>
							</th>
							<th>
								<center>Luas Tanah</center>
							</th>
							<th>
								<center>Nama Barang</center>
							</th>
							<th>
								<center>Qty</center>
							</th>
							<th>
								<center>Harga</center>
							</th>
							<th>
								<center>Jumlah</center>
							</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$sql = $this->db->query("SELECT * FROM detail_transaksi_keluar as a,barang_keluar as b where a.no_permintaan=b.no_permintaan
							and a.kode_keluar='$rs->kode_keluar' ");
						$no = 1;
						foreach ($sql->result() as $row) {
						?>
							<tr>
								<td>
									<center><?php echo $no++; ?></center>
								</td>
								<td>
									<center><?php echo $row->no_permintaan; ?></center>
								</td>
								<td>
									<center><?php echo $row->nama_proyek; ?></center>
								</td>
								<td>
									<center><?php echo $row->lokasi; ?></center>
								</td>
								<td>
									<center><?php echo $row->luas_tanah; ?></center>
								</td>
								<td>
									<center><?php echo $row->nama_barang; ?></center>
								</td>
								<td>
									<center><?php echo $row->qty; ?></center>
								</td>
								<td>
									<center><?php echo $row->harga; ?></center>
								</td>
								<td>
									<center><?php $totharga = $row->qty * $row->harga;
											echo number_format($totharga); ?> </center>
								</td>
							</tr>
						<?php } ?>
						<tr>
							<td colspan="8">
								<b>Total Harga</b>
							</td>
							<td>
								<center>Rp. <?php echo number_format($rs->total_harga) ?></center>
							</td>
						</tr>
						<!-- <tr>
						<td colspan="6"><b>Diskon Keseluruhan (10%)</b></td>
						<td>
							Rp.
						<?php
						$diskon = 0;
						if ($rs->total_harga >= 100000) {
							$diskon = 0.1 * $rs->total_harga;
						} else {
							$diskon = 0;
						}
						echo number_format($diskon)

						?>
						</td>
					</tr>
					<tr>
						<td colspan="6"><b>Total Bayar</b></td>
						<td>Rp. <?php echo number_format($rs->total_harga - $diskon) ?></td>
					</tr> -->
					</tbody>
				</table>

				<div style="text-align: right;">
					<p>JAKARTA, <?php echo date('d/m/Y') ?></p>
					<br><br><br><br><br>
					<p>Jakarta mana hayo</p>
				</div>
			</div>
		</div>
	</div>
</body>

</html>