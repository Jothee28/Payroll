<?php
class commision{
	private $_data,
			$_db;
	
	public function __construct($id = null){
		$this->_db = Database::getInstance();
	}

	public function lastinsertid(){
		return $this->_db->lastInsertId();
	}

	public function data(){
		return $this->_data;
	}
	
	public static function exists(){
		return (!empty($this->_data)) ? true : false;
	}

	public function addcommision($fields = array()){
		if(!$this->_db->insert('commision', $fields)) {
		  throw new Exception('There was a problem adding a commision.');
		}
	}

	public function editcommision($fields = array(), $id = null, $commision_id = null){
		if (!$this->_db->update('commision', $id, $fields, $commision_id)) {
		  throw new Exception('There was a problem updating commision.');
		}
	}

	public function searchOnly($commision_id = null){
		if($commision_id){
			$field = (is_numeric($commision_id)) ? 'commision_id' : 'commision_code';
			$data = $this->_db->get('commision', array($field, '=', $commision_id));
			
			if($data->count()){
				$this->_data = $data->first();
				return $this->_data;
			}
		}
		return false;
	}

	public function searchcommisionCorporate($ID = null){
		if($ID){
			$field = (is_numeric($ID)) ? 'corporateID' : 'commision';
			$data = $this->_db->get('commision', array($field, '=', $ID));
			if($data->count()){
				$this->_data = $data->results();
				return $this->_data;
			}
		}
	}

	public function searchcommisionCompany($ID = null){
		if($ID){
			$field = (is_numeric($ID)) ? 'companyID' : 'commision';
			$data = $this->_db->get('commision', array($field, '=', $ID));
			if($data->count()){
				$this->_data = $data->results();
				return $this->_data;
			}
		}
	}

	public function deletecommision($id = null){
		if($id){
			$field = (is_numeric($id)) ? 'commision_id' : 'commision_code';
			$data = $this->_db->delete('commision', array($field, '=', $id));
			return $data;
		}
		return false;
	}

	public function isLoggedIn(){
		return $this->_isLogggedIn;
	}
}
?>