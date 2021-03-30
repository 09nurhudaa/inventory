<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="varchar">Kode Barang <?php echo form_error('kode_barang') ?></label>
        <input type="text" class="form-control" name="kode_barang" id="kode_barang" placeholder="Kode Barang" value="<?php echo $kode_barang; ?>" />
    </div>
    <div class="form-group">
        <label for="varchar">Nama Barang <?php echo form_error('nama_barang') ?></label>
        <input type="text" class="form-control" name="nama_barang" id="nama_barang" placeholder="Nama Barang" value="<?php echo $nama_barang; ?>" />
    </div>
    <div class="form-group">
        <label for="int">Harga <?php echo form_error('harga') ?></label>
        <input type="text" class="form-control" name="harga" id="harga" placeholder="Harga" value="<?php echo $harga; ?>" />
    </div>
    <div class="form-group">
        <label for="int">Foto Barang </label>
        <input type="file" class="form-control" name="foto_barang" />
    </div>
    <div class="form-group">
        <label for="int">Jenis Barang </label>
        <select name="jenis_barang" class="form-control">
            <option value="<?php echo $jenis_barang ?>"><?php echo $jenis_barang ?></option>
            <?php
            $sql = $this->db->get('jenis_barang');
            foreach ($sql->result() as $row) {
            ?>
                <option value="<?php echo $row->jenis_barang ?>"><?php echo $row->jenis_barang ?></option>
            <?php } ?>
        </select>
    </div>

    <div class="form-group">
        <label for="int">Merk Barang </label>
        <select name="merk_barang" class="form-control">
            <option value="<?php echo $merk_barang ?>"><?php echo $merk_barang ?></option>
            <?php
            $sql = $this->db->get('merk_barang');
            foreach ($sql->result() as $row) {
            ?>
                <option value="<?php echo $row->merk_barang ?>"><?php echo $row->merk_barang ?></option>
            <?php } ?>
        </select>
    </div>

    <div class="form-group">
        <label for="int">Supplier </label>
        <select name="nama_supplier" class="form-control">
            <option value="<?php echo $nama_supplier ?>"><?php echo $nama_supplier ?></option>
            <?php
            $sql = $this->db->get('supplier');
            foreach ($sql->result() as $row) {
            ?>
                <option value="<?php echo $row->nama_supplier ?>"><?php echo $row->nama_supplier ?></option>
            <?php } ?>
        </select>
    </div>

    <div class="form-group">
        <label for="int">Stok <?php echo form_error('stok') ?></label>
        <input type="text" class="form-control" name="stok" id="stok" placeholder="Stok" value="<?php echo $stok; ?>" />
    </div>

    <div class="form-group">
        <label for="varchar">UOM <?php echo form_error('uom') ?></label>
        <input type="text" class="form-control" name="uom" id="uom" placeholder="Satuan" value="<?php echo $uom; ?>" />
    </div>

    <input type="hidden" name="id_barang" value="<?php echo $id_barang; ?>" />
    <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
    <a href="<?php echo site_url('barang') ?>" class="btn btn-default">Cancel</a>
</form>