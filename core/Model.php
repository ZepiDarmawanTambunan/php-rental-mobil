<?php 

if(!defined('BASEPATH')) echo "Tidak bisa langsung mengakses halaman ini!";

class Model {
    public function __construct(){
        $this->db = new Database();
    }

    // membuat method get seperti eloquent di laravel -> Model::get('users', ['nama', 'email']);
    public function get($table, $kolom = []){
        if (count($kolom) == 0) {
                $this->_query = "SELECT * FROM {$table}";
        } else {
            $i = 0;
			$total = count($kolom);
			$this->_query = "SELECT ";
            foreach ($kolom as $k) {
                $i++;
                $this->_query = $this->_query . "{$k}";
                if($total > $i) $this->_query = $this->_query . ', ';
            }
            $this->_query = $this->_query . " FROM {$table}";
        }
    }

    public function get_where($table, $where = [], $kolom = []){
        // get_where('users', ['tagihan' => 'lunas', 'pengiriman' => 'sudah sampai'], ['nama', 'email']);
        if(count($where) == 0) die('paramater kedua dibutuhkan!');
        if (count($kolom) == 0) {
			$this->_query = "SELECT * FROM {$table}";
        } else {
            $i = 0;
            $total = count($kolom);
            $this->_query = "SELECT ";
            foreach ($kolom as $k) {
                $i++;
                $this->_query = $this->_query . "{$k}";
                if($total > $i) $this->_query = $this->_query . ', ';
            }
            $this->_query = $this->_query . " FROM {$table}";
        }

        $this->_query = $this->_query . " WHERE ";
        $i = 0;
        $total = count($where);
        foreach ($where as $key => $value) {
            $i++;
            $this->_query = $this->_query . "{$key} = '{$value}'";
            if($total > $i) $this->_query = $this->_query . ' AND ';
        }
    }

    public function insert($table, $insert = []){
        // $insert('users', ['nama' => 'zepi', 'email' => 'zepi@gmail.com']);
        if(count($insert) == 0) die('paramater kedua dibutuhkan!');
        $this->_query = "INSERT INTO {$table} (";
        $i = 0;
        $total = count($insert);
        foreach ($insert as $key => $value) {
            $i++;
            $this->_query = $this->_query . "{$key}";
            if($total > $i) $this->_query = $this->_query . ', ';
        }
        $this->_query = $this->_query . ") VALUES (";
        $i = 0;
		$total = count($insert);
        foreach ($insert as $key => $value) {
            $i++;
            $this->_query = $this->_query . "'{$value}'";
            if($total > $i) $this->_query = $this->_query . ', ';
        }
        $this->_query = $this->_query . ")";
    }

    public function update($table, $update = [], $where = []){
        // update('users', ['nama'=> 'edit nama'], ['id' => '2']);
        if(count($update) == 0) die('paramater kedua dibutuhkan!');
		if(count($where) == 0) die('paramater ketiga dibutuhkan!');

        $this->_query = "UPDATE {$table} SET ";
        $i = 0;
		$total = count($update);
        foreach ($update as $key => $value) {
            $i++;
            $this->_query = $this->_query . "{$key} = '{$value}'";
            if($total > $i) $this->_query = $this->_query . ', ';
        }
        $this->_query = $this->_query . " WHERE ";
        $i = 0;
		$total = count($where);
        foreach ($where as $key => $value) {
			$i++;
			$this->_query = $this->_query . "{$key} = '{$value}'";

			if($total > $i) $this->_query = $this->_query . ' AND ';
		}
    }

    public function delete($table, $where = []){
        if(count($where) == 0) die('paramater kedua dibutuhkan!');
        $this->_query = "DELETE FROM {$table} WHERE ";
        $i = 0;
		$total = count($where);
        foreach ($where as $key => $value) {
			$i++;
			$this->_query = $this->_query . "{$key} = '{$value}'";

			if($total > $i) $this->_query = $this->_query . ' AND ';
		}
    }
    
    public function setQuery($query){
		$this->_query = $query;
	}

    public function execute(){
		return $this->db->query($this->_query);
	}
}