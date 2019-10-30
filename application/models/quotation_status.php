<?php  
class Quotation_status extends Doctrine_Record {
	
	public function setTableDefinition() {
		$this->hasColumn('status','varchar', 50);
	}

	public function setUp() {
		$this -> setTableName('Quotation_status');
		$this -> hasMany('Quotations_final', array(
			'local' => 'id',
			'foreign' => 'quotation_status'
		));
	}//end setUp


	public static function getAll(){
		$query = Doctrine_Query::create()
		-> select('*')
		-> from("quotations_status");
		$lastreqid = $query -> execute() -> toArray();
		return $lastreqid;
	}

}
?>