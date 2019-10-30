<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Report_Engine
 *
 * @author Alphy
 */
class Report_Engine extends MY_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->library('excel');

    }

    function index()
    {
        $year = date('Y');
        $this->dep($year);
    }


    function getAllDeptRep()
    {
        $Ct = $this->input->post('client');
        $Sd = $this->input->post('startdate');
        $Ed = $this->input->post('enddate');
        $D = $this->input->post('department');
        $A = $this->input->post('activities');
        $S = $this->input->post('status');

        if ($Ct == 'All' && $D == 'All') {
            $query = "SELECT * FROM request WHERE designation_date_1 BETWEEN '$Sd' AND '$Ed' AND request_id NOT LIKE '%r%' ";
            $this->ExcelGeneratorDept($query);
        } elseif ($Ct !== 'All' && $D == 'All') {
            echo 'Strike 2';
            $query = "SELECT * FROM request WHERE client_id='$Ct' AND designation_date_1 BETWEEN '$Sd' AND '$Ed' AND request_id NOT LIKE '%r%' ";
            $this->ExcelGeneratorDept($query);
        } elseif ($Ct == 'All' && $D !== 'All') {
            echo 'Strike 3';
            $ids = $this->getDeptsTests($D);
            $query = "SELECT r.request_id, r.batch_no, r.product_name,r.designation_date_1,r.compliance FROM request_details rd
                         INNER JOIN request r ON rd.request_id = r.request_id
                            WHERE rd.test_id IN ($ids) AND r.designation_date_1 BETWEEN '$Sd' AND '$Ed'
                      GROUP BY rd.request_id";
            $this->ExcelGeneratorDept($query);
        } elseif ($Ct !== 'All' && $D !== 'All') {
            echo 'Strike 4';
            $ids = $this->getDeptsTests($D);
            $query = "SELECT r.request_id, r.batch_no, r.product_name,r.designation_date_1 ,r.compliance FROM request_details rd
                         INNER JOIN request r ON rd.request_id = r.request_id
                            WHERE rd.test_id IN ($ids) AND r.client_id='$Ct' AND r.designation_date_1 BETWEEN '$Sd' AND '$Ed'
                      GROUP BY rd.request_id";
            $this->ExcelGeneratorDept($query);
        }
    }

    function ExcelGeneratorDept($query)
    {
        unlink("sample_report/ClientSampleReport2.xlsx");
        $objReader = PHPExcel_IOFactory::createReader('Excel2007');
        $objPHPExcel = $objReader->load("sample_report/Client_Sample_Template2.xlsx");
        $objPHPExcel->getActiveSheet(0);

        $signatories = $this->QueryBuilder($query);


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
        $i = 1;
        foreach ($signatories as $signatures):
            $col = 0;
            if ($signatures->CAN == NULL) {
                $status = 'Not Assigned';
            } else {
                $status = $signatures->CAN;
            }

            if ($signatures->compliance == NULL) {
                $comp = 'N/A';
            } else {
                $comp = $signatures->compliance;
            }

            $worksheet
                ->setCellValueByColumnAndRow($col++, $row2, $i)
                ->setCellValueByColumnAndRow($col++, $row2, $signatures->request_id)
                ->setCellValueByColumnAndRow($col++, $row2, $signatures->batch_no)
                ->setCellValueByColumnAndRow($col++, $row2, $signatures->product_name)
                ->setCellValueByColumnAndRow($col++, $row2, $signatures->designation_date_1)
                ->setCellValueByColumnAndRow($col++, $row2, $status)
                ->setCellValueByColumnAndRow($col++, $row2, $comp);
            $row2++;
            $i++;
        endforeach;

        // $objPHPExcel->getActiveSheet()->setCellValue('B1', strtoupper(str_replace(array("%20", "/", ",", " ", ".", "(", ")", "?"), "_", $cname)));
         $dept = $this->input->post('department');
        if($dept==='All'){
           $DEPT="ALL DEPARTMENTS";
        }elseif ($dept=='1'){
            $DEPT="WET-CHEMISTRY";
        }elseif ($dept=='2'){
            $DEPT="MICROBIOLOGY";
        }elseif ($dept=='3'){
            $DEPT="MEDICAL DEVICES";
        }
        $objPHPExcel->getActiveSheet()->setTitle($DEPT);

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        PHPExcel_Calculation::getInstance($objPHPExcel)->cyclicFormulaCount = 1;


        $objWriter->save("sample_report/ClientSampleReport2.xlsx");


        echo 'Data exported';
    }

    function getDeptsTests($id)
    {
        $query = $this->db->where('department', $id)->get('tests')->result();
        $ids = '';
        foreach ($query as $r) {
            $id .= $r->id . ",";
        }
        return rtrim($id, ",");
    }

    function QueryBuilder($query)
    {
        return $this->db->query($query)->result();
    }


    public function dep($year)
    {
        $data['title'] = 'Analyst Reports';
        $data['contents'] = 'body';
        $data['year'] = $year;
        $data['analysts'] = $this->getAllAnaysts();
        $data['wrec'] = count($this->getAll(1, $year));
        $data['mrec'] = count($this->getAll(2, $year));
        $data['mcom'] = count($this->getData(2, $year, 1));
        $data['wcom'] = count($this->getData(1, $year, 1));
        $data['mpen'] = count($this->getData(2, $year, 0));
        $data['wpen'] = count($this->getData(1, $year, 0));
        $this->template_loader($data);
    }

    function getAllAnaysts()
    {
        return $this->db->query("SELECT CONCAT(u.title,' ',u.fname,' ',u.lname) name  FROM users_types ut
INNER JOIN user u ON u.email = ut.email
AND ut.usertype_id='1'
AND ut.status ='1' ORDER BY u.fname ASC")->result();
    }


    function template_loader($data)
    {
        $this->load->view('dreports/template', $data);


    }

    function getReport()
    {
        $Ct = $this->input->post('client');
        $Sd = $this->input->post('startdate');
        $Ed = $this->input->post('enddate');
        $D = $this->input->post('department');
        $A = $this->input->post('activities');
        // $S = $this->input->post('status');

        if ($D == 'All' && $A == 'All'):
            $query = '';

            $this->ExcelGenerator($Sd, $Ed, $Ct, $query);

        elseif ($D !== 'All' && $A !== 'All') :
            $query = "AND a_s.department_id='$D' AND tr.activity='$A' GROUP BY re.request_id";
            $this->ExcelGenerator($Sd, $Ed, $Ct, $query);

        elseif ($D !== 'All' && $A == 'All') :
            $query = "AND a_s.department_id='$D' GROUP BY re.request_id";
            $this->ExcelGenerator($Sd, $Ed, $Ct, $query);

        elseif ($D == 'All' && $A !== 'All') :
            $query = "AND tr.activity='$A'  GROUP BY re.request_id";
            $this->ExcelGenerator($Sd, $Ed, $Ct, $query);
        else:
            echo 'Default';
        endif;
    }


    function ExcelGenerator($Sd, $Ed, $Ct, $query)
    {
        unlink("sample_report/ClientSampleReport.xlsx");
        $objReader = PHPExcel_IOFactory::createReader('Excel2007');
        $objPHPExcel = $objReader->load("sample_report/Client_Sample_Template.xlsx");
        $objPHPExcel->getActiveSheet(0);
        if ($query == '') {
            $signatories = $this->SQLDefaultGenerator($Sd, $Ed, $Ct, $query);
        } else {
            $signatories = $this->SQLOptionGenerator($Sd, $Ed, $Ct, $query);
        }

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
        $i = 1;
        foreach ($signatories as $signatures):
            $col = 0;
            $worksheet
                ->setCellValueByColumnAndRow($col++, $row2, $i)
                ->setCellValueByColumnAndRow($col++, $row2, $signatures->request_id)
                ->setCellValueByColumnAndRow($col++, $row2, $signatures->batch_no)
                ->setCellValueByColumnAndRow($col++, $row2, $signatures->product_name)
                ->setCellValueByColumnAndRow($col++, $row2, $signatures->r_date)
                ->setCellValueByColumnAndRow($col++, $row2, $signatures->can)
                ->setCellValueByColumnAndRow($col++, $row2, $signatures->activity)
                ->setCellValueByColumnAndRow($col++, $row2, $signatures->date_added)
                ->setCellValueByColumnAndRow($col++, $row2, $signatures->DiffDate)
                ->setCellValueByColumnAndRow($col++, $row2, '=IF(ISBLANK(E' . $row2 . '),"-",NETWORKDAYS(E' . $row2 . ',E' . $row2 . ',$D$4:$D$13))');


            $row2++;
            $i++;
        endforeach;

        // $objPHPExcel->getActiveSheet()->setCellValue('B1', strtoupper(str_replace(array("%20", "/", ",", " ", ".", "(", ")", "?"), "_", $cname)));
        $objPHPExcel->getActiveSheet()->setTitle(date('d-m-Y'));

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        PHPExcel_Calculation::getInstance($objPHPExcel)->cyclicFormulaCount = 1;


        $objWriter->save("sample_report/ClientSampleReport.xlsx");


        echo 'Data exported';
    }

    function SQLDefaultGenerator($Sd, $Ed, $Ct, $query = '')
    {

        if ($Ct == 'All') {
            $Client = " WHERE updated_at BETWEEN '$Sd' AND '$Ed'  AND request_id NOT LIKE '%r%' ";
        } else {
            $Client = " WHERE client_id='$Ct' AND updated_at BETWEEN '$Sd' AND '$Ed'  AND request_id NOT LIKE '%r%'";
        }

        return $this->db->query("SELECT re.request_id, re.batch_no, re.product_name, DATE_FORMAT(re.updated_at, '%d-%b-%Y') 'r_date', tr.activity, a_s.analyst_name,a_s.department_id,
                CASE WHEN tr.activity = 'CAN No.' THEN 'COA Ready' ELSE NULL END AS date_added,
                CASE WHEN a_s.stat = '1' THEN 'Complete' ELSE 'Pending' END AS status, re.client_id,
                CASE WHEN re.can = ' ' THEN '-' ELSE can END AS can,
                 DATEDIFF(CURDATE(),re.designation_date) AS DiffDate

                FROM (
                     SELECT request_id, batch_no, product_name,updated_at,client_id, can,designation_date
                           FROM request r
                           $Client
						   ORDER by id DESC
                           ) re
                LEFT OUTER JOIN(
                    SELECT labref, activity, date_added_1
                         FROM tracking_table t
                         WHERE id = (SELECT MAX(id) FROM tracking_table t2 WHERE t.labref = t2.labref)) tr
                         ON re.request_id = tr.labref
                LEFT OUTER JOIN assigned_samples a_s
                       ON re.request_id = a_s.labref
					   GROUP BY re.request_id
                
                      ")->result();
    }

    function SQLOptionGenerator($Sd, $Ed, $Ct, $query)
    {
        if ($Ct == 'All') {
            $Client = " WHERE updated_at BETWEEN '$Sd' AND '$Ed'  AND request_id NOT LIKE '%r%'";
        } else {
            $Client = " WHERE client_id='$Ct' AND updated_at BETWEEN '$Sd' AND '$Ed'  AND request_id NOT LIKE '%r%' ";
        }

        return $this->db->query("SELECT re.request_id, re.batch_no, re.product_name,re.compliance, DATE_FORMAT(re.updated_at, '%d-%b-%Y') 'r_date', tr.activity, a_s.analyst_name,a_s.department_id,
            CASE WHEN tr.activity = 'CAN No.' THEN 'COA Ready' ELSE NULL END AS date_added, 
            CASE WHEN a_s.stat = '1' THEN 'Complete' ELSE 'Pending' END AS status, re.client_id,
            CASE WHEN re.can = ' ' THEN '-' ELSE can END AS can FROM ( SELECT request_id, batch_no, product_name,updated_at,client_id, can,compliance,  DATEDIFF(CURDATE(),designation_date) AS DiffDate 
            FROM request r 
            $Client ) re 
                 INNER JOIN( 
                    SELECT labref, activity, date_added_1 
                        FROM tracking_table t WHERE id = (SELECT MAX(id) FROM tracking_table t2 WHERE t.labref = t2.labref)) tr 
                 ON re.request_id = tr.labref 
                        INNER JOIN assigned_samples a_s 
               ON re.request_id = a_s.labref
                          " . $query)->result();
    }

    function sampleLocator()
    {
      $samples = $this->input->post('samples');
        $s_data = explode(",",$samples);
        $news = "";
        foreach ($s_data as $s){
          $news .= "'$s'," ;
        }
        $ids = strtoupper(rtrim($news,","));
        echo $ids;
        $loca = $this->db->query("SELECT t.id, t.labref,r.product_name, CONCAT(u.title,' ',u.fname,' ',u.lname) name, date_added FROM tracking_table t INNER JOIN request r ON r.request_id=t.labref LEFT JOIN user u on t.user_id = u.id WHERE t.id = (SELECT MAX(t2.id) FROM tracking_table t2, user u WHERE t.labref = t2.labref AND u.id = t2.user_id) AND t.labref IN ($ids)")->result();

        unlink("sample_report/Last_Seen.xlsx");
        $objReader = PHPExcel_IOFactory::createReader('Excel2007');
        $objPHPExcel = $objReader->load("sample_report/LastSeen.xlsx");
        $objPHPExcel->getActiveSheet(0);
        $worksheet = $objPHPExcel->getActiveSheet();

        $row2 = 6;
        $i = 1;
        foreach ($loca as $signatures):
            $col = 0;
            $worksheet
                ->setCellValueByColumnAndRow($col++, $row2, $i)
                ->setCellValueByColumnAndRow($col++, $row2, $signatures->labref)
                ->setCellValueByColumnAndRow($col++, $row2, $signatures->product_name)
                ->setCellValueByColumnAndRow($col++, $row2, $signatures->name)
                ->setCellValueByColumnAndRow($col++, $row2, $signatures->date_added);

            $row2++;
            $i++;
        endforeach;
        //  $worksheet->setCellValue('F6', $count);
      //  $worksheet->setCellValue('A2', $title);

        // $objPHPExcel->getActiveSheet()->setCellValue('B1', strtoupper(str_replace(array("%20", "/", ",", " ", ".", "(", ")", "?"), "_", $cname)));
        $objPHPExcel->getActiveSheet()->setTitle("TRACKING SHEET");

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');


        $objWriter->save("sample_report/Last_Seen.xlsx");


    }


    function ExcelGeneratorUnassigned()
    {

        $St = $this->input->post('status');
        $Sd = $this->input->post('startdate');
        $Ed = $this->input->post('enddate');
        $client = $this->input->post('client');

        if ($client === 'All'):
            $signatories = $this->db->query("SELECT request_id, product_name, designation_date_1 "
                . "FROM request "
                . "WHERE assign_status='$St' "
                . "AND designation_date_1 BETWEEN '$Sd' AND '$Ed'")->result();
        else:
            $signatories = $this->db->query("SELECT request_id, product_name, designation_date_1 "
                . "FROM request "
                . "WHERE assign_status='$St' "
                . "AND designation_date_1 BETWEEN '$Sd' AND '$Ed' AND client_id='$client'")->result();
        endif;


        unlink("sample_report/StatusReport.xlsx");
        $objReader = PHPExcel_IOFactory::createReader('Excel2007');
        $objPHPExcel = $objReader->load("AssignedStatusReport.xlsx");
        $objPHPExcel->getActiveSheet(0);

        if ($St === '1') {
            $title = "ASSIGNED SAMPLES REPORT BETWEEN $Sd & $Ed";
        } else if ($St === '0') {
            $title = "UNASSIGNED SAMPLES REPORT BETWEEN $Sd & $Ed";

        } else {
            $title = "UNASSIGNED SAMPLES REPORT BETWEEN $Sd & $Ed";
        }


        $worksheet = $objPHPExcel->getActiveSheet();
        $styleArray = array(
            'borders' => array(
                'outline' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THICK,
                    'color' => array('argb' => 'FFFF0000'),
                ),
            ),
        );
        $row2 = 6;
        $i = 1;
        foreach ($signatories as $signatures):
            $col = 0;
            $worksheet
                ->setCellValueByColumnAndRow($col++, $row2, $i)
                ->setCellValueByColumnAndRow($col++, $row2, $signatures->request_id)
                ->setCellValueByColumnAndRow($col++, $row2, $signatures->product_name)
                ->setCellValueByColumnAndRow($col++, $row2, $signatures->designation_date_1);

            $row2++;
            $i++;
        endforeach;
        //  $worksheet->setCellValue('F6', $count);
        $worksheet->setCellValue('A2', $title);

        // $objPHPExcel->getActiveSheet()->setCellValue('B1', strtoupper(str_replace(array("%20", "/", ",", " ", ".", "(", ")", "?"), "_", $cname)));
        $objPHPExcel->getActiveSheet()->setTitle(date('d-m-Y'));

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');


        $objWriter->save("sample_report/StatusReport.xlsx");

        echo $count;
        echo 'Data exported';
    }


    function analyst_report($from, $to)
    {
        $data['received'] = $this->getCompletedCount($from, $to);
        $full = $this->getSupervisorName();
        $data['name'] = $full[0]->title . " " . $full[0]->fname . " " . $full[0]->lname;
        $data['no'] = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12);
        $data['mo'] = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
        $this->load->view('analyst_reporting', $data);
    }


    function analyst_report_final()
    {
        $data['analysts'] = $this->getA();
        $full = $this->getSupervisorName();
        $data['name'] = $full[0]->title . " " . $full[0]->fname . " " . $full[0]->lname;
        $data['no'] = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12);
        $data['mo'] = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
        $this->load->view('analyst_reporting_final', $data);
    }

    function rev_reps()
    {
        $data['analysts'] = $this->getA();
        $full = $this->getSupervisorName();
        $data['name'] = $full[0]->title . " " . $full[0]->fname . " " . $full[0]->lname;
        $data['no'] = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12);
        $data['mo'] = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
        $this->load->view('analyst_reporting_final', $data);
    }


    function Assigned_samples()
    {


        $data['settings_view'] = "request_v_ds_3";
        $data['info'] = $this->getAssigned();
        $data['clients'] = $this->getClients();
        $data['anna'] = $this->getAnalsyts();
        $data['anna_r'] = $this->getReviewersArray();
        $data['title'] = "Department Reports";
        $this->base_params($data);
    }


    function pataReporti($type, $dept, $year)
    {
        if ($type == 'all' && $dept == '1') {
            $data['heading'] = 'Wet Chemistry Assigned Samples ' . $year;
            $data['content'] = $this->getAll(1, $year);
        } else if ($type == 'all' && $dept == '2') {
            $data['heading'] = 'Microbiology Assigned Samples ' . $year;
            $data['content'] = $this->getAll(2, $year);
        } else if ($type == 'com' && $dept == '1') {
            $data['heading'] = 'Wet Chemistry Completed Samples ' . $year;
            $data['content'] = $this->getData(1, $year, 1);
        } else if ($type == 'com' && $dept == '2') {
            $data['heading'] = 'Microbiology Completed Samples ' . $year;
            $data['content'] = $this->getData(2, $year, 1);
        } else if ($type == 'pen' && $dept == '1') {
            $data['heading'] = 'Microbiology Pending Sampless ' . $year;
            $data['content'] = $this->getData(1, $year, 0);
        } else if ($type == 'pen' && $dept == '2') {
            $data['heading'] = 'Microbiology Pending Sampless ' . $year;
            $data['content'] = $this->getData(2, $year, 0);

        } else if ($type == 'sup') {
            $data['heading'] = 'All Samples Received By Supervisors ' . $year;
            $data['content'] = $this->getData(2, $year, 0);

        } else if ($type == 'supcom') {
            $data['heading'] = 'All Samples Approved By Supervisors ' . $year;
            $data['content'] = $this->getData(2, $year, 0);

        } else if ($type == 'supen') {
            $data['heading'] = 'All Samples Pending Supervisors Approvals ' . $year;
            $data['content'] = $this->getData(2, $year, 0);
        }
        $data['settings_view'] = "reports_d";
        $data['title'] = "Department Reports";
        $this->base_params($data);
    }

    function pataReportis($type, $dept)
    {
        $user_id = $this->session->userdata('user_id');

        if ($type == 'all') {
            $data['heading'] = $this->getUsersInfo($user_id) . ' - All Supervision Samples 2016';
            $data['content'] = $this->getTestsDone($user_id, 2016);
        } else if ($type == 'allc') {
            $data['heading'] = $this->getUsersInfo($user_id) . ' - Supervisor Complete Samples 2016';
            $data['content'] = $this->getTestsDone1($user_id, 2016, 1);
        } else if ($type == 'allp') {
            $data['heading'] = $this->getUsersInfo($user_id) . ' -  Supervisor Pending Samples 2016';
            $data['content'] = $this->getTestsDone1($user_id, 2016, 0);
        }
        $data['settings_view'] = "reports_ds";
        $data['title'] = "Department Reports";
        $this->base_params($data);
    }


    function dreport()
    {

        $user_id = $this->session->userdata('user_id');
        $data['settings_view'] = "dreports";
        $data['title'] = "Department Reports";
        $data['wrec'] = count($this->getAll(1, 2016));
        $data['mrec'] = count($this->getAll(2, 2016));
        $data['mcom'] = count($this->getData(2, 2016, 1));
        $data['wcom'] = count($this->getData(1, 2016, 1));
        $data['mpen'] = count($this->getData(2, 2016, 0));
        $data['wpen'] = count($this->getData(1, 2016, 0));
        $data['srec'] = count($this->getTestsDone($user_id, 2016));
        $data['sred'] = count($this->getTestsDone1($user_id, 2016, 1));
        $data['srep'] = count($this->getTestsDone1($user_id, 2016, 0));
        $data['per'] = $this->getUsersInfo($user_id);
        $this->base_params($data);
    }

    public function getUsersInfo($user_id)
    {

        $this->db->select('fname,lname');
        $this->db->where('id', $user_id);
        $query = $this->db->get('user')->result();
        return $query[0]->fname . " " . $query[0]->lname;
    }

    function getTestsDone($user_id, $year)
    {
        // $supervisor_id = $this->session->userdata('user_id');
        // $this->db->where('supervisor_id', $user_id);
        // $this->db->where('YEAR(date_time)', $year);
        //$this->db->where('approval_status', 0); 
        //$this->db->group_by('labref');   
        $query1 = "SELECT t.*, r.product_name FROM tests_done t, request r WHERE supervisor_id='$user_id' AND r.request_id=t.labref AND YEAR(date_time) ='$year' group by t.labref ORDER BY t.date_time DESC";
        //$query = $this->db->get('tests_done');
        return $result = $this->db->query($query1)->result();
    }

    function getTestsDone1($user_id, $year, $status)
    {
        $query1 = "SELECT t.*, r.product_name FROM tests_done t, request r WHERE supervisor_id='$user_id' AND r.request_id=t.labref AND YEAR(date_time) ='$year'  AND approval_status='$status' group by t.labref ORDER BY t.date_time DESC ";
        // $supervisor_id = $this->session->userdata('user_id');
        // $this->db->where('supervisor_id', $user_id);
        //$this->db->where('YEAR(date_time)', $year); 
        //$this->db->where('approval_status', $status); 
        ///$this->db->group_by('labref');    
        // $query = $this->db->get('tests_done');
        return $result = $this->db->query($query1)->result();
    }

    function getAll($id, $year = "2016")
    {
        return $this->db->query("SELECT a.labref, a.analyst_name, r.product_name, a.date_time_tracker received
FROM assigned_samples a, request r
WHERE YEAR( a.date_time_tracker ) = '$year'
AND a.department_id = '$id'
AND a.labref = r.request_id")->result();
    }


    function getData($id, $year, $status)
    {

        $query = $this->db->query("SELECT * FROM(
SELECT r.product_name,si.lab_ref_no labref,DATE_FORMAT(si.`created_at`,'%d-%m-%Y') received,si.done_status,CASE WHEN SUM(si.done_status) < COUNT(si.done_status) THEN 0 ELSE 1 END AS label,si.department_id, CONCAT(u.fname ,' ', u.lname) analyst_name
FROM sample_issuance si 
INNER JOIN request r 
ON r.request_id = si.lab_ref_no 
INNER JOIN user u
ON si.analyst_id = u.id
AND YEAR(si.created_at)='$year'
AND si.department_id='$id'
GROUP BY si.lab_ref_no 
ORDER BY si.created_at DESC)
su  WHERE label ='$status'")->result();
        return $query;
    }


    public function base_params($data)
    {
        $data['scripts'] = array("jquery-ui.js");
        $data['scripts'] = array("SpryAccordion.js");
        $data['styles'] = array("SpryAccordion.css");
        $data['quick_link'] = "uniformity";
        $data['content_view'] = "settings_v";
        $data['banner_text'] = "NQCL Settings";
        $data['link'] = "settings_management";

        $this->load->view('template', $data);
    }


    function analyst_report_hod()
    {
        $data['analysts'] = $this->getA();
        $full = $this->getSupervisorName();
        $data['name'] = $full[0]->title . " " . $full[0]->fname . " " . $full[0]->lname;

        $data['no'] = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12);
        $data['mo'] = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
        $this->load->view('analyst_reporting_hod', $data);
    }

    function getA()
    {
        return $this->db->query("SELECT u.* 
FROM user u, users_types t
WHERE u.email = t.email
AND t.usertype_id=1")->result();
    }

    function getCompleted($from, $to)
    {
        $uid = $this->session->userdata('user_id');
        $query = $this->db->query("SELECT * FROM(
SELECT r.product_name,si.lab_ref_no,DATE_FORMAT(si.`created_at`,'%d-%m-%Y') received,si.done_status,CASE WHEN SUM(si.done_status) < COUNT(si.done_status) THEN 0 ELSE 1 END AS label
FROM sample_issuance si 
INNER JOIN request r 
ON r.request_id = si.lab_ref_no 
AND si.analyst_id ='$uid' AND si.created_at 
BETWEEN '$from'  AND '$to'

GROUP BY si.lab_ref_no 
ORDER BY si.created_at DESC)
su  WHERE label ='1'
    ")->result();
        echo json_encode($query);
    }

    function getCompletedCount($from, $to)
    {
        $uid = $this->session->userdata('user_id');
        return $query = $this->db->query("SELECT si.lab_ref_no 
FROM sample_issuance si 
WHERE si.analyst_id ='$uid' AND si.created_at 
BETWEEN '$from'  AND '$to'
GROUP BY si.lab_ref_no 

    ")->num_rows();
    }

    function getSupCount($month, $month1, $year, $uid)
    {
        $query = $this->db->query("
SELECT si.lab_ref_no
FROM sample_issuance si 
WHERE si.analyst_id ='$uid' AND si.created_at 
BETWEEN '$year-$month-05'  AND '$year-$month1-05'
GROUP BY si.lab_ref_no 

    ")->num_rows();
        echo $query;

    }

    function noCompleted($month, $year)
    {
        $uid = $this->session->userdata('user_id');
        $query = $this->db->query("SELECT r.product_name,si.lab_ref_no,DATE_FORMAT(si.created_at, '%d-%m-%Y') received, DATE_FORMAT(t.date_added_1, '%d-%m-%Y') returned FROM sample_issuance si INNER JOIN request r ON r.request_id = si.lab_ref_no INNER JOIN tracking_table t ON t.labref = si.lab_ref_no AND t.activity='Returning to Supervisor' AND t.user_id = si.analyst_id AND si.analyst_id ='$uid' AND si.done_status='1' AND MONTH(si.created_at) = '$month' AND YEAR(si.created_at)='$year' GROUP BY si.lab_ref_no ")->num_rows();
        echo json_encode($query);
    }


    function getPending($from, $to)
    {
        $uid = $this->session->userdata('user_id');
        $month = date('Y-m-05', strtotime("-6 months"));


        $query = $this->db->query("SELECT * FROM(
SELECT r.product_name,si.lab_ref_no,DATE_FORMAT(si.`created_at`,'%d-%m-%Y') received,si.done_status,CASE WHEN SUM(si.done_status) < COUNT(si.done_status) THEN 0 ELSE 1 END AS label
FROM sample_issuance si 
INNER JOIN request r 
ON r.request_id = si.lab_ref_no 
AND si.analyst_id ='$uid' AND si.created_at 
BETWEEN '$month'  AND '$to'

GROUP BY si.lab_ref_no 
ORDER BY si.created_at DESC)
su  WHERE label ='0'")->result();
        echo json_encode($query);
    }


    function All()
    {
        $query1 = $this->db->query("SELECT a_s.*, si.samples_no as quantity_issued, p.name as sample_packaging, r.packaging, r.product_name,t.date_added
			FROM `assigned_samples` a_s
			left join sample_issuance si on a_s.labref = si.lab_ref_no
			left join request r on a_s.labref = r.request_id
			left join packaging p on r.packaging = p.id
      left join tracking_table t on a_s.labref = t.labref
                        WHERE si.analyst_id ='$q->analyst_id'
						AND a_s.department_id='$dept'
                        AND a_s.date_time_tracker BETWEEN '$start%' AND '$end%'
                            AND a_s.stat ='1'
                        AND t.activity ='$status1'

			group by a_s.labref")->result();


    }

    function saveData()
    {
        $uid = $this->session->userdata('user_id');
        $month = $this->input->post('month');
        $year = $this->input->post('year');


        $this->delete($uid, $month, $year, 'rsamples');
        $this->delete($uid, $month, $year, 'rsampleslook');

        $sname = $this->input->post('nameRS');
        $labref = $this->input->post('labrefRS');
        $recdate = $this->input->post('drecRS');
        $retdate = $this->input->post('dretRS');

        $sname1 = $this->input->post('nameOT');
        $labref1 = $this->input->post('labrefOT');
        $recdate1 = $this->input->post('drecOT');
        $retdate1 = $this->input->post('dretOT');

        $sname2 = $this->input->post('namePS');
        $labref2 = $this->input->post('labrefPS');
        $recdate2 = $this->input->post('drecPS');
        $retdate2 = $this->input->post('dretPS');

        $s = $this->input->post('tns');
        $co = $this->input->post('tnc');
        $p = $this->input->post('tnp');
        $a = $this->input->post('activities');
        $c = $this->input->post('comments');

        for ($i = 0; $i < count($sname); $i++):
            $rs = array(
                'month' => $month,
                'year' => $year,
                'analyst_id' => $uid,
                'sname' => $sname[$i],
                'labref' => $labref[$i],
                'recdate' => $recdate[$i],
                'retdate' => $retdate[$i],
                'rtype' => 'RS'
            );
            $this->save($rs);
        endfor;

        for ($i = 0; $i < count($sname1); $i++):
            $rs1 = array(
                'month' => $month,
                'year' => $year,
                'analyst_id' => $uid,
                'sname' => $sname1[$i],
                'labref' => $labref1[$i],
                'recdate' => $recdate1[$i],
                'retdate' => $retdate1[$i],
                'rtype' => 'OT'
            );
            $this->save($rs1);
        endfor;

        for ($i = 0; $i < count($sname2); $i++):
            $rs2 = array(
                'month' => $month,
                'year' => $year,
                'analyst_id' => $uid,
                'sname' => $sname2[$i],
                'labref' => $labref2[$i],
                'recdate' => $recdate2[$i],
                'retdate' => $retdate2[$i],
                'rtype' => 'PS'
            );
            $this->save($rs2);

        endfor;

        $da = array(
            'month' => $month,
            'year' => $year,
            'analyst_id' => $uid,
            'activities' => $a,
            'comments' => $c,
            'r' => $s,
            'c' => $co,
            'p' => $p,
        );
        $this->saveLookUp($da);
        echo 'Save Successful';
    }

    function save($data)
    {
        $this->db->insert('rsamples', $data);
    }

    function delete($aid, $month, $year, $table)
    {
        $this->db
            ->where('analyst_id', $aid)
            ->where('month', $month)
            ->where('year', $year)
            ->delete($table);
    }

    function saveLookUp($data)
    {
        $this->db->insert('rsampleslook', $data);
    }

    function serveLookup($month, $year, $type)
    {
        $uid = $this->session->userdata('user_id');
        $results = $this->db
            ->where('month', $month)
            ->where('year', $year)
            ->where('analyst_id', $uid)
            ->where('rtype', $type)
            ->get('rsamples')
            ->result();
        echo json_encode($results);

    }

    function serveLookupSu($month, $year, $uid, $type)
    {
        $results = $this->db
            ->where('month', $month)
            ->where('year', $year)
            ->where('analyst_id', $uid)
            ->where('rtype', $type)
            ->get('rsamples')
            ->result();
        echo json_encode($results);

    }

    function serveLookupSetails($month, $year)
    {
        $uid = $this->session->userdata('user_id');
        $results = $this->db
            ->where('month', $month)
            ->where('year', $year)
            ->where('analyst_id', $uid)
            ->get('rsampleslook')
            ->result();
        echo json_encode($results);

    }

    function serveLookupSetailsSu($month, $year, $uid)
    {
        $results = $this->db
            ->where('month', $month)
            ->where('year', $year)
            ->where('analyst_id', $uid)
            ->get('rsampleslook')
            ->result();
        echo json_encode($results);

    }

    function getSupervisorAnalystPending($month, $month1, $year, $uid)
    {
        $month = date('Y-m-05', strtotime("-6 months"));
        $query = $this->db->query("SELECT * FROM(
SELECT r.product_name,si.lab_ref_no,DATE_FORMAT(si.`created_at`,'%d-%m-%Y') received,si.done_status,CASE WHEN SUM(si.done_status) < COUNT(si.done_status) THEN 0 ELSE 1 END AS label
FROM sample_issuance si 
INNER JOIN request r 
ON r.request_id = si.lab_ref_no 
AND si.analyst_id ='$uid' AND si.created_at 
BETWEEN '$month'  AND '$year-$month1-05'

GROUP BY si.lab_ref_no 
ORDER BY si.created_at DESC)
su  WHERE label ='0'
    ")->result();
        echo json_encode($query);

    }


    function getSupervisorAnalystCompleted($month, $month1, $year, $uid)
    {


        $query = $this->db->query("SELECT * FROM(
SELECT r.product_name,si.lab_ref_no,DATE_FORMAT(si.`created_at`,'%d-%m-%Y') received,si.done_status,CASE WHEN SUM(si.done_status) < COUNT(si.done_status) THEN 0 ELSE 1 END AS label
FROM sample_issuance si 
INNER JOIN request r 
ON r.request_id = si.lab_ref_no 
AND si.analyst_id ='$uid' AND si.created_at 
BETWEEN '$year-$month-05'  AND '$year-$month1-05'

GROUP BY si.lab_ref_no 
ORDER BY si.created_at DESC)
su  WHERE label ='1'
    ")->result();
        echo json_encode($query);

    }


    function array_combine_($keys, $values)
    {
        $result = array();
        foreach ($keys as $i => $k) {
            $result[$k][] = $values[$i];
        }
        array_walk($result, create_function('&$v', '$v = (count($v) == 1)? array_pop($v): $v;'));
        return $result;
    }



    function ExcelGeneratorClients()
    {
        unlink("sample_report/Client_Template.xlsx");
        $objReader = PHPExcel_IOFactory::createReader('Excel2007');
        $objPHPExcel = $objReader->load("sample_report/ClientTemplate.xlsx");
        $objPHPExcel->getActiveSheet(0);

        $signatories = $this->db->query("SELECT * FROM `clients` ORDER BY name ASC")->result();


        $worksheet = $objPHPExcel->getActiveSheet();
        $styleArray = array(
            'borders' => array(
                'outline' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THICK,
                    'color' => array('argb' => 'FFFF0000'),
                ),
            ),
        );
        $row2 = 6;
        $i = 1;
        foreach ($signatories as $signatures):
            $col = 0;
          
            $worksheet
                ->setCellValueByColumnAndRow($col++, $row2, $i)
                ->setCellValueByColumnAndRow($col++, $row2, $signatures->id)
                ->setCellValueByColumnAndRow($col++, $row2, $signatures->name)
                ->setCellValueByColumnAndRow($col++, $row2, $signatures->email)
                ->setCellValueByColumnAndRow($col++, $row2, $signatures->client_type);              
            $row2++;
            $i++;
        endforeach;


        $objPHPExcel->getActiveSheet()->setTitle("CLIENT REPORT");

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        PHPExcel_Calculation::getInstance($objPHPExcel)->cyclicFormulaCount = 1;


        $objWriter->save("sample_report/Client_Template.xlsx");


        echo 'Data exported';
    }

}
