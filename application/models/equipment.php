<?php
class Equipment extends Doctrine_Record {

	public function setTableDefinition() {
		$this -> hasColumn('name', 'varchar', 50);
		$this -> hasColumn('serial_no', 'varchar', 20);
		$this -> hasColumn('nqcl_no', 'varchar', 20);
		$this -> hasColumn('date_acquired', 'date');
		$this -> hasColumn('no_of_units', 'int', 11);
		$this -> hasColumn('status', 'int', 30);
		$this -> hasColumn('room', 'int', 50);
		$this -> hasColumn('comment', 'varchar', 100);
		$this -> hasColumn('edit_status', 'int', 11);
		$this -> hasColumn('type', 'int', 20);
		$this -> hasColumn('model', 'varchar', 150);
		$this -> hasColumn('alias', 'varchar', 50);
	}//end setTableDefinition

	public function setUp() {
		$this -> setTableName('equipment');
		
		
		$this -> hasOne('rooms',array(
			'local' => 'room',
			'foreign' => 'id'			
		));

		$this -> hasOne('equipment_types',array(
			'local' => 'type',
			'foreign' => 'id'			
		));

		$this -> hasOne('equipment_status',array(
			'local' => 'status',
			'foreign' => 'id'			
		));
	}//end setUp

	public function getAll() {
		$query = Doctrine_Query::create() 
		-> select("e.*, r.room as rm, s.status as st, t.type as ty") 
		-> from("equipment e")
		-> leftJoin("e.rooms r")
		-> leftJoin("e.equipment_types t")
		-> leftJoin("e.equipment_status s");
		$equipmentData = $query -> execute() -> toArray();
		return $equipmentData;
	}//end getAll

	public function getAllHydrated() {
		$query = Doctrine_Query::create() -> select("name,nqcl_no") -> from("equipment");
		$equipmentData = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $equipmentData;
	}

	public function getEquipment($eid) {
		$name = str_replace('_', ' ',$eid);
		$query = Doctrine_Query::create() 
		-> select("*") 
		-> from("equipment")
		-> where("name=?", $name);
		$equipmentData = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $equipmentData;
	}
	
	public function getEquipmentEdit($eid) {
		$query = Doctrine_Query::create() 
		-> select("*") 
		-> from("equipment")
		-> where("id=?", $eid);
		$equipmentData = $query -> execute();
		return $equipmentData;
	}
	

	public function getMax(){
		$query = Doctrine_Query::create() 
		-> select("count('*')")
		-> from("equipment");
		$equipmentData = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $equipmentData;	
	}

}//end class
