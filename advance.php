<?php
 class Advance {
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

   public function addAdvance($fields = array()){
    if(!$this->_db->insert('advance_employee', $fields)) {
      throw new Exception('There was a problem adding advance.');
    }
  }
  

  public function updateAdvanceEmployee($fields = array(), $id = null, $advance_id){
    if (!$this->_db->update('advance_employee', $id, $fields, $advance_id)) {
      throw new Exception('There was a problem updating advance.');
    }
  }

  public function searchAdvanceUser($ID = null){
    if($ID){
      $field = (is_numeric($ID)) ? 'emp_id' : 'advance_employee';
      $data = $this->_db->get('advance_employee', array($field, '=', $ID));
      if($data->count()){
        $this->_data = $data->results();
        return $this->_data;
      }
    }
  }

 
    public function searchOnlyAdvance($id = null){
    if($id){
      $field = "advance_id";
      $data = $this->_db->get('advance_employee', array($field, '=', $id));
      if($data->count()){
        $this->_data = $data->first();
        return $this->_data;
      }
    }
  } 

    public function searchAdvance($ID = null){
    if($ID){
      $field = (is_numeric($ID)) ? 'advance_id' : 'advance_employee';
      $data = $this->_db->get('advance_employee', array($field, '=', $ID));
      if($data->count()){
        $this->_data = $data->results();
        return $this->_data;
      }
    }
  }

 public function deleteAdvanceEmployee($advance_id = null){
    if($advance_id){
      $field = (is_numeric($advance_id)) ? 'advance_id' : 'name';
      $data = $this->_db->delete('advance_employee', array($field, '=', $advance_id));
      return $data;
    }
    return false;
  }
}
?>
 
