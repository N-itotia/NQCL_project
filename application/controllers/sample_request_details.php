<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Sample_request_details extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('excel');
    }

    function generate2($start = '', $end = '') {
	     unlink("sample_report/Report.xlsx");

        if ($start == '' && $end == '') {
            $q2 = "SELECT * FROM tracker ORDER BY id DESC";
        } else {
            $q2 = "SELECT * FROM tracker WHERE designation_date_1 BETWEEN '$start' AND '$end' ORDER BY id DESC";
        }
		
		
		
		
		



        $this->db->query("DROP VIEW IF EXISTS tracker CASCADE");
        $query2 = ("CREATE VIEW tracker AS SELECT r.id, r.request_id, r.product_name,r.batch_no, c.name,r.designation_date_1 FROM request r LEFT OUTER JOIN clients c ON c.id =r.client_id ORDER BY r.id DESC" );
        $this->db->query($query2);
        $request = $this->db->query($q2)->result();

        $objReader = PHPExcel_IOFactory::createReader('Excel2007');
        $objPHPExcel = $objReader->load("sample_report/sample_template.xlsx");
        $objPHPExcel->getActiveSheet(0);
        $worksheet = $objPHPExcel->getActiveSheet();

        $row2 = 3;

        foreach ($request as $s) {
            $col = 0;
            $col2 = 3;
            $worksheet
                    ->setCellValueByColumnAndRow($col, $row2++, $s->request_id)
                    ->setCellValueByColumnAndRow(1, $row2 - 1, $s->batch_no . ' || ' . $s->product_name . ' || ' . $s->name)
                    ->setCellValueByColumnAndRow($col, $row2++, $s->designation_date_1);


            $res = $this->getTracking2($s->request_id);

            foreach ($res as $r) {
                //$worksheet->setCellValueByColumnAndRow($col2++, $row2, $r->activity);
                $worksheet
                        ->setCellValueByColumnAndRow($col2++, $row2, $r->date_added);
            }
        }

        $objPHPExcel->getActiveSheet()->setCellValue('D5', "=COUNTIF(B2:B30000,\"*Issuing*\")");
        $objPHPExcel->getActiveSheet()->setCellValue('D7', "=COUNTIF(B2:B30000,\"*CAN No.*\")");
        $objPHPExcel->getActiveSheet()->setCellValue('D9', "$start to $end");
        $objPHPExcel->getActiveSheet()->setTitle('Request Samples- ' . date('Y'));
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->setPreCalculateFormulas(false);
        $objWriter->save("sample_report/Report.xlsx");
        echo 'Completed';
    }
	
	function getTracking2($criteria){
	  return $this->db->query($criteria)->result();	
	}

    function generate($start = '', $end = '',$r1) {
          unlink("sample_report/Report.xlsx");
        $this->initializeData();
		$add = $this->input->post('R1');
		if($r1==''){
			$query = " WHERE designation_date_1 BETWEEN '$start' AND '$end'  AND request_id NOT LIKE '%r1'";
		}else if($r1=='r1'){
			$query = " WHERE designation_date_1 BETWEEN '$start' AND '$end' ";
		}else{
			
		}
        
        if ($start == '' && $end == '') {
            $criteria = " SELECT * FROM ftrack ORDER BY id DESC";
        } else {
           echo $criteria = "SELECT * FROM ftrack $query ORDER BY id DESC ";
		 
        }


        $objReader = PHPExcel_IOFactory::createReader('Excel2007');
        $objPHPExcel = $objReader->load("sample_report/sample_template2.xlsx");
        $objPHPExcel->getActiveSheet(0);
        $signatories = $this->getTracking($criteria);

        $worksheet = $objPHPExcel->getActiveSheet();
        $styleArray = array(
            'borders' => array(
                'outline' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THICK,
                    'color' => array('argb' => 'FFFF0000'),
                ),
            ),
        );
        $row2 = 3;

        foreach ($signatories as $signatures):
            $col = 0;
            $worksheet
                    ->setCellValueByColumnAndRow($col++, $row2, $signatures->request_id)
                    ->setCellValueByColumnAndRow($col++, $row2, $signatures->clientname)
                    ->setCellValueByColumnAndRow($col++, $row2, $signatures->product_name)
                    ->setCellValueByColumnAndRow($col++, $row2, $signatures->batch_no)
                    ->setCellValueByColumnAndRow($col++, $row2, $signatures->active_ing)
                    ->setCellValueByColumnAndRow($col++, $row2, $signatures->manufacturer_name)
                    ->setCellValueByColumnAndRow($col++, $row2, $signatures->exp_date)
                    ->setCellValueByColumnAndRow($col++, $row2, $signatures->exp_date)
                    ->setCellValueByColumnAndRow($col++, $row2, $signatures->presentation)
                    ->setCellValueByColumnAndRow($col++, $row2, $signatures->designation_date_1)
                    ->setCellValueByColumnAndRow($col++, $row2, $signatures->ISS)
                    ->setCellValueByColumnAndRow($col++, $row2, $signatures->RBS)
                    ->setCellValueByColumnAndRow($col++, $row2, $signatures->SWFR)
                    ->setCellValueByColumnAndRow($col++, $row2, $signatures->SCDR)
                    ->setCellValueByColumnAndRow($col++, $row2, $signatures->DSTD)
                    ->setCellValueByColumnAndRow($col++, $row2, $signatures->DDSD)
                    ->setCellValueByColumnAndRow($col++, $row2, $signatures->CANo);


            $row2++;
        endforeach;


        $objPHPExcel->getActiveSheet()->setTitle('Request Samples- ' . date('Y'));
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save("sample_report/Report.xlsx");


        echo 'Data exported';
    }
	
	
	
	
	  function generate_two() {
          unlink("sample_report/Report2.xlsx");
		  
		  $year = $this->input->post('year');
		  $activity = $this->input->post('activity');
		  $criteria = "";		 
		  
		  if(empty($activity)){
			 $criteria = "SELECT * FROM  vw_sample_turnaround WHERE YEAR(received)='$year'";  
		  }else{
			 $criteria = "SELECT * FROM  vw_sample_turnaround WHERE activity='$activity' AND YEAR(received)='$year'";   
		  }
		  
       
	   $objReader = PHPExcel_IOFactory::createReader('Excel2007');
        $objPHPExcel = $objReader->load("sample_report/sample_template3.xlsx");
        $objPHPExcel->getActiveSheet(0);
        $signatories = $this->getTracking($criteria);

        $worksheet = $objPHPExcel->getActiveSheet();
        $styleArray = array(
            'borders' => array(
                'outline' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THICK,
                    'color' => array('argb' => 'FFFF0000'),
                ),
            ),
        );
        $row2 = 3;

        foreach ($signatories as $signatures):
            $col = 0;
            $worksheet
                    ->setCellValueByColumnAndRow($col++, $row2, $signatures->request) 
                    ->setCellValueByColumnAndRow($col++, $row2, $signatures->client)					
                    ->setCellValueByColumnAndRow($col++, $row2, $signatures->product_name)
                    ->setCellValueByColumnAndRow($col++, $row2, $signatures->batch) 
					->setCellValueByColumnAndRow($col++, $row2, $signatures->received) 
					->setCellValueByColumnAndRow($col++, $row2, $signatures->activity)
					->setCellValueByColumnAndRow($col++, $row2, $signatures->coa_no)
					->setCellValueByColumnAndRow($col++, $row2, $signatures->issue_date)
					->setCellValueByColumnAndRow($col++, $row2, $signatures->coa_date)
					->setCellValueByColumnAndRow($col++, $row2, $signatures->days_taken)
					->setCellValueByColumnAndRow($col++, $row2, $signatures->turn_around);
               


            $row2++;
        endforeach;


        $objPHPExcel->getActiveSheet()->setTitle('Request Samples- ' . date('Y'));
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save("sample_report/Report2.xlsx");


        echo 'Data exported';
    }

    function initializeData() {

        $this->db->query("DROP VIEW IF EXISTS track");
        $this->db->query("DROP VIEW IF EXISTS ftrack");
        $this->db->query("CREATE VIEW track AS 
                                SELECT labref, 
                                      MAX(CASE WHEN activity='Issuing' THEN date_added ELSE '-' END) AS 'ISS', 
                                      MAX(CASE WHEN activity='Returning to Supervisor' THEN date_added ELSE '-' END) AS 'RBS', 
                                      MAX(CASE WHEN activity='Assigning for worksheet Review' THEN date_added ELSE '-' END) AS 'SWFR', 
                                      MAX(CASE WHEN activity='Assigning COA Draft for Review' THEN date_added ELSE '-' END) AS 'SCDR', 
                                      MAX(CASE WHEN activity='Forwarding COA for Approval' THEN date_added ELSE '-' END) AS 'DSTD', 
                                      MAX(CASE WHEN activity='Authorization of COA Release' THEN date_added ELSE '-' END) AS 'DDSD', 
                                      MAX(CASE WHEN activity='CAN No.' THEN date_added ELSE '-' END) AS 'CANo' 
                                FROM tracking_table 
                                GROUP BY labref
                        ");

        $this->db->query("CREATE VIEW ftrack AS 
                                       SELECT r.id, r.request_id, c.name clientname, r.product_name, r.batch_no,r.active_ing, r.manufacturer_name, r.manufacture_date,r.exp_date, r.presentation,r.designation_date_1,tr.* 
                                       FROM request r 
                                       LEFT JOIN clients c 
                                       ON r.client_id = c.id 
                                       LEFT OUTER JOIN track tr 
                                       ON tr.labref = r.request_id 
                                ");
    }

    function getTracking($criteria) {
        return $this->db->query($criteria)->result();
    }

}
