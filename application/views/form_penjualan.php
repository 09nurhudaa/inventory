<div class="row">
  <div class="col-md-12">
    <form action="app1/simpan_penjualan" method="POST">
      <div class="form-group">
        <label>Kode Pemesanan </label>
        <input type="text" class="form-control" name="kode_penjualan" id="kode_penjualan" value="<?php echo $kodeurut; ?>" readonly />
      </div>
      <div class="table-resposive">
        <table class="table table-bordered">
          <tr>
            <th>No.</th>
            <th>NO Permintaan</th>
            <th>Nama Barang</th>
            <th>Jumlah</th>
            <th>Harga</th>
            <th>Subtotal</th>
            <th>
              <!-- Trigger the modal with a button -->
              <button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal">Lihat Data Permintaan</button>
            </th>
          </tr>
          <tr>
            <?php $i = 1;
            $no = 1; ?>
            <?php foreach ($this->cart->contents() as $items) : ?>
              <td><?php echo $no; ?></td>
              <td><?php echo $items['id']; ?></td>
              <td><?php echo $items['name']; ?></td>
              <td><?php echo $items['qty']; ?></td>
              <td>Rp. <?php echo $this->cart->format_number($items['price']); ?></td>
              <td>Rp. <?php echo $this->cart->format_number($items['subtotal']); ?></td>
              <td>
                <a href="app1/hapus_cart/<?php echo $items['rowid'] ?>" class="btn btn-warning btn-sm">X</a>
              </td>
          </tr>
          <?php $i++;
              $no++; ?>
        <?php endforeach; ?>
        <tr>
          <th colspan="5">Total Harga</th>
          <th colspan="2">Rp. <?php echo $this->cart->format_number($this->cart->total()); ?></th>
        </tr>
        </table>
      </div>

      <div class="form-group">
        <input type="hidden" name="total_harga" value="<?php echo $this->cart->total() ?>">
        <input type="hidden" name="tgl_penjualan" value="<?php echo date('Y-m-d') ?>">

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="app1/penjualan" class="btn btn-default">Close</a>
      </div>
    </form>
  </div>
</div>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <form action="app1/simpan_cart" method="POST">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Tambah Barang</h4>
        </div>
        <?php if ($this->session->userdata('level') == "manajer") { ?>
          <div class="modal-body">
            <div class="form-group">
              <label>Nomor Permintaan</label><br>
              <select id="no_permintaan" name="no_permintaan" class="form-control">
                <option value="<?php echo $status = 0 ?>"><?php echo $status = 0 ?></option>
                <?php
                $sql = $this->db->get('barang_keluar');
                foreach ($sql->result() as $row) {
                ?>
                  <option value="<?php echo $row->no_permintaan ?>"><?php echo $row->no_permintaan ?></option>
                <?php } ?>
              </select>
            </div>

            <div class="form-group">
              <label>Nama Proyek</label>
              <input type="text" class="form-control" name="nama_proyek" id="nama_proyek" />
            </div>

            <div class="form-group">
              <label>Lokasi</label>
              <input type="text" class="form-control" name="lokasi" id="lokasi" />
            </div>

            <div class="form-group">
              <label>Luas Tanah</label>
              <input type="text" class="form-control" name="luas_tanah" id="luas_tanah" />
            </div>

            <div class="form-group">
              <label>Kode Barang</label>
              <input type="text" class="form-control" name="kode_barang" id="kode_barang" />
            </div>

            <div class="form-group">
              <label>Nama Barang </label>
              <input type="text" class="form-control" name="nama_barang" id="nama_barang" />
            </div>

            <div class="form-group">
              <label>Stok tersedia</label>
              <input type="text" class="form-control" name="stok" id="stok" />
            </div>

            <div class="form-group">
              <label>Harga </label>
              <input type="text" class="form-control" name="harga" id="harga" />
            </div>

            <div class="form-group">
              <label>Jumlah Beli </label>
              <input type="text" class="form-control" name="jumlah" id="jumlah" />
              <input type="hidden" class="form-control" name="nabar" id="nabar" />
            </div>

            <div class="form-group">
              <label>Satuan </label>
              <input type="text" class="form-control" name="uom" id="uom" />
            </div>

          </div>

          <div class="modal-footer">
            <button class="btn btn-info" type="submit">Simpan</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
      </div>
    <?php } else { ?>
      <div class="modal-body">
        <div class="form-group">
          <label>Nomor Permintaan</label><br>
          <select id="no_permintaan" name="no_permintaan" class="form-control">
            <option value="<?php echo $no_permintaan ?>"><?php echo $no_permintaan ?></option>
            <?php
            $sql = $this->db->get('barang_keluar');
            foreach ($sql->result() as $row) {
            ?>
              <option value="<?php echo $row->no_permintaan ?>"><?php echo $row->no_permintaan ?></option>
            <?php } ?>
          </select>
        </div>

        <div class="form-group">
          <label>Nama Proyek</label>
          <input type="text" class="form-control" name="nama_proyek" id="nama_proyek" readonly />
        </div>

        <div class="form-group">
          <label>Lokasi</label>
          <input type="text" class="form-control" name="lokasi" id="lokasi" readonly />
        </div>

        <div class="form-group">
          <label>Luas Tanah</label>
          <input type="text" class="form-control" name="luas_tanah" id="luas_tanah" readonly />
        </div>

        <div class="form-group">
          <label>Kode Barang</label>
          <input type="text" class="form-control" name="kode_barang" id="kode_barang" readonly />
        </div>

        <div class="form-group">
          <label>Nama Barang </label>
          <input type="text" class="form-control" name="nama_barang" id="nama_barang" readonly />
        </div>

        <div class="form-group">
          <label>Stok tersedia</label>
          <input type="text" class="form-control" name="stok" id="stok" readonly />
        </div>

        <div class="form-group">
          <label>Harga </label>
          <input type="text" class="form-control" name="harga" id="harga" readonly />
        </div>

        <div class="form-group">
          <label>Jumlah Beli </label>
          <input type="text" class="form-control" name="jumlah" id="jumlah" readonly />
          <input type="hidden" class="form-control" name="nabar" id="nabar" />
        </div>

        <div class="form-group">
          <label>Satuan </label>
          <input type="text" class="form-control" name="uom" id="uom" readonly />
        </div>

      </div>

      <div class="modal-footer">
        <button class="btn btn-info" type="submit">Simpan</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
  </div>
<?php } ?>

</form>

</div>
</div>

<script type="text/javascript">
  $(document).ready(function() {
    $('#no_permintaan').change(function() {
      var id = $(this).val();
      $.ajax({
        type: 'POST',
        url: '<?php echo base_url('app1/cek_barang1') ?>',
        Cache: false,
        dataType: "json",
        data: 'no_permintaan=' + id,
        success: function(resp) {
          $('#kode_barang').val(resp.kode_barang);
          $('#stok').val(resp.stok);
          $('#nama_barang').val(resp.nama_barang);
          $('#uom').val(resp.uom);
          $('#harga').val(resp.harga);
          $('#nama_proyek').val(resp.nama_proyek);
          $('#luas_tanah').val(resp.luas_tanah);
          $('#lokasi').val(resp.lokasi);
          $('#nabar').val(resp.nama_barang);
          $('#jumlah').val(resp.jumlah);
        }
      });
    });
  });
</script>