<?php
/* 
	Nama 	:	Mifta Aprilya Suryani
	NIM 	:	09021181419006
*/

require_once('../../libs/koneksi.php');

class Dao {
	var $koneksi;
	
	public function __construct($database) {
		$this->koneksi = new Koneksi($database);
		$this->koneksi->connect();
	}
	
	public function insert($table, $values, $field="") {
		$result='SUCCESS';
		mysqli_query($this->koneksi->link,"INSERT INTO $table $field VALUES $values") or $result='warning';
		
		$this->koneksi->disconnect();
		return $result;
	}

	public function getUserByEmail($email, $table) {
		$result='SUCCESS';
		$query_result = mysqli_query($this->koneksi->link,"SELECT * FROM $table WHERE email='$email'") or $result='warning';
		
		$this->koneksi->disconnect();

		if($query_result){
			return mysqli_fetch_assoc($query_result);
		} else {
			return false;
		}
	}
}
?>