<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public function index()
	{
		$data['title'] = 'User Dashboard';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$this->load->view('layout/dash_header', $data);
		$this->load->view('layout/dash_sidebar', $data);
		$this->load->view('layout/dash_topbar', $data);
		$this->load->view('user/home', $data);
		$this->load->view('layout/dash_footer');
	}
}

