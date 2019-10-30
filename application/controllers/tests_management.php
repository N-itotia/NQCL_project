<?php
	class Tests_management extends MY_Controller {
		public function methods(){
			//$reqid = $this -> uri -> segment(3);
			$test_id = $this -> uri -> segment(3);
			$data['methods']= Test_methods::getMethods($test_id);
			$data['content_view'] = "methods_v";
			$this -> load -> view('template1', $data);
			
		}

		public function testsMethodsWizard1(){
			$data['reqid'] = $this -> uri -> segment(3);
			$data['sample_info'] = Request::getSampleInfoSimple($data['reqid']);
			$data['tests'] = Tests::getTestsPerRequest($data['reqid']);
			$data['content_view'] = "tests_methods_wizard_v";
			$this -> load -> view('template1', $data);
		}


		public function testsMethodsWizard(){
			
			//get table names from uri segments 
		    $data['table'] = $table1 = $this -> uri -> segment(4);
		    $data['table2'] = $table2 = $this -> uri -> segment(5);
		   	$data['table3'] = $table3 = $this -> uri -> segment(6);
		    $data['reqid'] = $this -> uri -> segment(3);

		    //Get Client_id
		    $data['client_id'] = $c = $this -> uri -> segment(8);


		    //construct methods from table names from uri segments
		    $method1 = 'get'.ucfirst($table1).'InfoSimple';
		 	$method2 = 'get'.ucfirst($table2).'Per';
		   	

		   	//Get Currency
		   	$c = $table1::getCurrency($data['reqid']);
		   	$currency = $data['currency'] = $c[0]['Currency'];

		   	//Get title of fee attached to currency
		   	$data['charge'] = 'charge_'.strtolower($currency);

		 	//construct table name from uri segments
			if($table1 == 'request'){
				$table4  = 'invoice_components';
			}
			else{
				$table4 = $table1."_components";
			}
		   	 

		   	//construct method to get components
		   	$method3 = 'get'.ucfirst($table4);

			//Get column to use to do where clause
		   	$ref = $table1.'_id';

			//get data from tables
			$data['sample_info'] = $table1::$method1($data['reqid']);
			$data['tests'] = $table2::$method2($data['reqid'], $table3, $ref);
			$data['components'] = $table4::$method3($data['reqid'], $ref);
			$data['components_count'] = count($data['components']);
			$data['mc_tests'] = $this->getMulticTests();
			$data['compendia'] = Compendia::getAll();
			//Var_dump 
			//echo $table2."::".$method2."(".$data['reqid'].",".$table3.",".$ref.")";
			//var_dump($data['tests']);
			//pass data to view
			$data['content_view'] = "tests_methods_wizard_v";
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
		
		
		public function checkIfInvoiceBillingEntryExists($reqid, $method_id){
			$ib = Invoice_billing::checkEntry($reqid, $method_id);
			if($ib){
				return true;
			}
			return false;
		}
		
		
		public function updateClientBilling(){
			if (is_null($_POST)) {
				echo json_encode(array(
					'status' => 'error',
					'message'=> 'Data was not posted.'
					));
				}
				else {
				echo json_encode(array(
					'status' => 'success',
					'message'=> 'Data added successfully',
				));
			}

			//Initialize Charges arrays
			$test_charges = array();
			$method_charges = array();

			//Get request id
			$reqid = $this -> uri -> segment(3);
			$table = $this -> uri -> segment(4);
			$client_id = $this -> uri -> segment(5);
			
			//Condition to set table, method variables
			if($table == 'request'){
			
				//Client reference field
				$client_ref = 'client_id';

				//Other fields unique depending on whether invoice or quotation being raised
				$id = 'request_id';
				$billing_table = 'invoice_billing';
				$register = 'dispatch_register';
				$main_table = 'request';
				$components_table = "invoice_components";
				$ref = $main_table.'_id';
				$status = 'invoice_status';
				$no_of_batches = 1;
			}
			else if($table == 'quotations'){
				
				//Client reference field
				$client_ref = 'client_number';
				
				//Other fields unique depending on whether invoice or quotation being raised
				$id = 'quotations_id';
				$billing_table = 'q_request_details';
				$register = 'quotations';
				$main_table = $register;
				$components_table = $main_table."_components";
				$ref = $register.'_id';
				$status = 'quotation_status';
				$quotation_details = Quotations::getQuotationParameters($reqid);
				$no_of_batches = $quotation_details[0]['No_of_batches'];

				//Get general quotation id
				$qid = $quotation_details[0]['Quotation_id'];
			}
			
			//Capitalize main table and billing_table variables, make them classes
			$main_table_class = ucfirst($register);
			$billing_table_class = ucfirst($billing_table);
			$components_table_class = ucfirst($components_table);

			var_dump($ref);
			
			//Get Currency
			$c = $main_table_class::getCurrency($reqid);
			if($c[0]['Currency']){
				$currency = $c[0]['Currency'];				
			}
			else{
				//Default currency
				$currency = 'KES';
			}

			//var_dump($c);
			
			//$this->output->enable_profiler(TRUE);

			//Currency in small letters
			$cr = strtolower($currency);

			//Get POST values
			$tests = $this -> input -> post('tests', TRUE);			
			$compendia = $this -> input -> post('compendia', TRUE);


			//Capitalize components table variable, make as class
			$components_table_class = ucfirst($components_table);

			//Get components method
			$components_method = 'get'.$components_table_class;

			//Get component ids from components table
			$components = $components_table_class::$components_method($reqid, $ref);
			
			//Array to hold component specific method charges
			$method_charges_components = array();
			$component_methods = array();
			$multi = array();
			
			
			//Get multicomponent tests
			$multi_tests = $this->getMulticTests();

			//Loop through all batches, updating each with method charges
			for($b=1;$b<=$no_of_batches;$b++){ 
				
				if($table == 'quotations'){
					$reqid = $qid."-".$b;
				}
				else{
					$reqid = $reqid;
				}

			if(count($components) > 1){
				
				for($i=0;$i<count($tests);$i++){


						//Get post name for compendia
						$compendia_post_name  = "compendia_".$tests[$i];
						$compendium = $this->input->post($compendia_post_name);

						//Update compendia
						$this->db->where(array('test_id' => $tests[$i]));
						$this->db->update($billing_table, array('compendia_id'=>$compendium));

						//Get Method Post Name for Assay
						$method_post_name2 = "methods_".$tests[$i];
						$method = $this -> input -> post($method_post_name2);
					
						if(in_array($tests[$i], $multi_tests)){
					
							//Update quotation components ,Loop through components
							foreach($components as $component){

								//Get Method Post Name for Assay
								$method_post_name = "methods_".str_replace(' ', '_', $component['component'] )."_".$tests[$i];
								$method2 = $this -> input -> post($method_post_name);

								//If method is not null then get Method Details
								if($method2 != 0){
									
									$method_details = Test_methods::getMethodDetails($method2);
									//$mcharges = $method_details[0]['charge'];
									//array_push($method_charges_components, $method_details[0]['charge']);
									$mcharges = $method_details[0]['charge_'.$cr];
									//array_push($method_charges_components, $method_details[0]['charge_'.$cr]);
									
									array_push($component_methods, $method2);
									array_push($multi, $tests[$i]);
									$method_charges_components[$method2] = $method_details[0]['charge_'.$cr];
									
								}
								else{
									var_dump($method_charges_components);
									$mcharges = 0;
									echo 'empty method2';
								}

									//Update Arrays
									$cb_where_array = array('test_id' => $tests[$i], 'component' => $component['component']);
									$cb_update_array = array('method_charge' => $mcharges , 'method_id' => $method2);

									//Update quotation_components
									$this -> db -> where($cb_where_array);
									$this -> db -> update($components_table, $cb_update_array);

								}
								
								$mtotal = array($tests[$i] => []);
								
								
								foreach($component_methods as $m){
									array_push($mtotal[$tests[$i]], $method_charges_components[$m]);
								}
								
								foreach($multi as $m){
									if($m == $tests[$i]){
										$mt[$tests[$i]] = array_sum($mtotal[$m]);
									}
								}
								//$mt[$tests[$i]] = array_sum($mtotal[$tests[$i]]);
								//var_dump($mt[$tests[$i]]);
								
						}

						//Get Method Post Name for Non-multicomponent tests 
						$method_post_name2 = "methods_".$tests[$i];
						$method = $this -> input -> post($method_post_name2);
						
						//Get test details
						$test_details_main = Tests::getCharges($tests[$i]);
						$test_details = Test_methods::getCharges($method, $tests[$i]);
						


						//Check details of the test charges
						var_dump($test_details);
						
						if($this->checkIfInvoiceBillingEntryExists($reqid, $tests[$i]) == true){
						
							//Get total for each test's components
							$components_total = $components_table::getComponentsTotal($reqid, $tests[$i]);
											
							//Begin and end transcation to serialize order of db update otherwise second overwrites first.
							//Update main billing table with test's component totals
							$this -> db -> trans_start();
							$this -> db -> where(array('test_id'=>$tests[$i], $ref => $reqid));
							$this -> db -> update($billing_table, array('method_id'=> NULL,'method_charge'=>$components_total[0]['component_total']));
							$this -> db -> trans_complete();
						
							//Update Non-multicomponent test							
							if(!in_array($tests[$i], $multi_tests)){
								$this -> db -> trans_start();
								$this -> db -> where(array('test_id'=>$tests[$i], $ref => $reqid));
								$this -> db -> update($billing_table, array('method_id'=>$method,'method_charge'=>$test_details[0]['charge_'.$cr]));
								$this -> db -> trans_complete();
							}	
						}
						else {

						//Check if is an invoice or a quotation
						if($table == 'invoice'){
							$ib = new Invoice_billing();
							$ib->request_id = $reqid;
							$ib->client_id = $client_id;
							$ib->test_id = $tests[$i];
							$ib->method_id = $method;
							if(!in_array($tests[$i], $multi_tests)){
							$ib->method_charge = $test_details[0]['charge_'.$cr];
							}
							if (!empty($test_details_main)) {
								$ib->test_charge = $test_details_main[0]['Charge_'.$cr];
							}
							$ib->save();
						}
						else if ($table == 'quotations'){
							//If table is quotations then update billing table accordingly
							//Get total for each test's components
							$components_total = $components_table::getComponentsTotal($reqid, $tests[$i]);
											
							//Begin and end transcation to serialize order of db update otherwise second overwrites first.
							//Update main billing table with test's component totals
							$this -> db -> trans_start();
							$this -> db -> where(array('test_id'=>$tests[$i], $ref => $reqid));
							$this -> db -> update($billing_table, array('method_id'=> NULL,'method_charge'=>$components_total[0]['component_total']));
							$this -> db -> trans_complete();
						
							//Update Non-multicomponent test							
							if(!in_array($tests[$i], $multi_tests)){
								$this -> db -> trans_start();
								$this -> db -> where(array('test_id'=>$tests[$i], $ref => $reqid));
								$this -> db -> update($billing_table, array('method_id'=>$method,'method_charge'=>$test_details[0]['charge_'.$cr]));
								$this -> db -> trans_complete();
							}	

						}
						
					}
				}
			}
			
			else{

				//Update client billing
				for($i=0;$i<count($tests);$i++){

					//Get post name for compendia
					$compendia_post_name  = "compendia_".$tests[$i];
					$compendium = $this->input->post($compendia_post_name);

					//Update compendia
					$this->db->where(array('test_id' => $tests[$i]));
					$this->db->update($billing_table, array('compendia_id'=>$compendium));	

					//Get Method Post Name	
					$method_post_name = "methods_".$tests[$i];
					$method = $this -> input -> post($method_post_name);
					
					//Get method 
					var_dump($method);

					//If method is not null then get Method Details
					if($method != 0){
						//var_dump($method);
						$method_details = Test_methods::getMethodDetails($method);

						//$mcharges = $method_details[0]['charge'];
						//array_push($method_charges, $method_details[0]['charge']);
						$mcharges = $method_details[0]['charge_'.$cr];
						array_push($method_charges, $method_details[0]['charge_'.$cr]);
					}
					else{
						echo $method;
						$mcharges = 0;
					}

					//Get test details
					$test_details = Tests::getCharges($tests[$i]);
					
					//Update Arrays
					$cb_where_array = array($id => $reqid, 'test_id' => $tests[$i]);
					$cb_update_array = array('method_charge' => $mcharges , 'method_id' => $method);

					//var_dump($cb_where_array);
					//echo $billing_table;
					//var_dump($cb_update_array);
					
					
					/*Check if this entry exists in the invoice billing table
					* if entry does not exist, add it to enable invoice processing
					*/				
					
					if($this->checkIfInvoiceBillingEntryExists($reqid, $method) == true){

						//Update Client Billing
						$this -> db -> where($cb_where_array);
						$this -> db -> update($billing_table, $cb_update_array);
					}
					else {

						echo 'test';
						
						if($table == 'invoice'){
							$ib = new Invoice_billing();
							$ib->request_id = $reqid;
							$ib->client_id = $client_id;
							$ib->test_id = $tests[$i];
							$ib->method_id = $method;
							$ib->method_charge = $mcharges;
							if (!empty($test_details)) {
								$ib->test_charge = $test_details[0]['Charge_'.$cr];
							}
							$ib->save();
						}
						else if($table == 'quotations'){
							//Update Client Billing
							$this -> db -> where($cb_where_array);
							$this -> db -> update($billing_table, $cb_update_array);
						}
					}

					var_dump($test_details);

					//Profile queries
					$this-> output -> enable_profiler(true);
					
					//Push method charges into initialized array
					array_push($test_charges, $test_details[0]['Charge_'.$cr]);
				}
			}
					
			
			if(count($components) < 2){
				//Get Totals
				$method_totals = array_sum($method_charges);
				$test_totals = array_sum($test_charges);
				$total_charges = $method_totals + $test_totals;

				//Determine if request made from quotation or request , do discount

				if($main_table == 'request'){
					
					//Get Discount for this client
					$disc = Clients::getDiscountPercentage($client_id);
					
					if(!empty($disc)){
						$discount_percentage = $disc[0]['discount_percentage'];
					}
					else{
						$discount_percentage = 0;
					}
					
					//Compute Discounted amount
					$discount = $total_charges * $discount_percentage/100;

					//Discounted amount
					$discounted_amount = $total_charges - $discount;
				}
				else{
					$discounted_amount = $total_charges;
					$discount = 0;
				}


				//Update Dispatch register
				$quotation_status = 1;
				$dr_update_array = array('amount' => $discounted_amount, 'discount' => $discount, $status => 1);
				$this -> db -> where($id, $reqid);
				$this -> db -> update($register, $dr_update_array);

				//Update Main Table
				$main_update_array = array($status => 1 );
				$this -> db -> where($id, $reqid);
				$this -> db -> update($main_table, $main_update_array);
				
				
				/*Get no. of entries
				$qn = Quotations::getQuotationNumber2($reqid);
				$entries = Quotations::getNoOfEntries($qn[0]['Quotation_no']);
				$no_of_entries_done = $entries[0]['Quotation_entries_done'] + 1;
				var_dump($entries);
				*/
				if($main_table == "quotation"){
					
					$completion_status = 1;
					
					//Update no. of entries done
					$entries_update_array = array('Completion_status' => $completion_status);
					$this -> db -> where($id, $reqid);
					$this -> db -> update($main_table, $entries_update_array);
				}
				
			}
			else{

			}

		}	
			
		
		}

	}
?>