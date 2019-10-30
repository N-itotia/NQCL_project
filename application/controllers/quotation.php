<?php
class Quotation extends MY_Controller {

	function __construct() {
		parent::__construct();
	}


	public function index(){

		Quotation::generate();

	}


	public function updateTestBilling(){

		//Get id
		$data['reqid'] = $reqid = $this -> uri -> segment(3);
		


	}

	public function updateTest(){
		$test_name = $this -> input -> post('test');

		//Check if sample is multicomponent
		$this -> checkIfSampleIsMulticomponent($qid);

		//Check if test is multicomponent
		$this -> checkIfTestIsMulticomponent($qid);

	}

	public function updateCompendia(){

		//Get unique identifiers
		$qid = $this -> uri -> segment(3);
		$test_id = $this -> uri -> segment(4);

		//Get compendia
		$compendia_id = $this -> input -> post('compendia');
		
		//Update compendia
		$this -> db -> where(array('quotations_id'=> $qid, 'test_id'=>$test_id));
		$this -> db -> update('q_request_details', array('compendia_id' => $compendia_id));
	}

	public function saveQuotation(){

		//Get uri segments pass them onto data array variable
		$data['reqid'] =  $reqid = $this -> uri -> segment(3);
		$data['table'] =  $this -> uri -> segment(4);
		$data['table2'] = $this -> uri -> segment(5);
		$data['table3'] = $this -> uri -> segment(6);		
	
		//Get total from the billing table
		$total = Q_request_details::getTotal($reqid);
		
		//Get parameters necessary to retrieve quotation totals
		$qn = Quotations::getQuotationParameters($reqid);
		$qno = $qn[0]['Quotation_no'];
		$qid = $qn[0]['Quotation_id'];

		//Get number of quotation entries so far
		$current_entries = Quotations::getNoOfEntries($qno);
		$new_entries = $current_entries[0]['no_of_entries'] + 1;


		//Update individual quotation entry
		$this -> db -> trans_start(); 
		$this -> db -> where(array('quotation_id'=> $qid));
		$this -> db -> update('quotations', array('amount' => $total[0]['sum']));
		$this -> db -> trans_complete();


		//Get Overall Total
		$main_total = Quotations::getMainTotal($qno);	
		var_dump($main_total);

		$quotation_extras = Quotations_final::getQuotationExtras($qno); 
		$payable_amount = $main_total[0]['sum'] + $quotation_extras[0]['admin_fee'] + ($quotation_extras[0]['reporting_fee']/100*$main_total[0]['sum']) - ($quotation_extras[0]['discount']/100*$main_total[0]['sum']);

		//Update main quotations table
		$this -> db -> trans_start();
		$this -> db -> where(array('quotation_no'=> $qno));
		$this -> db -> update('quotations_final', array('amount' => $main_total[0]['sum'], 'payable_amount' => $payable_amount,'quotation_entries'=> $new_entries));
		$this -> db -> trans_complete();	

		//Profile
		//$this->output->enable_profiler(true);	 
	}


	public function editTestView(){

		$data['currency'] = $currency = $this -> uri -> segment(6);
		$data['test_name'] = $this -> uri -> segment(5);
		$data['test_id']  =  $test_id =  $this -> uri -> segment(4);
		$data['quotations_id'] = $qid = $this -> uri -> segment(3);


		//Get components and compendia
		$data['components'] = Quotations_components::getComponentMethods($qid, $test_id, $currency);
		$data['compendia'] = Compendia::getAll();


		$data['content_view'] = "quotation_editTest_v";
        $this->load->view('template_next', $data);
	}

	public function editCompendiaView(){

		$data['current_compendium'] =  $this -> uri -> segment(7);
		$data['currency'] = $currency = $this -> uri -> segment(6);
		$data['test_name'] = $this -> uri -> segment(5);
		$data['test_id']  =  $test_id =  $this -> uri -> segment(4);
		$data['quotations_id'] = $qid = $this -> uri -> segment(3);


		//Get components and compendia
		$data['components'] = Quotations_components::getComponentMethods($qid, $test_id, $currency);
		$data['compendia'] = Compendia::getAll();


		$data['content_view'] = "quotation_editCompendia_v";
        $this->load->view('template_next', $data);
	}

	public function quotationExtras (){

		//Get uri segments pass them onto data array variable
		$data['reqid'] = $data['rid'] = $rid = $this -> uri -> segment(3);
		$data['table'] = $this -> uri -> segment(4);
		$data['table2'] = $this -> uri -> segment(5);
		$data['table3'] = $this -> uri -> segment(6);
	
		//Get data
		$data['extras'] = Quotations_final::getQuotationExtras($rid);

		//Get Signatory
		$data['signatory'] = Quotations_final::getSignatory($rid);

		//Get Extra Billing Columns
		$sql = "SELECT COLUMN_NAME as 'column', COLUMN_COMMENT as 'comment' FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = 'enqcl' AND TABLE_NAME = 'quotations' AND COLUMN_COMMENT <> '';";	
		$query = $this->db->query($sql);
		$data['extra_columns'] = $query->result_array();

		$client = Quotations_final::getClient($rid);
		$data['client_id'] = $client_id = $client[0]['client_id'];

		//Get all client info
		$data['client_info'] = $this->getAllClientInfo($client_id);

		//Get Quotation No
		$data['quotation_no'] = $rid;

		//Get list of eligible signatories
		$data['signatories'] = User::getSignatories();

		//Get Currency
		$data['currency'] = Quotations_final::getCurrency($rid);

		//Get Multicomponent Status
		//$data['sample_mstatus'] = Quotations_components::getMulticomponentStatus($rid);
		$data['multi_tests'] = $this->getMulticTests();

		//Get quotation summary
		$data['quotation_summary']= Quotations::getQuotationSummary($rid);

		//Get Total of this Quotation
		$data['quotation_total'] = Quotations::getTotalPerClient($client_id, $rid);

		//Get All Notes
		$data['quotation_notes'] = Quotation_notes::getAllQuotationNotes($rid);		

		//Set view
		$data['content_view'] = "quotation_extras";
        $this->load->view('template1', $data);
	}
	

	public function invoiceExtras (){

		//Get uri segments pass them onto data array variable
		$data['reqid'] = $this -> uri -> segment(3);
		$data['table'] = $this -> uri -> segment(4);
		$data['table2'] = $this -> uri -> segment(5);
		$data['table3'] = $this -> uri -> segment(6);
	
		//Set view
		$data['content_view'] = "invoice_extras";
	}

	public function add_reference(){
		$data['reqid'] = $reqid = $this->uri->segment(3);
		$rid = Quotations::getQuotationNumber2($reqid);
		$data['quotation_no'] = $rid[0]['Quotation_no'];
		$data['quotation_summary']= Quotations::getQuotationSummary($rid[0]['Quotation_no']);
		$data['currency'] = Quotations_final::getCurrency($rid[0]['Quotation_no']);
		$data['content_view'] = "add_ndq_ref_v";
		$this->load->view('template1', $data);
 	}

 	public function save_reference(){
 		$reqid = $this->uri->segment(3);
 		
 		//Get NDQ Reference
 		$ndq_ref = $this->uri->segment(4);

 		//Update NDQ Reference
 		$this -> db -> where('Quotations_id', $reqid);
		$this -> db -> update('quotations', array('ndq_ref'=>$ndq_ref));
 	}

 	public function editMethodView(){

 		//Get Method ID, Test Id, Quotations Id 
 		$method_id = $data['method_id'] = $this->uri->segment(3);
 		$test_id = $data['test_id'] = $this->uri->segment(4);
 		$data['quotations_id'] = $this->uri->segment(5);
 		$data['component_id'] = $this->uri->segment(6);
 		$data['component_name'] = $this->uri->segment(7);

 		//Get Test Name
 		$data['test_name'] = Tests::getTestNameSimple($test_id);

 		//Get quotation details
 		$quotation_details = Quotations::getQuotationParameters($data['quotations_id']);
		$data['no_of_batches'] = $quotation_details[0]['No_of_batches'];
		$data['quotation_id'] = $quotation_details[0]['Quotation_id'];
		$data['quotation_no'] = $quotation_details[0]['Quotation_no'];
		$data['currency'] = $quotation_details[0]['Currency'];

 		//Get Method Data
 		$data['method_data'] = Test_methods::getMethodsHydrated($test_id);

 		//Pass data to view
 		$data['content_view'] = "editMethod_v";
 		$this->load->view('template_next', $data);
 	}

 	public function testsSearch(){

 		//Get term
 		$term = $this-> input -> post('term', TRUE);

 		//Send to search function
 		$this->testSuggestions($term);
 	}

 	public function editMethod(){

 		//Get POST value
 		$method = $this -> input -> post('method');
 	
 		//Get update parameters
 		$method_id = $data['method_id'] = $this->uri->segment(3);
 		$test_id = $data['test_id'] = $this->uri->segment(4);
 		$data['quotations_id'] = $quotations_id = $this->uri->segment(5);
 		$data['component_id'] = $component_id = $this->uri->segment(6);
 		$data['component_name'] = $this->uri->segment(7);
 		$data['batch_status'] = $batch_status = $this->uri->segment(11);
 		$currency = $this->uri->segment(12);
 		$data['quotation_no'] = $quotation_no = $this->uri->segment(10);
 		$data['quotation_id'] = $quotation_id = $this->uri->segment(8);

 		//Batch,Individual Evaluation
 		if($batch_status == 1){
 			$ref = 'quotation_id';
 			$qid = $quotation_id;
 		}
 		else{
 			$ref = 'quotations_id';
 			$qid = $quotations_id;
 		}

 		//Check what batch status is returned, returns correct batch status
 		var_dump($batch_status);


 		$this->db->trans_start();

 		//Get Method Charge
 		$method_details = Test_methods::getMethodDetails($method);
 		$method_charge = $method_details[0]['charge_'.strtolower($currency)];

 		//Update Quotation Components
 		$qc_where_array = array($ref => $qid, 'test_id'=>$test_id);
 		$qc_update_array = array('method_id'=>$method, 'method_charge'=> $method_charge);
 		$this -> db -> where($qc_where_array);
		$this -> db -> update('quotations_components', $qc_update_array);

		$this->db->trans_complete();

		$this->db->trans_start();	
		//Get new component total
		$tmc = Quotations_components::getComponentsTotalAlt($ref,$quotations_id,$test_id);
		$total_methodCharge = $tmc[0]['component_total'];
		var_dump($total_methodCharge);

		//Update Q Request Details with component total
		$qr_where_array =  array($ref => $qid, 'test_id' => $test_id);
		$qr_update_array =  array('method_charge' => $total_methodCharge);

		$this -> db -> where($qr_where_array);
		$this -> db -> update('q_request_details', $qr_update_array);

		//$this -> output -> enable_profiler(true);

		$this->db->trans_complete();


		//Check db transactions
		$this -> output -> enable_profiler(true);



		//Get total for this batch only.
		$b_total = Q_request_details::getBatchTotal($quotations_id);
		$batch_total = $b_total[0]['sum'];
		
				//Update quotations final
		$qb_where_array = array($ref => $qid);
		$qb_update_array = array('amount'=>$batch_total);
		$this -> db -> where($qb_where_array);
		$this -> db -> update('quotations', $qb_update_array);


		//Get new total
		$main_total = Q_request_details::getTotal($quotation_id);
		$total = $main_total[0]['sum'];
		var_dump($main_total);		

		$quotation_extras = Quotations_final::getQuotationExtras($quotation_no); 
		$payable_amount = $total + $quotation_extras[0]['admin_fee'] + ($quotation_extras[0]['reporting_fee']/100*$total) - ($quotation_extras[0]['discount']/100*$total);


		//Update quotations final
		$qf_where_array = array('quotation_no' => $quotation_no);
		$qf_update_array = array('amount'=>$total, 'payable_amount'=>$payable_amount);
		$this -> db -> where($qf_where_array);
		$this -> db -> update('quotations_final', $qf_update_array);


 	}

	public function listall(){
		$data['title'] = "List of all Quotations";
		$data['content_view'] = "settings_v";
        $data['banner_text'] = "NQCL Settings";
        $data['link'] = "settings_management";
		$data['settings_view'] = "list_quotation_v";
        $this->load->view('template_next', $data);
	}

	public function invoices(){
		$data['title'] = "List of all Invoices";
		$data['content_view'] = "settings_v";
        $data['banner_text'] = "NQCL Settings";
        $data['link'] = "settings_management";
		$data['settings_view'] = "list_invoices_v";
        $this->load->view('template_next', $data);
	}


	public function getInvoices(){		
		$quotations = Quotations::getInvoices();
        if (!empty($quotations)) {
            foreach ($quotations as $q) {
                $data[] = $q;
            }
            echo json_encode($data);
        } else {
            echo "[]";
        }
	}

	
	public function getlist(){
		$quotations = Quotations::getAllConsolidated();
        if (!empty($quotations)) {
            foreach ($quotations as $q) {
                $data[] = $q;
            }
            echo json_encode($data);
        } else {
            echo "[]";
        }
	}
	
	public function getChildEntries(){
		$quotation_no = $this->uri->segment(3);		
		$quotations = Quotations::getChildEntries($quotation_no);
        if (!empty($quotations)) {
            foreach ($quotations as $q) {
                $data[] = $q;
            }
            echo json_encode($data);
        } else {
            echo "[]";
        }
	}
	
	public function listAllChildren(){
		$data['quotation_no'] = $this->uri->segment(3);
		$c = Quotations_final::getCurrency($data['quotation_no']);	
		$data['currency'] = $c[0]['currency'];
		$data['content_view'] = "list_quotation_child_v";
        $this->load->view('template_next', $data);
	}

	public function listAllComponentMethods(){
		$data['quotation_id'] = $rid= $this->uri->segment(3);
		$data['test_id']= $test_id = $this->uri->segment(4);
		$data['table'] = $this->uri->segment(5);
		$data['currency'] = $currency = $this->uri->segment(6);
		$data['content_view'] = "list_componentMethods__v";
        $this->load->view('template_next', $data);
	}

	public function updateSystem(){
		//Get request_id
		$reqid = $this -> uri -> segment(3);
		$table = $this -> uri -> segment(4);


		//Condition gets variables
			if($table == 'request'){
				$id = 'request_id';
				$billing_table = 'client_billing';
				$register = 'dispatch_register';
				$main_table = 'request';
				$components_table = $main_table."_components";
				$ref = $main_table.'_id';
			}
			else if($table == 'quotations'){
				$id = 'quotations_id';
				$billing_table = 'q_request_details';
				$register = 'quotations';
				$main_table = $register;
				$components_table = $main_table."_components";
				$ref = $register.'_id';
			}
			else if($table == 'invoice'){
				$id = 'request_id';
				$billing_table = 'invoice_billing';
				$register = 'dispatch_register';
				$main_table = 'request';
				$components_table = $table."_components";
				$ref = $id;
			}

		//Generate post input variable names dynamically
		$mcTests = Tests::getMcTests2();
		$testsChecked = array();
		$tests_table = ucfirst($billing_table);
		$tests = $tests_table::getTests2($reqid);
		foreach ($tests as $test) {
			$testsChecked[] = $test['test_id'];	
		}
		
		var_dump($testsChecked);
		
		//Get currency
		$c = Quotations::getCurrency($reqid);
		$currency = $c[0]['Currency'];
	
		
		//Capitalize components table variable, make as class
		$components_table_class = ucfirst($components_table);

		//Get components method
		$components_method = 'get'.$components_table_class;


		$components = $components_table_class::$components_method($reqid, $ref);
		$components_no = count($components);

		
		//No. of Dissolution stages
		$no_of_stages = $this -> input -> post('no_of_stages');
		
		
		foreach ($mcTests as $mc){
		if(in_array($mc["id"],$testsChecked)){
			var_dump($mc["Name"]);
		$post_name = $mc["Name"].'_sys';	
		$base_charge_name = 'base_charge_'.$mc["Name"];
		$testName = $mc["Name"];
		$testId = $mc["id"];
			
		//Get post inputs
		$post_name = $this -> input -> post('system_'.$testId);
		//$dissolution_sys = $this -> input -> post('system_2');
	

		//Get Base Charge of Test
		$base_charge_name = $components_table_class::getBaseCharge($testId, $reqid);

		
		//Update Assay
		if($post_name != 0){
		
		//Get Extra Charge for Assay
		$xcharge = Additional_components_charges::getExtraCharge($post_name, $currency);
		$extra_charge = $xcharge[0]['charge_'.strtolower($currency)];

		if($post_name != 5){
			
			//Update Assay System
			$cb_where_array = array($ref => $reqid, 'test_id' => $testId);
			$cb_update_array = array('charge_system' => $post_name);
		
		}
		
		else {
			
			$cb_where_array = array($ref => $reqid, 'test_id' => $testId);
			$cb_update_array = array('charge_system' => $post_name, 'stages' => $no_of_stages);
		
		}
		//$extra_charge_assay 
		
		//Update quotation_components for Assay
		$this -> db -> where($cb_where_array);
		$this -> db -> update($billing_table, $cb_update_array);

		if($post_name == 1){
			$test_charge = $base_charge_name['method_charge']  + ($extra_charge * ($components_no - 1));
		}
		else if($post_name == 2){
			$test_charge = $base_charge_name['method_charge'] * $components_no;
		}


		//Update Client Billing Table
		$cb_update_array2 = array('test_charge' => $test_charge);

		$this -> db -> where($cb_where_array);
		$this -> db -> update($billing_table, $cb_update_array2);

	 	$testId2 = $base_charge_name['id'] + 1;

		$rc_where_array = array('id' => $testId2);
		$rc_update_array = array('method_charge' => $extra_charge);

		$this -> db -> where($rc_where_array);
		$this -> db -> update($components_table, $rc_update_array);

		//var_dump($base_charge_assay);

		}}
		
		}

		//Get existing amount from the register table
		$amount = $billing_table::getTotal($reqid);
		$total = $amount[0]['sum'];
		
		//Discoun and total amount
		$discounted_amount = $total;
		$discount = 0;

		//Update Dispatch register
		$quotation_status = 1;
			
			if($table != 'invoice'){
				$dr_update_array = array('amount' => $discounted_amount, 'discount' => $discount, 'quotation_status' => $quotation_status);
			}
			else{
				$dr_update_array = array('invoiced_amount'=> $discounted_amount);
			}

		$this -> db -> where(array($ref => $reqid));
		$this -> db -> update($register, $dr_update_array);

		//Update Main Table
		$main_update_array = array('quotation_status' => $quotation_status);
		$this -> db -> where($ref, $reqid);
		$this -> db -> update($main_table, $main_update_array);

		if($table == 'invoice'){
			$system_status = 1;
			$sample_issuance_update = array('system_status' => $system_status);
			$sample_issuance_where = array('Lab_ref_no' => $reqid);
			
			//Sample Issuance System Select Status
			$this -> db -> where($sample_issuance_where);
			$this -> db -> update('sample_issuance', $sample_issuance_update);

		}
		
			
			
			/*
			$entries = Quotations::getNoOfEntries($qn[0]['Quotation_no']);
			$no_of_entries_done = $entries[0]['Quotation_entries_done'];
			var_dump($no_of_entries_done);
			*/
			
			//Get no. of entries
			$qn = Quotations::getQuotationNumber2($reqid);
			$completion_status = 1;
			
			//Update no. of entries done
			$entries_update_array = array('Completion_status' => $completion_status);
			$this -> db -> where('quotation_no', $qn[0]['Quotation_no']);
			$this -> db -> update('Quotations', $entries_update_array);
			

	}

	public function chooseSystem(){

		//Get unique id
		$data['reqid'] = $this -> uri -> segment(3);

		//Get tables from uri segments
		$data['table'] = $this -> uri -> segment(4);
		$data['table2'] = $this -> uri -> segment(5);
		$data['table3'] = $this -> uri -> segment(6);

		//Get Client_id
		$data['client_id'] = $this -> uri -> segment(7);

		//Capitalize class name
		$tests_table = ucfirst($data['table3']);
		
		$mc_tests = Tests::getMcTests2();
		$data['multi_tests'] = $mc_tests;
		$data['tests_checked'] = array();
		$tests = $tests_table::getTests2($data['reqid']);
		foreach ($tests as $test) {
			$data['tests_checked'][] = $test['test_id'];	
		}
		$data['content_view'] = 'system_select_v';
		$this -> load -> view('template1', $data);
	}


	public function stateComponents(){

			//get table names from uri segments 
		    $data['table'] = $this -> uri -> segment(4);
		    $data['table2'] = $this -> uri -> segment(5);
		   	$data['table3']= $this -> uri -> segment(6);
		    
		   	//Get unique identifier
		    $data['reqid'] = $this -> uri -> segment(3);  

		    //Get client id
		    $data['client_id'] = $this -> uri -> segment(7);


		   	if($data['table'] == "request"){
		   		//Get requisite proforma info
		    	$proforma_info = Request::getProformaNo($data['reqid']);

		   		//Get Date Received
		   		$date_received = $proforma_info[0]['Designation_date'];
		    	
		    	//Get number of distinct existing proformas for this client and date
		   		$no_of_proformas = Request::getProformaCountPerClient($data['client_id'], $date_received);

		   		if(!empty($no_of_proformas)){
		   			$data['proforma_no'] = $no_of_proformas[0]['count'];
		   		}
		   		else{
		   			$data['proforma_no'] = 0;
		   		}
				
				//Get proforma no.
				
		   		
		   		//Get Client Agent
		    	$c_a_i = Clients::getClientAgentId($data['client_id']);
            	$client_agent_id = $c_a_i[0]['client_agent_id'];

            	$data['proforma_nos'] = Request::getProformaInfo($data['client_id'], $date_received);

		    }
		    else{
		    	
		    	$quotation_details = Quotations::getQuotationParameters($data['reqid']);

		    	$data['no_of_batches'] = $quotation_details[0]['No_of_batches'];

		    	if(empty($data['client_id'])){
		    		$data['client_id'] = $quotation_details[0]['Client_number']; 
		    	}

		    	//Set quotation id to a variable
		    	$data['quotation_id'] = $quotation_details[0]['Quotation_id'];

		    	//var_dump($quotation_details);
		    }
		    
			//pass data to view
			$data['content_view'] = 'quotation_state_components_v';
			$this -> load -> view('template1', $data);
	}
	
			public function getMulticTests(){
			//Get tests that for multicomponent , can take different methods for each component
			$mc_tests = Tests::getMcTests();
			
			//Simplify multidimensional array
			$mct = array();
			foreach($mc_tests as $mc){
				array_push($mct, $mc['id']);
			}
			
			//Return simplified array
			return $mct;	
		}


	public function setComponents(){

		//Get unique request id from last segment of uri
		$reqid = $this -> uri -> segment(3);

		//Get tables from last segment of uri
		$table = $this -> uri -> segment(4);
		$table2 = $this -> uri -> segment(5);
		$table3 = $this -> uri -> segment(6);

		//Get client id
		$data['client_id'] = $this -> uri -> segment(7);

		//Hold array of component inputs in array variable (input name was set as an array in the view)
		$components = $this -> input -> post("component");

		//Get multicomponent status
		$component_status = $this -> input -> post("multicomponent");


		//Condition determines if table is request
		if($table == "request"){

			//Get Proforma No from the Proforma No. Select
			$p_no = $this -> input -> post("proforma_no");

			//Get Date Received
			$data['proforma_no'] = $proforma_info = Request::getProformaNo($reqid);
		   	$date_received = $proforma_info[0]['Designation_date'];

			//Get proforma No from function that checks if p_no is empty/not
			$proforma_no = $this -> getProformaNo($p_no, $data['client_id'], $date_received);

			//Update Proforma No in Request Table
			$proforma_update_array = array('proforma_no' => $proforma_no, 'proforma_no_status' => 1);
			$proforma_update_where_array = array('request_id' => $reqid);

			//Update Proforma
			$this -> db -> where($proforma_update_where_array);
			$this -> db -> update('request',$proforma_update_array);

			//Update Client Billing Table with new Proforma Number		
			$proforma_update_array_cb = array('proforma_no' => $proforma_no);
			$proforma_update_where_array_cb = array('request_id' => $reqid);

			//Update Proforma
			$this -> db -> where($proforma_update_where_array_cb);
			$this -> db -> update('client_billing',$proforma_update_array_cb);

			$no_of_batches = 0;

		}
		else{
			$no_of_batches = $this->uri->segment(8);
		}

		//Get tests affected by multicomponent quality of sample
		//Condition so that if single, not to enter multiple components
		if($component_status == 1){
			$multi_tests = $this->getMulticTests();
		}
		else if($component_status == 0){
			$multi_tests = array(0);
		}

		//Construct table names and unique column names with variables
		$components_table = ucfirst($table)."_components";
		$id = $table."_id";

		if($table == 'quotations'){
			for($b=1; $b<=$no_of_batches;$b++){
				//Loop through array of components, saving each to own row in quotations_components table
				for($j=0; $j < count($multi_tests); $j++){
					for ($i=0; $i < count($components); $i++) {
					  	$component = new $components_table();
			            $component->component = $components[$i];
			            $component->test_id = $multi_tests[$j];
			            $component->$id = substr($reqid,0,-2)."-".$b;
			            $component->quotation_id = $reqid;
			            $component->save();	
					}
				}
			}
		}
		else{
				for($j=0; $j < count($multi_tests); $j++){
					for ($i=0; $i < count($components); $i++) {
					  	$component = new $components_table();
			            $component->component = $components[$i];
			            $component->test_id = $multi_tests[$j];
			            $component->$id = $reqid;
			            $component->save();	
					}
				}
		}
	}

	public function getProformaNo($p_no, $c, $d){

			//Condition checks whether proforma_no has been selected in generate quotation view
			if(!empty($p_no) && $p_no != 'New'){
				$proforma_no = $p_no;
			}
			else if(empty($p_no) || $p_no == 'New'){

				//Get No. of Quotations
				$no_of_proformas = Request::getProformaCountPerClient($c, $d);

				//Get Month and Year from date received
				$yr = date('y', strtotime($d));
				$m = date('m', strtotime($d));
				$d = date('d', strtotime($d));

				//Concatenate gotten year and month to generate year-month part of proforma no.
				$date_r = $yr."-".$m."-".$d;

				if(!empty($no_of_proformas)){
					//Increment no. of quotations by 1
					$proforma_serial = $no_of_proformas[0]["count"] + 1;

					//Pad quotation no with two leading zeros
					$serial = sprintf('%02s', $proforma_serial);

					//Generate quotation number
					$proforma_no = 'NDQ-'.$c."-".$date_r."-P".$serial;
				}
				else{
					$proforma_no = 'NDQ-'.$c."-".$date_r."-P"."01";
				}


			}

			return $proforma_no;
	}

	public function save() {


		if (is_null($_POST)) {
            echo json_encode(array(
            'status' => 'error',
            'message'=> 'Data was not posted.'
            ));
            }
        else
            {
            echo json_encode(array(
                'status' => 'success',
                'message'=> 'Data added successfully',
                'array' => json_encode($_POST)
            ));
            }
		
		$newstatus = $this->uri->segment(3);
		
		
		//Variable inputs unique to each entry
		$no_of_batches = $this -> input -> post("no_of_batches");
		$sample_name = $this -> input -> post("sample_name");
		$test =$this -> input -> post("test");
		
		//If new quotation, variables global to the consolidated quotation
		$currency = $this -> input -> post("currency");
		$currency_small = strtolower($currency);

		$email = $this -> input -> post("client_email");
		$client_number = $this -> input -> post("client_id");
		$client_name = $this -> input -> post("client_name");
		//$active_ingredients = $this -> input -> post("active_ing");
		$dosage_form = $this -> input -> post("dosage_form");
		$quotation_date = $this -> input -> post("quotation_date");
		$q_no = $this -> input -> post("quotation_no");
		
		//Get Quotation Id
		$quotation_id = $this -> getQuotationId();

		//Get client number
		$client_no = $this -> getClientNumber($client_number, $q_no);

		//Get Quotation Number
		
		$quotation_no = $this -> getQuotationNo($client_no, $q_no);	
		//var_dump($client_no);


		//Save each batch individually
		for($b=1;$b<=$no_of_batches;$b++){

		

		//Save Quotation
		$quotation = new Quotations();
		$quotation -> Dosage_form = $dosage_form;
		$quotation -> client_email = $email;
		//$quotation -> Active_ingredients = $active_ingredients;
		$quotation -> Sample_name = $sample_name;
		$quotation -> Client_name = $client_name;
		$quotation -> Quotation_date = date('y-m-d');
		$quotation -> No_of_batches = $no_of_batches;
		$quotation -> Client_number = $client_no;
		$quotation -> Quotation_id = $quotation_id;
		$quotation -> Quotations_id = $quotation_id.'-'.$b;
		$quotation -> Quotation_no = $quotation_no;
		$quotation -> Batch_id = $b;
		$quotation -> Currency = $currency;
		$quotation -> save();

		//Add default component to components table

	
				for($i=0;$i<count($test);$i++){
					$request = new Q_request_details();
					$request -> test_id = $test[$i];
					$request -> client_number = $client_number;
					$request -> client_email = $email;
					$request -> quotation_id = $quotation_id;
					$request -> quotations_id = $quotation_id.'-'.$b;
					$request -> save();
					//var_dump($test_charges[0]['Charge']);
				
				//Add default component to components table
				//Get default Test Method, assume first method is default
					$method_details = Test_methods::getMethodsDefault($test[$i]);
					//var_dump($method_details[0]['id']);


					//Add to quotations components table
					$qc = new Quotations_components();
					$qc->component = $sample_name;
					$qc->quotations_id = $quotation_id.'-'.$b;
					$qc->quotation_id = $quotation_id;
					$qc->test_id = $test[$i];
					$qc->method_id = $method_details[0]['id'];
					$qc->method_charge = $method_details[0]['charge_'.$currency_small];
					$qc->save();

					//Update test total with default method charges
					$tmc = Quotations_components::getComponentsTotal($quotation_id.'-'.$b, $test[$i]);
					$total_methodCharge = $tmc[0]['component_total'];
						//var_dump($total_methodCharge);

					//Update Q Request Details with component total
					$qr_where_array =  array('quotations_id' =>$quotation_id.'-'.$b, 'test_id' => $test[$i]);
					$qr_update_array =  array('method_charge' => $total_methodCharge);

					$this -> db -> where($qr_where_array);
					$this -> db -> update('q_request_details', $qr_update_array);

				}

			}

		if($this->checkIfThisQuotationAlreadyPrinted($quotation_no) == false){
			//Save to main quotation table
			$q_f = new Quotations_final();
			$q_f -> quotation_entries = 1;
			$q_f -> quotation_no = $quotation_no;
			$q_f -> client_id = $client_no;
			$q_f -> currency = $currency;
			$q_f -> save();
		}


		//Initialize row at Quotation NOtes
		$q_n = new Quotation_notes();
		$q_n -> quotation_no = $quotation_no;
		$q_n -> save();

		}

		//Backgenerate invoice from quotation
		public function generateQuotation (){

			//Get drafting user details
			$user_id = $this->session->userdata('user_id'); 
			$user_type_id = $this->session->userdata('usertype_id'); 

			//Get ndq no., client no.
			$ndqno = $this->uri->segment(3);
			$client_no = $this->uri->segment(4);

			//Default No. of Batches
			$no_of_batches = 1;

			//Get client details
			$client_details = Clients::getClientInfo($client_no);
			//var_dump($client_details);

			//Get tests
			$tests = Request_details::getTests($ndqno);
			$request_details = Request::getQuotationData($ndqno);
			
			//Get currency from db, if NULL default to KES
			if($request_details[0]['Dispatch_register']['currency'] != NULL ){
				$cur = $request_details[0]['Dispatch_register']['currency'];
			}else{
				$cur = 'KES';
			}

			//Make Currency Small 
			$currency_small = strtolower($cur);

			//Get quotation number
			$q_no = $this -> input -> post("quotation_no");
		
			//Get Quotation Id
			$quotation_id = $this -> getQuotationId();

			//Get Quotation Number
			$quotation_no = 'INV-'.$ndqno;	


			//Add to quotations final
			$q_f = new Quotations_final();
			$q_f -> quotation_entries = 1;
			$q_f -> quotation_no = $quotation_no;
			$q_f -> client_id = $client_no;
			$q_f -> currency = $cur;
			$q_f -> save();

			//Initialize row at Quotation Notes
			$q_n = new Quotation_notes();
			$q_n -> quotation_no = $quotation_no;
			$q_n -> save();


			//Loop through no. of batches
			for($b=1;$b<=$no_of_batches;$b++){

						//Set quotations_id
						$quotations_id = $quotation_no.'-'.$b;

						//Save Quotation
						$quotation = new Quotations();
						$quotation -> Dosage_form = $request_details[0]['Dosage_Form'];
						$quotation -> client_email = $client_details[0]['email'];
						$quotation -> Sample_name = $request_details[0]['product_name'];
						$quotation -> Client_name = $client_details[0]['Name'];
						$quotation -> Quotation_date = date('y-m-d');
						$quotation -> No_of_batches = $no_of_batches;
						$quotation -> Client_number = $client_no;
						$quotation -> Quotation_id = $quotation_id;
						$quotation -> Quotations_id = $quotation_no.'-'.$b;
						$quotation -> Quotation_no = $quotation_no;
						$quotation -> Quotation_status = 1;
						$quotation -> ndq_ref = $ndqno;
						$quotation -> Batch_id = $b;
						$quotation -> Currency = $cur;
						$quotation -> save();

				//Loop through tests and save to quotations tests table
				foreach ($tests as $key => $value) {

						//Save tests to quotation request details
						$q_r = new Q_request_details();
						$q_r -> test_id = $value['test_id'];
						$q_r -> client_number = $client_no;
						$q_r -> client_email = '';
						$q_r -> quotation_id = $quotation_id;
						$q_r -> quotations_id = $quotation_no.'-'.$b;
						$q_r -> save();

						//Get default method for components
						$method_details = Test_methods::getMethodsDefault($value['test_id']);
						var_dump($method_details[0]['id']);

						//Add to quotations components table
						$qc = new Quotations_components();
						$qc->component = $request_details[0]['product_name'];
						$qc->quotations_id = $quotation_no.'-'.$b;
						$qc->test_id = $value['test_id'];
						$qc->method_id = $method_details[0]['id'];
						$qc->method_charge = $method_details[0]['charge_'.$currency_small];
						$qc->save();

						//Update test total with default method charges
						$tmc = Quotations_components::getComponentsTotal($quotation_no.'-'.$b, $value['test_id']);
						$total_methodCharge = $tmc[0]['component_total'];
						//var_dump($total_methodCharge);

						//Update Q Request Details with component total
						$qr_where_array =  array('quotations_id' =>$quotation_no.'-'.$b, 'test_id' => $value['test_id']);
						$qr_update_array =  array('method_charge' => $total_methodCharge);

						$this -> db -> where($qr_where_array);
						$this -> db -> update('q_request_details', $qr_update_array);
				
				}


						//Get total for this batch only.
						$b_total = Q_request_details::getBatchTotal($quotations_id);
						$batch_total = $b_total[0]['sum'];
		
						//Update quotations final
						$qb_where_array = array('quotations_id' => $quotations_id);
						$qb_update_array = array('amount'=>$batch_total);
						$this -> db -> where($qb_where_array);
						$this -> db -> update('quotations', $qb_update_array);


						//Get new total
						$main_total = Q_request_details::getTotal($quotation_id);
						$total = $main_total[0]['sum'];
						//var_dump($main_total);		

						$quotation_extras = Quotations_final::getQuotationExtras($quotation_no); 
						$payable_amount = $total + $quotation_extras[0]['admin_fee'] + ($quotation_extras[0]['reporting_fee']/100*$total) - ($quotation_extras[0]['discount']/100*$total);

						//Update quotations final
						$qf_where_array = array('quotation_no' => $quotation_no);
						$qf_update_array = array('amount'=>$total, 'payable_amount'=>$payable_amount);
						$this -> db -> where($qf_where_array);
						$this -> db -> update('quotations_final', $qf_update_array);


						//Update request table invoice status
						$rq_where_array =  array('request_id'=>$ndqno);
						$rq_update_array = array('invoice_status'=> 1);
						$this -> db -> where($rq_where_array);
						$this -> db -> update('request', $rq_update_array);

			}


			//Add draft stage to invoice tracking table
			$inv_t = new Invoice_tracking();
			$inv_t->invoice_no = $quotation_no;
			$inv_t->stage = 'Drafting';
			$inv_t->user_id = $user_id;
			$inv_t->user_type_id = $user_type_id;
			$inv_t->discount = 0;
			$inv_t->amount = $total;
			$inv_t->payable_amount = $payable_amount;
			$inv_t->date = date('Y-m-d H:i:s');
			$inv_t->save();

		}


		public function addTestView(){


			//Get uris
			$data['currency'] = $currency = $this -> uri -> segment(4);
			$data['quotations_id'] = $qid = $this -> uri -> segment(3);

			//Get components
			$data['components'] = Quotations_components::getQuotations_components($qid, 'quotations_id');

			//Pass to view
			$data['content_view'] = "quotation_addTest_v";
	        $this->load->view('template_next', $data);

		}



		public function addComponentView(){


			//Get uris
			$data['currency'] = $currency = $this -> uri -> segment(4);
			$data['quotations_id'] = $qid = $this -> uri -> segment(3);

			//Get components
			$data['components'] = Quotations_components::getQuotations_components($qid, 'quotations_id');

			//Get Tests
			$data['tests'] = Q_request_details::getChargesPerClient($qid);

			//Pass to view
			$data['content_view'] = "quotation_addComponent_v";
	        $this->load->view('template_next', $data);

		}

		public function addComponent(){

			//Get inputs
			$components = $this->input->post('components');
			$quotations_id = $this->uri->segment(3);
			$currency =  $this->uri->segment(4);
			$currency_small = strtolower($currency);
			
			//Loop through components table, form tests input names, put in array
			foreach($components as $key => $value){

				//Replace spaces in component name with underscores
				$component = str_replace(" ", "_", $value);

				//Get tests for each component
				$tests = $this->input->post($component.'_tests');

				foreach($tests as $test){

					//Get default Test Method, assume first method is default
					$method_details = Test_methods::getMethodsDefault($test);
					var_dump($method_details[0]['id']);

					//Add to quotations components table
					$qc = new Quotations_components();
					$qc->component = $value;
					$qc->quotations_id = $quotations_id;
					$qc->test_id = $test;
					$qc->method_id = $method_details[0]['id'];
					$qc->method_charge = $method_details[0]['charge_'.$currency_small];
					$qc->save();
				}
			}	

		}


		public function removeComponent(){
			
			//Get parameters
			$quotations_id =  $this -> uri -> segment(3);
			$component_id =  $this-> uri -> segment(4);
			$component_name = $this -> uri -> segment(5);



			//Get total charge for this component
			$c_total = Quotations_components::getComponentTotal($quotations_id, $component_name);
			$component_total = $c_total[0]['component_total'];

			//Substract this component total from test total if 
			if($component_total != 0){
				echo '';
			}

		
			//Remove component from db0
			/*$this->db->delete('quotations_components', array('quotations_id'=>$quotations_id, 'component'=>$component_name));*/


			//Update totals


		}

		public function addTest(){

			//Get inputs, parameter
			$test_name = $this->input->post('test');
			$quotations_id = $this->uri->segment(3);

			//Get test id from test name
			$test= Tests::getTestIdFromName($test_name);
			$test_id = $test[0]['id'];

			//Initialize array to hold method charges
			$method_charges =  array();

			//Get components
			$components = Quotations_components::getQuotations_components($quotations_id, 'quotations_id');

			//Loop through components while saving tests?
			foreach($components as $component){

				//Check component
				$component_name = $component['component'];

				//Get Method
				$method = $this->input->post($component_name.$test_name);
				
				//Get Method Charge
				$method_charge =  $this->input->post($component_name.$test_name."_charge");

				//Save quotations components
				if($method!=null){

					//Add to Quotation Components Table
					$qco =  new Quotations_components();
					$qco->component = $component_name;
					$qco->quotations_id = $quotations_id;
					$qco->test_id = $test_id;
					$qco->method_id = $method;
					$qco->method_charge = $method_charge;
					$qco->save();

					//Put charges into array
					array_push($method_charges, $method_charge);
				}

			}

			//Save new test
			$qr = new Q_request_details();
			$qr->quotations_id = $quotations_id;
			$qr->test_id = $test_id;
			$qr->method_charge = array_sum($method_charges);
			$qr->save();

		}

		//Approve Invoice at Reviewer level
		public function approveInvoice(){

			//Get approving user details
			$user_id = $this->session->userdata('user_id'); 
			$user_type_id = $this->session->userdata('usertype_id'); 

			//Get discount
			$invoice_discount = $this->input->post('invoice_discount');

			//Get identifier
			$request_id =  $this->uri->segment(3);
			$inv_id = $this->uri->segment(4);

			//Extract Invoice Id
			$invoice_id = substr($inv_id, 0, -2);

			//Update request table
			$this->db->where('request_id', $request_id);
			$this->db->update('request', array('invoice_status'=>2));

			//Update Invoice
			$this->db->where('request_id', $request_id);
			$this->db->update('request', array('invoice_status'=>2));	

			//Get amount
			$q_amount = Quotations_final::getAmount($invoice_id);
			$amount = $q_amount[0]['amount'];
			$payable_amount = (100-$invoice_discount)/100*$amount;

			//Update Discount
			$this->db->where('quotation_no', $invoice_id);
			$this->db->update('quotations_final', array('discount'=>$invoice_discount, 'payable_amount'=>$payable_amount));

			//Update Tracking
			$inv_track = new Invoice_tracking();
			$inv_track -> invoice_no = $invoice_id;
			$inv_track -> stage = 'Reviewer Approval';
			$inv_track -> user_id = $user_id;
			$inv_track -> user_type_id = $user_type_id;
			$inv_track -> discount = $invoice_discount;
			$inv_track -> amount = $amount;
			$inv_track -> payable_amount = $payable_amount;
			$inv_track -> date = date('Y-m-d H:i:s');
			$inv_track -> save();
		}


		public function getInvoiceTracking(){

			//Get approving user details
			$user_id = $this->session->userdata('user_id'); 
			$user_type_id = $this->session->userdata('usertype_id'); 

			//Get invoice no
			$inv_id = $this->uri->segment(3);
			$invoice_id = substr($inv_id, 0, -2); 

			//Get invoice tracking data
			$inv_track_data = Invoice_tracking::getTrackingByInvoice($invoice_id);

			if (!empty($inv_track_data)) {
	            foreach ($inv_track_data as $i) {
	                $data[] = $i;
	            }
            echo json_encode($data);
	        } else {
	            echo "[]";
	        }
		}


		public function checkMultiStatus(){
			$tname = $this -> uri -> segment(3);
			$this->getMulticStatus($tname);
		}

		public function getMethods(){
			
			//Get uri segment, decode to remove spaces, send to CORE method to  get methods
			$tname = $this -> uri-> segment(3);
			$testname = urldecode($tname);

			//Get currency
			$currency = $this -> uri -> segment(4);

			//Get methods
			$this-> getMethodsForTest($testname, $currency);
			
		}



		public function copyPasteAddEntry($q,$s,$b){
			
			for($i=0;$i<count($test);$i++){
				$test_charges = Tests::getCharges($test[$i]);
				$request = new Q_request_details();
				$request -> test_id = $test[$i];
				$request -> client_number = $client_number;
				$request -> client_email = $email;
				$request -> quotations_id = $quotation_id;
				if (!empty($test_charges)) {
                	$request-> test_charge = $test_charges[0]['Charge_'.strtolower($currency)];
				}
				$request -> save();
				//var_dump($test_charges[0]['Charge']);
			}
			
			
				//Save name of dynamic temp table in variale
				$tmp_table = 'quotation_tmp';
				
				//Select all from main table
				$select_all = "SELECT * FROM $t WHERE $c = '$o'";
				$sa = $this->db->query($select_all)->result_array();
				echo count($sa);
				
				//Select Max id
				$mi = $this->db->query("SELECT MAX(id) as max_id FROM $t;")->result_array();
				$max_id = $mi[0]['max_id'];
				var_dump($max_id);
				
				//Select First id
				$fi = $this->db->query("SELECT id as first_id FROM $t WHERE $c = '$o' ORDER BY id ASC LIMIT 1;")->result_array();
				$first_id = $fi[0]['first_id'];
				
				//Create temp table
				$create_temp_table = "CREATE TEMPORARY TABLE $tmp_table ". $select_all;
				
				//Update unique columns
				$update_unique_field = "UPDATE $tmp_table SET $c ='$n' WHERE $c = '$o';";
				$update_id = "UPDATE $tmp_table SET id =((SELECT MAX(id) FROM $t) + 1) WHERE $c = '$n';";
				
				//Insert into table
				$insert_into_table = "INSERT INTO $t SELECT * FROM $tmp_table WHERE $c = '$n';";
            
				$this->db->trans_start();
				$this->db->query($create_temp_table);
				$this->db->query($update_unique_field);
				for($i=0;$i<count($sa);$i++){
					$new_id = $max_id+1+$i;
					$old_id = $first_id + $i;
					$this->db->query("UPDATE $tmp_table SET id = '$new_id' WHERE id = '$old_id';");
				}
				$this->db->query($insert_into_table);
				$this->db->query("DROP table $tmp_table");
				$this->db->trans_complete();
				
				$this->output->enable_profiler(TRUE);
		}
		
		public function getQuotationNos(){
			$cid = $this -> uri -> segment(3);
			$quotation_nos = Quotations::getNos($cid);
			echo json_encode($quotation_nos);
		}

		public function getClientNumber($client_number, $q_no){
			if (!empty($client_number)) {
				if($q_no != 'New'){
					$client_no  = Quotations::getClientNo($q_no);
					//var_dump($client_no);
					$client_number = $client_no[0]['Client_number'];
				}
				else{
					$client_number = $this->input->post("client_id");
				}
	            
	        } else {
	            $cid = Clients::getLastId();
	            $client_number = $cid[0]['max'] + 1;
	            $this -> saveNewClient($client_number);
	        }

	        return $client_number;
		}

		public function getQuotationId(){
			//Get no. of quotations in table
			$no_of_quotations = Quotations::getRowCount();

			//Increment no. of quotations by 1
			$quotation_serial = $no_of_quotations[0]["count"] + 1;

			//Pad quotation no with two leading zeros
			$serial = sprintf('%02s', $quotation_serial);

			//Generate quotation number
			$quotation_no = 'Q-'.date('ymd')."-".$serial;

			return $quotation_no;
		}


		public function getQuotationNo($c, $q){

			//Condition checks whether quotation_no has been selected in generate quotation view
			if(!empty($q) && $q != 'New'){
				$quotation_no = $q;
			}
			else if(empty($q) || $q == 'New'){

				//Get No. of Quotations
				$no_of_quotations = Quotations::getRowCountPerClient($c);

				//Increment no. of quotations by 1
				$quotation_serial = $no_of_quotations[0]["count"] + 1;

				//Pad quotation no with two leading zeros
				$serial = sprintf('%02s', $quotation_serial);

				//Generate quotation number
				$quotation_no = 'NDQ-'.$c."-".date('ymd')."-Q-".$serial;
			}

			return $quotation_no;
		}


	public function generate(){
		$data['currency'] = Currencies::getAll();
		$data['lastclientno'] = Quotations::getLastId();
		$data['dosageforms'] = Dosage_form::getAll();
		$data['tests'] = Tests::getAll();
		$data['wetchemistry'] = Tests::getWetChemistry();
		$data['microbiologicalanalysis'] = Tests::getMicrobiologicalAnalysis();
		$data['medicaldevices'] = Tests::getMedicalDevices();
		$data['scripts'] = array("jquery-ui.js");
		$data['scripts'] = array("jquery.ui.core.js","jquery.ui.datepicker.js","jquery.ui.widget.js");		
		$data['styles'] = array("jquery.ui.all.css");
		$data['content_view'] = "generate_quotation_v";
		$data['quotation_no'] = $qid = $this -> getQuotationId();
		$data['qid'] = $qid.'-1';
		$data['q_no'] = $this -> uri -> segment(7);
		$data['source'] = $this->uri->segment(3);
		$data['q_no_add'] = $this->uri->segment(4);
		
		if(empty($data['q_no'])&& $data['source'] != 'add'){
			$reqid = $data['quotation_no'];
			$newstatus = 1;
		}
		else if(empty($data['q_no'])){
			$reqid = $data['q_no_add'];
			$newstatus = 0;
		}else if($data['source'] != 'add'){
			$reqid = $data['q_no'];
			$newstatus = 0;
		}
		
		$data['newstatus'] = $newstatus;
		$data['qn'] = $reqid;
		
		/*if($data['source'] == 'add'){}*/
		$data['quotation_info'] = Quotations::getQuotationDetailsGlobal($reqid);
		$data['no_of_entries'] = Quotations::getNoOfEntries($reqid);
		$data['no_of_entries_done'] = Quotations::getCompletedEntries($reqid);
		
		//$data['previous_quotations'] = $this -> getPreviousQuotations(); 
		$this -> load -> view('template1', $data);
	}

	public function listing(){
		$data['quotations'] = Quotations::getAll();
		$data['settings_view'] = "quotations_list_v";
		$this -> base_params($data);
	}


	public function printQuotation(){

        //DOMpdf initialization
        require_once("application/helpers/dompdf/dompdf_config.inc.php");
        $this->load->helper('dompdf', 'file');
        $this->load->helper('file');

        //DOMpdf configuration
        $dompdf = new DOMPDF();
        $dompdf->set_paper('A4');

        //Get unique id
       	$data['reqid'] = $reqid = $this -> uri -> segment(3);

       	//Get tables from uri segments
       	$data['table'] = $table = $this -> uri -> segment(4);
		
		//Get Extra Billing Columns
		$sql = "SELECT COLUMN_NAME as 'column', COLUMN_COMMENT as 'comment' FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = 'enqcl' AND TABLE_NAME = 'quotations' AND COLUMN_COMMENT <> '';";	
		$query = $this->db->query($sql);
		$data['extra_columns'] = $extra_columns = $query->result_array();
		
		//Get extra
		$data['reporting_fee_p'] = $reporting_fee_p = $this -> uri -> segment(7);
		$data['admin_fee'] = $admin_fee = $this -> uri -> segment(8);
		$data['discount_p'] = $discount_p = $this -> uri -> segment(9);
		
		//Update Quotations table with extras
		$qu_array = array(
            'reporting_fee' => $reporting_fee_p,
            'admin_fee' => $admin_fee,
            'discount' => $discount_p
        );
		
		$data['percentage_a'] = $qu_array;

		$this->db->where('quotations_id', $reqid);
		$this->db->update('quotations', $qu_array);

		//Get Notes
		$quotation_note = $this -> input -> post('quotation_note');
		
		//Update Notes at Quotation
		$this->db->where('quotation_no', $reqid);
		$this->db->update('quotation_notes', array('system_note'=>$quotation_note));
		
		//Get Signatory Details	
		$signatory_title = $this -> uri -> segment(5);
		$signatory = $this -> uri -> segment(6);

		//Replace special characters in signatory details
		$data['signatory'] = $signatory_n = str_replace("%20", " ", $signatory_title);
		$data['signatory_title'] = $signatory_t = str_replace("%20", " ", $signatory);

		//Get method
		$data['method'] = $this -> router -> fetch_method();

		//Get client id
		$cid = Quotations_final::getClient($data['reqid']);
		$client_id = $data['cid'] = $cid[0]['client_id'];

		//Do condition for getting billing tables e.t.c
			if($table == 'request'){
				$id = 'request_id';
				$billing_table = 'Client_billing';
				$register = 'dispatch_register';
				$main_table = 'Request';
				$components_table = $main_table."_components";
				$ref = $main_table.'_id';
				$status = 'proforma_print_status';
				$tests_index = 4;
				
				//Get Currency
				$currency = Quotations::getCurrency($reqid);
				$c = $currency[0]['Currency'];
			}
			else if($table == 'quotations'){
				$id = 'quotations_id';
				$billing_table = 'Q_request_details';
				$register = 'Quotations';
				$main_table = $register;
				$components_table = $main_table."_components";
				$ref = $register.'_id';
				$status = 'quotation_print_status';
				$tests_index = 6;
				
				//Get Currency
				$currency = Quotations_final::getCurrency($reqid);
				$c = $currency[0]['currency'];
			}


		//Pdf url info
       	$saveTo = './quotations';
       	$quotation_name = "Quotation_" . $data['reqid'] . ".pdf";

       	//$qt_no = $this -> getQuotationNoFromDb($data['reqid']);

		$data['test_data'] = $billing_table::getChargesPerClient($data['reqid']);
		$data['invoice_data'] = $data['i_data'] = $main_table::getInvoiceDetailsPerClient($client_id, $reqid);
 		$data['currency'] = $c;
		$data['admin_fee'] = $admin_fee;
		
		
		//Get Total
		$data['total'] = $register::getTotalPerClient($client_id, $reqid);
		$total_cost = $data['total'][0]['sum'];
		
		//Adjusted Total
		$adjusted_total = $total_cost + $admin_fee + ($total_cost*$reporting_fee_p/100) - ($total_cost*$discount_p/100);
		
		//Consolidate values and keys arrays to form single extras array 
		$xt = array();
		$u = 7;
		
		foreach($extra_columns as $xc){
			
			//Get input value from extras inputs
			$val = $this -> uri -> segment($u++);
			//If value is not 0 or blank
			//If the value is tagged as percentage , divide by 100 then multiply by total_cost
			
			$tag = $xc['comment'];
			if($val != 0 ){
				if($tag == '%'){
					$amount = $val/100*$total_cost;
				}
				else{
					$amount = $val;
				}
				//Make column key, amount value
				$xt[$xc['column']] = $amount;
			}
		}
		
		//Insert in array to reference in quotations view
		$data['xtra_columns'] = $xt;
		
		//Push amounts into array that generates totals footer
		$data['tr_array'] = array('TOTAL COST'=>$adjusted_total);	
		
		//Push to view
        //$data['settings_view'] = "quotation_multiple_v";
        $html = $this->load->view('quotation_multiple_v', $data, TRUE);
       // $this -> base_params($data);
        
        
        $dompdf->load_html($html);
        $dompdf->render();
        write_file($saveTo . "/" . $quotation_name, $dompdf->output());
        

       //Set invoice print status
       $this -> setInvoicePrintStatus($reqid, $saveTo, $quotation_name, $main_table, $ref, $status);

       //Save details of printed quotation


       //Check if this quotation had been printed before, if had set active status of rest of quotation entries to zero
       if($this->checkIfThisQuotationAlreadyPrinted($reqid) == true){
       		
       		$this->db->where('quotation_no', $reqid);
			$this->db->update('quotations_final', array('admin_fee' => $admin_fee, 'reporting_fee' => $reporting_fee_p,
				'discount' => $discount_p,
				'amount' => $total_cost,
				'payable_amount' => $adjusted_total,
				'signatory_title' => $signatory_t,
				'signatory_name' => $signatory_n,
				'print_status' => 1,
				'date_printed' => date('Y-m-d'),
				'source_status' => 2,
            	'quotation_status' => 1
				)
			);
       }
       else{

       	//Save Quotation
		$q_f = new Quotations_final();
		$q_f -> quotation_no = $reqid;
		$q_f -> client_id = $client_id;
		$q_f -> admin_fee = $admin_fee;
		$q_f -> reporting_fee = $reporting_fee_p;
		$q_f -> discount = $discount_p;
		$q_f -> amount = $total_cost;
		$q_f -> payable_amount = $adjusted_total;
		$q_f -> signatory_title = $signatory_t;
		$q_f -> signatory_name = $signatory_n;
		$q_f->  date_printed = date('Y-m-d');
		$q_f->  print_status = 1;
		$q_f->	source_status =2;
		$q_f->	quotation_status=1;
		$q_f -> save();
		
		} 

		
	}


	public function editClient(){
		$client_id =  $this -> uri -> segment(3);
		$data['client_info'] = $this->getAllClientInfoExtended($client_id);
		$data['content_view'] = "client_edit_global";
        $this->load->view('template_next', $data);    
	}

	public function printSingleQuotation(){

		$quotation_id = $this->uri->segment(3);
		$data['quotations_id'] = $quotation_id;
		$qn = Quotations::getQuotationParameters($quotation_id);
		$qno =$data['qno']= $qn[0]['Quotation_no'];

		$data['quotation_summary']= Quotations::getQuotationSummary($qno);
		$data['content_view'] = 'quotation_single_v';
		$this -> load -> view('template1', $data);
	}

		public function checkIfThisQuotationAlreadyPrinted($q){
			
			$qf = Quotations_final::checkEntry($q);
			
			if($qf){
				return true;
			}
			return false;
		}

		public function getQuotationNoFromDb($r){
			//Get Quotation No.
       		$quotation_n = Quotations::getQuotationNumber($r);
			$qt_no = $quotation_n[0]["Quotation_no"];
			return $qt_no;
		}


		public function printProforma(){

        //DOMpdf initialization
        require_once("application/helpers/dompdf/dompdf_config.inc.php");
        $this->load->helper('dompdf', 'file');
        $this->load->helper('file');

        //DOMpdf configuration
        $dompdf = new DOMPDF();
        $dompdf->set_paper('A4');

        //Get unique id
       	$data['reqid'] = $reqid = $this -> uri -> segment(3);

       	//Get tables from uri segments
       	$data['table'] = $table = $this -> uri -> segment(4);
		$data['table2'] = $this -> uri -> segment(5);
		$data['table3'] = $this -> uri -> segment(6);

		//Get client id
		$data['client_id'] = $client_id = $this -> uri -> segment(7);

		//Get Proforma No
		//$data['proforma_no'] = $proforma_no = $this -> uri -> segment(8);

		//Get Date Received
		$data['proforma_info'] = $proforma_info = Request::getProformaNo($data['reqid']);
		$data['date_received'] = $date_received = $proforma_info[0]['Designation_date'];
		$data['proforma_no'] = $proforma_no = $proforma_info[0]['proforma_no'];

		//Get method 
		$data['method'] = $this -> router -> fetch_method();

		//Get Signatory Details
		$signatory_title = $this -> uri -> segment(8);
		$signatory = $this -> uri -> segment(9);

		//Replace special characters in signatory details
		$data['signatory'] = str_replace("%20", " ", $signatory_title);
		$data['signatory_title'] = str_replace("%20", " ", $signatory);

		//Do condition for getting billing tables e.t.c
			if($table == 'request'){
				$id = 'request_id';
				$billing_table = 'Client_billing';
				$register = 'dispatch_register';
				$main_table = 'Request';
				$components_table = $main_table."_components";
				$ref = $main_table.'_id';
				$status = 'proforma_print_status';
				$tests_index = 4;
			}
			else if($table == 'quotations'){
				$id = 'quotations_id';
				$billing_table = 'Q_request_details';
				$register = 'Quotations';
				$main_table = $register;
				$components_table = $main_table."_components";
				$ref = $register.'_id';
				$status = 'quotation_print_status';
				$tests_index = 6;
			}


		//Pdf url info
       	$saveTo = './proformas';
       	$quotation_name = "Proforma_" . $data['reqid'] . ".pdf";
		
		//Get data for the pdf	
		$data['test_data'] = $billing_table::getChargesPerClient($data['reqid']);
		//$data['invoice_data'] = $main_table::getInvoiceDetails($data['reqid']);
 		
		//Get invoice_data per client
 		$data['invoice_data'] = $main_table::getInvoiceDetailsPerClient($client_id, $date_received, $proforma_no);

		//Get Total
		$data['total'] = $billing_table::getTotalperClientProforma($client_id, $proforma_no);

		//Set Totals and discounts to variables
		$total_cost = $data['total'][0]['sum'];
		$amount_payable = 0.8 * $total_cost;
		
		//Push amounts into array that generates totals footer
		$data['tr_array'] = array('TOTAL COST'=>$total_cost,'80%' => $amount_payable);	
		

	     //$data['settings_view'] = 'proforma_invoice_v';
	     $html = $this->load->view('proforma_invoice_v', $data, TRUE);
	     //$this -> base_params($data);
        
        $dompdf->load_html($html);
        $dompdf->render();
        write_file($saveTo . "/" . $quotation_name, $dompdf->output());
        

       //Set invoice print status
       $this -> setInvoicePrintStatus($reqid, $saveTo, $quotation_name, $main_table, $ref, $status);
 
	}




	public function printInvoice(){

       	//Get tables from uri segments
       	$data['table'] = $table = $this -> uri -> segment(4);
		$data['table2'] = $this -> uri -> segment(5);
		$data['table3'] = $this -> uri -> segment(6);
		
		//Status Method Parameters
		$main_table = 'request';
		$ref = 'request_id';
		$status = 'invoice_print_status';

        //DOMpdf initialization
        require_once("application/helpers/dompdf/dompdf_config.inc.php");
        $this->load->helper('dompdf', 'file');
        $this->load->helper('file');

        //DOMpdf configuration
        $dompdf = new DOMPDF();
        $dompdf->set_paper('A4');

        //
       	$data['reqid'] = $reqid = $this -> uri -> segment(3);	
       	$saveTo = './invoices';
       	$invoicename = "Invoice_" . $data['reqid'] . ".pdf";
			
		$data['test_data'] = Invoice_billing::getChargesPerClient($data['reqid']);
		$data['invoice_data'] = Request::getInvoiceDetails($data['reqid']);

		//Get Invoice Number
		$coa_nos = Coa_number::getCoaNo($data['reqid']);
		$year = date('Y');
		$data['invoice_number'] = "/".$coa_nos[0]['number'];
		
		//Get client id
		$data['client_id']  = $this -> uri -> segment(7);

		//Get Total
		$data['total'] = Invoice_billing::getTotal($data['reqid']);
		$total_cost = $data['total'][0]['sum'];	

		//Get Discount Data
		$client_discount_percentage = Clients::getDiscountPercentage($data['client_id']);
		$discount_percentage = $client_discount_percentage[0]['discount_percentage'];
		$discount_title = 'DISCOUNT '. $discount_percentage.'%';
	
		//Test Discount
		$data['disc'] = $client_discount_percentage;
	
		//Compute Discounts
		$discount = $discount_percentage/100 * $total_cost;
		$amount_payable = $total_cost - $discount;

		//Push amounts into array that generates totals footer depending on client eligible for discount/not
		if($discount_percentage != 0){
			$data['tr_array'] = array('TOTAL COST'=>$total_cost, $discount_title => $discount , 'AMOUNT PAYABLE' => $amount_payable);
			$data['discount_cols'] = 6;
			$data['discount_csp']= 2;
		}
		else{
			$data['tr_array'] = array('TOTAL COST'=>$total_cost, 'AMOUNT PAYABLE' => $amount_payable);
			$data['discount_cols'] = 5;
			$data['discount_csp'] = 1;
		}

		//Get method 
		$data['method'] = $this -> router -> fetch_method();

		//Get Default Signatory Details - Get Director
		$data['signatory']  = User::getDirector();
		
		//Get action to be performed from button value
		$action = $this->uri->segment(8);
		
		//Pass action variable to data array
		$data['action'] = $action;
		
		//Perform action on the invoice view, depending on button clicked
        if($action == 'print'){
			//Print invoice to pdf
			$html = $this -> load -> view('invoice_pdf_v', $data, TRUE);	
			$dompdf->load_html($html);
			$dompdf->render();
			write_file($saveTo . "/" . $invoicename, $dompdf->output());
		}
		else if($action == 'view'){
			$data['content_view'] = 'invoice_pdf_v';
			$this -> load -> view('template1', $data);
		}
	}

	public function showInvoiceBeforePrint(){
	
		//Get unique id
		$data['reqid'] = $this -> uri -> segment(3);
		
		//Get tables
		$data['table'] = $this -> uri -> segment(4);
		$data['table2'] = $this -> uri -> segment(5);
		$data['table3'] = $this -> uri -> segment(6);

		//Get client id
		$data['client_id']  = $this -> uri -> segment(7);

		//Get list of eligible signatories
		$data['signatories'] = User::getSignatories();

		//Get Invoice Data to go to pdf print
		$data['test_data'] = Client_billing::getChargesPerClient($data['reqid']);
		$data['invoice_data'] = Request::getInvoiceDetails($data['reqid']);

		//Get originator method
		$data['method'] = $this -> router -> fetch_method();

		//Get Total
		$data['total'] = Client_billing::getTotal($data['reqid']);
		$total_cost = $data['total'][0]['sum'];	

		//Get Discount Data
		$client_discount_percentage = Clients::getDiscountPercentage($data['client_id']);
		$discount_percentage = $client_discount_percentage[0]['discount_percentage'];
		$discount_title = 'DISCOUNT '. $discount_percentage.'%';
	
		//Compute Discounts
		$discount = $discount_percentage/100 * $total_cost;
		$amount_payable = $total_cost - $discount;

		//Push amounts into array that generates totals footer depending on client eligible for discount/not
		if($discount_percentage != 0){
			$data['tr_array'] = array('TOTAL COST'=>$total_cost, $discount_title => $discount , 'AMOUNT PAYABLE' => $amount_payable);
			$data['discount_cols'] = 6;
			$data['discount_csp']= 2;
		}
		else{
			$data['tr_array'] = array('TOTAL COST'=>$total_cost, 'AMOUNT PAYABLE' => $amount_payable);
			$data['discount_cols'] = 5;
			$data['discount_csp'] = 1;
		}

	
		//Get Invoice Number
		$coa_nos = Coa_number::getCoaNo($data['reqid']);
		$year = date('Y');
		$data['invoice_number'] = "/".$coa_nos[0]['number'];
		
		//Get Signatory Details
		$data['signatory'] = "Hezekiah Chepkwony";
		$data['signatory_title'] = "Dr.";
		
		//Set view, load it
		$data['content_view'] = 'invoice_before_print_v';
		$this -> load -> view('template1', $data);	
	
	}

	public function seeJson(){	
		$data['reqid'] = $reqid = $this -> uri -> segment(3);
		$test = Client_billing::getChargesPerClient($data['reqid']);
		echo json_encode($test);
	}
     
	public function setInvoicePrintStatus($r, $s, $i, $table, $ref, $status){

		//Request update arrays
		$request_where_array =  array($ref => $r);
		$request_update_array = array($status => 1);

		//Update request
		$this -> db -> where($request_where_array);
		$this -> db -> update($table,$request_update_array);

	}

	public function showBillsPerTest(){
		$data['rid'] = $this -> uri -> segment(3);
		$data['content_view'] = 'quotation_bill_per_test_v';
		$this -> load -> view('template1', $data);
	}

	public function show_breakdown(){
		$data['rid'] = $this -> uri -> segment(3);
		$this -> load -> view('quotation_billing_breakdown_v', $data);	
	}

	public function breakdown(){
		$rid = $this -> uri -> segment(3);
		$charges =Q_request_details::getChargesPerQuotation($rid);
		foreach ($charges as $r){
			$data[] = $r;
		}
		echo json_encode($data);
	}

	public function show(){
	$data['settings_view'] = "show_quotation_v";
	$this -> base_params($data);	
	}

	public function base_params($data) {
		$data['title'] = "Request Management";
		$data['styles'] = array("jquery-ui.css");
		$data['scripts'] = array("jquery-ui.js");
		$data['scripts'] = array("SpryAccordion.js");
		$data['styles'] = array("SpryAccordion.css");
		$data['quick_link'] = "quotation";
		$data['content_view'] = "settings_v";
		$data['banner_text'] = "NQCL Settings";
		$data['link'] = "settings_management";
		$this -> load -> view('template', $data);
	}//end base_params

}






?>
