<?php

class Currencies extends Doctrine_Record {

	public function setTableDefinition() {

		$this -> hasColumn('name', 'varchar', 30);
		$this -> hasColumn('abbrev', 'varchar', 10);
		$this -> hasColumn('symbol', 'varchar', 10);
	
	}

	public function setUp() {
		$this -> setTableName('currencies');

		/*$this -> hasOne('Clients', array(
			'local'=> 'client_id',
			'foreign' => 'id'
		));*/

	}

	public function getAll(){
		$query = Doctrine_Query::create()
			-> select("*")
			-> from("currencies");
		$currencyData = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $currencyData;
	}
}

?>