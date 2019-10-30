<?php

class Reagents_issuance extends Doctrine_Record {

	public function setTableDefinition() {
		$this -> hasColumn('s11_number', 'varchar', 30);
		$this -> hasColumn('reagent_id', 'int', 11);
		$this -> hasColumn('issuee_id', 'int', 11);
		$this -> hasColumn('issuer_id', 'int', 11);
		$this -> hasColumn('issuer_name', 'varchar', 50);
		$this -> hasColumn('quantity_issued', 'int', 11);
		$this -> hasColumn('date_issued', 'date');
	}

	public function setUp() {
		$this -> setTableName('reagents_issuance');

		$this -> hasOne('reagents', array(
			'local' => 'reagent_id',
			'foreign' => 'id'
		));
	}//end setUp

	public function getAll() {
		$query = Doctrine_Query::create() -> select("*") -> from("reagents_issuance");
		$coaData = $query -> execute();
		return $coaData;
	}



}
?>
