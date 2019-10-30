<?php

class Quotations_final extends Doctrine_Record {
	
	public function setTableDefinition() {
		$this->hasColumn('quotation_no','varchar', 40);
		$this->hasColumn('client_id','int', 11);	
		$this->hasColumn('date_printed','date');
		$this->hasColumn('amount','int',11);
		$this->hasColumn('payable_amount','int',11);
		$this->hasColumn('discount','int', 11);
		$this->hasColumn('reporting_fee','int', 11);
		$this->hasColumn('admin_fee','int', 11);
		$this->hasColumn('currency','varchar', 40);
		$this->hasColumn('quotation_entries','int', 11);
		$this->hasColumn('signatory_title', 'varchar', 40);
		$this->hasColumn('signatory_name', 'varchar', 40);
		$this->hasColumn('print_status', 'int', 11);
		$this->hasColumn('source_status', 'int', 11);
	}

	public function setUp() {
		$this -> setTableName('Quotations_final');
		$this -> hasOne('clients', array(
			'local' => 'client_id',
			'foreign' => 'clientid'
		));

		$this -> hasMany('Quotations', array(
			'local' => 'quotation_no',
			'foreign' => 'quotation_no'
		));
		
		$this -> hasMany('Currencies', array(
			'local' => 'currency',
			'foreign' => 'abbrev'
		));

		$this -> hasOne('Quotation_status', array(
			'local' => 'Quotation_status',
			'foreign' => 'id'
		));
		/*$this -> hasMany('Invoices', array(
			'local' => 'invoice_ref',
			'foreign' => 'invoice_no'
		));*/

	}//end setUp


	public static function checkEntry($q){
		$query = Doctrine_Query::create()
		-> select("qf.id")
		-> from("quotations_final qf")
		-> where("qf.quotation_no =?", $q);
		$qf_data = $query-> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $qf_data;
	}


	public static function getSignatory($q){
		$query = Doctrine_Query::create()
		-> select("qf.signatory_title,qf.signatory_name")
		-> from("quotations_final qf")
		-> where("qf.quotation_no =?", $q);
		$qf_data = $query-> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $qf_data;
	}

	public static function getQuotationExtras($q){
		$query = Doctrine_Query::create()
		-> select("qf.discount, qf.reporting_fee, qf.admin_fee")
		-> from("quotations_final qf")
		-> where("qf.quotation_no =?", $q);
		$qf_data = $query-> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $qf_data;		
	}


	public static function getCurrency($q){
		$query = Doctrine_Query::create()
		-> select("qf.currency")
		-> from("quotations_final qf")
		-> where("qf.quotation_no =?", $q);
		$qf_data = $query-> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $qf_data;
	}

	public static function getClient($q){
		$query = Doctrine_Query::create()
		-> select("qf.client_id")
		-> from("quotations_final qf")
		-> leftJoin("qf.clients")
		-> where("qf.quotation_no =?", $q);
		$qf_data = $query-> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $qf_data;	
	}

	public static function getAmount($inv){
		$query = Doctrine_Query::create()
		-> select("qf.amount")
		-> from("quotations_final qf")
		-> where("qf.quotation_no =?", $inv);
		$qf_data = $query-> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $qf_data;
	}



	}