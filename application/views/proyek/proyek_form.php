<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="varchar">Kode Proyek <?php echo form_error('kd_proyek') ?></label>
        <input type="text" class="form-control" name="kd_proyek" id="kd_proyek" placeholder="Kode Proyek" value="<?php echo $kd_proyek; ?>" />
    </div>

    <div class="form-group">
        <label for="varchar">Nama Proyek <?php echo form_error('nama_proyek') ?></label>
        <input type="text" class="form-control" name="nama_proyek" id="nama_proyek" placeholder="Nama Proyek" value="<?php echo $nama_proyek; ?>" />
    </div>

    <div class="form-group">
        <label for="int">Lokasi</label>
        <select name="lokasi" class="form-control">
            <option value="<?php echo $lokasi ?>"><?php echo $lokasi ?></option>
            <?php
            $sql = $this->db->get('sub_proyek');
            foreach ($sql->result() as $row) {
            ?>
                <option value="<?php echo $row->lokasi ?>"><?php echo $row->lokasi ?></option>
            <?php } ?>
        </select>
    </div>

    <input type="hidden" name="id_proyek" value="<?php echo $id_proyek; ?>" />
    <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
    <a href="<?php echo site_url('proyek') ?>" class="btn btn-default">Cancel</a>
</form>