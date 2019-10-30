<?php

class Assign_withdrawal_log extends Doctrine_Record {

	public function setTableDefinition() {
		$this -> hasColumn('request_id','varchar', 30);
		$this -> hasColumn('reason_id', 'int', 11);
		$this -> hasColumn('comment', 'varchar', 50);
		$this -> hasColumn('date', 'date');
	}
	
	public function getAll() {
		$query = Doctrine_Query::create()
		-> select('*')
		-> from('assign_withdrawal_log');
		$withdrawnData = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $withdrawnData;
	}
}
?>