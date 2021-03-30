<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Proyek extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->model('Proyek_model');
    $this->load->model('No_urut');
    $this->load->library('form_validation');
  }

  public function index()
  {
    $q = urldecode($this->input->get('q', TRUE));
    $start = intval($this->input->get('start'));

    if ($q <> '') {
      $config['base_url'] = base_url() . 'proyek/index.html?q=' . urlencode($q);
      $config['first_url'] = base_url() . 'proyek/index.html?q=' . urlencode($q);
    } else {
      $config['base_url'] = base_url() . 'proyek/index.html';
      $config['first_url'] = base_url() . 'proyek/index.html';
    }

    $config['per_page'] = 10;
    $config['page_query_string'] = TRUE;
    $config['total_rows'] = $this->Proyek_model->total_rows($q);
    $nama_proyek = $this->Proyek_model->get_limit_data($config['per_page'], $start, $q);

    $this->load->library('pagination');
    $this->pagination->initialize($config);

    $data = array(
      'proyek' => $nama_proyek,
      'q' => $q,
      'pagination' => $this->pagination->create_links(),
      'total_rows' => $config['total_rows'],
      'start' => $start,
      'konten' => 'proyek/proyek_list',
      'judul' => 'Proyek',
    );
    $this->load->view('v_index', $data);
  }

  public function read($id)
  {
    $row = $this->Proyek_model->get_by_id($id);
    if ($row) {
      $data = array(
        'id_proyek' => $row->id_proyek,
        'nama_proyek' => $row->nama_proyek,
        'lokasi' => $row->lokasi,
      );
      $this->load->view('proyek/proyek_read', $data);
    } else {
      $this->session->set_flashdata('message', 'Record Not Found');
      redirect(site_url('proyek'));
    }
  }

  public function create()
  {
    $data = array(
      'button' => 'Create',
      'action' => site_url('proyek/create_action'),
      'id_proyek' => set_value('id_proyek'),
      'kd_proyek' => $this->No_urut->buat_kode_proyek(),
      'nama_proyek' => set_value('nama_proyek'),
      'lokasi' => set_value('lokasi'),
      'konten' => 'proyek/proyek_form',
      'judul' => 'Proyek',
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
        'kd_proyek' => $this->input->post('kd_proyek', TRUE),
        'nama_proyek' => $this->input->post('nama_proyek', TRUE),
        'lokasi' => $this->input->post('lokasi', TRUE),
      );

      $this->Proyek_model->insert($data);
      $this->session->set_flashdata('message', 'Create Record Success');
      redirect(site_url('proyek'));
    }
  }

  public function update($id)
  {
    $row = $this->Proyek_model->get_by_id($id);

    if ($row) {
      $data = array(
        'button' => 'Update',
        'action' => site_url('proyek/update_action'),
        'id_proyek' => set_value('id_proyek', $row->id_proyek),
        'kd_proyek' => set_value('kd_proyek', $row->kd_proyek),
        'nama_proyek' => set_value('nama_proyek', $row->nama_proyek),
        'lokasi' => set_value('lokasi', $row->lokasi),
        'konten' => 'proyek/proyek_form',
        'judul' => 'Proyek',
      );
      $this->load->view('v_index', $data);
    } else {
      $this->session->set_flashdata('message', 'Record Not Found');
      redirect(site_url('proyek'));
    }
  }

  public function update_action()
  {
    $this->_rules();

    if ($this->form_validation->run() == FALSE) {
      $this->update($this->input->post('id_proyek', TRUE));
    } else {
      $data = array(
        'kd_proyek' => $this->input->post('kd_proyek', TRUE),
        'nama_proyek' => $this->input->post('nama_proyek', TRUE),
        'lokasi' => $this->input->post('lokasi', TRUE),
      );

      $this->Proyek_model->update($this->input->post('id_proyek', TRUE), $data);
      $this->session->set_flashdata('message', 'Update Record Success');
      redirect(site_url('proyek'));
    }
  }

  public function delete($id)
  {
    $row = $this->Proyek_model->get_by_id($id);

    if ($row) {
      $this->Proyek_model->delete($id);
      $this->session->set_flashdata('message', 'Delete Record Success');
      redirect(site_url('proyek'));
    } else {
      $this->session->set_flashdata('message', 'Record Not Found');
      redirect(site_url('proyek'));
    }
  }

  public function _rules()
  {
    $this->form_validation->set_rules('nama_proyek', 'nama proyek', 'trim|required');
    $this->form_validation->set_rules('kd_proyek', 'kode proyek', 'trim|required');
    $this->form_validation->set_rules('lokasi', 'lokasi', 'trim|required');
    $this->form_validation->set_rules('id_proyek', 'id_proyek', 'trim');
    $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
  }
}
