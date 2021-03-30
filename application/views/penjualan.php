<div class="row">
	<div class="col-md-4">
		<a href="app1/tambah_penjualan" class="btn btn-primary">Tambah Transaksi</a>
		<!-- <a href="penjualan/export_penjualan" target="_blank" class="btn btn-primary">Export</a> -->
	</div>
	<div class="col-md-4"></div>
	<div class="col-md-4"></div><br><br><br>
	<div class="col-md-12">
		<table class="table table-bordered" style="margin-bottom: 10px" id="example">
			<thead>
				<tr>
					<th>No.</th>
					<th>Kode Transaksi</th>
					<th>Tanggal Transaksi</th>
					<th>Total Bayar</th>
					<th>Pilihan</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$sql = $this->db->query("SELECT * FROM transaksi_keluar order by id_keluar DESC");
				$no = 1;
				foreach ($sql->result() as $row) {
				?>
					<tr>
						<td><?php echo $no++; ?></td>
						<td><?php echo $row->kode_keluar; ?></td>
						<td><?php echo $row->tgl_keluar; ?></td>
						<td><?php echo number_format($row->total_harga); ?></td>
						<td>
							<?php if ($this->session->userdata('level') == "manajer") { ?>
								<a href="app1/detail_penjualan/<?php echo $row->kode_keluar ?>" class="btn btn-info btn-sm">detail</a>
								<a href="app1/cetak_penjualan/<?php echo $row->kode_keluar ?>" target="_blank" class="btn btn-success btn-sm">cetak</a>
							<?php } else { ?>
								<a href="app1/detail_penjualan/<?php echo $row->kode_keluar ?>" class="btn btn-info btn-sm">detail</a>
								<a href="app1/hapus_penjualan/<?php echo $row->kode_keluar ?>" class="btn btn-danger btn-sm" onclick="javasciprt: return confirm('Are You Sure ?')">hapus</a>
								<a href="app1/cetak_penjualan/<?php echo $row->kode_keluar ?>" target="_blank" class="btn btn-success btn-sm">cetak</a>
						</td>
					<?php } ?>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>
</div>