<?php
class Compendia extends Doctrine_Record {
	public function setTableDefinition() {
		$this -> hasColumn('name', 'varchar',100);	
		$this -> hasColumn('abbrev', 'int',20);		
	}

	public function setUp() {
		$this -> setTableName('compendia');
		$this -> hasMany('q_request_details', array('local' => 'id', 'foreign' => 'compendia_id'));
		
	}

	public static function getAll() {
		$query = Doctrine_Query::create() 
		-> select("*") 
		-> from("compendia");
		$compendia = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $compendia;
	}


	
}