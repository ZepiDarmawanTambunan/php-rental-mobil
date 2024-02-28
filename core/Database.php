<?php 

if(!defined('BASEPATH')) echo "Tidak bisa langsung mengakses halaman ini!";
class Database {
    public function __construct()
    {
		// $this->_koneksi = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        // if($this->_koneksi->connect_error) die('gagal konek!');
        try {
            $this->_koneksi = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);    
            $this->_koneksi->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
        } catch (\Exception $e) {
            die($e->getMessage());
        }
    }

    public function query($query){
        $stmt = $this->_koneksi->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function error(){
        return $this->_koneksi->errorInfo();
    }
}