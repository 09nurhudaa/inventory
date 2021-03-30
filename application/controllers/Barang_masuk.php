<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Barang_masuk extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Barang_masuk_model');
        $this->load->model('No_urut');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 'barang_masuk/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'barang_masuk/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'barang_masuk/index.html';
            $config['first_url'] = base_url() . 'barang_masuk/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Barang_masuk_model->total_rows($q);
        $barang_masuk = $this->Barang_masuk_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'barang_masuk_data' => $barang_masuk,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'konten' => 'barang_masuk/barang_masuk_list',
            'judul' => 'Data Permohonan Barang Masuk',
        );
        $this->load->view('v_index', $data);
    }

    public function cek_barang()
    {
        $nama_barang = $this->input->post('nama_barang');
        $cek = $this->db->query("SELECT * FROM barang WHERE nama_barang='$nama_barang'")->row();
        $data = array(
            'stok' => $cek->stok,
            'kode_barang' => $cek->kode_barang,
            'nama_barang' => $cek->nama_barang,
            'nama_supplier' => $cek->nama_supplier,
            'harga' => $cek->harga,
            'uom' => $cek->uom,
        );
        echo json_encode($data);
    }

    public function read($id)
    {
        $row = $this->Barang_masuk_model->get_by_id($id);
        if ($row) {
            $data = array(
                'id_barang_masuk' => $row->id_barang_masuk,
                'kode_permintaan' => $row->kode_permintaan,
                'kode_barang' => $row->kode_barang,
                'nama_barang' => $row->nama_barang,
                'nama_supplier' => $row->nama_supplier,
                'stok' => $row->stok,
                'uom' => $row->uom,
                'jumlah' => $row->jumlah,
                'harga' => $row->harga,
            );
            $this->load->view('barang_masuk/barang_masuk_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('barang_masuk'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('barang_masuk/create_action'),
            'id_barang_masuk' => set_value('id_barang_masuk'),
            'kode_permintaan' => $this->No_urut->buat_kode_permintaan(),
            'kode_barang' => set_value('kode_barang'),
            'nama_barang' => set_value('nama_barang'),
            'nama_supplier' => set_value('nama_supplier'),
            'stok' => set_value('stok'),
            'jumlah' => set_value('jumlah'),
            'uom' => set_value('uom'),
            'harga' => set_value('harga'),
            'konten' => 'barang_masuk/barang_masuk_form',
            'judul' => 'Data Permohonan Barang Masuk',
        );
        $this->load->view('v_index', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'kode_permintaan' => $this->input->post('kode_permintaan', TRUE),
                'kode_barang' => $this->input->post('kode_barang', TRUE),
                'nama_barang' => $this->input->post('nama_barang', TRUE),
                'nama_supplier' => $this->input->post('nama_supplier', TRUE),
                'jumlah' => $this->input->post('jumlah', TRUE),
                'uom' => $this->input->post('uom', TRUE),
                'stok' => $this->input->post('stok', TRUE),
                'harga' => $this->input->post('harga', TRUE),
            );

            $this->Barang_masuk_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('barang_masuk'));
        }
    }

    public function update($id)
    {
        $row = $this->Barang_masuk_model->get_by_id($id);
        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('barang_masuk/update_action'),
                'id_barang_masuk' => set_value('id_barang_masuk', $row->id_barang_masuk),
                'kode_permintaan' => set_value('kode_permintaan', $row->kode_permintaan),
                'nama_barang' => set_value('nama_barang', $row->nama_barang),
                'kode_barang' => set_value('kode_barang', $row->kode_barang),
                'stok' => set_value('stok', $row->stok),
                'nama_supplier' => set_value('nama_supplier', $row->nama_supplier),
                'jumlah' => set_value('jumlah', $row->jumlah),
                'uom' => set_value('uom', $row->uom),
                'harga' => set_value('harga', $row->harga),
                'konten' => 'barang_masuk/barang_masuk_form',
                'judul' => 'Edit Permohonan Barang Masuk',
            );
            $this->load->view('v_index', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('barang_masuk'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_barang_masuk', TRUE));
        } else {
            $data = array(
                'kode_permintaan' => $this->input->post('kode_permintaan', TRUE),
                'nama_barang' => $this->input->post('nama_barang', TRUE),
                'kode_barang' => $this->input->post('kode_barang', TRUE),
                'nama_supplier' => $this->input->post('nama_supplier', TRUE),
                'stok' => $this->input->post('stok', TRUE),
                'uom' => $this->input->post('uom', TRUE),
                'jumlah' => $this->input->post('jumlah', TRUE),
                'harga' => $this->input->post('harga', TRUE),
            );
            $this->Barang_masuk_model->update($this->input->post('id_barang_masuk', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('barang_masuk'));
        }
    }

    public function delete($id)
    {
        $row = $this->Barang_masuk_model->get_by_id($id);

        if ($row) {
            $this->Barang_masuk_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('barang_masuk'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('barang_masuk'));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('kode_permintaan', 'kode_permintaan', 'trim|required');
        $this->form_validation->set_rules('nama_barang', 'nama_barang', 'trim|required');
        $this->form_validation->set_rules('kode_barang', 'kode_barang', 'trim|required');
        $this->form_validation->set_rules('nama_supplier', 'nama_supplier', 'trim|required');
        $this->form_validation->set_rules('jumlah', 'jumlah', 'trim|required');
        $this->form_validation->set_rules('harga', 'harga', 'trim|required');
        $this->form_validation->set_rules('stok', 'stok', 'trim|required');
        $this->form_validation->set_rules('uom', 'uom', 'trim|required');
        $this->form_validation->set_rules('id_barang_masuk', 'id_barang_masuk', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}

/* End of file Barang_masuk.php */