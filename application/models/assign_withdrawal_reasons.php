<?php

class Assign_withdrawal_reasons extends Doctrine_Record {

	public function setTableDefinition() {
		$this -> hasColumn('name','varchar', 50);
		$this -> hasColumn('reporting_status', 'int', 11);
		$this -> hasColumn('system_status', 'int', 11);
	}
	
	public function getAllReasons() {
		$query = Doctrine_Query::create()
		-> select('*')
		-> from('assign_withdrawal_reasons')
		-> where('system_status =?', 0);
		$withdrawnData = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $withdrawnData;
	}
}
?>