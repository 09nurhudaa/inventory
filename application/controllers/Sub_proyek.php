<?php

if (!defined('BASEPATH'))
  exit('No direct script access allowed');

class Sub_proyek extends CI_Controller
{
  function __construct()
  {
    parent::__construct();
    $this->load->model('Sub_proyek_model');;
    $this->load->library('form_validation');
  }

  public function index()
  {
    $q = urldecode($this->input->get('q', TRUE));
    $start = intval($this->input->get('start'));

    if ($q <> '') {
      $config['base_url'] = base_url() . 'sub_proyek/index.html?q=' . urlencode($q);
      $config['first_url'] = base_url() . 'sub_proyek/index.html?q=' . urlencode($q);
    } else {
      $config['base_url'] = base_url() . 'sub_proyek/index.html';
      $config['first_url'] = base_url() . 'sub_proyek/index.html';
    }

    $config['per_page'] = 10;
    $config['page_query_string'] = TRUE;
    $config['total_rows'] = $this->Sub_proyek_model->total_rows($q);
    $sub_proyek = $this->Sub_proyek_model->get_limit_data($config['per_page'], $start, $q);

    $this->load->library('pagination');
    $this->pagination->initialize($config);

    $data = array(
      'sub_proyek_data' => $sub_proyek,
      'q' => $q,
      'pagination' => $this->pagination->create_links(),
      'total_rows' => $config['total_rows'],
      'start' => $start,
      'konten' => 'sub_proyek/sub_proyek_list',
      'judul' => 'Sub Proyek',
    );
    $this->load->view('v_index', $data);
  }

  public function read($id)
  {
    $row = $this->Sub_proyek_model->get_by_id($id);
    if ($row) {
      $data = array(
        'id_sub_proyek' => $row->id_sub_proyek,
        'lokasi' => $row->lokasi,
        'luas_tanah' => $row->luas_tanah,
      );
      $this->load->view('sub_proyek/sub_proyek_read', $data);
    } else {
      $this->session->set_flashdata('message', 'Record Not Found');
      redirect(site_url('sub_proyek'));
    }
  }

  public function create()
  {
    $data = array(
      'button' => 'Create',
      'action' => site_url('sub_proyek/create_action'),
      'id_sub_proyek' => set_value('id_sub_proyek'),
      'lokasi' => set_value('lokasi'),
      'luas_tanah' => set_value('luas_tanah'),
      'konten' => 'sub_proyek/sub_proyek_form',
      'judul' => 'Sub Proyek',
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
        'lokasi' => $this->input->post('lokasi', TRUE),
        'luas_tanah' => $this->input->post('luas_tanah', TRUE),
      );

      $this->Sub_proyek_model->insert($data);
      $this->session->set_flashdata('message', 'Create Record Success');
      redirect(site_url('sub_proyek'));
    }
  }

  public function update($id)
  {
    $row = $this->Sub_proyek_model->get_by_id($id);

    if ($row) {
      $data = array(
        'button' => 'Update',
        'action' => site_url('sub_proyek/update_action'),
        'id_sub_proyek' => set_value('id_sub_proyek', $row->id_sub_proyek),
        'lokasi' => set_value('lokasi', $row->lokasi),
        'luas_tanah' => set_value('luas_tanah', $row->luas_tanah),
        'konten' => 'sub_proyek/sub_proyek_form',
        'judul' => 'Sub Proyek',
      );
      $this->load->view('v_index', $data);
    } else {
      $this->session->set_flashdata('message', 'Record Not Found');
      redirect(site_url('sub_proyek'));
    }
  }

  public function update_action()
  {
    $this->_rules();

    if ($this->form_validation->run() == FALSE) {
      $this->update($this->input->post('id_sub_proyek', TRUE));
    } else {
      $data = array(
        'lokasi' => $this->input->post('lokasi', TRUE),
        'luas_tanah' => $this->input->post('luas_tanah', TRUE),
      );

      $this->Sub_proyek_model->update($this->input->post('id_sub_proyek', TRUE), $data);
      $this->session->set_flashdata('message', 'Update Record Success');
      redirect(site_url('sub_proyek'));
    }
  }

  public function delete($id)
  {
    $row = $this->Sub_proyek_model->get_by_id($id);

    if ($row) {
      $this->Sub_proyek_model->delete($id);
      $this->session->set_flashdata('message', 'Delete Record Success');
      redirect(site_url('sub_proyek'));
    } else {
      $this->session->set_flashdata('message', 'Record Not Found');
      redirect(site_url('sub_proyek'));
    }
  }

  public function _rules()
  {
    $this->form_validation->set_rules('lokasi', 'lokasi', 'trim|required');
    $this->form_validation->set_rules('luas_tanah', 'luas tanah', 'trim|required');
    $this->form_validation->set_rules('id_sub_proyek', 'id_sub_proyek', 'trim');
    $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
  }
}
