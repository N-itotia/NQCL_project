<?php
class Rooms extends Doctrine_Record {

	public function setTableDefinition() {
		$this -> hasColumn('room', 'varchar', 50);
		$this -> hasColumn('room_code', 'varchar', 50);

	}//end setTableDefinition

	public function setUp() {
		$this -> setTableName('rooms');
		
		$this -> hasMany('equipment',array(
			'local' => 'id',
			'foreign' => 'room'			
		));

	}//end setUp

}//end class
