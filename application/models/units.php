<?php
class Units extends Doctrine_Record {

	public function setTableDefinition() {

		$this -> hasColumn('name', 'varchar', 30);
		$this -> hasColumn('dept_id', 'int', 11);
		$this -> hasColumn('alias', 'varchar', 30);

	}
	public function setUp() {
		$this -> setTableName('units');
		/*$this -> hasMany('User_type', array(
			'local'=> 'id',
			'foreign' => 'unit'
			));*/
		$this -> hasMany('Users', array(
			'local'=> 'id',
			'foreign' => 'unit_id'
			));
		$this -> hasMany('Sample_issuance',array(
			'local' => 'id',
			'foreign' => 'Department_id'
		));

		$this -> hasMany('Tests', array(
			'local' => 'dept_id',
			'foreign' => 'Department'
		));

	}//end setUp

	public function getUnit($dept_id){

		$query = Doctrine_Query::create()
		-> select("*")
		-> from("units")
		-> where("dept_id = ?", $dept_id);
		$componentData = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $componentData;
	}

	public function getDeptAliases($dept_id){
		$query =  Doctrine_Query::create()
		-> select("alias")
		-> from("units")
		-> where("dept_id = ?", $dept_id);
		$aliasData = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $aliasData;
	}
	
	public function getTid($dept_id){
		$query =  Doctrine_Query::create()
		-> select("dept_id")
		-> from("units")
		-> where("id = ?", $dept_id);
		$aliasData = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $aliasData;
	}

	public function getMainUnits(){
		$query = Doctrine_Query::create()
		-> select("u.*")
		-> from("units u")
		-> where("u.id < 4");
		$componentData = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $componentData;

	}

	public function getTechnicalUnits(){
		$query = Doctrine_Query::create()
		-> select("u.*")
		-> from("units u")
		-> where("u.id < 5");
		$componentData = $query -> execute();
		return $componentData;

	}


}
?>
