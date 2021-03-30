<div class="row">
  <div class="col-md-12">
    <form action="app/simpan_pembelian" method="POST">
      <div class="form-group">
        <label>Kode Pemesanan </label>
        <input type="text" class="form-control" name="kode_pembelian" id="kode_pembelian" value="<?php echo $kodeurut; ?>" readonly />
      </div>
      <div class="table-resposive">
        <table class="table table-bordered">
          <tr>
            <th>No.</th>
            <th>Kode Barang</th>
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
                <a href="app/hapus_cart/<?php echo $items['rowid'] ?>" class="btn btn-warning btn-sm">X</a>
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
        <input type="hidden" name="tgl_pembelian" value="<?php echo date('Y-m-d') ?>">

        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="app/pembelian" class="btn btn-default">Close</a>
      </div>
    </form>
  </div>
</div>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <form action="app/simpan_cart" method="POST">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Tambah Barang</h4>
        </div>
        <?php if ($this->session->userdata('level') == "manajer") { ?>
          <div class="modal-body">
            <div class="form-group">
              <label>Nomor Permintaan</label><br>
              <select id="kode_permintaan" name="kode_permintaan" class="form-control">
                <option value="<?php echo $kode_permintaan ?>"><?php echo $kode_permintaan ?></option>
                <?php
                $sql = $this->db->get('barang_masuk');
                foreach ($sql->result() as $row) {
                ?>
                  <option value="<?php echo $row->kode_permintaan ?>"><?php echo $row->kode_permintaan ?></option>
                <?php } ?>
              </select>
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
              <label>Supplier </label>
              <input type="text" class="form-control" name="nama_supplier" id="nama_supplier" />
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
          <select id="kode_permintaan" name="kode_permintaan" class="form-control">
            <option value="<?php echo $kode_permintaan ?>"><?php echo $kode_permintaan ?></option>
            <?php
            $sql = $this->db->get('barang_masuk');
            foreach ($sql->result() as $row) {
            ?>
              <option value="<?php echo $row->kode_permintaan ?>"><?php echo $row->kode_permintaan ?></option>
            <?php } ?>
          </select>
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
          <label>Supplier </label>
          <input type="text" class="form-control" name="nama_supplier" id="nama_supplier" readonly />
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
    $('#kode_permintaan').change(function() {
      var id = $(this).val();
      $.ajax({
        type: 'POST',
        url: '<?php echo base_url('app/cek_barang1') ?>',
        Cache: false,
        dataType: "json",
        data: 'kode_permintaan=' + id,
        success: function(resp) {
          $('#kode_barang').val(resp.kode_barang);
          $('#stok').val(resp.stok);
          $('#uom').val(resp.uom);
          $('#nama_barang').val(resp.nama_barang);
          $('#harga').val(resp.harga);
          $('#nama_supplier').val(resp.nama_supplier);
          $('#nabar').val(resp.nama_barang);
          $('#jumlah').val(resp.jumlah);
        }
      });
    });
  });
</script>

<script type="text/javascript">
  $(document).ready(function() {
    $('#nama_barang').change(function() {
      var id = $(this).val();
      $.ajax({
        type: 'POST',
        url: '<?php echo base_url('app/cek_barang') ?>',
        Cache: false,
        dataType: "json",
        data: 'kode_barang=' + id,
        success: function(resp) {
          $('#nama_barang').val(resp.nama_barang);
          $('#kode_barang').val(resp.kode_barang);
          $('#stok').val(resp.stok);
          $('#nabar').val(resp.nama_barang);
        }
      });
    });
  });
</script>