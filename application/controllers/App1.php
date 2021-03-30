<?php
defined('BASEPATH') or exit('No direct script access allowed');

class App1 extends CI_Controller
{

  public function index()
  {
    if ($this->session->userdata('level') == "") {
      redirect('penjualan/login');
    }
    $data = array(
      'konten' => 'home',
      'judul' => 'Dashboard',
    );
    $this->load->view('v_index', $data);
  }

  public function history()
  {
    if ($this->session->userdata('id_user') == "") {
      redirect('penjualan/login');
    }
    $data = array(
      'konten' => 'history',
      'judul' => 'History Diagnosa',
    );
    $this->load->view('v_index', $data);
  }

  public function registrasi()
  {

    $this->load->view('reg_user');
  }

  public function login()
  {

    if ($this->input->post() == NULL) {
      $this->load->view('login');
    } else {
      $username = $this->input->post('username');
      $password = $this->input->post('password');
      $cek_user = $this->db->query("SELECT * FROM users WHERE username='$username' and password='$password' ");
      $cek_supplier = $this->db->query("SELECT * FROM supplier WHERE username='$username' and password='$password'");
      if ($cek_user->num_rows() == 1) {
        foreach ($cek_user->result() as $row) {
          $sess_data['id_user'] = $row->id_user;
          $sess_data['nama'] = $row->nama_user;
          $sess_data['username'] = $row->username;
          $sess_data['level'] = $row->level;
          $this->session->set_userdata($sess_data);
        }
        redirect('penjualan');
      } elseif ($cek_supplier->num_rows() == 1) {
        foreach ($cek_supplier->result() as $row) {
          $sess_data['id_user'] = $row->kode_supplier;
          $sess_data['nama'] = $row->nama_supplier;
          $sess_data['username'] = $row->username;
          $sess_data['level'] = 'supplier';
          $this->session->set_userdata($sess_data);
        }
        redirect('penjualan');
      } else {
?>
        <script type="text/javascript">
          alert('Username dan password kamu salah !');
          window.location = "<?php echo base_url('penjualan/login'); ?>";
        </script>
    <?php
      }
    }
  }

  function logout()
  {
    $this->session->unset_userdata('id_user');
    $this->session->unset_userdata('username');
    $this->session->unset_userdata('nama');
    $this->session->unset_userdata('level');
    session_destroy();
    redirect('penjualan/login');
  }

  public function simpan_reg()
  {
    $nama = $this->input->post('nama');
    $username = $this->input->post('username');
    $password = $this->input->post('password');

    $data = array(
      'nama' => $nama,
      'username' => $username,
      'password' => $password,
      'level' => 'user',
    );

    $this->db->insert('user', $data);
    ?>
    <script type="text/javascript">
      alert('Pendaftaran Berhasil, Silahkan Login');
      window.location = '<?php echo base_url('penjualan/login'); ?>'
    </script>
  <?php
  }


  public function cek_barang1()
  {
    $no_permintaan = $this->input->post('no_permintaan');
    $cek = $this->db->query("SELECT * FROM barang_keluar WHERE no_permintaan='$no_permintaan'")->row();
    $data = array(
      'kode_barang' => $cek->kode_barang,
      'nama_barang' => $cek->nama_barang,
      'nama_proyek' => $cek->nama_proyek,
      'lokasi' => $cek->lokasi,
      'luas_tanah' => $cek->luas_tanah,
      'stok' => $cek->stok,
      'uom' => $cek->uom,
      'harga' => $cek->harga,
      'jumlah' => $cek->jumlah,
    );
    echo json_encode($data);
  }

  public function tambah_penjualan()
  {
    $this->load->model('No_urut');

    $data = array(
      'konten' => 'form_penjualan',
      'judul' => 'Konfirmasi Barang Keluar',
      'kodeurut' => $this->No_urut->buat_kode_penjualan(),
    );
    $this->load->view('v_index', $data);
  }

  public function hapus_penjualan($kode_penjualan)
  {

    $this->db->where('kode_keluar', $kode_penjualan);
    $this->db->delete('transaksi_keluar');
    $this->db->where('kode_keluar', $kode_penjualan);
    $this->db->delete('detail_transaksi_keluar');
  ?>
    <script type="text/javascript">
      alert('Berhapus Hapus Data');
      window.location = '<?php echo base_url('app1/penjualan') ?>';
    </script>
<?php
  }

  public function cetak_penjualan($kode_penjualan)
  {

    $data = array(
      'data' => $this->db->query("SELECT * FROM transaksi_keluar where kode_keluar='$kode_penjualan'"),
    );
    $this->load->view('cetak_penjualan', $data);
  }

  public function detail_penjualan($kode_penjualan)
  {

    $data = array(
      'konten' => 'detail_penjualan',
      'judul' => 'Detail Barang Keluar',
      'data' => $this->db->query("SELECT * FROM transaksi_keluar where kode_keluar='$kode_penjualan'"),
    );
    $this->load->view('v_index', $data);
  }


  public function simpan_penjualan()
  {
    $kode_penjualan = $this->input->post('kode_penjualan');
    $total_harga = $this->input->post('total_harga');
    $tgl_penjualan = $this->input->post('tgl_penjualan');
    // $pelanggan = $this->input->post('pelanggan');

    foreach ($this->cart->contents() as $items) {
      $no_permintaan = $items['id'];
      $qty = $items['qty'];
      $kode_barang = $items['kode_barang'];
      $d = array(
        'kode_keluar' => $kode_penjualan,
        'no_permintaan' => $no_permintaan,
        'kode_barang' => $kode_barang,
        'qty' => $qty,
      );
      $cek = $this->db->query("Update barang_keluar set status=1 where no_permintaan ='" . $no_permintaan
        . "'");
      if ($cek) {
        $this->db->insert('detail_transaksi_keluar', $d);
      }
    }

    $data = array(
      'kode_keluar' => $kode_penjualan,
      'total_harga' => $total_harga,
      'tgl_keluar' => $tgl_penjualan,
    );
    $this->db->insert('transaksi_keluar', $data);
    $this->cart->destroy();
    redirect('app1/penjualan');
  }

  public function simpan_cart()
  {

    $data = array(
      'id'    => $this->input->post('no_permintaan'),
      'kode_barang'    => $this->input->post('kode_barang'),
      'qty'   => $this->input->post('jumlah'),
      'price' => $this->input->post('harga'),
      'name'  => $this->input->post('nabar'),
    );
    $this->cart->insert($data);
    redirect('app1/tambah_penjualan');
  }

  public function hapus_cart($id)
  {

    $data = array(
      'rowid'    => $id,
      'qty'   => 0,
    );
    $this->cart->update($data);
    redirect('app1/tambah_penjualan');
  }


  public function penjualan()
  {
    $data = array(
      'konten' => 'penjualan',
      'judul' => 'Konfirmasi Barang Keluar',
    );
    $this->load->view('v_index', $data);
  }

  public function pemesanan_supplier()
  {
    $data = array(
      'konten' => 'pesanan_supplier',
      'judul' => 'Data Pemesanan Barang ke Supplier',
    );
    $this->load->view('v_index', $data);
  }
}
