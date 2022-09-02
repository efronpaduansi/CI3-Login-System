<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');

	}

	public function index()
	{
		//validasi form input
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'trim|required');

		if($this->form_validation->run() == false){
			$data['title'] = 'Register to CI3App';
			$this->load->view('layout/header', $data);
			$this->load->view('auth/login');
			$this->load->view('layout/footer');
		}else{
			//jika validasinya sukses, jalankan method private login
			$this->_login();
		}
	}

	//fungsi login
	private function _login()
	{
		$email 		= $this->input->post('email');
		$password 	= $this->input->post('password');

		//cek data user di database sesuai email yang diinput
		$user = $this->db->get_where('user', ['email' => $email])->row_array();
		
		//jika data user ada
		if($user){
			//cek apakah usernya aktif
			if($user['is_active'] == 1){
				//verifikasi password
				if(password_verify($password, $user['password'])){
					$data = [
						'email' => $user['email'],
						'role_id' => $user['role_id']
					];
					$this->session->set_userdata($data);
					if($user['role_id'] == 1){
						redirect('/admin');
					}else{
						redirect('/user');
					}
				}else{
					//kirimkan flashdata
					$this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Password salah!</div>');
					//arahkan kehalaman login
					redirect('/auth');
				}

			}else{
				//kirimkan flashdata
				$this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Email Anda belum di verifikasi!</div>');
				//arahkan kehalaman login
				redirect('/auth');
			}
		}else{
			//kirimkan flashdata
			$this->session->set_flashdata('pesan', '<div class="alert alert-danger" role="alert">Email yang anda masukkan belum terdaftar!</div>');
			//arahkan kehalaman login
			redirect('/auth');
		}
	}
	
	public function register()
	{
		//set rules
		$this->form_validation->set_rules('fullname', 'Fullname', 'required|trim');
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
			'is_unique' => 'Email sudah terdaftar! Silahkan login.'
		]);
		$this->form_validation->set_rules('password', 'Password', 'required|trim|min_length[3]', [
			'min_length' => 'Panjang password minimal 3 karakter!'
		]);
		$this->form_validation->set_rules('passconf', 'Passconf', 'required|trim|min_length[3]|matches[password]',[
			'matches' => 'Konfirmasi password salah!'
		]);

		//cek validasi form input
		if($this->form_validation->run() == false){
			$data['title'] = 'Register to CI3App';
			$this->load->view('layout/header', $data);
			$this->load->view('auth/register');
			$this->load->view('layout/footer');

		}else{
			$data = [
				'fullname' 		=> htmlspecialchars($this->input->post('fullname')),
				'email' 		=> htmlspecialchars($this->input->post('email')),
				'image' 		=> 'default.jpg',
				'password' 		=> password_hash($this->input->post('password'), PASSWORD_DEFAULT),
				'role_id' 		=> 2,
				'is_active' 	=> 1,
				'date_created' 	=> time()
			];

			//insert ke database
			$this->db->insert('user', $data);
			//kirimkan flashdata
			$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Selamat akun anda telah dibuat!</div>');
			//arahkan kehalaman login
			redirect('/auth');
		}

	}

	//fungsi logout
	public function logout()
	{
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('role_id');

		//kirimkan flashdata
		$this->session->set_flashdata('pesan', '<div class="alert alert-success" role="alert">Anda telah keluar, silahkan masuk!</div>');
		//arahkan kehalaman login
		redirect('/auth');
	}

}

