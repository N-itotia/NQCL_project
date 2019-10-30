<?php

class Request_filters extends Doctrine_Record {

	public function setTableDefinition() {
		$this -> hasColumn('name', 'varchar', 20);
		$this -> hasColumn('true_value', 'int', 11);
	}

	public function setUp() {
		$this -> setTableName('request_filters');
	}//end setUp


	public static function getAll(){

		$query=Doctrine_Query::create()
		-> select("*")
		-> from("request_filters r");
		$testData=$query->execute(array(), DOCTRINE::HYDRATE_ARRAY);
		return $testData;
	}


}
?>
