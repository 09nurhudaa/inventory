<form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="varchar">Lokasi <?php echo form_error('lokasi') ?></label>
        <input type="text" class="form-control" name="lokasi" id="lokasi" placeholder="Lokasi" value="<?php echo $lokasi; ?>" />
    </div>

    <div class="form-group">
        <label for="varchar">Luas Tanah<?php echo form_error('luas_tanah') ?></label>
        <input type="text" class="form-control" name="luas_tanah" id="luas_tanah" placeholder="Luas Tanah" value="<?php echo $luas_tanah; ?>" />
    </div>

    <input type="hidden" name="id_sub_proyek" value="<?php echo $id_sub_proyek; ?>" />
    <button type="submit" class="btn btn-primary"><?php echo $button ?></button>
    <a href="<?php echo site_url('sub_proyek') ?>" class="btn btn-default">Cancel</a>
</form>