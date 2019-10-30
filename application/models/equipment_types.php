<?php
class Equipment_types extends Doctrine_Record {

	public function setTableDefinition() {
		$this -> hasColumn('type', 'varchar', 50);

	}//end setTableDefinition

	public function setUp() {
		$this -> setTableName('equipment_types');
		
		$this -> hasMany('equipment',array(
			'local' => 'id',
			'foreign' => 'type'			
		));

	}//end setUp

}//end class
