<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Barang_keluar extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Barang_keluar_model');
        $this->load->model('No_urut');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 'barang_keluar/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'barang_keluar/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'barang_keluar/index.html';
            $config['first_url'] = base_url() . 'barang_keluar/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Barang_keluar_model->total_rows($q);
        $barang_keluar = $this->Barang_keluar_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'barang_keluar_data' => $barang_keluar,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'konten' => 'barang_keluar/barang_keluar_list',
            'judul' => 'Data Permohonan Barang Keluar',
        );
        $this->load->view('v_index', $data);
    }

    public function cek_barang()
    {
        $nama_barang = $this->input->post('nama_barang');
        $cek = $this->db->query("SELECT * FROM barang WHERE nama_barang='$nama_barang'")->row();
        $data = array(
            'stok' => $cek->stok,
            'nama_barang' => $cek->nama_barang,
            'kode_barang' => $cek->kode_barang,
            'harga' => $cek->harga,
            'uom' => $cek->uom,
        );
        echo json_encode($data);
    }

    public function cek_barang2()
    {
        $nama_proyek = $this->input->post('nama_proyek');
        $cek = $this->db->query("SELECT * FROM proyek WHERE nama_proyek='$nama_proyek'")->row();
        $data = array(
            'nama_proyek' => $cek->nama_proyek,
            'lokasi' => $cek->lokasi,
            'luas_tanah' => $cek->luas_tanah,
        );
        echo json_encode($data);
    }


    public function read($id)
    {
        $row = $this->Barang_keluar_model->get_by_id($id);
        if ($row) {
            $data = array(
                'id_barang_keluar' => $row->id_barang_keluar,
                'no_permintaan' => $row->no_permintaan,
                'nama_barang' => $row->nama_barang,
                'kode_barang' => $row->kode_barang,
                'harga' => $row->harga,
                'tgl_keluar' => $row->tgl_keluar,
                'jumlah' => $row->jumlah,
                'uom' => $row->uom,
                'nama_proyek' => $row->nama_proyek,
                'lokasi' => $row->lokasi,
                'luas_tanah' => $row->luas_tanah,
            );
            $this->load->view('barang_keluar/barang_keluar_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('barang_keluar'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('barang_keluar/create_action'),
            'id_barang_keluar' => set_value('id_barang_keluar'),
            'no_permintaan' => $this->No_urut->buat_no_permintaan(),
            'nama_barang' => set_value('nama_barang'),
            'kode_barang' => set_value('kode_barang'),
            'harga' => set_value('harga'),
            'stok' => set_value('stok'),
            'tgl_keluar' => set_value('tgl_keluar'),
            'jumlah' => set_value('jumlah'),
            'uom' => set_value('uom'),
            'nama_proyek' => set_value('nama_proyek'),
            'lokasi' => set_value('lokasi'),
            'luas_tanah' => set_value('luas_tanah'),
            'konten' => 'barang_keluar/barang_keluar_form',
            'judul' => 'Data Permohonan Barang Keluar',
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
                'no_permintaan' => $this->input->post('no_permintaan', TRUE),
                'nama_barang' => $this->input->post('nama_barang', TRUE),
                'kode_barang' => $this->input->post('kode_barang', TRUE),
                'harga' => $this->input->post('harga', TRUE),
                'stok' => $this->input->post('stok', TRUE),
                'tgl_keluar' => $this->input->post('tgl_keluar', TRUE),
                'jumlah' => $this->input->post('jumlah', TRUE),
                'uom' => $this->input->post('uom', TRUE),
                'nama_proyek' => $this->input->post('nama_proyek', TRUE),
                'lokasi' => $this->input->post('lokasi', TRUE),
                'luas_tanah' => $this->input->post('luas_tanah', TRUE),
            );

            $this->Barang_keluar_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('barang_keluar'));
        }
    }

    public function update($id)
    {
        $row = $this->Barang_keluar_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('barang_keluar/update_action'),
                'id_barang_keluar' => set_value('id_barang_keluar', $row->id_barang_keluar),
                'no_permintaan' => set_value('no_permintaan', $row->no_permintaan),
                'nama_barang' => set_value('nama_barang', $row->nama_barang),
                'kode_barang' => set_value('kode_barang', $row->kode_barang),
                'harga' => set_value('harga', $row->harga),
                'stok' => set_value('stok', $row->stok),
                'tgl_keluar' => set_value('tgl_keluar', $row->tgl_keluar),
                'jumlah' => set_value('jumlah', $row->jumlah),
                'uom' => set_value('uom', $row->uom),
                'nama_proyek' => set_value('nama_proyek', $row->nama_proyek),
                'lokasi' => set_value('lokasi', $row->lokasi),
                'luas_tanah' => set_value('jumlah', $row->luas_tanah),
                'konten' => 'barang_keluar/barang_keluar_form',
                'judul' => 'Edit Permohonan Barang Keluar',
            );
            $this->load->view('v_index', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('barang_keluar'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_barang_keluar', TRUE));
        } else {
            $data = array(
                'no_permintan' => $this->input->post('no_permintaan', TRUE),
                'nama_barang' => $this->input->post('nama_barang', TRUE),
                'kode_barang' => $this->input->post('kode_barang', TRUE),
                'harga' => $this->input->post('harga', TRUE),
                'tgl_keluar' => $this->input->post('tgl_keluar', TRUE),
                'jumlah' => $this->input->post('jumlah', TRUE),
                'uom' => $this->input->post('uom', TRUE),
                'nama_proyek' => $this->input->post('nama_proyek', TRUE),
                'lokasi' => $this->input->post('lokasi', TRUE),
                'luas_tanah' => $this->input->post('luas_tanah', TRUE),
            );

            $this->Barang_keluar_model->update($this->input->post('id_barang_keluar', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('barang_keluar'));
        }
    }

    public function delete($id)
    {
        $row = $this->Barang_keluar_model->get_by_id($id);

        if ($row) {
            $this->Barang_keluar_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('barang_keluar'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('barang_keluar'));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('no_permintaan', 'no permintaan', 'trim|required');
        $this->form_validation->set_rules('nama_barang', 'nama barang', 'trim|required');
        $this->form_validation->set_rules('kode_barang', 'kode barang', 'trim|required');
        $this->form_validation->set_rules('stok', 'stok', 'trim|required');
        $this->form_validation->set_rules('tgl_keluar', 'tgl keluar', 'trim|required');
        $this->form_validation->set_rules('jumlah', 'jumlah', 'trim|required');
        $this->form_validation->set_rules('uom', 'satuan', 'trim|required');
        $this->form_validation->set_rules('nama_proyek', 'nama proyek', 'trim|required');
        $this->form_validation->set_rules('lokasi', 'lokasi', 'trim|required');
        $this->form_validation->set_rules('luas_tanah', 'luas tanah', 'trim|required');
        $this->form_validation->set_rules('id_barang_keluar', 'id_barang_keluar', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }
}

/* End of file Barang_keluar.php */
/* Location: ./application/controllers/Barang_keluar.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2018-05-10 15:13:50 */
/* http://harviacode.com */