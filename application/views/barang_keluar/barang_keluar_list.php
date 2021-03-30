<div class="row" style="margin-bottom: 10px">
    <div class="col-md-4">
        <?php echo anchor(site_url('barang_keluar/create'), 'Create', 'class="btn btn-primary"'); ?>
    </div>
    <div class="col-md-4 text-center">
        <div style="margin-top: 8px" id="message">
            <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
        </div>
    </div>
    <div class="col-md-1 text-right">
    </div>
    <div class="col-md-3 text-right">
        <form action="<?php echo site_url('barang_keluar/index'); ?>" class="form-inline" method="get">
            <div class="input-group">
                <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                <span class="input-group-btn">
                    <?php
                    if ($q <> '') {
                    ?>
                        <a href="<?php echo site_url('barang_keluar'); ?>" class="btn btn-default">Reset</a>
                    <?php
                    }
                    ?>
                    <button class="btn btn-primary" type="submit">Search</button>
                </span>
            </div>
        </form>
    </div>
</div>
<table class="table table-bordered" style="margin-bottom: 10px">
    <tr>
        <th>
            <center>No</center>
        </th>
        <th>
            <center>No Permintaan</center>
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
            <center>Harga</center>
        </th>
        <th>
            <center>Stok Tersedia</center>
        </th>
        <th>
            <center>Tgl Keluar</center>
        </th>
        <th>
            <center>Jumlah</center>
        </th>
        <th>
            <center>Satuan</center>
        </th>
        <th>
            <center>Action</center>
        </th>
    </tr><?php
            foreach ($barang_keluar_data as $barang_keluar) {
            ?>
        <tr>
            <td width="80px"><?php echo ++$start ?></td>
            <td align=center><?php echo $barang_keluar->no_permintaan ?></td>
            <td align=center><?php echo $barang_keluar->nama_proyek ?></td>
            <td align=center><?php echo $barang_keluar->lokasi ?></td>
            <td align=center><?php echo $barang_keluar->luas_tanah ?></td>
            <td align=center><?php echo $barang_keluar->nama_barang ?></td>
            <td align=center><?php echo $barang_keluar->harga ?></td>
            <td align=center><?php echo $barang_keluar->stok ?></td>
            <td align=center><?php echo $barang_keluar->tgl_keluar ?></td>
            <td align=center><?php echo $barang_keluar->jumlah ?></td>
            <td align=center><?php echo $barang_keluar->uom ?></td>
            <td style="text-align:center" width="200px">
                <?php
                if ($this->session->userdata('level') == "manajer") {
                    echo anchor(site_url('barang_keluar/update/' . $barang_keluar->id_barang_keluar), 'Update');
                } elseif ($this->session->userdata('level') == "petugas gudang") {
                    echo anchor(site_url('barang_keluar/update/' . $barang_keluar->id_barang_keluar), 'Update');
                } else {
                    echo anchor(site_url('barang_keluar/update/' . $barang_keluar->id_barang_keluar), 'Update');
                    echo ' | ';
                    echo anchor(site_url('barang_keluar/delete/' . $barang_keluar->id_barang_keluar), 'Delete', 'onclick="javasciprt: return confirm(\'Are You Sure ?\')"');
                }
                // echo anchor(site_url('barang_keluar/update/' . $barang_keluar->id_barang_keluar), 'Update');
                // echo ' | ';
                // echo anchor(site_url('barang_keluar/delete/' . $barang_keluar->id_barang_keluar), 'Delete', 'onclick="javasciprt: return confirm(\'Are You Sure ?\')"');
                ?>
            </td>
        </tr>
    <?php
            }
    ?>
</table>
<div class="row">
    <div class="col-md-6">
        <a href="#" class="btn btn-primary">Total Record : <?php echo $total_rows ?></a>
    </div>
    <div class="col-md-6 text-right">
        <?php echo $pagination ?>
    </div>
</div>