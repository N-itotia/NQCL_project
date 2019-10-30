<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Client_sample_report extends MY_Controller {

    function __construct() {        
        parent::__construct();
        $this->load->library('excel');    
        }
        
        function generate($start,$end,$cid,$dept,$cname) {
             unlink("sample_report/ClientSampleReport.xlsx");
        $objReader = PHPExcel_IOFactory::createReader('Excel2007');
        $objPHPExcel = $objReader->load("Client_Sample_Template.xlsx");
        $objPHPExcel->getActiveSheet(0);        
        $signatories = $this->getSignatories($start,$end,$cid,$dept);
      
        $worksheet = $objPHPExcel->getActiveSheet();
    $styleArray = array(
            'borders' => array(
                'outline' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THICK,
                    'color' => array('argb' => 'FFFF0000'),
                ),
            ),
        );
        $row2 = 15;
        $i=1;
        foreach ($signatories as $signatures):
            $col = 0;
            $worksheet
                    ->setCellValueByColumnAndRow($col++, $row2,$i)
                    ->setCellValueByColumnAndRow($col++, $row2, $signatures->request_id)                                   
                    ->setCellValueByColumnAndRow($col++, $row2, $signatures->product_name)                 
                    ->setCellValueByColumnAndRow($col++, $row2, $signatures->r_date)
                    ->setCellValueByColumnAndRow($col++, $row2, $signatures->can)
                    ->setCellValueByColumnAndRow($col++, $row2, $signatures->analyst_name)  
                    ->setCellValueByColumnAndRow($col++, $row2, $signatures->activity )
                    ->setCellValueByColumnAndRow($col++, $row2, $signatures->date_added) 
                    ->setCellValueByColumnAndRow($col++, $row2, '=IF(ISBLANK(H'.$row2'),NETWORKDAYS(D'.$row2',$B$4,$C$4:$C$12),"-")')
                    ->setCellValueByColumnAndRow($col++, $row2, '=IF(ISBLANK(H'.$row2'),"-",NETWORKDAYS(D'.$row2',H15,$C$4:$C$13))');
                    
                   
            $row2++;
            $i++;
        endforeach;

        $objPHPExcel->getActiveSheet()->setCellValue('B1', strtoupper(str_replace(array("%20","/",","," ",".","(",")","?"),"_",$cname)));
        $objPHPExcel->getActiveSheet()->setTitle(date('d-m-Y'));

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        PHPExcel_Calculation::getInstance($objPHPExcel)->cyclicFormulaCount = 1;
       

        $objWriter->save("sample_report/ClientSampleReport.xlsx");


        echo 'Data exported';
    }
    
    function getSignatories($start,$end,$cid,$dept) {
    return $this->db->query("SELECT re.request_id, re.product_name, DATE_FORMAT(re.updated_at, '%d-%b-%Y') 'r_date', tr.activity, a_s.analyst_name,a_s.department_id,
CASE WHEN tr.activity = 'Authorization of COA Release' THEN DATE_FORMAT(tr.date_added_1, '%d-%b-%Y') ELSE NULL END AS date_added,
CASE WHEN a_s.stat = '1' THEN 'Complete' ELSE 'Pending' END AS status, re.client_id,
CASE WHEN re.can = ' ' THEN '-' ELSE can END AS can

FROM (
     SELECT request_id, product_name,updated_at,client_id, can
           FROM request r
           WHERE client_id='$cid'
           AND updated_at BETWEEN '$start' AND '$end'
           ) re
LEFT OUTER JOIN(
    SELECT labref, activity, date_added_1
         FROM tracking_table t
         WHERE id = (SELECT MAX(id) FROM tracking_table t2 WHERE t.labref = t2.labref)) tr
         ON re.request_id = tr.labref
LEFT OUTER JOIN assigned_samples a_s
       ON re.request_id = a_s.labref
       AND a_s.department_id ='$dept' ")->result(); 
     
        }
    

}

