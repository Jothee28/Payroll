 <?php
class payroll_history{
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

	public function addpayroll_history($fields = array()){
		if(!$this->_db->insert('payroll_history', $fields)) {
		  throw new Exception('There was a problem adding a payroll_history.');
		}
	}

	public function editpayroll_history($fields = array(), $id = null, $payroll_history_id = null){
		if (!$this->_db->update('payroll_history', $id, $fields, $payroll_history_id)) {
		  throw new Exception('There was a problem updating payroll_history.');
		}
	}

	public function searchOnly($payroll_history_id = null){
		if($payroll_history_id){
			$field = (is_numeric($payroll_history_id)) ? 'payroll_history_id' : 'payroll_history_code';
			$data = $this->_db->get('payroll_history', array($field, '=', $payroll_history_id));
			
			if($data->count()){
				$this->_data = $data->first();
				return $this->_data;
			}
		}
		return false;
	}
public function searchOnlypayroll_history($payroll_history_id = null){
		if($payroll_history_id){
			$field = (is_numeric($payroll_history_id)) ? 'payroll_history_id' : 'payroll_history_code';
			$data = $this->_db->get('payroll_history', array($field, '=', $payroll_history_id));
			
			if($data->count()){
				$this->_data = $data->first();
				return $this->_data;
			}
		}
		return false;
	}
	public function searchpayroll_historyCorporate($ID = null){
		if($ID){
			$field = (is_numeric($ID)) ? 'corporateID' : 'payroll_history';
			$data = $this->_db->get('payroll_history', array($field, '=', $ID));
			if($data->count()){
				$this->_data = $data->results();
				return $this->_data;
			}
		}
	}

	public function searchpayroll_historyCompany($ID = null){
		if($ID){
			$field = (is_numeric($ID)) ? 'companyID' : 'payroll_history';
			$data = $this->_db->get('payroll_history', array($field, '=', $ID));
			if($data->count()){
				$this->_data = $data->results();
				return $this->_data;
			}
		}
	}
	


	public function deletepayroll_history($id = null){
		if($id){
			$field = (is_numeric($id)) ? 'payroll_history_id' : 'payroll_history_code';
			$data = $this->_db->delete('payroll_history', array($field, '=', $id));
			return $data;
		}
		return false;
	}

	public function searchempadvance($id = null, $startdate = null, $enddate = null){
		if($id && $startdate && $enddate){
			$field = (is_numeric($id)) ? 'emp_id' : 'userID';
			$data = $this->_db->get2('advance_employee', array($field, '=', $id), array("advance_date", ">=", $startdate), array("advance_date", "<=", $enddate));
			
			if($data->count()){
				$this->_data = $data->results();
				return $this->_data;
			}
		}
		return false;
	}

	public function searchempallowance($id = null, $startdate = null, $enddate = null){
		if($id && $startdate && $enddate){
			$field = (is_numeric($id)) ? 'emp_id' : 'userID';
			$data = $this->_db->get2('allowance_employee', array($field, '=', $id), array("allowanceDate", ">=", $startdate), array("allowanceDate", "<=", $enddate));
			
			if($data->count()){
				$this->_data = $data->results();
				return $this->_data;
			}
		}
		return false;
	}

	public function searchempbik($id = null, $startdate = null, $enddate = null){
		if($id && $startdate && $enddate){
			$field = (is_numeric($id)) ? 'emp_id' : 'userID';
			$data = $this->_db->get2('bik_employee', array($field, '=', $id), array("bik_date", ">=", $startdate), array("bik_date", "<=", $enddate));
			
			if($data->count()){
				$this->_data = $data->results();
				return $this->_data;
			}
		}
		return false;
	}

	public function searchempbonus($id = null, $startdate = null, $enddate = null){
		if($id && $startdate && $enddate){
			$field = (is_numeric($id)) ? 'emp_id' : 'userID';
			$data = $this->_db->get2('bonus_employee', array($field, '=', $id), array("bonusDate", ">=", $startdate), array("bonusDate", "<=", $enddate));
			
			if($data->count()){
				$this->_data = $data->results();
				return $this->_data;
			}
		}
		return false;
	}


	public function searchempcommission($id = null, $startdate = null, $enddate = null){
		if($id && $startdate && $enddate){
			$field = (is_numeric($id)) ? 'emp_id' : 'userID';
			$data = $this->_db->get2('commision_employee', array($field, '=', $id), array("commision_date", ">=", $startdate), array("commision_date", "<=", $enddate));
			
			if($data->count()){
				$this->_data = $data->results();
				return $this->_data;
			}
		}
		return false;
	}

	public function searchempcp38($id = null, $startdate = null, $enddate = null){
		if($id && $startdate && $enddate){
			$field = (is_numeric($id)) ? 'emp_id' : 'userID';
			$data = $this->_db->get2('cp38_employee', array($field, '=', $id), array("cp38_date", ">=", $startdate), array("cp38_date", "<=", $enddate));
			
			if($data->count()){
				$this->_data = $data->results();
				return $this->_data;
			}
		}
		return false;
	}


	public function searchempdeduction($id = null, $startdate = null, $enddate = null){
		if($id && $startdate && $enddate){
			$field = (is_numeric($id)) ? 'emp_id' : 'userID';
			$data = $this->_db->get2('deduction_employee', array($field, '=', $id), array("deductionDate", ">=", $startdate), array("deductionDate", "<=", $enddate));
			
			if($data->count()){
				$this->_data = $data->results();
				return $this->_data;
			}
		}
		return false;
	}

	public function searchemplevy($id = null, $startdate = null, $enddate = null){
		if($id && $startdate && $enddate){
			$field = (is_numeric($id)) ? 'emp_id' : 'userID';
			$data = $this->_db->get2('levy_employee', array($field, '=', $id), array("levy_date", ">=", $startdate), array("levy_date", "<=", $enddate));
			
			if($data->count()){
				$this->_data = $data->results();
				return $this->_data;
			}
		}
		return false;
	}

	public function searchemplevyemployee($id = null, $startdate = null, $enddate = null){
		if($id && $startdate && $enddate){
			$field = (is_numeric($id)) ? 'emp_id' : 'userID';
			$data = $this->_db->get2('levy_employee', array($field, '=', $id), array("levy_date", ">=", $startdate), array("levy_date", "<=", $enddate));
			
			if($data->count()){
				$this->_data = $data->results();
				return $this->_data;
			}
		}
		return false;
	}



	public function searchemploan($id = null, $startdate = null, $enddate = null){
		if($id && $startdate && $enddate){
			$field = (is_numeric($id)) ? 'emp_id' : 'userID';
			$data = $this->_db->get2('loan_employee', array($field, '=', $id), array("loan_date", ">=", $startdate), array("loan_date", "<=", $enddate));
			
			if($data->count()){
				$this->_data = $data->results();
				return $this->_data;
			}
		}
		return false;
	}

	public function searchempovertime($id = null, $startdate = null, $enddate = null){
		if($id && $startdate && $enddate){
			$field = (is_numeric($id)) ? 'emp_id' : 'userID';
			$data = $this->_db->get2('overtime_employee', array($field, '=', $id), array("overtime_date", ">=", $startdate), array("overtime_date", "<=", $enddate));
			
			if($data->count()){
				$this->_data = $data->results();
				return $this->_data;
			}
		}
		return false;
	}

	public function searchempparrears($id = null, $startdate = null, $enddate = null){
		if($id && $startdate && $enddate){
			$field = (is_numeric($id)) ? 'emp_id' : 'userID';
			$data = $this->_db->get2('parrears_employee', array($field, '=', $id), array("pArrearsDate", ">=", $startdate), array("pArrearsDate", "<=", $enddate));
			
			if($data->count()){
				$this->_data = $data->results();
				return $this->_data;
			}
		}
		return false;
	}

	public function searchempclaim($id = null, $startdate = null, $enddate = null){
		if($id && $startdate && $enddate){
			$field = (is_numeric($id)) ? 'emp_id' : 'userID';
			$data = $this->_db->get2('claim', array($field, '=', $id), array("claimDate", ">=", $startdate), array("claimDate", "<=", $enddate));
			
			if($data->count()){
				$this->_data = $data->results();
				return $this->_data;
			}
		}
		return false;
	}


	public function searchempoptional_deduction($id = null, $startdate = null, $enddate = null){
		if($id && $startdate && $enddate){
			$field = (is_numeric($id)) ? 'emp_id' : 'userID';
			$data = $this->_db->get2('optional_deduction_employee', array($field, '=', $id), array("date", ">=", $startdate), array("date", "<=", $enddate));
			
			if($data->count()){
				$this->_data = $data->results();
				return $this->_data;
			}
		}
		return false;
	}

	public function searchpayslipdate($id = null, $startdate = null, $enddate = null){
		if($id && $startdate && $enddate){
			$field = (is_numeric($id)) ? 'emp_id' : 'userID';
			$data = $this->_db->get2('payslip', array($field, '=', $id), array("date", ">=", $startdate), array("date", "<=", $enddate));
			
			if($data->count()){
				$this->_data = $data->results();
				return $this->_data;
			}
		}
		return false;
	}

	public function getpayrollyear($period = null, $emp_id = null){
		if($emp_id){
			$field = (is_numeric($emp_id)) ? 'emp_id' : 'emp_id';
			$data = $this->_db->getOne('payslip', array($field, '=', $emp_id), array("payslipDate", "LIKE", $period));
			
			if($data->count()){
				$this->_data = $data->results();
				return $this->_data;
			}
		}
		return false;
	}

	public function getcurrentmonthemp($period = null, $emp_id = null){
		if($emp_id){
			$field = (is_numeric($emp_id)) ? 'emp_id' : 'emp_id';
			$data = $this->_db->getOne('payslip', array($field, '=', $emp_id), array("payslipDate", "=", $period));
			
			if($data->count()){
				$this->_data = $data->results();
				return $this->_data;
			}
		}
		return false;
	}


	public function isLoggedIn(){
		return $this->_isLogggedIn;
	}
}
?>