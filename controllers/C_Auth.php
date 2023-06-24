<?php 

if(!defined('BASEPATH')) echo "Tidak bisa langsung mengakses halaman ini!";

class C_Auth extends Controller{
	public function __construct(){
		$this->addFunction('url');
		if(isset($_SESSION['login'])) {
			header('Location: ' . base_url('dashboard'));
		}

		$this->addFunction('web');
		$this->addFunction('session');
		$this->req = $this->library('Request');
		$this->akun = $this->model('M_Akun');
	}
	
	public function index(){
		$this->view('login');
	}

	public function login(){
		var_dump("tes");
		return 'tes';
	}

	public function logout(){
		unset($_SESSION['login']);
		redirect();
	}
}