<div class="col-xs-6 col-sm-3 sidebar-offcanvas" role="navigation">
  <ul class="list-group panel">
    <li class="list-group-item"><i class="glyphicon glyphicon-align-justify"></i> <b>MENU UTAMA</b></li>
    <li class="list-group-item"><input type="text" class="form-control search-query" placeholder="Search Something"></li>
    <li class="list-group-item"><a href="<?php echo base_url() ?>"><i class="glyphicon glyphicon-home"></i>Dashboard </a></li>

    <?php
    if ($this->session->userdata('level') == 'admin') {
    ?>

      <li>
        <a href="#demo4" class="list-group-item " data-toggle="collapse"><i class="glyphicon glyphicon-th-large"></i>Data Master <span class="glyphicon glyphicon-chevron-right"></span></a>
      <li class="collapse" id="demo4">
        <a href="barang" class="list-group-item"> Data Barang</a>
        <a href="proyek" class="list-group-item"> Data Proyek</a>
        <a href="jenis_barang" class="list-group-item"> Jenis Barang</a>
        <a href="merk_barang" class="list-group-item"> Merk Barang</a>
        <a href="supplier" class="list-group-item"> Supplier</a>
        <a href="sub_proyek" class="list-group-item">Sub Proyek</a>
      </li>
      </li>
      <li>
        <a href="#demo5" class="list-group-item " data-toggle="collapse"><i class="glyphicon glyphicon-folder-open"></i>Data Transaksi <span class="glyphicon glyphicon-chevron-right"></span></a>
      <li class="collapse" id="demo5">
        <a href="barang_masuk" class="list-group-item">Data Permohonan Barang Masuk</a>
        <a href="barang_keluar" class="list-group-item">Data Permohonan Barang Keluar</a>
        <a href="app/pembelian" class="list-group-item">Konfirmasi Barang Masuk</a>
        <a href="app1/penjualan" class="list-group-item">Konfirmasi Barang Keluar</a>

      </li>
      </li>
      <li class="list-group-item"><a href="users"><i class="glyphicon glyphicon-user"></i>Manajemen User </a></li>
      <li class="list-group-item"><a href="<?php echo base_url() ?>app/logout"><i class="glyphicon glyphicon-share"></i>Logout </a></li>

    <?php
    } elseif ($this->session->userdata('level') == 'manajer') {
    ?>

      <!-- <li>
        <a href="#demo4" class="list-group-item " data-toggle="collapse"><i class="glyphicon glyphicon-th-large"></i>Data Master <span class="glyphicon glyphicon-chevron-right"></span></a>
      <li class="collapse" id="demo4">
        <a href="barang" class="list-group-item"> Data Barang</a>
        <a href="proyek" class="list-group-item"> Data Proyek</a>
        <a href="jenis_barang" class="list-group-item"> Jenis Barang</a>
        <a href="merk_barang" class="list-group-item"> Merk Barang</a>
        <a href="supplier" class="list-group-item"> Supplier</a>
      </li>
      </li> -->

      <li>
        <a href="#demo5" class="list-group-item " data-toggle="collapse"><i class="glyphicon glyphicon-folder-open"></i>Data Transaksi <span class="glyphicon glyphicon-chevron-right"></span></a>
      <li class="collapse" id="demo5">
        <a href="barang_masuk" class="list-group-item">Transaksi Barang Masuk</a>
        <a href="barang_keluar" class="list-group-item">Transaksi Barang Keluar</a>
        <a href="app/pembelian" class="list-group-item">Konfirmasi Barang Masuk</a>
        <a href="app1/penjualan" class="list-group-item">Konfirmasi Barang Keluar</a>
      </li>
      </li>
      <!-- <li class="list-group-item"><a href="users"><i class="glyphicon glyphicon-user"></i>Manajemen User </a></li> -->
      <li class="list-group-item"><a href="<?php echo base_url() ?>app/logout"><i class="glyphicon glyphicon-share"></i>Logout </a></li>

    <?php
    } elseif ($this->session->userdata('level') == 'petugas gudang') {
    ?>

      <li>
        <a href="#demo5" class="list-group-item " data-toggle="collapse"><i class="glyphicon glyphicon-folder-open"></i>Data Transaksi <span class="glyphicon glyphicon-chevron-right"></span></a>
      <li class="collapse" id="demo5">
        <a href="barang_masuk" class="list-group-item">Transaksi Barang Masuk</a>
        <a href="barang_keluar" class="list-group-item">Transaksi Barang Keluar</a>
      </li>
      </li>
      <!-- <li class="list-group-item"><a href="users"><i class="glyphicon glyphicon-user"></i>Manajemen User </a></li> -->
      <li class="list-group-item"><a href="<?php echo base_url() ?>app/logout"><i class="glyphicon glyphicon-share"></i>Logout </a></li>

    <?php
    } elseif ($this->session->userdata('level') == 'supplier') {
    ?>



      <li class="list-group-item"><a href="app/pemesanan_supplier"><i class="glyphicon glyphicon-tasks"></i>Daftar Pesanan Barang </a></li>
      <li class="list-group-item"><a href="<?php echo base_url() ?>app/logout"><i class="glyphicon glyphicon-share"></i>Logout </a></li>

    <?php } ?>

  </ul>
</div>