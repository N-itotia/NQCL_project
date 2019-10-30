<?php

class Client_type extends Doctrine_Record {
	public function setTableDefinition() {
		$this -> hasColumn('ctype', 'varchar', 10);
		$this -> hasColumn('cdesc', 'varchar', 50);
	}
	
	public function setUp(){
		$this -> setTableName('client_type');
	}
	
	
	public static function getAll(){
		$query = Doctrine_Query::create()
		-> select("*")
		-> from("client_type");
		$type = $query -> execute();
		return $type;
	}
}

?>