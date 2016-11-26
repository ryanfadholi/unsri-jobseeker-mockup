<?php
/* 
	Nama 	:	M. Ryan Fadholi
	NIM 	:	09021281419050
*/

require_once( __DIR__. '/../../libs/koneksi.php');

class Dao {
	var $koneksi;
	
	public function __construct($database) {
		$this->koneksi = new Koneksi($database);
		$this->koneksi->connect();
	}
	
	public function insert($table, $input_values) {
		$result='SUCCESS';

		$count = 0;

		//INSERT INTO VALUES syntax starts with a bracket
		$insert_values = "(";
		//Convert all values in the array to a single string
		foreach ($input_values as $field => $value) {
			//Except for the first attribute, add comma before the value
			//to match MySQL query syntax.
			switch ($count) {
				case 0:
					break;
				default:
					$insert_values .= ',';
					break;
			}

		$insert_values .= "'$value'";
		$count++;
		}
		//INSERT INTO VALUES syntax ends with a bracket
		$insert_values .= ")";

		$query = "INSERT INTO $table VALUES $insert_values";
		mysqli_query($this->koneksi->link, $query) or $result='warning';
		
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
			return mysqli_fetch_all($query_result,MYSQLI_ASSOC);
			//return mysqli_fetch_assoc($query_result);
		} else {
			return false;
		}
	}

	public function search($search_query) {
		/*
		Get a row from jobseeker_registration which email matches the parameter given.
		*/
		$query = "SELECT * 
		FROM jobseeker_registration 
		WHERE email LIKE '%" . $search_query ."%'
		OR name LIKE '%" . $search_query . "%'
		OR noktp LIKE '%" . $search_query . "%'
		OR birthplace LIKE '%" . $search_query . "%'
		OR address LIKE '%" . $search_query . "%'";

		$query_result = mysqli_query($this->koneksi->link,$query) or $result='warning';
		$this->koneksi->disconnect();

		if($query_result){
			return mysqli_fetch_all($query_result,MYSQLI_ASSOC);
		} else {
			return false;
		}
	}

	public function viewall($start, $rows){
		/*
		Get all rows from jobseeker_registration.
		*/ 
		$query = "SELECT * FROM jobseeker_registration LIMIT $start, $rows";

    	$query_result = mysqli_query($this->koneksi->link,$query);
    	$this->koneksi->disconnect();

		if($query_result){
			return mysqli_fetch_all($query_result,MYSQLI_ASSOC);
		} else {
			return false;
		}
	}
}
?>