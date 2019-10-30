<?php

class Quotations extends Doctrine_Record {
	
	public function setTableDefinition() {
	
	$this->hasColumn('client_email','varchar', 30);
	$this->hasColumn('Client_number','varchar', 35);	
	$this->hasColumn('Client_name','varchar', 35);
	$this->hasColumn('Sample_name','varchar', 35);
	$this->hasColumn('No_of_batches','int', 11);
	$this->hasColumn('Quotation_date','varchar',35);
	$this->hasColumn('Quotation_id', 'varchar', 30);
	$this->hasColumn('Quotations_id','varchar',35);
	$this->hasColumn('Quotation_no','varchar',35);
	$this->hasColumn('Quotation_entries','int',11);
	$this->hasColumn('Quotation_entries_done','int',11);
	$this->hasColumn('Amount','int',11);
	$this->hasColumn('Batch_id','int',11);
	$this->hasColumn('Active_ingredients','varchar',35);
	$this->hasColumn('Dosage_form','int', 11);
	$this->hasColumn('Currency','varchar', 10);
	$this->hasColumn('Discount','int', 11);
	$this->hasColumn('Reporting_fee','int', 11);
	$this->hasColumn('Admin_fee','int', 11);
	$this->hasColumn('Quotation_status', 'int', 11);
	$this->hasColumn('Completion_status', 'int', 11);
	$this->hasColumn('quotation_print_status', 'int', 11);
	$this->hasColumn('ndq_ref', 'varchar', 50);
	$this->hasColumn('signatory_title', 'varchar', 50);
	$this->hasColumn('signatory_name', 'varchar', 50);
	}

	public function setUp() {
		$this -> setTableName('Quotations');
		$this -> hasOne('Clients', array(
			'local' => 'client_number',
			'foreign' => 'id'
		));

		$this -> hasMany('Q_request_details', array(
			'local' => 'quotations_id',
			'foreign' => 'quotations_id'
		));
		
		$this -> hasMany('Currencies', array(
			'local' => 'currency',
			'foreign' => 'abbrev'
		));

		$this -> hasMany('Quotations_final', array(
			'local' => 'Quotation_no',
			'foreign' => 'quotation_no'
		));

		$this -> hasMany('Quotation_status', array(
			'local' => 'Quotation_status',
			'foreign' => 'id'
		));

		$this -> hasOne('Request_payment', array(
			'local' => 'Quotations_id',
			'foreign' => 'Quotation_no'
		));

	}//end setUp


	public static function getLastId(){
		$query = Doctrine_Query::create()
		-> select('max(id)')
		-> from("quotations");
		$lastreqid = $query -> execute() -> toArray();
		return $lastreqid;
	}



	public static function getQuotationSummary($q_no){
		$query = Doctrine_Query::create()
		-> select('q.Sample_name, q.Quotation_date, q.Quotation_no, q.currency, q.Client_name')
		-> from("quotations q")
		-> where("q.Quotation_no =?", $q_no)
		-> leftJoin("q.Clients c")
		-> groupBy("q.Quotation_no");
		$summary = $query -> execute() -> toArray();
		return $summary;
	}


	public static function getNos($c){
		$query = Doctrine_Query::create()
		-> select('Quotation_no')
		-> from("quotations")
		-> where("Client_number = ?", $c);
		$lastreqid = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $lastreqid;
	}
	
	public static function getClientNo($q){
		$query =  Doctrine_Query::create()
		-> select('Client_number')
		-> from("quotations")
		-> where("Quotation_no = ?", $q);
		$lastreqid = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $lastreqid;
		
	}
	
	public static function getNoOfEntries($reqid){
		$query = Doctrine_Query::create()
		-> select('count(*) as no_of_entries')
		-> from("quotations")
		-> where("quotation_no = ?", $reqid)
		-> orderBy("id ASC")
		-> groupBy("quotation_id");
		$entries = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $entries;
	}
	
	public static function getCompletedEntries($reqid){
		$query = Doctrine_Query::create()
		-> select('count(*) as completed')
		-> from("quotations")
		-> where("quotation_no = ?", $reqid)
		-> andWhere("Completion_status =?", 1)
		-> orderBy("id ASC")
		-> limit(1);
		$entries = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $entries;
	}
	
	public static function getQuotationDetails($reqid){
		$query = Doctrine_Query::create()
		-> select('q.client_email as email, q.client_number, q.client_name, q.sample_name, q.No_Of_Batches, q.Currency')
		-> from("quotations q")
		-> where("quotation_no = ?", $reqid);
		$entries = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $entries;
	}
	
	public static function getQuotationDetailsGlobal($reqid){
		$query = Doctrine_Query::create()
		-> select('q.client_email as email, q.client_number, q.client_name, q.sample_name, q.No_Of_Batches, q.Currency, q.Quotation_entries')
		-> from("quotations q")
		-> where("quotation_no = ?", $reqid);
		$entries = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $entries;
	}
	public static function getQuotationNumber2($reqid){
		$query = Doctrine_Query::create()
		-> select('Quotation_no')
		-> from("quotations")
		-> where("quotations_id = ?", $reqid);
		$entries = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $entries;
	}

	public static function getQuotationParameters($reqid){
		$query = Doctrine_Query::create()
		-> select('Quotation_no, No_of_batches, client_number, quotation_id, currency')
		-> from("quotations")
		-> where("quotations_id = ?", $reqid);
		$entries = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $entries;
	}
	
	public static function getBillingExtras($rid){
		$query = Doctrine_Query::create()
		-> select('admin_fee, reporting_fee, discount')
		-> from("quotations")
		-> where("quotations_id = ?", $rid);
		$extras = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $extras;
	}


	public static function getRowCount(){
		$query = Doctrine_Query::create()
		-> select('count(*)')
		-> from("quotations");
		$rowcount = $query -> execute() -> toArray();
		return $rowcount;
	}
	
	public static function getCurrency($reqid){
		$query = Doctrine_Query::create()
		-> select('currency')
		-> from("quotations")
		-> where("quotations_id = ?", $reqid);
		$c = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $c;
	}

	public static function getRowCountPerClient($c){
		$query = Doctrine_Query::create()
		-> select('count(*)')
		-> from("quotations")
		-> where("Client_number = ?", $c);
		$rowcount = $query -> execute() -> toArray();
		return $rowcount;
	}


	public static function getQuotationsInfoSimple($reqid){
		$query = Doctrine_Query::create()
		-> select("q.id, q.sample_name as product_name, c.name")
		-> from("quotations q")
		-> leftJoin("q.Clients c")
		-> where("q.quotations_id = ?", $reqid);
		$componentData = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $componentData;	
	}

	public static function getInvoiceDetails($r){
		$query = Doctrine_Query::create()
		-> select("q.Quotation_date as Date,q.quotations_id as Quotation_No, q.Client_name as Client_Name, q.client_email as Client_Email, q.sample_name as Sample_Name,  q.No_of_batches as No_Of_Batches, t.Name, q.id, rq.id, q.amount as Unit_Cost, (q.amount * q.No_of_batches) as Total_Cost")
		-> from("quotations q")
		-> leftJoin("q.Clients c")
		-> leftJoin("q.Q_request_details rq")
		-> leftJoin("rq.Tests t")
		-> where("q.quotations_id =?", $r);
		$invoiceData = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $invoiceData;
	}

	public static function getClientId($r){
		$query = Doctrine_Query::create()
		-> select("distinct(client_number)")
		-> from("quotations")
		-> where("quotations_id = ?", $r);
		$client_data = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $client_data[0];
	}


	public static function getInvoiceDetailsPerClient($c, $q){
		$query = Doctrine_Query::create()
		-> select("q.Quotation_date as Date,q.quotations_id as Quotation_No, q.quotation_no as Q_No, q.Client_name as Client_Name, q.client_email as Client_Email, q.sample_name as Sample_Name,  q.No_of_batches as No_Of_Batches, t.Name, q.id, rq.id, q.amount as Unit_Cost, (q.amount * q.No_of_batches) as Total_Cost")
		-> from("quotations q")
		-> leftJoin("q.Clients c")
		-> leftJoin("q.Q_request_details rq")
		-> leftJoin("rq.Tests t")
		-> where("q.client_number =?", $c)
		-> andWhere("q.Quotation_no =?", $q)
		-> groupBy("q.Quotation_id");
		$invoiceData = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $invoiceData;
	}


	public static function getTotalPerClient($c, $q){
		$query = Doctrine_Query::create()
		-> select("sum(q.amount), q.id")
		-> from("quotations q")
		-> where("q.client_number =?", $c)
		-> andWhere("q.Quotation_no =?", $q);
		$invoiceData = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $invoiceData;
	}


	public static function getMainTotal($q){
		$query = Doctrine_Query::create()
		-> select("sum(amount), q.id")
		-> from("quotations q")
		-> where("q.Quotation_no =?", $q);
		$invoiceData = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $invoiceData;
	}


public static function getSample($reqid) {
		$query = Doctrine_Query::create() -> select("*") 
		-> from("quotations")
		-> where("client_number =?", $reqid);
		$productData = $query -> execute() -> toArray();
		return $productData;
	}//end getall


	public static function getQuotationNumber($reqid) {
		$query = Doctrine_Query::create() -> select("quotation_no") 
		-> from("quotations")
		-> where("quotations_id =?", $reqid);
		$productData = $query -> execute() -> toArray();
		return $productData;
	}

	
	public static function getAllHydrated() {
		$query = Doctrine_Query::create()
		-> select("q.id, q.client_number as client_id, q.client_email, q.client_name, q.quotation_date, q.quotation_no, q.quotation_entries, q.amount, q.reporting_fee, q.admin_fee, q.discount, q.currency,q.quotation_status") 
		-> from("quotations q")
		-> groupBy("q.quotation_no")
		-> orderBy("id DESC");
		$productData = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $productData;
	}


	public static function getAllConsolidated() {
		$query = Doctrine_Query::create()
		-> select("q.id, q.client_number as client_id, q.client_email, q.client_name, q.quotation_no, q.currency, qf.amount, qf.reporting_fee, qf.admin_fee, qf.discount, qf.payable_amount, qf.quotation_entries, qf.print_status, qf.source_status, qs.status") 
		-> from("quotations q")
		-> leftJoin("q.Quotations_final qf")
		-> leftJoin("qf.Quotation_status qs")
		-> orderBy("id DESC")
		-> groupBy("qf.id");
		$productData = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $productData;
	}

	public static function getChildEntries($quotation_no) {
		$query = Doctrine_Query::create()
		-> select("q.id, q.quotations_id, q.sample_name,q.no_of_batches,q.quotation_date, q.batch_id, q.quotation_no, q.amount, rp.request_id as ndq_ref, q.currency,q.quotation_status") 
		-> from("quotations q")
		-> leftJoin("q.Request_payment rp")
		-> where("q.quotation_no = ?", $quotation_no)
		-> orderBy("q.id DESC");
		$productData = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $productData;
	}


	public static function getInvoices() {
		$query = Doctrine_Query::create()
		-> select("q.id, q.quotations_id, q.sample_name,q.no_of_batches,q.quotation_date, q.batch_id, q.quotation_no, q.amount, rp.request_id as ndq_ref, q.currency,q.quotation_status") 
		-> from("quotations q")
		-> leftJoin("q.Request_payment rp")
		-> orderBy("q.id DESC");
		$productData = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $productData;
	}	

	public static function getAll() {
		$query = Doctrine_Query::create() -> select("*") -> from("Quotations");
		$productData = $query -> execute() -> toArray();
		return $productData;
	}//end getall

}

?>