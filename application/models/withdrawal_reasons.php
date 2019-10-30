<?php
class Withdrawal_reasons extends Doctrine_Record {
	public function setTableDefinition() {
		$this -> hasColumn('id', 'int',15);
		$this -> hasColumn('reason', 'varchar',100);			
	}

	public function setUp() {
		$this -> setTableName('withdrawal_reasons');
		//$this -> hasMany('user as u_type1', array('local' => 'id', 'foreign' => 'usertype_id'));
		
	}

}