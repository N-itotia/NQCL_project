<?php
class Request_payment extends Doctrine_Record {
	
	public function setTableDefinition() {
		$this -> hasColumn('request_id', 'varchar',40);
		$this -> hasColumn('quotation_no', 'varchar',40);
		$this -> hasColumn('receipt_no', 'varchar',40);
		$this -> hasColumn('date', 'date');		
	}

	public function setUp() {
		$this -> setTableName('request_payment');
		$this -> hasOne('Quotations', array(
			'local' => 'quotation_no',
			'foreign' => 'Quotations_id'
		));
		
	}

}