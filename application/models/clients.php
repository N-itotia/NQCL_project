<?php

class Clients extends Doctrine_Record {

	public function setTableDefinition() {
		
		$this -> hasColumn('Clientid', 'int', 11);
		$this -> hasColumn('Name', 'varchar', 50);
		$this -> hasColumn('Address', 'varchar', 25);
		$this -> hasColumn('Client_type', 'varchar', 5);
		$this -> hasColumn('Contact_person', 'varchar', 25);
		$this -> hasColumn('Contact_phone', 'int', 10);
		$this -> hasColumn('Version_id','int', 11);
		$this -> hasColumn('Alias', 'varchar', 50);
		$this -> hasColumn('Comment', 'varchar', 255);
		$this -> hasColumn('Client_status', 'int', 11);
		$this -> hasColumn('Edit_status', 'int', 11);
		$this -> hasColumn('credit', 'int', 11);
		$this -> hasColumn('email', 'varchar', 100);
		$this -> hasColumn('discount_percentage', 'int', 11);
		$this -> hasColumn('discount_status', 'int', 11);
		$this -> hasColumn('credit', 'int', 11);
		$this -> hasColumn('client_agent_id', 'int', 11);

	}

	public function setUp() {
		$this->actAs('Timestampable');
		$this -> setTableName('clients');
		
		$this -> hasMany('Request',array(
			'local' => 'Clientid',
			'foreign' => 'client_id'			
				));

		$this -> hasMany('client_billing',array(
			'local' => 'id',
			'foreign' => 'client_id'			
		));

		$this -> hasMany('quotations',array(
			'local' => 'email',
			'foreign' => 'client_email'			
		));

		$this -> hasOne('Dispatch_register',array(
			'local' => 'id',
			'foreign' => 'client_id'			
		));

		$this -> hasOne('Payments',array(
			'local' => 'id',
			'foreign' => 'client_id'			
		));

		$this -> hasMany('Quotations',array(
			'local' => 'id',
			'foreign' => 'client_number'			
		));

		$this -> hasOne('Client_agents',array(
			'local' => 'client_agent_id',
			'foreign' => 'id'			
		));

		$this -> hasMany('Client_contacts',array(
			'local' => 'id',
			'foreign' => 'client_id'			
		));

	}//end setUp

	public function getAll() {
		$query = Doctrine_Query::create() -> select("*") -> from("clients");
		$clientData = $query -> execute();
		return $clientData;
	}//end getall


	public function getDiscountPercentage($cid){
		$query = Doctrine_Query::create() 
		-> select("discount_percentage") 
		-> from("clients")
		-> where("id = ?", $cid);
		$discountData = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $discountData;
	}

	public static function getInfo($client_id){
		$query = Doctrine_Query::create()
		-> select("c.Name,c.Address,c.email,c.contact_person, c.contact_phone")
		-> from("clients c")
		-> where("c.id = ?", $client_id);
		$client_info =  $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $client_info;
	}
	
	public static function getInfoAlt($client_id){
		$query = Doctrine_Query::create()
		-> select("c.Name,c.Address,c.email,c.contact_person, c.contact_phone")
		-> from("clients c")
		-> where("clientid = ?", $client_id);
		$client_info =  $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $client_info;
	}
		


	public static function getInfoAll($client_id){		
		$query = Doctrine_Query::create()
		-> select("c.*, cc.*")
		-> from("clients c")
		-> leftJoin ("c.Client_contacts cc")
		-> where("c.id = ?", $client_id);
		$client_info =  $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $client_info;
	}

	public function getClientAgentId($clientid){
		$query = Doctrine_Query::create() 
		-> select("client_agent_id") 
		-> from("clients");
		$clientData = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $clientData;
	}

	public function getName($cid){
		$query = Doctrine_Query::create() 
		-> select("Name") 
		-> from("clients")
		-> where("id = ?", $cid);
		$clientData = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $clientData;	
	}


	public function getUid($n){
		$query = Doctrine_Query::create()
		-> select("id")
		-> from("clients")
		-> where("email = ?", $n);
		$uidata = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $uidata;
	}

	public function getClientCredit($cid){
		$query = Doctrine_Query::create() 
		-> select("credit, Contact_person, Contact_phone, Name") 
		-> from("clients")
		-> where("id = ?", $cid);
		$clientData = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $clientData;	
	}


	public function getClientIdFromUname($uname){
		$query = Doctrine_Query::create() 
		-> select("id") 
		-> from("clients")
		-> where("alias = ?", $uname);
		$clientData = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $clientData;	
	}

	public function getAllClientAccounts(){
		$query = Doctrine_Query::create() 
		-> select("c.*, dr.*") 
		-> from("clients c")
		-> leftJoin("c.Dispatch_register dr");
		$clientData = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $clientData;
	}


	public function getAllHydrated() {
		$query = Doctrine_Query::create() -> select("*") -> from("clients");
		$clientData = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $clientData;
	}

	public function getClientId($uname){
		$query = Doctrine_Query::create() 
		-> select("id") 
		-> from("clients")
		-> where("alias =?", $uname);
		$clientData = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $clientData;
	}
	
	
	    public static function getClientNew($reqid) {

		$query = Doctrine_Query::create() 
		-> select("c.*") 
		-> from("clients c, request r")
		-> where("clientid=?",$reqid);
		//where("r.id IN (select max(r.id) from request where r.request_id = '$reqid') && r.client_id = c.clientid");
		$clientData =  $query -> execute();
		return $clientData[0];
	}
 
 
  public static function getClientNewC($reqid) {

		$query = Doctrine_Query::create() 
		-> select("u.*") 
		-> from("nqcl_clients u")
		-> where("u.email=?",$reqid);
		//where("r.id IN (select max(r.id) from request where r.request_id = '$reqid') && r.client_id = c.clientid");
		$clientData =  $query -> execute();
		return $clientData[0];
	}


	public function getClient($reqid) {

		$query = Doctrine_Query::create() 
		-> select("c.*") 
		-> from("clients c, request r")
		-> where("r.request_id = '$reqid' && r.client_id = c.id");
		//where("id IN (select max(id) from request where r.request_id = '$reqid') && r.client_id = c.id");
		$clientData =  $query -> execute() -> getFirst();
		return $clientData;
	}


	public function getClientDetail($cid){
		$query = Doctrine_Query::create() 
			-> select("*") 
			-> from("clients")
			-> where("id = ?", $cid);
		$clientData =  $query -> execute() -> toArray();
		return $clientData;
	}



		public function getClient2($reqid) {

		$query = Doctrine_Query::create() 
		-> select("c.*") 
		-> from("clients c, request r")
		-> where("r.request_id = '$reqid' && r.client_id = c.id");
		//where("r.id IN (select max(r.id) from request where r.request_id = '$reqid') && r.client_id = c.clientid");
		$clientData =  $query -> execute();
		return $clientData[0];
	}


		public function getClient3($reqid) {

		$query = Doctrine_Query::create() 
		-> select("c.name as client_name, c.email, c.address, c.client_type, c.contact_person, c.Contact_phone
			ca.client_agent_name, cc.contact_name, cc.contact_phone, r.id") 
		-> from("clients c")
		-> leftJoin("c.Client_contacts cc")
		-> leftJoin("c.Client_agents ca")
		-> leftJoin("c.Request r")
		-> where("r.request_id = ?", $reqid);
		//where("r.id IN (select max(r.id) from request where r.request_id = '$reqid') && r.client_id = c.clientid");
		$clientData =  $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $clientData;
	}


	public function getNames($cl_id) {
		$query = Doctrine_Query::create() 
		-> select("*") 
		-> from("clients")
		-> where("id IN (select max(id) from clients where clientid = '$cl_id')");
		;
		$clientData = $query -> execute();
		return $clientData;
	}

	public function getLast(){
		$query = Doctrine_Query::create()
		-> select("*")
		-> from("clients");
		$lastClientData = $query -> execute() -> toArray();
		return $lastClientData;
	}
	
	public function getHistory($reqid, $version_id){
		$query = Doctrine_Query::create()
		-> select("*")
		-> from("clients , request")
		-> where("request.client_id = clients.clientid")
		-> andWhere("clients.version_id =?", $version_id)
		-> andWhere("request.request_id =?", $reqid)
		-> orderBy('id DESC');
		$lastClientData = $query -> execute() -> getLast();
		return $lastClientData;
	}


	public function getClientInfo($id){
		$query = Doctrine_Query::create()
		-> select("*")
		-> from("clients")
		-> where("id =?", $id);
		$clientdata = $query -> execute() -> toArray();
		return $clientdata;
	}

	public function getLastId(){

		$query = Doctrine_Query::create()
		-> select("max(id)")
		-> from("clients");
		$lastid = $query -> execute() -> toArray();
		return $lastid;
	}

	public function getClientDetails($ref) {
		$query = Doctrine_Query::create()
		-> select('*')
		-> from('clients')
		-> where('alias =?', $ref);
		$clientdetails = $query -> execute() -> toArray();
		return $clientdetails;
	}

}
?>