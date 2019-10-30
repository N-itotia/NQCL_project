<?php
class Equipment_status extends Doctrine_Record {

	public function setTableDefinition() {
		$this -> hasColumn('status', 'varchar', 50);

	}//end setTableDefinition

	public function setUp() {
		$this -> setTableName('equipment_status');
		
		$this -> hasMany('equipment',array(
			'local' => 'id',
			'foreign' => 'status'			
		));

	}//end setUp

}//end class
