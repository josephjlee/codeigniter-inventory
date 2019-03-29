<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Petugas extends CI_Controller {

	public function __construct()
  {
    parent::__construct();
    $this->load->model(array('petugas_model', 'level_model'));
    $this->load->helper('url_helper');
    $this->load->library('session');
  }

	public function index()
	{
		$data['petugas'] = $this->petugas_model->all();

		$keyword = $this->input->get('keyword');
		if( $keyword != null ) {
			$data['petugas'] = $this->petugas_model->findByKeyword($keyword);
		}

		$this->load->view('petugas/index', $data);
	}

	public function create()
	{
		$data['level'] = $this->level_model->all();

		$this->load->view('petugas/create', $data);
	}

	public function store()
	{
		$this->petugas_model->create();
		$this->session->set_flashdata('msg', 'Berhasil Membuat Petugas!');

		redirect('/petugas');
	}

	public function edit($id)
	{
		$data['level'] = $this->level_model->all();
		$data['petugas'] = $this->petugas_model->find($id);

		$this->load->view('petugas/edit', $data);
	}

	public function update($id)
	{
		$this->petugas_model->update($id);
		$this->session->set_flashdata('msg', 'Berhasil Mengubah Petugas!');

		redirect('/petugas');
	}

	public function delete($id)
	{
		$this->petugas_model->destroy($id);
		$this->session->set_flashdata('msg', 'Berhasil Menghapus Petugas!');

		redirect('/petugas');
	}

}