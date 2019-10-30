<?php

class Invoice extends Doctrine_Record {

	public function setTableDefinition() {
		$this -> hasColumn('invoice_no', 'int', 11);
		$this -> hasColumn('invoice_date', 'date');
		$this -> hasColumn('client_address', 'varchar', 200);
		$this -> hasColumn('client_id', 'int', 11);
		$this -> hasColumn('product', 'varchar', 100);
		$this -> hasColumn('batch_no', 'varchar', 50);
		$this -> hasColumn('cert_no', 'varchar', 50);
		$this -> hasColumn('lab_ref_no', 'varchar', 50);
		$this -> hasColumn('client_ref_no', 'varchar', 50);
		$this -> hasColumn('tests_requested', 'varchar', 100);
		$this -> hasColumn('total_cost', 'double');
		$this -> hasColumn('discount', 'double');
		$this -> hasColumn('amount_payable', 'double');
		$this -> hasColumn('currency', 'varchar', 10);
		$this -> hasColumn('status', 'int', 11);
		

	}

	public function setUp() {
		$this->actAs('Timestampable');
		$this -> setTableName('invoice');
		
		$this -> hasMany('invoice_tests',array(
			'local' => 'lab_ref_no',
			'foreign' => 'lab_ref_no'			
		));
		
		$this -> hasOne('client',array(
			'local' => 'client_id',
			'foreign' => 'id'			
		));


	}//end setUp


	//Get invoice details for a sample
	public function getFinalInvoice($labref){
		
		$query = Doctrine_Query::create()
		-> select('inv.*, ')
		-> from("invoice inv")
		-> leftJoin("inv.invoice_tests inv_t")
		-> where("inv.lab_ref_no = ?", $labref);
		$inv = $query -> execute() -> toArray();
		return $inv;
	}
	
	

}