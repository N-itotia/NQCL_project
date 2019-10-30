<?php

class Q_request_details extends Doctrine_Record {

	public function setTableDefinition() {
		$this -> hasColumn('quotations_id', 'varchar', 30);
		$this -> hasColumn('quotation_id', 'varchar', 30);
		$this -> hasColumn('client_email', 'varchar', 30);
		$this -> hasColumn('client_number', 'varchar', 35);
		$this -> hasColumn('test_charge', 'int', 11);
		$this -> hasColumn('method_charge', 'int', 11);
		$this -> hasColumn('test_id', 'int', 11);
		$this -> hasColumn('method_id', 'int', 11);
		$this -> hasColumn('compendia_id', 'int', 11);
	}

	public function setUp() {
		$this -> setTableName('q_request_details');
		$this -> hasMany('Tests',
		array(
		'local' => 'test_id',
		'foreign' => 'id'
		));

		$this -> hasMany('tests',array(
			'local' => 'test_id',
			'foreign' => 'id'			
		));
		
		$this -> hasMany('test_methods',array(
			'local' => 'method_id',
			'foreign' => 'id'			
		));

		$this -> hasOne('clients',array(
			'local' => 'client_id',
			'foreign' => 'id'			
		));

		$this -> hasMany('Quotations',
		array(
			'local' => 'quotations_id',
			'foreign' => 'quotations_id'
		));

		$this -> hasMany('compendia',
		array(
			'local' => 'compendia_id',
			'foreign' => 'id'
		));

		$this->hasMany('quotations_components', array(
			'local' => 'quotations_id',
			'foreign' => 'quotations_id'
		));
	}//end setUp

	public static function getTestsNames($reqid){
		$query = Doctrine_Query::create()
		-> select("alias, Test_type")
		-> from("tests, q_request_details")
		-> where('q_request_details.client_number =?', $reqid)
		-> andWhere('tests.id = q_request_details.test_id');
		$testData = $query -> execute(array(), DOCTRINE::HYDRATE_ARRAY);
		return $testData;
	}

	public static function getTests2($reqid){
		$query = Doctrine_Query::create()
		-> select("test_id")
		-> from("q_request_details")
		-> where("quotations_id = ?" , $reqid);
		$testData = $query -> execute(array(), DOCTRINE::HYDRATE_ARRAY);
		return $testData;
	}

	public static function getChargesPerClient($rid){
		$query = Doctrine_Query::create()
		-> select("q.*, t.*, m.*, c.*")
		-> from("q_request_details q")
		-> leftJoin("q.tests t")
		-> leftJoin("q.test_methods m")
		-> leftJoin("q.compendia c")
		-> where("q.quotations_id =?", $rid);
		$clientData = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $clientData;
	}

	public static function getTotal($rid){
		$query = Doctrine_Query::create()
		-> select('c.*, m.*, t.*, sum(c.method_charge)')
		-> from("q_request_details c")
		-> where("c.quotation_id =?", $rid)
		-> leftJoin("c.tests t")
		-> leftJoin("c.test_methods m");
		$clientData = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $clientData;	
	}

	public static function getMainTotal($rid){
		$query = Doctrine_Query::create()
		-> select('c.*, m.*, t.*, sum(c.method_charge)')
		-> from("q_request_details c")
		-> where("c.quotations_no =?", $rid)
		-> leftJoin("c.tests t")
		-> leftJoin("c.test_methods m");
		$clientData = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $clientData;	
	}

	public static function getBatchTotal($rid){
		$query = Doctrine_Query::create()
		-> select('c.*, m.*, t.*, sum(c.method_charge)')
		-> from("q_request_details c")
		-> where("c.quotations_id =?", $rid)
		-> leftJoin("c.tests t")
		-> leftJoin("c.test_methods m");
		$clientData = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $clientData;	
	}

	/*public static function getMethodData($rid, $test_id, $currency){
		$query = Doctrine_Query::create()
		-> select('qr.id,t.id, t.Name, c.name, c.abbrev, qc.component, tm.name, tm.charge_'.$currency)
		-> from ('q_request_details qr')
		-> leftJoin("qr.tests t")
		-> leftJoin("qr.test_methods tm")
		-> leftJoin("qr.quotations_components qc")
		-> where('qr.quotations_id =?', $rid)
		-> andWhere('qr.test_id =?', $test_id);
		$methodData = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $methodData;
	}*/

}
?>