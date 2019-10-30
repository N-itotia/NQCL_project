<?php

class Quotations_components extends Doctrine_Record {

	public function setTableDefinition() {
		$this -> hasColumn('component', 'varchar', 50);
		$this -> hasColumn('test_id', 'int', 11);
		$this -> hasColumn('method_id', 'int', 11);
		$this -> hasColumn('quotations_id', 'varchar', 30);
		$this -> hasColumn('quotation_id', 'varchar', 30);
		$this -> hasColumn('method_charge', 'int', 11);
		$this -> hasColumn('test_charge', 'int', 11);
		$this -> hasColumn('additional_charge', 'int', 11);
		$this -> hasColumn('charge_system', 'int', 11);
		$this -> hasColumn('quotation_status', 'int', 11);
	}

	public function setUp() {
		$this -> setTableName('quotations_components');
		$this -> hasMany('Q_request_details',
		array(
			'local' => 'quotations_id',
			'foreign' => 'quotations_id'
		));

		$this -> hasMany('Test_methods',
		array(
			'local' => 'method_id',
			'foreign' => 'id'
		));
	}//end setUp

	public function getAll() {
		$query = Doctrine_Query::create() -> select("*") -> from("quotations_components");
		$coaData = $query -> execute();
		return $coaData;
	}



	public static function getComponentTotal($rid, $component_name){
		$query = Doctrine_Query::create()
		-> select('sum(method_charge) as component_total')
		-> from("quotations_components")
		-> where("quotations_id = ?", $rid)
		-> andWhere("component =?", $component_name);
		$component_total = $query -> execute() -> toArray();
		return $component_total;
	}



	public static function getMulticomponentStatus($rid){
		$query = Doctrine_Query::create()
		-> select('count(id)')
		-> from("quotations_components")
		-> where("quotations_id = ?", $rid);
		$count = $query -> execute() -> toArray();
		return $count[0]['count'];			 	
	}

	public static function getQuotations_components($reqid, $ref){
		$query = Doctrine_Query::create() 
		-> select("rc.component, rc.id") 
		-> from("quotations_components rc")
		-> where("rc.$ref = ?", $reqid)
		-> groupBy("rc.component");
		$componentData = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $componentData;
	}

	public static function getBaseCharge($a, $reqid){
		$query = Doctrine_Query::create() 
		-> select("rc.method_charge") 
		-> from("quotations_components rc")
		-> where("rc.test_id = ?", $a)
		-> andWhere("rc.quotations_id =?", $reqid)
		-> groupBy("rc.component")
		-> limit("1");
		$componentData = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $componentData[0];
	}
	
	
	public static function getComponentsTotal($reqid, $test_id){
		$query = Doctrine_Query::create() 
		-> select("SUM(qc.method_charge) as component_total") 
		-> from("quotations_components qc")
		-> andWhere("qc.quotations_id =?", $reqid)
		-> andWhere("qc.test_id =?", $test_id);
		$componentData = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $componentData;
	}

	public static function getComponentsTotalAlt($ref, $reqid, $test_id){
		$query = Doctrine_Query::create() 
		-> select("SUM(qc.method_charge) as component_total") 
		-> from("quotations_components qc")
		-> andWhere("qc.quotations_id =?", $reqid)
		-> andWhere("qc.test_id =?", $test_id);
		$componentData = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $componentData;
	}


	public static function getComponentMethods($reqid, $test_id, $currency){
		$query = Doctrine_Query::create() 
		-> select("rc.component, rc.id, t.name, t.id, t.charge_$currency") 
		-> from("quotations_components rc")
		-> leftJoin("rc.Test_methods t")
		-> where("rc.quotations_id = ?", $reqid)
		-> andWhere("rc.test_id = ?", $test_id)
		-> groupBy("rc.component");
		$componentData = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $componentData;	
	}


}
?>
