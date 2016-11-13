<?php
/* 
	Nama 	:	M. Ryan Fadholi
	NIM 	:	09021281419050
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

	public function update($values) {

		$count = 0;
		$update_values = "";
		foreach ($values as $field => $value) {
			//Except for the first attribute, add comma before the value
			//to match MySQL query syntax.
			switch ($count) {
				case 0:
					break;
				default:
					$update_values .= ', ';
					break;
			}

			//if the field is ktp_id, change to noktp to
			//bridge field discrepancy between form and db.
			if($field == 'ktp_id'){
				$field = 'noktp';
			}

			$update_values .= "$field='$value'";
			$count++;
		}

		$result='SUCCESS';
		$query = "UPDATE jobseeker_registration SET $update_values WHERE email='" . $values['email'] ."'";

		mysqli_query($this->koneksi->link,$query) or $result='warning';
		
		$this->koneksi->disconnect();
		return $result;
	}

	public function getuserbyemail($email) {
		/*
		Get a row from jobseeker_registration which email matches the parameter given.
		*/
		$query = "SELECT * FROM jobseeker_registration WHERE email='$email'";
		$query_result = mysqli_query($this->koneksi->link,$query) or $result='warning';
		$this->koneksi->disconnect();

		if($query_result){
			return mysqli_fetch_assoc($query_result);
		} else {
			return false;
		}
	}
}
?>