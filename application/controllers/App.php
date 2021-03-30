<?php
defined('BASEPATH') or exit('No direct script access allowed');

class App extends CI_Controller
{
	public function index()
	{
		if ($this->session->userdata('level') == "") {
			redirect('app/login');
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
			redirect('app/login');
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
				redirect('app');
			} elseif ($cek_supplier->num_rows() == 1) {
				foreach ($cek_supplier->result() as $row) {
					$sess_data['id_user'] = $row->kode_supplier;
					$sess_data['nama'] = $row->nama_supplier;
					$sess_data['username'] = $row->username;
					$sess_data['level'] = 'supplier';
					$this->session->set_userdata($sess_data);
				}
				redirect('app');
			} else {
?>
				<script type="text/javascript">
					alert('Username dan password kamu salah !');
					window.location = "<?php echo base_url('app/login'); ?>";
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
		redirect('app/login');
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
			window.location = '<?php echo base_url('app/login'); ?>'
		</script>
	<?php
	}


	public function cek_barang1()
	{
		$kode_permintaan = $this->input->post('kode_permintaan');
		$cek = $this->db->query("SELECT * FROM barang_masuk WHERE kode_permintaan='$kode_permintaan'")->row();
		$data = array(
			'nama_barang' => $cek->nama_barang,
			'kode_barang' => $cek->kode_barang,
			'nama_supplier' => $cek->nama_supplier,
			'stok' => $cek->stok,
			'uom' => $cek->uom,
			'harga' => $cek->harga,
			'jumlah' => $cek->jumlah,
		);
		echo json_encode($data);
	}

	public function tambah_pembelian()
	{
		$this->load->model('No_urut');

		$data = array(
			'konten' => 'form_pembelian',
			'judul' => 'Tambah Transaksi',
			'kodeurut' => $this->No_urut->buat_kode_pembelian(),
		);
		$this->load->view('v_index', $data);
	}

	public function hapus_pembelian($kode_pembelian)
	{

		$this->db->where('kode_transaksi', $kode_pembelian);
		$this->db->delete('transaksi');
		$this->db->where('kode_transaksi', $kode_pembelian);
		$this->db->delete('detail_transaksi');
	?>
		<script type="text/javascript">
			alert('Berhapus Hapus Data');
			window.location = '<?php echo base_url('app/pembelian') ?>';
		</script>
<?php
	}

	public function cetak_pembelian($kode_pembelian)
	{

		$data = array(
			'data' => $this->db->query("SELECT * FROM transaksi where kode_transaksi='$kode_pembelian'"),
		);
		$this->load->view('cetak_pembelian', $data);
	}

	public function detail_pembelian($kode_pembelian)
	{

		$data = array(
			'konten' => 'detail_pembelian',
			'judul' => 'Detail Pembelian',
			'data' => $this->db->query("SELECT * FROM transaksi where kode_transaksi='$kode_pembelian'"),
		);
		$this->load->view('v_index', $data);
	}


	public function simpan_pembelian()
	{
		$kode_pembelian = $this->input->post('kode_pembelian');
		$total_harga = $this->input->post('total_harga');
		$tgl_pembelian = $this->input->post('tgl_pembelian');
		// $pelanggan = $this->input->post('pelanggan');

		foreach ($this->cart->contents() as $items) {
			$kode_barang = $items['id'];
			$qty = $items['qty'];
			$d = array(
				'kode_transaksi' => $kode_pembelian,
				'kode_barang' => $kode_barang,
				'qty' => $qty,
			);
			$cek = $this->db->query("Update barang_masuk set status=1 where kode_barang ='" . $kode_barang . "'");
			if ($cek) {
				$this->db->insert('detail_transaksi', $d);
			}
		}

		$data = array(
			'kode_transaksi' => $kode_pembelian,
			'total_harga' => $total_harga,
			'tgl_transaksi' => $tgl_pembelian,
		);
		$this->db->insert('transaksi', $data);
		$this->cart->destroy();
		redirect('app/pembelian');
	}

	public function simpan_cart()
	{

		$data = array(
			'id'    => $this->input->post('kode_barang'),
			'qty'   => $this->input->post('jumlah'),
			'price' => $this->input->post('harga'),
			'name'  => $this->input->post('nabar'),
		);
		$this->cart->insert($data);
		redirect('app/tambah_pembelian');
	}

	public function hapus_cart($id)
	{

		$data = array(
			'rowid'    => $id,
			'qty'   => 0,
		);
		$this->cart->update($data);
		redirect('app/tambah_pembelian');
	}


	public function pembelian()
	{
		$data = array(
			'konten' => 'pembelian',
			'judul' => 'Data Transaksi',
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
