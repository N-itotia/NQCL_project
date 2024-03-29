<?php

require_once APPPATH . 'controllers/audit.php';
require_once APPPATH . 'controllers/wordexe.php';

class Coa extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('dompdf_lib');
    }

//
//    function generateCoa($labref) {
//        // error_reporting(1);
//        $data['labref'] = $labref = $this->uri->segment(3);
//        $data['information'] = $this->getRequestInformation($labref);
//        $data['tests_requested'] = $this->getRequestedTests($labref);
//        $data['trd'] = $this->getRequestedTestsDisplay2($labref);
//       // print_r($data['trd']);
//        $data['signatories'] = $this->getSignatories($labref);
//        $data['coa_details'] = $this->getAssayDissSummary($labref);
//        $data['conclusion'] = $this->salvageConclusion($labref);
//        $data['coa_number'] = $this->salvageCOANumbering();
//
//        $data['settings_view'] = 'coa_v';
//        $this->base_params($data);
//    }


    function getYear() {
        if (date('m') > 6) {
            $year = date('Y') . "-" . (date('y') + 1);
        } else {
            $year = (date('Y') - 1) . "-" . date('y');
        }
        return $CAN = 'CAN/' . $year . '/';
    }
    
    
      function getYear2() {
        if (date('m') > 6) {
            $year = date('y') . "-" . (date('y') + 1);
        } else {
            $year = (date('y') - 1) . "-" . date('y');
        }
        return  '/'.$year ;
    }
    
       function generateCoa_crr($labref) {
        // error_reporting(1);
        error_reporting(0);
        $data['s4']=  $this->uri->segment(4);
        $data['title'] = 'COA-Engine - ' . $labref;
        $data['inyear']=  $this->getYear2();
        $data['year']=  $this->getYear();
        $data['information'] = $this->getRequestInformation($labref);
        $data['tests_requested'] = $this->getRequestedTests($labref);
        $data['trd'] = $this->getRequestedTestsDisplay2($labref);
        $data['labref'] = $labref;
        $this->load->view('coa_engine/reviewer', $data);
    }
	
	  function generateCoa_invoice($labref) {
        // error_reporting(1);
      
        $data['s4']=  $this->uri->segment(4);
        $data['title'] = 'INVOICE ENGINE - ' . $labref;
        $data['year2']=  $this->getYear2();
        $data['year']=  $this->getYear();
        $data['inv']=  $this->getInvoice($labref);

        $data['information'] = $this->getRequestInformation($labref);
        $data['tests_requested'] = $this->getRequestedTests($labref);
        $data['trd'] = $this->getRequestedTestsDisplay2($labref);
        $data['labref'] = $labref;
        $this->load->view('coa_engine/invoice2', $data);
    }
	
	function clean($labref){
		$this->db->where('labref',$labref)->delete('invoic_temp');
		redirect('coa/generateCoa_invoice/'.$labref.'/INVOICE/');
	}
	
	
	   function getNames() {     
        return $this->db->query("SELECT ut.usertype_id,u.title, u.fname, u.lname,ut.status FROM user u, users_types ut WHERE u.email = ut.email AND ut.usertype_id !=29 AND ut.status !=0 AND ut.usertype_id!=0 AND ut.usertype_id!=100 AND ut.usertype_id!=14 AND ut.usertype_id!=5 AND ut.usertype_id!=21 AND ut.usertype_id!=22 AND ut.usertype_id!=12 AND ut.usertype_id!=23 GROUP BY fname ORDER BY fname ASC ")->result();
    }
    function suggest() {

        $term = $this->input->post('term', TRUE);

        $rows = $this->getNames();

        $keywords = array();
        foreach ($rows as $row):
            array_push($keywords, strtoupper($row->title ." ".$row->fname ." ".$row->lname));
           endforeach;
        echo json_encode($keywords);
     }
	
	  function generateCoa_invoice2($labref) {
        // error_reporting(1);
        error_reporting(1);
        $data['s4'] =   $this->uri->segment(4);
        $data['title'] = 'INVOICE ENGINE - ' . $labref;
        $data['year2']=  $this->getYear2();
        $data['year']=  $this->getYear();
        $data['information'] = $this->getRequestInformation($labref);
		$data['currency'] = $this->getInvoiceCurrency($labref);
		$data['tests_requested'] = $this->getRequestedTests($labref);
		
		//Get NDQ Number
		$data['reqid'] = $labref;
          
        //Get Client Id  
        $client_id = $data['information'][0]->client_id;
		
		//Get Invoice Data to go to pdf print
		$data['test_data'] = Invoice_billing::getInvoiceDetailsUpdated($data['reqid']);

		//Get originator method
		$data['method'] = $this -> router -> fetch_method();

		//Get Total
		$data['total'] = Invoice_billing::getTotal($data['reqid']);
		$total_cost = $data['total'][0]['sum'];	

		//Get Discount Data
		$client_discount_percentage = Clients::getDiscountPercentage($client_id);
		$discount_percentage = $client_discount_percentage[0]['discount_percentage'];
        $data['discount_percentage'] = $discount_percentage;
		$discount_title = 'discount';
	
		//Compute Discounts
		$discount = $discount_percentage/100 * $total_cost;
		$amount_payable = $total_cost - $discount;

		//Push amounts into array that generates totals footer depending on client eligible for discount/not
		if($discount_percentage != 0){
			$data['tr_array'] = array('total_cost'=>$total_cost, $discount_title => $discount , 'amount_payable' => $amount_payable);
			$data['discount_cols'] = 6;
			$data['discount_csp']= 2;
		}
		else{
			$data['tr_array'] = array('total_cost'=>$total_cost, 'amount_payable' => $amount_payable);
			$data['discount_cols'] = 5;
			$data['discount_csp'] = 1;
		}
					
        $data['labref'] = $labref;
        $this->load->view('coa_engine/invoice_auto', $data);

    }
    
    function saveCOABilling($labref){
        $this->db->where('labref',$labref)->delete('invoic_temp');
        $in = $this->input->post('inumber');  
        $batch = $this->input->post('batch_no');        
		
        $can = $this->input->post('cert');
        $client_ref = $this->input->post('client_ref');
       // $client = $this->input->post('client');
        $cost = $this->input->post('cost');
        $currency = $this->input->post('currency');
        $discount = $this->input->post('discount');
	    $test = $this->input->post('tetst');
        $method = $this->input->post('method');
        $compendia = $this->input->post('compendia');

				

   for($i=0;$i<count($cost);$i++){
        $array = array(
            'labref' => $labref,
            'invno' => $in,
            'can' => $can,
			'batch' => $batch,          
			'client_ref'=>$client_ref,
            'discount'=>$discount,
            'currency'=>$currency,
            'cost' => $cost[$i],
			'tests'=>$test[$i],
			'method'=>$method[$i],
			'compendia'=>$compendia[$i]
           
        );
        $this->db->insert('invoic_temp', $array);
    }
    }
	
	function saveCOABillingUpdate($labref){
		   $client = $this->input->post('client'); 
				$this->db->where('labref',$labref)->update('invoic_temp',array('client'=>$client));

	}
	
	
	
	function saveInvoice($labref){
		
		//Check if this labref exists in invoice table yet
		if($this->checkIfExistsInvoiceTable($labref) == 0) {
		
		$table = 'invoice';
		$table_tests = 'invoice_tests';
		
		${$table."_columns"} = $this->getCommentedColumns($table);
		${$table_tests."_columns"} = $this->getCommentedColumns($table_tests);
		
		
		$tablecols = array();
		$tablevals = array();
		
		//Save main invoice data
		foreach(${$table."_columns"} as $k => $v){
			//${$v['COLUMN_NAME']} = $this->input->post($v['COLUMN_NAME']);
			$val = $this->input->post($v['COLUMN_NAME']);
			if(!empty($val)){
				array_push($tablecols, $v['COLUMN_NAME']);
				array_push ($tablevals, "'$val'");
			}
		}
		
		
		$tc = implode(',', $tablecols);
		$tv = implode(',', $tablevals);
		
		$sql= "INSERT INTO $table($tc)VALUES($tv)";
		$this->db->query($sql);
		echo $sql;
		
		//Get invoice tests columns
		$test = $this->input->post('test');
		$test_id = $this -> input -> post("test_id");
		$method = $this->input->post('method');
		$method_id = $this -> input -> post("method_id");
		$compedia = $this->input->post('compedia');
		$cost = $this->input->post('cost');
		
		//Iterate through tests and save test related data
		for($i=0;$i<count($test);$i++){
			$iv = new Invoice_tests();
			$iv->t_index = $i;
			$iv->lab_ref_no = $labref;
			$iv->test = $test[$i];
			$iv->test_id = $test_id[$i];
			$iv->method = $method[$i];
			$iv->method_id = $method_id[$i];
			$iv->compedia = $compedia[$i];
			$iv->cost = $cost[$i];
			$iv->save();
		}
		
		//$this->output->enable_profiler(true);
		}
		else{
			echo json_encode(array(
				'status' => 'error',
				'message'=> 'Invoice for ' . $labref . ' already saved. To update go to <a href = "">All Invoices</a>'
			));
		}
	}
    
    function getInvoice($labref){
        return $this->db->where('labref',$labref)->get('invoic_temp')->result();
    }
	
	
            
	
	
    
   

    function generateCoa($labref) {
        // error_reporting(1);
        $data['labref'] = $labref = $this->uri->segment(3);
        $data['information'] = $this->getRequestInformation($labref);
        $data['tests_requested'] = $this->getRequestedTests($labref);
        $data['trd'] = $this->getRequestedTestsDisplay2($labref);
        $data['coa_stat'] = $this->checkDirectorsComment($labref);
        $data['title'] = 'COA -' . $labref;
        $data['fyear'] = $this->getYear();
        $data['signatories'] = $this->getSignatories($labref);
        $data['coa_details'] = $this->getAssayDissSummary($labref);
        $data['conclusion'] = $this->salvageConclusion($labref);
        $data['coa_number'] = $this->salvageCOANumbering();

        $this->load->view('coa_v_3', $data);
    }

    function generateCoa_r($labref) {
        // error_reporting(1);
        $data['labref'] = $labref = $this->uri->segment(3);
        $data['information'] = $this->getRequestInformation($labref);
        $data['tests_requested'] = $this->getRequestedTests($labref);
        $data['trd'] = $this->getRequestedTestsDisplay2($labref);
        $data['title'] = 'COA -' . $labref;
//        $data['tests']=  $this->tests();
        $data['test_methods'] = $this->test_methods();
        $data['fyear'] = $this->getYear();
        //var_dump($data['test_methods']);
        $data['coa_stat'] = $this->checkDirectorsComment($labref);
        $data['signatories'] = $this->getSignatories($labref);
        $data['coa_details'] = $this->getAssayDissSummary($labref);
        $data['conclusion'] = $this->salvageConclusion($labref);
        $data['coa_number'] = $this->salvageCOANumbering();

        $this->load->view('coa_v_3_review', $data);
    }

    function test_methods() {
        return $this->db->group_by('name')->get('test_methods')->result();
    }

    function test_methods_AJAX() {
        echo json_encode($this->db->group_by('name')->get('test_methods')->result());
    }

    function test_AJAX() {
        echo json_encode($this->db->get('tests')->result());
    }

    function coa_engine($labref) {
        error_reporting(0);
        $data['title'] = 'COA-Engine - ' . $labref;
        $data['labref'] = $labref;
        $this->load->view('coa_engine/index', $data);
    }
	
	 function coa_engine_top($labref) {
        error_reporting(0);
        $data['title'] = 'COA-Engine-TOP - ' . $labref;
        $data['labref'] = $labref;
        $this->load->view('coa_engine/index_top', $data);
    }
	
	function coa_engine_top_2($labref) {
        error_reporting(0);
        $data['title'] = 'COA-Engine - ' . $labref;
        $data['labref'] = $labref;
        $this->load->view('coa_engine/index_top_2', $data);
    }
	
		function coa_engine_final($labref) {
        error_reporting(0);
        $data['title'] = 'COA-Engine-TOP - ' . $labref;
        $data['labref'] = $labref;
        $this->load->view('coa_engine/index_rev', $data);
    }


    function coa_engine_editor() {
        exec('"C:\Program Files\Sublime Text 3\sublime_text.exe" "C:\xampp\htdocs\foo.php"');
    }

    function _exec($cmd) {
        $WshShell = new COM("WScript.Shell");
        $oExec = $WshShell->Run($cmd, 0, false);
        echo $cmd;
        return $oExec == 0 ? true : false;
    }

    function execInBackground($cmd) {
        if (substr(php_uname(), 0, 7) == "Windows") {
            pclose(popen("start  " . $cmd, "r"));
        } else {
            exec($cmd . " > /dev/null &");
        }
    }

    function generateCoa_cr($labref) {
        // error_reporting(1);
        $data['labref'] = $labref = $this->uri->segment(3);
        $data['clients'] = $this->load_clients();
        $data['information'] = $this->getRequestInformation($labref);
        $data['tests_requested'] = $this->getRequestedTests($labref);
        $data['trd'] = $this->getRequestedTestsDisplay2($labref);
        $data['coa_stat'] = $this->checkDirectorsComment($labref);
        $data['fyear'] = $this->getYear();
        $data['title'] = 'COA -' . $labref;
        $data['signatories'] = $this->getSignatories($labref);
        $data['coa_details'] = $this->getAssayDissSummary($labref);
        $data['conclusion'] = $this->salvageConclusion($labref);
        $data['coa_number'] = $this->salvageCOANumbering();

        $this->load->view('coa_v_3_after_r', $data);
    }
    
       /*function generateCoa_crr($labref) {
        // error_reporting(1);
        error_reporting(0);
        $data['s4']=  $this->uri->segment(4);
        $data['title'] = 'COA-Engine - ' . $labref;
        $data['labref'] = $labref;
        $this->load->view('coa_engine/reviewer', $data);
    }*/
    
        function generateCoa_final($labref) {
        // error_reporting(1);
        error_reporting(0);
        $data['title'] = 'COA-Engine - ' . $labref;
        $data['labref'] = $labref;
        $data['fyear'] = $this->getYear();
        $data['coa_number'] = $this->salvageCOANumbering();
        $this->load->view('coa_engine/index_final', $data);
    }
	
	  function generateCoa_finalr($labref) {
        // error_reporting(1);
        error_reporting(0);
        $data['title'] = 'COA-Engine - ' . $labref;
        $data['labref'] = $labref;
        $data['fyear'] = $this->getYear();
        $data['coa_number'] = $this->salvageCOANumbering();
        $this->load->view('coa_engine/index_final', $data);
    }

    function generateCoa_final_review($labref) {
        // error_reporting(1);
        error_reporting(0);
        $data['title'] = 'COA-Engine - ' . $labref;
        $data['labref'] = $labref;
        $data['fyear'] = $this->getYear();
        $data['coa_number'] = $this->salvageCOANumbering();
        $this->load->view('coa_engine/reviewer', $data);
    }

    
    function updatecan($labref){
        $can = $this->input->post('can');
        $this->db->where('request_id',$labref)->update('request',array('CAN'=>$can));
    }

    function generateCoa_fd($labref) {
        // error_reporting(1);
        $data['clients'] = $this->load_clients();
        $data['labref'] = $labref = $this->uri->segment(3);
        $data['information'] = $this->getRequestInformation($labref);
        $data['tests_requested'] = $this->getRequestedTests($labref);
        $data['trd'] = $this->getRequestedTestsDisplay2($labref);
        $data['coa_stat'] = $this->checkDirectorsComment($labref);
        $data['title'] = 'COA -' . $labref;
        $data['fyear'] = $this->getYear();
        $data['signatories'] = $this->getSignatories($labref);
        $data['coa_details'] = $this->getAssayDissSummary($labref);
        $data['conclusion'] = $this->salvageConclusion($labref);
        $data['coa_number'] = $this->salvageCOANumbering();

        $this->load->view('coa_v_3_1', $data);
    }

    function generateCoa_dash($labref) {
        // error_reporting(1);
        $data['clients'] = $this->load_clients();
        $data['labref'] = $labref = $this->uri->segment(3);
        $data['information'] = $this->getRequestInformation($labref);
        $data['tests_requested'] = $this->getRequestedTests($labref);
        $data['trd'] = $this->getRequestedTestsDisplay2($labref);
        $data['coa_stat'] = $this->checkDirectorsComment($labref);
        $data['title'] = 'COA -' . $labref;
        $data['fyear'] = $this->getYear();
        $data['signatories'] = $this->getSignatories($labref);
        $data['coa_details'] = $this->getAssayDissSummary($labref);
        $data['conclusion'] = $this->salvageConclusion($labref);
        $data['coa_number'] = $this->salvageCOANumbering();

        $this->load->view('coa_v_3_dash', $data);
    }

    function load_clients() {
        return $this->db->query("SELECT DISTINCT (
name
), id
FROM `clients`
GROUP BY name
ORDER BY name ASC")->result();
    }

    function analyst_coa_view($labref) {
        // error_reporting(1);
        $data['labref'] = $labref = $this->uri->segment(3);
        $data['information'] = $this->getRequestInformation($labref);
        $data['tests_requested'] = $this->getRequestedTests($labref);
        $data['trd'] = $this->getRequestedTestsDisplay2($labref);
        $data['coa_stat'] = $this->checkDirectorsComment($labref);
        $data['title'] = 'COA -' . $labref;
        $data['signatories'] = $this->getSignatories($labref);
        $data['coa_details'] = $this->getAssayDissSummary($labref);
        $data['conclusion'] = $this->salvageConclusion($labref);
        $data['coa_number'] = $this->salvageCOANumbering();

        $this->load->view('coa_v_3_analyst', $data);
    }

    function checkCAN($labref) {
        $uri = $this->uri->segment(2);
        if ($uri == 'generateCoa_dash' || $uri == 'approve_d') {
            $num = $this->db->where('request_id', $labref)->get('coa_number')->num_rows();
            if ($num > 0) {
                return 1;
            } else {
                $last_id = $this->db->query("SELECT MAX(id) AS id FROM coa_number WHERE request_id = '$labref'")->result();
                $num = $last_id[0]->id + 1;
                $data = array(
                    'number' => $num,
                    'request_id' => $labref
                );
                $this->db->insert('coa_number', $data);
                echo 'COA Assigned Number';
            }
        }
    }

    function get_signatories($labref) {
        echo json_encode($this->db->where('labref', $labref)->get('signature_table')->result());
    }

    function switchclient($labref) {
        $client_id = $this->input->post('client_id_change');
        $this->db->where('request_id', $labref)->update('request', array('client_id' => $client_id));
    }

    function saveCOA() {
        $labref = $this->uri->segment(3);
        $test_id = $this->getRequestedTestIds($labref);

        if ($this->checkIfCOABodyExists($labref) == '1') {
            // $method_array = $this->input->post('method');   
            // $compedia_array = $this->input->post('compedia');
            //$specification_array = $this->input->post('specification');
            // $complies_array = $this->input->post('complies');
            $testid_array = $this->input->post('tests');

            $method1_array = array();
            $compedia1_array = array();
            $specification1_array = array();
            $determined_array = array();
            $complies1_array = array();


            $temp_array1 = array();
            $temp_array2 = array();
            $temp_array3 = array();
            $temp_array4 = array();
            $temp_array5 = array();

            $count = 0;

            $person = $this->getPerson();
            $name = $person[0]->fname . " " . $person[0]->lname;
            $last_id = $this->db->query("SELECT max(id) as id FROM coa_body_log")->result();

            foreach ($testid_array as $temp_array) {

                $temp_array1 = $this->input->post('determined_' . $count);
                $temp_array2 = $this->input->post('method_' . $count);
                $temp_array3 = $this->input->post('compedia_' . $count);
                $temp_array4 = $this->input->post('specification_' . $count);
                $temp_array5 = $this->input->post('complies_' . $count);


                $method1_array[$temp_array] = implode(':', $temp_array2);
                $compedia1_array[$temp_array] = implode(':', $temp_array3);
                $specification1_array[$temp_array] = implode(':', $temp_array4);
                $determined_array[$temp_array] = implode(':', $temp_array1);
                $complies1_array[$temp_array] = implode(':', $temp_array5);
                $count++;
            }


            $spec_count = 0;
            $last_id1 = $last_id[0]->id;
            foreach ($testid_array as $testid) {

                $update_data = array(
                    'method' => $method1_array[$testid],
                    'compedia' => $compedia1_array[$testid],
                    'specification' => $specification1_array[$testid],
                    'determined' => $determined_array[$testid],
                    'complies' => $complies1_array[$testid],
                    'conclusion' => $this->input->post('conclusion'),
                    'row_number' => ''
                );




                $new_query =$this->db->where('labref', $labref)
                         ->where('test_id', $testid)
                         ->update('coa_body', $update_data);
                $this->db->where('id', $last_id1)->update('coa_body_log', array('who' => $name));
                $spec_count++;
                $last_id1++;
            }
            $last_id2 = $this->db->query("SELECT max(id) as id FROM coa_body_log")->result();
            $this->db->where('id', $last_id2[0]->id)->update('coa_body_log', array('who' => $name));

	   }else{
            $this->checkCAN($labref);
            $this->rows_update($labref);
            $this->send_to_signature($labref);
            $this->coaIsDraftedUpdate($labref);
            $this->updateCOATracking();
            $this->saveCOATOP($labref);
            //$this->generate_certificate($labref);
            $word = new Wordexe();
            $word->generate($labref);
          //  $audit = new Audit();
           // $audit->audit_trail($new_query);
            //$this->do_audit_update($labref);
            //  $this->convertToPdf($labref);
            //$this->generateCoaDraft($labref);
            //$this->output->enable_profiler();

            $compedia_array = $this->input->post('compedia');
            $specification_array = $this->input->post('specification');
            $testid_array = $this->input->post('tests');
            $spec_count = 0;
            foreach ($testid_array as $testid) {
                $update_data = array(
                    'compedia' => $compedia_array[$spec_count],
                    'specification' => $specification_array[$spec_count]
                );
                $this->db->where('labref', $labref);
                $this->db->where('test_id', $testid);
                $this->db->update('coa_body', $update_data);
                $spec_count++;
            }
            $this->generate_certificate($labref);
            // $this->generateCoaDraft($labref);
        }
	}

    function saveCOAuto($labref) {
       

     
            $testid_array = $this->input->post('tests');

            $method1_array = array();
            $compedia1_array = array();
            $specification1_array = array();
            $determined_array = array();
            $complies1_array = array();


            $temp_array1 = array();
            $temp_array2 = array();
            $temp_array3 = array();
            $temp_array4 = array();
            $temp_array5 = array();

            $count = 0;           

            foreach ($testid_array as $temp_array) {

                $temp_array1 = $this->input->post('determined_' . $count);
                $temp_array2 = $this->input->post('method_' . $count);
                $temp_array3 = $this->input->post('compedia_' . $count);
                $temp_array4 = $this->input->post('specification_' . $count);
                $temp_array5 = $this->input->post('complies_' . $count);


                $method1_array[$temp_array] = implode(':', $temp_array2);
                $compedia1_array[$temp_array] = implode(':', $temp_array3);
                $specification1_array[$temp_array] = implode(':', $temp_array4);
                $determined_array[$temp_array] = implode(':', $temp_array1);
                $complies1_array[$temp_array] = implode(':', $temp_array5);
                $count++;
            }


            foreach ($testid_array as $testid) {

                $update_data = array(
                    'method' => $method1_array[$testid],
                    'compedia' => $compedia1_array[$testid],
                    'specification' => $specification1_array[$testid],
                    'determined' => $determined_array[$testid],
                    'complies' => $complies1_array[$testid],
                    'conclusion' => $this->input->post('conclusion'),
                    'row_number' => ''
                );




                   $this->db
                         ->where('labref', $labref)
                         ->where('test_id', $testid)
                         ->update('coa_body', $update_data);
             
            }
           


            $this->send_to_signature($labref);
            $this->saveCOATOP($labref);        
         
        } 
    
    

    function rows_update($labref) {
        $r_num = $this->input->post('table_row');
        for ($i = 0; $i < count($r_num); $i++) {
            $update = array('row_number' => $r_num[$i]);
            var_dump($update);
            $this->db->where('labref', $labref[$i])->update('coa_body', $update);
        }
    }

    function deletetest($labref, $tid) {
        $this->db->where('labref', $labref)->where('test_id', $tid)->delete('coa_body');
        $this->db->where('request_id', $labref)->where('test_id', $tid)->delete('request_details');
    }

    function saveCOANT($labref) {

        $update_data = array(
            'test_id' => $this->input->post('test_1'),
            'method' => $this->input->post('method_1'),
            'compedia' => $this->input->post('compendia_1'),
            'specification' => $this->input->post('specification_1'),
            'determined' => $this->input->post('determined_1'),
            'complies' => $this->input->post('remarks_1'),
            'labref' => $labref
        );

        $update_data2 = array(
            'test_id' => $this->input->post('test_1'),
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
            'limits' => '',
            'analyst_id' => '0',
            'request_id' => $labref
        );


        $this->db->insert('coa_body', $update_data);
      //  $this->db->insert('request_details', $update_data2);
    }

    function saveClient($id) {

        $update_data = array(
            'name' => $this->input->post('c_name'),
            'address' => $this->input->post('c_address')
        );


        $this->db->where('id', $id)->update('clients', $update_data);
    }

    function do_audit_update($labref) {
        $r = $this->max_revision($labref);
        $rev_id = $r[0]->r;
        $current_user = $this->getPerson();
        $name = $current_user[0]->title . " " . $current_user[0]->fname . " " . $current_user[0]->lname;

        $this->db->where('labref', $labref)
                ->where('revision', $rev_id)
                ->update('coa_body_audit', array('by_who' => $name));
        echo 'Person Updated';
    }

    function audit_trail($labref) {
        $data['audit'] = $this->show_coa_audit_trail($labref);
        $data['labref'] = $labref;
        $this->load->view('audit_trail', $data);
    }

    function show_coa_audit_trail($labref) {
        return $this->db->query("SELECT c.*,t.name as test_name FROM coa_body_audit c, tests t WHERE t.id=c.test_id AND c.labref='$labref' ")->result();
    }

    function max_revision($labref) {
        $rew = $this->db->query("SELECT MAX(revision) AS r FROM coa_body_audit WHERE labref='$labref'")->result();
        return $rew;
    }

    function send_to_signature($labref) {
        $segment2 = $this->uri->segment(4);

        if ($segment2 == 'coa_draft' || $segment2 == 'coa_director' || $segment2 == 'coa_printing') {
            echo 'No saving needed!';
        } else {

            $this->db->where('labref', $labref)->delete('signature_table');
            $designation = $this->input->post('designation');
            $designator = $this->input->post('designator');
            $date = $this->input->post('date');

            for ($i = 0; $i < count($date); $i++) {
                $array = array(
                    'labref' => $labref,
                    'designation' => $designation[$i],
                    'signature_name' => $designator[$i],
                    'sign' => '',
                    'date_signed' => $date[$i]
                );
                $this->db->insert('signature_table', $array);
            }
        }
    }

    function coaLabrefAJAX() {
        echo json_encode($this->db->select('labref')->group_by('labref')->get('coa_body')->result());
    }

    function makeCopy($current, $proposed) {
        if (file_exists('printed_coa/' . $current . '.docx')):
            unlink('printed_coa/' . $proposed . '.docx');
            copy('printed_coa/' . $current . '.docx',  $proposed . '.docx');

            $word = new Wordexe();
            $word->loadFindReplace($current, $proposed);
            $coaBat = fopen('batfiles/' . $proposed . '.bat', 'w');
            $command = "start \\\\192.168.1.140\\nqcl\\$proposed.docx";
            fwrite($coaBat, $command);
            fclose($coaBat);


            echo 'Draft successfully replicated';

        else:
            echo 'Current DRAFT has not been generated, Kindly complete that task first';
        endif;
    }

    function send_to_signatureAJAX($labref) {



        $designation = $this->input->post('designation');
        $designator = $this->input->post('designator');
        $date = $this->input->post('date');


        $array = array(
            'labref' => $labref,
            'designation' => $designation,
            'signature_name' => $designator,
            'sign' => '',
            'date_signed' => $date
        );
        $this->db->insert('signature_table', $array);
    }

    function remove_signatory($id) {
        $this->db->where('id', $id)->delete('signature_table');
    }

    public function getPerson() {
        $user_id = $this->session->userdata('user_id');
        $this->db->select("title,lname, fname");
        $this->db->where('id', $user_id);
        $query = $this->db->get('user');
        return $result = $query->result();
    }

    function updateCOATracking() {
        
    }

    function GetProcAutocomplete($options = array()) {
        $this->db->distinct();
        $this->db->select('name');
        $this->db->like('name', $options['name'], 'after');
        $query = $this->db->get('proc_suggestions');
        return $query->result();
    }

    function method_suggestions() {

        $term = $this->input->post('term', TRUE);

        $rows = $this->GetProcAutocomplete(array('name' => $term));

        $keywords = array();
        foreach ($rows as $row)
            array_push($keywords, $row->name);

        echo json_encode($keywords);
    }

    function saveCOATOP($labref) {

        $data = array(
            'manufacturer_name' => $this->input->post('manufacturer'),
            'product_name' => $this->input->post('product_name'),
            'presentation' => $this->input->post('presentation'),
            'manufacturer_add' => $this->input->post('address'),
            'label_claim' => $this->input->post('labelclaim'),
            //'designation_date' => $this->input->post('date_received'),
            'batch_no' => $this->input->post('batch_no'),
            'manufacture_date' => $this->input->post('mnfg_date'),
            'exp_date' => $this->input->post('exp_date'),
            'clientsampleref' => $this->input->post('client_ref'),
            //'CAN' => $this->input->post('co_num')
        );
        $this->db->where('request_id', $labref)->update('request', $data);
    }
    
    function ChangeLog($labref){
        $data = $this->db->query("SELECT cl.*, t.name, CONCAT(u.title,' ',u.fname ,' ',u.lname) user FROM coa_changelog cl, tests t, user u WHERE cl.user = u.id AND cl.test_id=t.id AND cl.labref='$labref' ")->result();
        if($data):
            echo json_encode($data);
        else:
            echo '[]';
        endif;
    }

    function coaIsDraftedUpdate($labref) {
        $user = $this->getUsersInfo();
        $person = $user[0]->title . ". " . $user[0]->fname . " " . $user[0]->lname;
        $id = $this->session->userdata('user_id');
        $coaUpdate = array('coa_status' => '1');
        $this->db->where('labref', $labref);
        $this->db->update('reviewer_documentation', $coaUpdate);

        $this->db->where('labref', $labref);
        $this->db->where('activity', 'Draft COA');
        $this->db->update('sample_details', array('date_returned' => date('Y-m-d'), 'by' => $person, 'user_id' => $id));
    }

    function getCOABody($labref) {
        $this->db->where('labref', $labref);
        $query = $this->db->get('coa_body');
        $result = $query->result();
        return $result;
        //print_r($result);
    }

    function checkIfCOABodyExists($labref) {
        $this->db->select('labref');
        $this->db->where('labref', $labref);
        $query = $this->db->get('coa_body');
        if ($query->num_rows() > 0) {
            return '1';
        } else {
            return '0';
        }
    }
	
	function checkIfExistsInvoiceTable($labref) {
        $this->db->select('lab_ref_no');
        $this->db->where('lab_ref_no', $labref);
        $query = $this->db->get('invoice');
        if ($query->num_rows() > 0) {
            return '1';
        } else {
            return '0';
        }
    }

    function generateCoaDraft($labref, $offset = 0) {
        // error_reporting(1);
        $data['labref'] = $labref = $this->uri->segment(3);
        $data['information'] = $this->getRequestInformation($labref);
        $data['tests_requested'] = $this->getRequestedTests($labref);
        $data['trd'] = $this->getRequestedTestsDisplay2($labref);
        $data['coa_details'] = $this->getAssayDissSummary($labref);
        $data['signatories'] = $this->getSignatories($labref);
        $data['compedia_specification'] = $this->getCOABody($labref);
        $data['conclusion'] = $this->salvageConclusion($labref);
        $data['coa_number'] = $this->salvageCOANumbering();
        $html = $this->load->view('coa_v_2', $data, true);
        $this->dompdf_lib->createPDF($html, $labref);
    }

    function makeCoaSecondPart($labref) {
        $cd = $this->getCOABody($labref);
        for ($i = 0; $i < count($cd); $i++) {
            echo $cd[$i]->compedia;
        }
    }

    function getRequestInformation($labref) {
        $this->db->from('request r');
        $this->db->join('clients c', 'r.client_id = c.id');
        $this->db->where('r.request_id', $labref);
        $this->db->limit(1);
        $query = $this->db->get();
        $Information = $query->result();
        return $Information;
    }

    function getRequestInformationAJAX($labref) {
        $this->db->from('request r');
        $this->db->join('clients c', 'r.client_id = c.id');
        $this->db->where('r.request_id', $labref);
        $this->db->limit(1);
        $query = $this->db->get();
        $Information = $query->result();
        echo json_encode($Information);
    }

    function getRequestedTestsAJAX($labref) {
        $this->db->select('t.name, rd.id');
        $this->db->from('tests t');
        $this->db->join('request_details rd', 't.id=rd.test_id');
        $this->db->where('rd.request_id', $labref);
        $this->db->order_by('rd.index_id', 'asc');

        $query = $this->db->get();
        $result = $query->result();
        $output = array_map(function ($object) {
            return $object->name;
        }, $result);

        $tests = implode(', ', $output);
        echo json_encode($replaced = $this->replace_last($tests, ', ', ' & '));
    }

    function getRequestedTestsAJAXRe($labref) {
        $this->db->select('t.name, rd.id, rd.test_id');
        $this->db->from('tests t');
        $this->db->join('request_details rd', 't.id=rd.test_id');
        $this->db->where('rd.request_id', $labref);
        $this->db->order_by('rd.index_id', 'asc');
        $query = $this->db->get();
        $result = $query->result();
        echo json_encode($result);
    }

    function getRequestedTestsDisplayAJAX($labref) {
        $query = $this->db->query("SELECT rd.index_id, rd.test_id,t.name, c.* FROM coa_body c JOIN request_details rd ON c.labref = rd.request_id JOIN tests t ON c.test_id = t.id AND rd.test_id = c.test_id WHERE c.labref='$labref' ORDER BY rd.index_id ");
        $result = $query->result();
        echo json_encode($result);


        // print_r($result);
    }

    function getSignatoriesAJAX($labref) {
        $this->db->where('labref', $labref);
        $this->db->group_by('signature_name', $labref);
        $this->db->order_by('id', 'asc');
        $query = $this->db->get('signature_table');
        $result = $query->result();
        echo json_encode($result);
    }

    function updateQuestionOrder() {
        $list = $this->input->post('list');
        $output = array();
        parse_str($list, $output);
        $i = 0;
        foreach ($output['testReorder'] as $qid):
            $this->db->where('id', $qid)->update('request_details', array('index_id' => $i));
            $i++;
        endforeach;
    }

    function getRequestedTests($labref) {
        $this->db->select('name');
        $this->db->from('tests t');
        $this->db->join('request_details rd', 't.id=rd.test_id');
        $this->db->where('rd.request_id', $labref);
        $this->db->order_by('name', 'desc');
        $query = $this->db->get();
        $result = $query->result();
        $output = array_map(function ($object) {
            return $object->name;
        }, $result);

        $tests = implode(', ', $output);
        return $replaced = $this->replace_last($tests, ', ', ' and ');
    }

    function replace_last($haystack, $needle, $with) {
        $pos = strrpos($haystack, $needle);
        if ($pos !== FALSE) {
            $haystack = substr_replace($haystack, $with, $pos, strlen($needle));
        }
        return $haystack;
    }

    function getRequestedTestIds($labref) {
        $this->db->select('test_id');
        $this->db->from('coa_body');
        //$this->db->join('request_details rd', 't.id=rd.test_id');
        $this->db->where('labref', $labref);
        $query = $this->db->get();
        $result = $query->result();
        return $result;
        // print_r($result);
    }

    function getRequestedTestsDisplay($labref) {
        $this->db->select('name');
        $this->db->from('tests t');
        $this->db->join('request_details rd', 't.id=rd.test_id');
        $this->db->where('rd.request_id', $labref);
        $query = $this->db->get();
        $result = $query->result();
        return $result;
    }

    function getRequestedTestsDisplay2($labref) {
        $query = $this->db->query("SELECT  t.id as test_id, cb.method AS methods,`name` , `compedia`,`determined` , `specification`,complies,cb.id
                                 FROM (
                                       `tests` t, `coa_body` cb
                                       )
                                JOIN `request_details` rd ON `t`.`id` = `cb`.`test_id`
                                WHERE `rd`.`request_id` = '$labref'
                                AND cb.labref = '$labref'
                                GROUP BY name
                                ORDER BY name DESC
                                LIMIT 0 , 30");
        $result = $query->result();
        // print_r($result);

        return $result;
        // print_r($result);
    }

    function salvageConclusion($labref) {
        $this->db->select('conclusion');
        $this->db->where('labref', $labref);
        $this->db->group_by('labref');
        $query = $this->db->get('coa_body');

        return $result = $query->result();
        //print_r($result);
    }

    function salvageCOANumbering() {
        $this->db->select('number');
        $query = $this->db->get('coa_number');
        return $result = $query->result();
        //print_r($result);
    }

    function getAssayDissSummary($labref) {
        $this->db->where('labref', $labref);
        $query = $this->db->get('coa_body');
        $result = $query->result();
        // print_r($result);
        return $result;
    }

    function getSignatories($labref) {
        $this->db->where('labref', $labref);
        $this->db->group_by('signature_name', $labref);
        $this->db->order_by('id', 'asc');
        $query = $this->db->get('signature_table');
        return$result = $query->result();
        // print_r($result);
    }

    public function base_params($data) {
        $labref = $this->uri->segment(3);
        $data['title'] = "COA - " . $labref;
        $data['styles'] = array("jquery-ui.css");
        $data['scripts'] = array("jquery-ui.js");
        $data['scripts'] = array("SpryAccordion.js");
        $data['styles'] = array("SpryAccordion.css");
        $data['content_view'] = "settings_v";
        //$data['banner_text'] = "NQCL Settings";
        //$data['link'] = "settings_management";

        $this->load->view('template', $data);
    }

}
?>

