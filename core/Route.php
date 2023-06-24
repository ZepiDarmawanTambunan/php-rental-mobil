<?php 

if(!defined('BASEPATH')) echo "Tidak bisa langsung mengakses halaman ini!";

class Route {

	protected $_url;
	protected $_controller;
	protected $_method;
	protected $_params = [];

    public function __construct(){
		$this->_dispatchUrl();
		$this->_setController();
		$this->_setMethod();
		$this->_setParams();

        if(method_exists($this->_controller, $this->_method)) call_user_func_array([$this->_controller, $this->_method], $this->_params);
        else die('method tidak ditemukan!');
    }

	// BEFORE (BUT ERROR)
	// protected function _dispatchUrl(){
	// 	$this->_url = isset($_GET['url']) ? $_GET['url'] : '';
	// 	$this->_url = filter_var($this->_url, FILTER_SANITIZE_URL);
	// 	$this->_url = rtrim($this->_url, '/');
	// 	$this->_url = explode('/', $this->_url);
	// }
	
	// NOW
	protected function _dispatchUrl(){
		$url = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '';
		$url = filter_var($url, FILTER_SANITIZE_URL);
		$url = rtrim($url, '/');
		$url = explode('?', $url)[0]; // Menghapus query string
	
		$this->_url = array_values(array_filter(explode('/', $url)));
	
		// Mengganti NULL menjadi "" jika $this->_url[0] adalah NULL
		if (!isset($this->_url[0])) {
			$this->_url[0] = "";
		}
	}

    // product => C_Product.php
    protected function _setController(){
		if($this->_url[0] != '') {
			$controller = explode("_", $this->_url[0]);
			$this->_controller = 'C_';
			for ($i = 0; $i < count($controller); $i++) {
				if($i > 0) $this->_controller .= '_';
				$this->_controller .= ucfirst($controller[$i]);
			}
		} else $this->_controller = DEFAULT_CONTROLLER;
		if(file_exists(C_PATH . DS . $this->_controller . '.php')) {
			require_once C_PATH . DS . $this->_controller . '.php';
			$this->_controller = new $this->_controller();
			unset($this->_url[0]);
		} else die('controller tidak ditemukan!');
	}

	protected function _setMethod(){
		if(isset($this->_url[1])) $this->_method = $this->_url[1];
		else $this->_method = 'index';
		if(method_exists($this->_controller, $this->_method)) unset($this->_url[1]);
	}
    
    // [123]
	protected function _setParams(){
		if(!empty($this->_url)) $this->_params = array_values($this->_url);
	}
}