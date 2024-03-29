<?php
class User extends Doctrine_Record {

	public function setTableDefinition() {
		$this->hasColumn('fname', 'varchar', 255);
		$this->hasColumn('lname', 'varchar', 255);
		$this->hasColumn('other_names', 'varchar', 20);
		$this->hasColumn('email', 'string', 255, array('unique' => 'true'));
		$this->hasColumn('username', 'string', 255, array('unique' => 'true'));
		$this->hasColumn('password', 'string', 255);
		$this->hasColumn('user_type', 'int', 11);
		$this->hasColumn('telephone', 'varchar', 255);
		$this->hasColumn('status', 'int', 11);
		$this->hasColumn('department_id','int', 11);
		$this->hasColumn('edit_status', 'int', 11);
		$this->hasColumn('acc_status', 'int', 11);
		$this->hasColumn('comment', 'varchar', 255);
		$this->hasColumn('tier','int', 11);
		$this->hasColumn('unit_id', 'int', 11);
		$this->hasColumn('pm_count', 'int', 11);
		$this->hasColumn('title', 'varchar', 20);
	}
	
	public function setUp() {
		$this->setTableName('user');
		$this->actAs('Timestampable');
		$this->hasMutator('password', '_encrypt_password');
		$this -> hasMany('Columns', array(
			'local'=> 'id',
			'foreign' => 'issued_to'
			));

		$this -> hasMany('column_issue', array(
			'local'=> 'id',
			'foreign' => 'analyst_id'
		));

		$this -> hasMany('User_type', array(
			'local'=> 'tier',
			'foreign' => 'tier'
			));
		$this -> hasOne('Departments', array(
			'local'=> 'department_id',
			'foreign' => 'id'
			));
		$this -> hasMany('Users_types', array(
			'local'=> 'email',
			'foreign' => 'email'
			));
		$this -> hasOne('Units', array(
			'local'=> 'unit_id',
			'foreign' => 'id'
			));
		$this -> hasMany('Sample_issuance',array(
			'local' => 'id',
			'foreign' => 'Analyst_id'			
			));
		$this -> hasMany('Invoice_tracking',array(
			'local' => 'id',
			'foreign' => 'user_id'			
			));	
	}

	public function getNameCount($name){
		$query = Doctrine_Query::create()
		-> select('count(distinct(username))')
		-> from('user')
		-> where('username =?', $name);
		$countData = $query -> execute() -> toArray();
		return $countData;
	}

	public function getMailCount($name){
		$query = Doctrine_Query::create()
		-> select('count(distinct(email))')
		-> from('user')
		-> where('email =?', $name);
		$countData = $query -> execute() -> toArray();
		return $countData;
	}




	protected function _encrypt_password($value) {
		$salt = '#*seCrEt!@-*%';
		$this->_set('password', md5($salt . $value));
	}
	
	public function login($username, $password) {
		$short = substr($username, 0, strpos( $username, '@nqcl.go.ke'));
		$fuser = $short.'@nqcl.go.ke';
		$query = Doctrine_Query::create() -> select("user_type") -> from("User") -> where("username = '" . $fuser . "'");

		$x = $query -> execute();
		return $x[0];
	}

	public function alt_logins($username, $usertype){
		$query = Doctrine_Query::create()
		-> select('u.*, t.*')
		-> from('users_types u')
		-> leftJoin('u.User_type t')
		-> where('u.email=?', $username)
		-> andWhere('t.usertype_id=?', $usertype);
		$countData = $query -> execute(array(), Doctrine::HYDRATE_ARRAY) ;
		return $countData;
	}


	public static function getAll2($facility,$id) {
		$query = Doctrine_Query::create() -> select("*") -> from("user")->where("usertype_id=2 or usertype_id=5 ")->andWhere("id <> $id and facility='$facility'");
		$level = $query -> execute();
		return $level;
	}
	public static function getAll3($use_id) {
		$query = Doctrine_Query::create() -> select("*") -> from("user")->where("usertype_id=2 and id=$use_id");
		$level = $query -> execute();
		return $level;
		
	}
	public static function getAll4($use_id) {
		$myobj = Doctrine::getTable('user')->findOneById($use_id);
        $id=$myobj->id ;
		$my_array =array('0'=>$id);
		return $my_array;
	}
	public static function getAll(){
		$query = Doctrine_Query::create() -> select("*") -> from("user");
		$level = $query -> execute();
		return $level;
	}
	public static function getAll5($district, $id){
		$query = Doctrine_Query::create() -> select("*") -> from("user")->where("district=$district") ->andWhere("id <> $id");
		$level = $query -> execute();
		return $level;
	}
	public static function getUsers($facility_c){
		$query = Doctrine_Query::create() -> select("*") -> from("user")->where("facility=$facility_c");
		$level = $query -> execute();
		return $level;
	}
	
	public static function getAnalysts($reqid) {
		$query = Doctrine_Query::create()
		->select("u.*")
		->from("User u, Tests t, Request_details r")
		->where('u.department_id = ?',1)
		//->andWhere('u.user_type =?', 1)
		->andWhere('r.request_id = ?', $reqid)
		->orderBy('u.fname', 'ASC');
		$analyst_s =  $query -> execute(array(), DOCTRINE::HYDRATE_ARRAY);
		return $analyst_s;
	}


	
	public static function getAnalysts2($reqid, $user_type) {
		$query = Doctrine_Query::create()
		->select("u.*")
		->from("User u, Request_details r")
		->where('u.user_type = ?',$user_type)
		//->andWhere('u.user_type =?', 1)
		->andWhere('r.request_id = ?', $reqid);
		$analyst_s =  $query -> execute(array(), DOCTRINE::HYDRATE_ARRAY);
		return $analyst_s;
	}
	
	public static function getAnalyst3($analyst_id){
		
		$query = Doctrine_Query::create() -> select("*") -> from("user")->
		where('id= ?', $analyst_id);
		$level = $query -> execute() -> toArray();
		return $level;
		
	}

	public static function getAllAnalysts(){

		$query = Doctrine_Query::create() -> select("*") -> from("user")->
		where('user_type = ?', 1 );
		$level = $query -> execute() -> toArray();
		return $level;

	}

	public static function getAnalystsAll() {
		$query = Doctrine_Query::create()
		->select("u.*, ut.*")
		->from("User u")
		->leftJoin("u.Users_types ut")
		->where('ut.usertype_id = ?', 1) 
		->orderBy('u.fname','DESC');
		$analyst_s =  $query -> execute(array(), DOCTRINE::HYDRATE_ARRAY);
		return $analyst_s;
	}
	

	public static function getSignatories() {
		$query = Doctrine_Query::create()
		->select("u.*, uts.*, ut.*")
		->from("User u")
		->leftJoin("u.Users_types uts")
		->leftJoin("uts.User_type ut")
		->where('ut.tier > 3');
		$sig =  $query -> execute(array(), DOCTRINE::HYDRATE_ARRAY);
		return $sig;
	}



	public static function getAllSupervisors() {
		$query = Doctrine_Query::create()
		->select("u.*, ut.*")
		->from("User u")
		->leftJoin("u.Users_types ut")
		->where('ut.usertype_id = ?', 2) ;
		$analyst_s =  $query -> execute(array(), DOCTRINE::HYDRATE_ARRAY);
		return $analyst_s;
	}
	
		public static function getAllAnalystsData() {
		$query = Doctrine_Query::create()
		->select("u.*, ut.*")
		->from("User u")
		->leftJoin("u.Users_types ut")
		->where('ut.usertype_id = ?', 1) ;
		$analyst_s =  $query -> execute(array(), DOCTRINE::HYDRATE_ARRAY);
		return $analyst_s;
	}
	
	public static function getAllReviewers() {
		$query = Doctrine_Query::create()
		->select("u.*, ut.*")
		->from("User u")
		->leftJoin("u.Users_types ut")
		->where('ut.usertype_id = ?', 3) ;
		$analyst_s =  $query -> execute(array(), DOCTRINE::HYDRATE_ARRAY);
		return $analyst_s;
	}
	
			public static function getAllReviewersOfCoa() {
		$query = Doctrine_Query::create()
		->select("u.*, ut.*")
		->from("User u")
		->leftJoin("u.Users_types ut")
		->where('ut.usertype_id = ?', 30) ;
		$analyst_s =  $query -> execute(array(), DOCTRINE::HYDRATE_ARRAY);
		return $analyst_s;
	}
	
	public static function getAllDirectors() {
		$query = Doctrine_Query::create()
		->select("u.*, ut.*")
		->from("User u")
		->leftJoin("u.Users_types ut")
		->where('ut.usertype_id = ?', 8) ;
		$analyst_s =  $query -> execute(array(), DOCTRINE::HYDRATE_ARRAY);
		return $analyst_s;
	}
	
	public static function getDirector() {
		$query = Doctrine_Query::create()
		->select("u.id,u.title as title, u.fname as fname, u.lname as lname, uts.id, ut.name as role")
		->from("User u")
		->leftJoin("u.Users_types uts")
		->leftJoin("uts.User_type ut")
		->where('uts.usertype_id = ?', 8) ;
		$analyst_s =  $query -> execute(array(), DOCTRINE::HYDRATE_ARRAY);
		return $analyst_s;
	}
	
	public function getAll6(){
		$query = Doctrine_Query::create() -> 
		select("u.*,t.*,d.*, ut.*")-> 
		from("user u")->
		leftJoin("u.Departments d") ->
		leftJoin("u.Users_types ut") ->
		innerJoin("ut.User_type t");
		$level = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $level;
	}


	public function getUserDetails($user_id){
		$query = Doctrine_Query::create() -> 
		select("u.*,t.*,d.*, ut.*, un.*")-> 
		from("user u")->
		leftJoin("u.Departments d") ->
		leftJoin("u.Users_types ut")->
		innerJoin("ut.User_type t") ->
		leftJoin("u.Units un") ->
		where("u.id =?", $user_id);
		$level = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $level;
	}

	public function getUserData($username, $usertype){
		$query = Doctrine_Query::create() -> 
		select("u.*,t.*,d.*, ut.*")-> 
		from("user u")->
		leftJoin("u.Departments d") ->
		leftJoin("u.Users_types ut") ->
		innerJoin("ut.User_type t") ->
		where("u.email =?", $username) ->
		andWhere("ut.usertype_id =?", $usertype);
		$u_data = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $u_data;
	}


	public function getUser($uid){
		$query = Doctrine_Query::create() -> 
		select("*") -> 
		from("user")->
		where('id = ?', $uid );
		$userdatum = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $userdatum;
	}
	
	public function getUserType($user_id) {
		
		$query = Doctrine_Query::create()->select('*') ->from('user') ->where('id = ?', $user_id);
		$result = $query ->execute(array(), Doctrine::HYDRATE_ARRAY);
		return $result;

	}
	
	public static function getAllUser($analyst_id){
		$query = Doctrine_Query::create() -> select("*") -> from("user")
		->where('id = ?', $analyst_id);
		$level = $query -> execute();
		return $level;
		
	}
	


	public static function getDeptId($analyst_id){
		$query = Doctrine_Query::create() -> select("*") -> from("user")
		->where('id = ?', $analyst_id);
		$level = $query -> execute();
		return $level;
		
	}

	public static function getOneDirector() {
		$query = Doctrine_Query::create()
		->select("u.*, ut.*")
		->from("User u")
		->leftJoin("u.Users_types ut")
		->where('ut.usertype_id = ?', 8)
		->groupBy('ut.usertype_id');
		$analyst_s =  $query -> execute(array(), DOCTRINE::HYDRATE_ARRAY);
		return $analyst_s[0];
	}
	
	
}
