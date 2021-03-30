<form action="<?php echo $action; ?>" method="post">
    <div class="form-group">
        <label for="varchar">Nomor Permintaan <?php echo form_error('no_permintaan') ?></label>
        <input type="text" class="form-control" name="no_permintaan" id="no_permintaan" placeholder="Nomor Permintaan" value="<?php echo $no_permintaan; ?>" readonly />
    </div>

    <div class="form-group">
        <label for="varchar">Nama Barang <?php echo form_error('nama_barang') ?></label>
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
        <input type="text" class="form-control" name="kode_barang" id="kode_barang" placeholder="kode_barang" value="<?php echo $kode_barang; ?>" readonly />
    </div>

    <div class="form-group">
        <label for="varchar">Stok Tersedia <?php echo form_error('stok') ?></label>
        <input type="text" class="form-control" name="stok" id="stok" placeholder="Stok" value="<?php echo $stok; ?>" readonly />
    </div>

    <div class="form-group">
        <label for="varchar">Harga <?php echo form_error('harga') ?></label>
        <input type="text" class="form-control" name="harga" id="harga" placeholder="Harga" value="<?php echo $harga; ?>" readonly />
    </div>

    <div class="form-group">
        <label for="date">Tgl Keluar <?php echo form_error('tgl_keluar') ?></label>
        <input type="date" class="form-control tgl" name="tgl_keluar" id="tgl_keluar" placeholder="Tgl Keluar" value="<?php echo $tgl_keluar; ?>" />
    </div>

    <div class="form-group">
        <label for="int">Jumlah <?php echo form_error('jumlah') ?></label>
        <input type="text" class="form-control" name="jumlah" id="jumlah" placeholder="Jumlah" value="<?php echo $jumlah; ?>" />
    </div>

    <div class="form-group">
        <label for="varchar">satuan <?php echo form_error('uom') ?></label>
        <input type="text" class="form-control" name="uom" id="uom" placeholder="Satuan" value="<?php echo $uom; ?>" readonly />
    </div>

    <div class="form-group">
        <label for="varchar">Nama Proyek <?php echo form_error('nama_proyek') ?></label>
        <select id="nama_proyek" name="nama_proyek" class="form-control">
            <option value="<?php echo $nama_proyek ?>"><?php echo $nama_proyek ?></option>
            <?php
            $sql = $this->db->get('proyek');
            foreach ($sql->result() as $row) {
            ?>
                <option value="<?php echo $row->nama_proyek ?>"><?php echo $row->nama_proyek ?></option>
            <?php } ?>
        </select>
    </div>

    <div class="form-group">
        <label for="varchar">Lokasi <?php echo form_error('lokasi') ?></label>
        <input type="text" class="form-control" name="lokasi" id="lokasi" placeholder="Lokasi" value="<?php echo $lokasi; ?>" readonly />
    </div>

    <div class="form-group">
        <label for="varchar">Luas Tanah <?php echo form_error('luas_tanah') ?></label>
        <input type="text" class="form-control" name="luas_tanah" id="luas_tanah" placeholder="Luas Tanah" value="<?php echo $luas_tanah; ?>" readonly />
    </div>
    <input type="hidden" name="id_barang_keluar" value="<?php echo $id_barang_keluar; ?>" />
    <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
    <input type="hidden" class="form-control" name="nabar" id="nabar" />
    <a href="<?php echo site_url('barang_keluar') ?>" class="btn btn-default">Cancel</a>
</form>

<script type="text/javascript">
    $(document).ready(function() {
        $('#nama_barang').change(function() {
            var id = $(this).val();
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url('barang_keluar/cek_barang') ?>',
                Cache: false,
                dataType: "json",
                data: 'nama_barang=' + id,
                success: function(resp) {
                    $('#uom').val(resp.uom);
                    $('#kode_barang').val(resp.kode_barang);
                    $('#harga').val(resp.harga);
                    $('#stok').val(resp.stok);
                    $('#nabar').val(resp.nama_barang);
                }
            });
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#nama_proyek').change(function() {
            var id = $(this).val();
            $.ajax({
                type: 'POST',
                url: '<?php echo base_url('barang_keluar/cek_barang2') ?>',
                Cache: false,
                dataType: "json",
                data: 'nama_proyek=' + id,
                success: function(resp) {
                    $('#nama_proyek').val(resp.nama_proyek);
                    $('#lokasi').val(resp.lokasi);
                    $('#luas_tanah').val(resp.luas_tanah);
                }
            });
        });
    });
</script>