 <?php
class CommisionEmployee{
	private $_data,
			$_db;
	
	public function __construct($id = null){
		$this->_db = Database::getInstance();
	}
	
	public function data(){
		return $this->_data;
	}
	public function lastinsertid(){
		return $this->_db->lastInsertId();
	}
	
	public static function exists(){
		return (!empty($this->_data)) ? true : false;
	}
 
	public function addCommision($fields = array()){
		if(!$this->_db->insert('commision', $fields)) {
		  throw new Exception('There was a problem adding commision.');
		}
	}
	public function addCommisionEmployee($fields = array()){
		if(!$this->_db->insert('commision_employee', $fields)) {
		  throw new Exception('There was a problem adding commision.');
		}
	}
	
	public function updateCommisionEmployee($fields = array(), $id = null, $commision_eid){
		if (!$this->_db->update('commision_employee', $id, $fields, $commision_eid)) {
		  throw new Exception('There was a problem updating commision.');
		}
	} 

	public function searchCommisionUser($ID = null){
		if($ID){
			$field = (is_numeric($ID)) ? 'emp_id' : 'commision_employee';
			$data = $this->_db->get('commision_employee', array($field, '=', $ID));
			if($data->count()){
				$this->_data = $data->results();
				return $this->_data;
			}
		}
	}

		public function searchOnlyCommision($id = null){
		if($id){
			$field = "commision_id";
			$data = $this->_db->get('commision', array($field, '=', $id));
			if($data->count()){
				$this->_data = $data->first();
				return $this->_data;
			}
		}
	}

	public function searchOnlyCommisionEmployee($id = null){
		if($id){
			$field = "commision_eid";
			$data = $this->_db->get('commision_employee', array($field, '=', $id));
			if($data->count()){
				$this->_data = $data->first();
				return $this->_data;
			}
		}
	}

	public function searchCommision($ID = null){ 
		if($ID){
			$field = (is_numeric($ID)) ? 'commision_id' : 'commision';
			$data = $this->_db->get('commision', array($field, '=', $ID));
			if($data->count()){
				$this->_data = $data->first();
				return $this->_data;
			}
		   
		}
	}

	public function searchCommisionCompany($ID = null){ 
		if($ID){
			$field = (is_numeric($ID)) ? 'companyID' : 'commision';
			$data = $this->_db->get('commision', array($field, '=', $ID));
			if($data->count()){
				$this->_data = $data->results();
				return $this->_data;
			}
		   
		}
	}

	public function searchCommisionCorporate($ID = null){ 
		if($ID){
			$field = (is_numeric($ID)) ? 'corporateID' : 'commision';
			$data = $this->_db->get('commision', array($field, '=', $ID));
			if($data->count()){
				$this->_data = $data->results();
				return $this->_data;
			}
		   
		}
	}

	public function searchCommisionEmployee($ID = null){ 
		if($ID){
			$field = (is_numeric($ID)) ? 'commision_eid' : 'commision_employee';
			$data = $this->_db->get('commision_employee', array($field, '=', $ID));
		   if($data->count()){
				$this->_data = $data->first();
				return $this->_data;
			}
		   }
	}

	public function deleteCommisionEmployee($commision_eid = null){
		if($commision_eid){
			$field = (is_numeric($commision_eid)) ? 'commision_eid' : 'name';
			$data = $this->_db->delete('commision_employee', array($field, '=', $commision_eid));
			return $data;
		}
		return false;
	}
}


	?>


