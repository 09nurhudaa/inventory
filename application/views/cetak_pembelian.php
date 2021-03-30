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
      <h4>Inventory</h4>
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
            <td><?php echo $rs->kode_transaksi; ?></td>
            <!-- <th>Nama Pelanggan</th>
					<th>:</th>
					<td><?php echo $rs->nama_pelanggan; ?></td> -->
          </tr>
          <tr>
            <th>Tgl transaksi</th>
            <th>:</th>
            <td><?php echo $rs->tgl_transaksi; ?></td>
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
              <th>No.</th>
              <th>Kode Barang</th>
              <th>Nama Barang</th>
              <th>Supplier</th>
              <th>Qty</th>
              <th>Harga</th>
              <th>Jumlah</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $sql = $this->db->query("SELECT * FROM detail_transaksi as a,barang as b, supplier as s where a.kode_barang=b.kode_barang and b.nama_supplier=s.nama_supplier and a.kode_transaksi='$rs->kode_transaksi' ");
            $no = 1;
            foreach ($sql->result() as $row) {
            ?>
              <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $row->kode_barang; ?></td>
                <td><?php echo $row->nama_barang; ?></td>
                <td><?php echo $row->nama_supplier; ?></td>
                <td><?php echo $row->qty; ?></td>

                <td><?php echo $row->harga; ?></td>
                <td><?php
                    $totharga = $row->qty * $row->harga;
                    echo number_format($totharga);
                    ?></td>
              </tr>
            <?php } ?>
            <tr>
              <td colspan="6">Total</td>
              <td>Rp. <?php echo number_format($rs->total_harga) ?></td>
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