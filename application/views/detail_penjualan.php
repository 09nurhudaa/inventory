<?php
$rs = $data->row();
?>
<div class="row">
	<div class="col-md-12">
		<table class="table">
			<tr>
				<th>Kode Transaksi</th>
				<th>:</th>
				<td><?php echo $rs->kode_keluar; ?></td>
				<!-- <th>Nama Pelanggan</th>
				<th>:</th>
				<td><?php echo $rs->nama_pelanggan; ?></td> -->
			</tr>
			<tr>
				<th>Tgl Penjualan</th>
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
					</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
	<div class="modal-footer">
		<a href="app1/penjualan" class="btn btn-default">Close</a>
	</div>
</div>