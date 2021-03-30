<form action="<?php echo $action; ?>" method="post">
    <div class="form-group">
        <label for="varchar">Nomor Permintaan <?php echo form_error('kode_permintaan') ?></label>
        <input type="text" class="form-control" name="kode_permintaan" id="kode_permintaan" placeholder="Nomor Permintaan" value="<?php echo $kode_permintaan; ?>" readonly />
    </div>

    <div class="form-group">
        <label>Nama Barang</label><br>
        <select id="nama_barang" name="nama_barang" class="form-control">
            <option value="<?php echo $nama_barang ?>"><?php echo $nama_barang ?></option>
            <?php
            $sql = $this->db->get('barang');
            foreach ($sql->result() as $row) {
            ?>
                <option value="<?php echo $row->nama_barang ?>"><?php echo $row->nama_barang ?></option>
            <?php } ?>
        </select>
    </div>

    <div class="form-group">
        <label for="varchar">Kode Barang <?php echo form_error('kode_barang') ?></label>
        <input type="text" class="form-control" name="kode_barang" id="kode_barang" placeholder="Kode Barang" value="<?php echo $kode_barang; ?>" readonly />
    </div>


    <div class="form-group">
        <label for="varchar">Nama Supplier <?php echo form_error('nama_supplier') ?></label>
        <input type="text" class="form-control" name="nama_supplier" id="nama_supplier" placeholder="Nama Supplier" value="<?php echo $nama_supplier; ?>" readonly />
    </div>

    <div class="form-group">
        <label for="int">Stok Barang Tersedia <?php echo form_error('stok') ?></label>
        <input type="text" class="form-control" name="stok" id="stok" placeholder="Stok" value="<?php echo $stok; ?>" readonly />
    </div>

    <div class="form-group">
        <label for="int">Jumlah Barang Masuk <?php echo form_error('jumlah') ?></label>
        <input type="text" class="form-control" name="jumlah" id="jumlah" placeholder="Jumlah" value="<?php echo $jumlah; ?>" />
    </div>

    <div class="form-group">
        <label for="varchar">Satuan <?php echo form_error('uom') ?></label>
        <input type="text" class="form-control" name="uom" id="uom" placeholder="Satuan" value="<?php echo $uom; ?>" readonly />
    </div>

    <div class="form-group">
        <label for="int">Harga <?php echo form_error('harga') ?></label>
        <input type="text" class="form-control" name="harga" id="harga" placeholder="Harga" value="<?php echo $harga; ?>" readonly />
    </div>

    <input type="hidden" name="id_barang_masuk" value="<?php echo $id_barang_masuk; ?>" />
    <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
    <input type="hidden" class="form-control" name="nabar" id="nabar" />
    <a href="<?php echo site_url('barang_masuk') ?>" class="btn btn-default">Cancel</a>
</form>

<script type="text/javascript">
    $(document).ready(function() {
        $('#nama_barang').change(function() {
            var id = $(this).val();
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url('barang_masuk/cek_barang') ?>',
                Cache: false,
                dataType: "json",
                data: 'nama_barang=' + id,
                success: function(resp) {
                    $('#kode_barang').val(resp.kode_barang);
                    $('#nama_supplier').val(resp.nama_supplier);
                    $('#uom').val(resp.uom);
                    $('#harga').val(resp.harga);
                    $('#stok').val(resp.stok);
                    $('#nabar').val(resp.nama_barang);
                }
            });
        });
    });
</script>