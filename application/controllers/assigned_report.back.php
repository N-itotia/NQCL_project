<?php

require_once("application/helpers/dompdf/dompdf_config.inc.php");

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Assigned_report extends MY_Controller {

    function __construct() {
        parent::__construct();
    }

    function showdata() {
        $this->Issuing();
    }

    function loadScripts() {
        
    }

    function getReportPerAnalyst($start, $end, $dept, $a_id, $status) {
        //$this->load->view('');
        if ($status == 'Returning%20to%20Documentation') {
            $title = 'Analyst Completed/Pending Samples Report (' . $start . ' to ' . $end . ')';
            $stat = '1';
        } else {
            $stat = '0';
            $title = 'Analyst Pending Samples Report (' . $start . ' to ' . $end . ')';
        }
        $status1 = str_replace("%20", " ", $status);
        $css = '<!doctype><html><head><title>' . $title . '</title>';
        $css.= '<style type="text/css">
          .tg{width:900px;};
.tg  {border-collapse:collapse;border-spacing:0;border-color:#bbb;}
.tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#bbb;color:#594F4F;background-color:#E0FFEB;}
.tg th{font-family:Arial, sans-serif;font-size:30px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#bbb;color:#493F3F;background-color:#9DE0AD;}
.tg .tg-ugh9{background-color:#C2FFD6; width:300px;}
.tg .tg-031e .e12{background-color:#C2FFD6; width:300px;}
.he{ font-weight: bold;}
p{width:100%;
height: 5px;}
</style>


';



        $css.='</head><body>';
        $css.='<p><center><< <a href="' . base_url() . 'request_management/assigned_samples' . '">Back</a>    <strong><u>' . $title . '</u></strong></center></p>';

        $query = $this->db->query("SELECT * FROM assigned_samples WHERE date_time_tracker BETWEEN '$start%' AND '$end%' AND department_id='$dept' AND analyst_id='$a_id' GROUP BY analyst_id ")->result();

        foreach ($query as $q):
            $css.='<p></p>';
            $css.='<center>';
            $css.= '<table class="tg"><tr><th class="tg-031e" colspan="6">' . $q->analyst_name . ' (COMPLETE)</th></tr>';
            $css.= '<tr>
    <td class="tg-031e he">No:</td><td class="tg-031e he">Labreference No:</td><td class="tg-ugh9 he">Product Name</td><td class="tg-ugh9 he">Quantity Issued</td><td class="tg-ugh9 he">Date Issued<br>(d-m-Y)</td><td class="tg-ugh9 he">Date Returned<br>(d-m-Y)</td></tr>';
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
            $i = 1;
            foreach ($query1 as $q1):
                if ($stat == '1'):
                    $date = $q1->date_added;
                else:
                    $date = '-';
                endif;
                $ymd = DateTime::createFromFormat('Y-m-d', $q1->date_time_tracker)->format('d-m-Y');
                $css.= ' <tr>
       <td class="tg-031e">' . $i . '</td>
    <td class="tg-031e">' . $q1->labref . '</td>
      <td class="tg-031e e12">' . $q1->product_name . '</td>
    <td class="tg-ugh9">' . $q1->quantity_issued . " " . $q1->sample_packaging . '</td> '
                        . ' <td class="tg-031e e12">' . $ymd . '</td><td class="tg-031e e12">' . $date . '</td></tr>'
                        . '</tr>';
                $i++;
            endforeach;

            $css.= '</table>';
            $css.='</center></body></html>';
        endforeach;
        echo $css;

        $this->getReportPerAnalystPending($start, $end, $dept, $a_id);
    }

    function getDocumentation($start, $end, $dept, $a_id, $status) {
        //$this->load->view('');
        if ($status == 'Returning%20to%20Documentation') {
            $title = 'Analyst Completed/Pending Samples Report (' . $start . ' to ' . $end . ')';
            $stat = '1';
        } else {
            $stat = '0';
            $title = 'Analyst Pending Samples Report (' . $start . ' to ' . $end . ')';
        }
        $status1 = str_replace("%20", " ", $status);
        $css = '<!doctype><html><head><title>' . $title . '</title>';
        $css.= '<style type="text/css">
          .tg{width:900px;};
.tg  {border-collapse:collapse;border-spacing:0;border-color:#bbb;}
.tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#bbb;color:#594F4F;background-color:#E0FFEB;}
.tg th{font-family:Arial, sans-serif;font-size:30px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#bbb;color:#493F3F;background-color:#9DE0AD;}
.tg .tg-ugh9{background-color:#C2FFD6; width:300px;}
.tg .tg-031e .e12{background-color:#C2FFD6; width:300px;}
.he{ font-weight: bold;}
p{width:100%;
height: 5px;}
</style>


';



        $css.='</head><body>';
        $css.='<p><center><< <a href="' . base_url() . 'request_management/assigned_samples' . '">Back</a>    <strong><u>' . $title . '</u></strong></center></p>';

        $query = $this->db->query("SELECT * FROM assigned_samples WHERE date_time_tracker BETWEEN '$start%' AND '$end%' GROUP BY analyst_id ")->result();

        foreach ($query as $q):
            $css.='<p></p>';
            $css.='<center>';
            $css.= '<table class="tg"><tr><th class="tg-031e" colspan="6">' . $q->analyst_name . ' (COMPLETE)</th></tr>';
            $css.= '<tr>
    <td class="tg-031e he">No:</td><td class="tg-031e he">Labreference No:</td><td class="tg-ugh9 he">Product Name</td><td class="tg-ugh9 he">Quantity Issued</td><td class="tg-ugh9 he">Date Issued<br>(d-m-Y)</td><td class="tg-ugh9 he">Date Returned<br>(d-m-Y)</td></tr>';
            $query1 = $this->db->query("SELECT a_s.*, si.samples_no as quantity_issued, p.name as sample_packaging, r.packaging, r.product_name,t.date_added
			FROM `assigned_samples` a_s
			left join sample_issuance si on a_s.labref = si.lab_ref_no
			left join request r on a_s.labref = r.request_id
			left join packaging p on r.packaging = p.id
      left join tracking_table t on a_s.labref = t.labref
                        WHERE si.analyst_id ='$q->analyst_id'
						
                        AND a_s.date_time_tracker BETWEEN '$start%' AND '$end%'
                            AND a_s.stat ='1'
                        AND t.activity ='$status1'

			group by a_s.labref")->result();
            $i = 1;
            foreach ($query1 as $q1):
                if ($stat == '1'):
                    $date = $q1->date_added;
                else:
                    $date = '-';
                endif;
                $ymd = DateTime::createFromFormat('Y-m-d', $q1->date_time_tracker)->format('d-m-Y');
                $css.= ' <tr>
       <td class="tg-031e">' . $i . '</td>
    <td class="tg-031e">' . $q1->labref . '</td>
      <td class="tg-031e e12">' . $q1->product_name . '</td>
    <td class="tg-ugh9">' . $q1->quantity_issued . " " . $q1->sample_packaging . '</td> '
                        . ' <td class="tg-031e e12">' . $ymd . '</td><td class="tg-031e e12">' . $date . '</td></tr>'
                        . '</tr>';
                $i++;
            endforeach;

            $css.= '</table>';
            $css.='</center></body></html>';
        endforeach;
        echo $css;

        $this->getReportDocPending($start, $end, $dept, $a_id, $status);
    }

    function getReportDocPending($start, $end, $dept, $a_id, $status) {

        $status1 = "Issuing";



        $css = '<p></p><br>';
        $css.='<p><center> <strong><u>Pending Samples</u></strong></center></p>';

        $query = $this->db->query("SELECT * FROM assigned_samples WHERE date_time_tracker BETWEEN '$start%' AND '$end%'  GROUP BY analyst_id ")->result();

        foreach ($query as $q):
            $css.='<p></p>';
            $css.='<center>';
            $css.= '<table class="tg"><tr><th class="tg-031e" colspan="6">' . $q->analyst_name . ' (PENDING)</th></tr>';
            $css.= '<tr>
    <td class="tg-031e he">No:</td><td class="tg-031e he">Labreference No:</td><td class="tg-ugh9 he">Product Name</td><td class="tg-ugh9 he">Quantity Issued</td><td class="tg-ugh9 he">Date Issued<br>(d-m-Y)</td><td class="tg-ugh9 he">Date Returned<br>(d-m-Y)</td></tr>';
            $query1 = $this->db->query("SELECT a_s.*, si.samples_no as quantity_issued, p.name as sample_packaging, r.packaging, r.product_name,t.date_added
      FROM `assigned_samples` a_s
      left join sample_issuance si on a_s.labref = si.lab_ref_no
      left join request r on a_s.labref = r.request_id
      left join packaging p on r.packaging = p.id
      left join tracking_table t on a_s.labref = t.labref
                        WHERE si.analyst_id ='$q->analyst_id'
          
                        AND a_s.date_time_tracker BETWEEN '$start%' AND '$end%'
                            AND a_s.stat ='0'
                        AND t.activity ='$status1'

      group by a_s.labref")->result();
            $i = 1;
            foreach ($query1 as $q1):

                $date = '-';

                $ymd = DateTime::createFromFormat('Y-m-d', $q1->date_time_tracker)->format('d-m-Y');
                $css.= ' <tr>
       <td class="tg-031e">' . $i . '</td>
    <td class="tg-031e">' . $q1->labref . '</td>
      <td class="tg-031e e12">' . $q1->product_name . '</td>
    <td class="tg-ugh9">' . $q1->quantity_issued . " " . $q1->sample_packaging . '</td> '
                        . ' <td class="tg-031e e12">' . $ymd . '</td><td class="tg-031e e12">' . $date . '</td></tr>'
                        . '</tr>';
                $i++;
            endforeach;

            $css.= '</table>';
            $css.='</center></body></html>';
        endforeach;
        echo $css;
    }

    function getReportPerAnalystPending($start, $end, $dept, $a_id) {

        $status1 = "Issuing";



        $css = '<p></p><br>';
        $css.='<p><center> <strong><u>Pending Samples</u></strong></center></p>';

        $query = $this->db->query("SELECT * FROM assigned_samples WHERE date_time_tracker BETWEEN '$start%' AND '$end%'  GROUP BY analyst_id ")->result();

        foreach ($query as $q):
            $css.='<p></p>';
            $css.='<center>';
            $css.= '<table class="tg"><tr><th class="tg-031e" colspan="6">' . $q->analyst_name . ' (PENDING)</th></tr>';
            $css.= '<tr>
    <td class="tg-031e he">No:</td><td class="tg-031e he">Labreference No:</td><td class="tg-ugh9 he">Product Name</td><td class="tg-ugh9 he">Quantity Issued</td><td class="tg-ugh9 he">Date Issued<br>(d-m-Y)</td><td class="tg-ugh9 he">Date Returned<br>(d-m-Y)</td></tr>';
            $query1 = $this->db->query("SELECT a_s.*, si.samples_no as quantity_issued, p.name as sample_packaging, r.packaging, r.product_name,t.date_added
      FROM `assigned_samples` a_s
      left join sample_issuance si on a_s.labref = si.lab_ref_no
      left join request r on a_s.labref = r.request_id
      left join packaging p on r.packaging = p.id
      left join tracking_table t on a_s.labref = t.labref
                        WHERE si.analyst_id ='$q->analyst_id'
         
                        AND a_s.date_time_tracker BETWEEN '$start%' AND '$end%'
                            AND a_s.stat ='0'
                        AND t.activity ='$status1'

      group by a_s.labref")->result();
            $i = 1;
            foreach ($query1 as $q1):

                $date = '-';

                $ymd = DateTime::createFromFormat('Y-m-d', $q1->date_time_tracker)->format('d-m-Y');
                $css.= ' <tr>
       <td class="tg-031e">' . $i . '</td>
    <td class="tg-031e">' . $q1->labref . '</td>
      <td class="tg-031e e12">' . $q1->product_name . '</td>
    <td class="tg-ugh9">' . $q1->quantity_issued . " " . $q1->sample_packaging . '</td> '
                        . ' <td class="tg-031e e12">' . $ymd . '</td><td class="tg-031e e12">' . $date . '</td></tr>'
                        . '</tr>';
                $i++;
            endforeach;

            $css.= '</table>';
            $css.='</center></body></html>';
        endforeach;
        echo $css;
    }

    function getReport($start, $end, $dept, $status) {

        if ($status == 'Returning%20to%20Documentation') {
            $title = 'Analyst Completed Samples Report (' . $start . ' to ' . $end . ')';
            $stat = '1';
        } else {
            $stat = '0';
            $title = 'Analyst Pending Samples Report (' . $start . ' to ' . $end . ')';
        }
        $status1 = str_replace("%20", " ", $status);
        //$this->load->view('');
        $css = '<!doctype><html><head><title>' . $title . '</title>';
        $css.= '<style type="text/css">
          .tg{width:900px;};
.tg  {border-collapse:collapse;border-spacing:0;border-color:#bbb;}
.tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#bbb;color:#594F4F;background-color:#E0FFEB;}
.tg th{font-family:Arial, sans-serif;font-size:30px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#bbb;color:#493F3F;background-color:#9DE0AD;}
.tg .tg-ugh9{background-color:#C2FFD6; width:300px;}
.tg .tg-031e .e12{background-color:#C2FFD6; width:300px;}
.he{ font-weight: bold;}
p{width:100%;
height: 5px;}
</style>


';


        $css.='</head><body>';
        $css.='<p><center><< <a href="' . base_url() . 'request_management/assigned_samples' . '">Back</a>    <strong><u>' . $title . '</u></strong></center></p>';

        $query = $this->db->query("SELECT * FROM assigned_samples WHERE date_time_tracker BETWEEN '$start%' AND '$end%' AND department_id='$dept' GROUP BY analyst_id ")->result();

        foreach ($query as $q):
            $css.='<p></p>';
            $css.='<center>';
            $css.= '<table class="tg"><tr><th class="tg-031e" colspan="6">' . $q->analyst_name . '</th></tr>';
            $css.= '<tr>
    <td class="tg-031e he">No:</td><td class="tg-031e he">Labreference No:</td><td class="tg-ugh9 he">Product Name</td><td class="tg-ugh9 he">Quantity Issued</td><td class="tg-ugh9 he">Date Issued<br>(d-m-Y)</td><td class="tg-ugh9 he">Date Returned<br>(d-m-Y)</td></tr>';
            $query1 = $this->db->query("SELECT a_s.*, si.samples_no as quantity_issued, p.name as sample_packaging, r.packaging, r.product_name,t.date_added
      FROM `assigned_samples` a_s 
      left join sample_issuance si on a_s.labref = si.lab_ref_no
      left join request r on a_s.labref = r.request_id
      left join packaging p on r.packaging = p.id
      left join tracking_table t on a_s.labref = t.labref
                        WHERE si.analyst_id ='$q->analyst_id'
            AND a_s.department_id='$dept'
                        AND a_s.date_time_tracker BETWEEN '$start%' AND '$end%'
               AND a_s.stat ='$stat'
                        AND t.activity ='$status1'

      group by a_s.labref")->result();
            $i = 1;
            foreach ($query1 as $q1):
                $ymd = DateTime::createFromFormat('Y-m-d', $q1->date_time_tracker)->format('d-m-Y');

                if ($stat == '1'):
                    $date = $q1->date_added;
                else:
                    $date = '-';
                endif;
                $css.= ' <tr>
       <td class="tg-031e">' . $i . '</td>
    <td class="tg-031e">' . $q1->labref . '</td>
        <td class="tg-031e">' . $q1->product_name . '</td>
    <td class="tg-ugh9">' . $q1->quantity_issued . " " . $q1->sample_packaging . '</td> '
                        . ' <td class="tg-031e e12">' . $ymd . '</td><td class="tg-031e">' . $date . '</td></tr>';
                $i++;
            endforeach;

            $css.= '</table>';
            $css.='</center></body></html>';
        endforeach;
        echo $css;
        /* $this->load->helper('dompdf', 'file');
          $this->load->helper('file');

          //DOMpdf configuration
          $dompdf = new DOMPDF();
          $dompdf->load_html($css);
          $dompdf->render();
          file_put_contents('assigned_samples_report/Assigned_Sample_Report.pdf', $dompdf->output()); */
    }

    function getNetReport($start, $end, $dept) {
        //$this->load->view('');
        $css = '<!doctype><html><head><title>Analyst Sample Assignment Report</title>';
        $css.= '<style type="text/css">
          .tg{width:900px;};
.tg  {border-collapse:collapse;border-spacing:0;border-color:#bbb;}
.tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#bbb;color:#594F4F;background-color:#E0FFEB;}
.tg th{font-family:Arial, sans-serif;font-size:30px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#bbb;color:#493F3F;background-color:#9DE0AD;}
.tg .tg-ugh9{background-color:#C2FFD6; width:300px;}
.tg .tg-031e .e12{background-color:#C2FFD6; width:300px;}
.he{ font-weight: bold;}
p{width:100%;
height: 5px;}
</style>


';


        $css.='</head><body>';
        $css.='<p><center><strong><u>Samples Assigned to Analyst</u></strong></center></p>';

        $query = $this->db->query("SELECT * FROM assigned_samples WHERE date_time_tracker BETWEEN '$start%' AND '$end%' AND department_id='$dept' GROUP BY analyst_id ")->result();

        foreach ($query as $q):
            $css.='<p></p>';
            $css.='<center>';
            $css.= '<table class="tg"><tr><th class="tg-031e" colspan="4">' . $q->analyst_name . '</th></tr>';
            $css.= '<tr>
    <td class="tg-031e he">No:</td><td class="tg-031e he">Labreference No:</td><td class="tg-ugh9 he">Quantity Issued</td><td class="tg-ugh9 he">Date Issued</td></tr>';
            $query1 = $this->db->query("SELECT a_s.*, si.samples_no as quantity_issued, p.name as sample_packaging, r.packaging
      FROM `assigned_samples` a_s
      left join sample_issuance si on a_s.labref = si.lab_ref_no
      left join request r on a_s.labref = r.request_id
      left join packaging p on r.packaging = p.id
      inner join supervisor_approvals sa on sa.labref = a_s.labref
                        WHERE si.analyst_id ='$q->analyst_id'
            AND a_s.department_id='$dept'
                        AND a_s.date_time_tracker BETWEEN '$start%'
                        AND '$end%'

      group by a_s.labref")->result();
            $i = 1;
            foreach ($query1 as $q1):
                $css.= ' <tr>
       <td class="tg-031e">' . $i . '</td>
    <td class="tg-031e">' . $q1->labref . '</td>
    <td class="tg-ugh9">' . $q1->quantity_issued . " " . $q1->sample_packaging . '</td> '
                        . ' <td class="tg-031e e12">' . $q1->date_time_tracker . '</td></tr>';
                $i++;
            endforeach;

            $css.= '</table>';
            $css.='</center></body></html>';
        endforeach;
        echo $css;
        /* $this->load->helper('dompdf', 'file');
          $this->load->helper('file');

          //DOMpdf configuration
          $dompdf = new DOMPDF();
          $dompdf->load_html($css);
          $dompdf->render();
          file_put_contents('assigned_samples_report/Assigned_Sample_Report.pdf', $dompdf->output()); */
    }

    function getReportPerReviewer($start, $end, $r_id = '') {
        //$this->load->view('');
        $css = '<!doctype><html><head><title>Reviewer Sample Assignment Report</title>';
        $css.= '<style type="text/css">
          .tg{width:900px;};
.tg  {border-collapse:collapse;border-spacing:0;border-color:#bbb;}
.tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#bbb;color:#594F4F;background-color:#E0FFEB;}
.tg th{font-family:Arial, sans-serif;font-size:30px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#bbb;color:#493F3F;background-color:#9DE0AD;}
.tg .tg-ugh9{background-color:#C2FFD6; width:300px;}
.tg .tg-031e .e12{background-color:#C2FFD6; width:300px;}
.he{ font-weight: bold;}
p{width:100%;
height: 5px;}
</style>


';


        $css.='</head><body>';
        $css.='<p><center><< <a href="' . base_url() . 'request_management/assigned_samples' . '">Back</a>   <strong><u>Samples Assigned to Reviewers </u></strong></center></p>';

        $query = $this->db->query("SELECT r.*, concat(u.title,' ',u.fname,' ',u.lname) as reviewer_name FROM reviewer_worksheets r, user u WHERE r.time_done BETWEEN '$start%' AND '$end%' AND r.reviewer_id = u.id AND r.reviewer_id = $r_id GROUP BY reviewer_id ")->result();

        foreach ($query as $q):
            $css.='<p></p>';
            $css.='<center>';
            $css.= '<table class="tg"><tr><th class="tg-031e" colspan="4">' . $q->reviewer_name . '</th></tr>';
            $css.= '<tr>
    <td class="tg-031e he">No:</td><td class="tg-031e he">Labreference No:</td><td class="tg-ugh9 he">Product Name</td><td class="tg-ugh9 he">Date Issued</td></tr>';
            $query1 = $this->db->query("SELECT * FROM reviewer_worksheets r_w, request r

                        WHERE r_w.reviewer_id ='$q->reviewer_id'
					    AND r_w.folder = r.request_id
                        AND r_w.time_done BETWEEN '$start%'
                        AND '$end%'

			group by r_w.folder")->result();
            $i = 1;
            foreach ($query1 as $q1):
                $css.= ' <tr>
       <td class="tg-031e">' . $i . '</td>
    <td class="tg-031e">' . $q1->folder . '</td>
	<td class="tg-031e">' . $q1->product_name . '</td>'
                        . ' <td class="tg-031e e12">' . $q1->time_done . '</td></tr>';
                $i++;
            endforeach;

            $css.= '</table>';
            $css.='</center></body></html>';
        endforeach;
        echo $css;
        /* $this->load->helper('dompdf', 'file');
          $this->load->helper('file');

          //DOMpdf configuration
          $dompdf = new DOMPDF();
          $dompdf->load_html($css);
          $dompdf->render();
          file_put_contents('assigned_samples_report/Assigned_Sample_Report.pdf', $dompdf->output()); */
    }

    function getReviewerReport($start, $end, $dept = '') {
        //$this->load->view('');
        $css = '<!doctype><html><head><title>Reviewer Sample Assignment Report</title>';
        $css.= '<style type="text/css">
          .tg{width:900px;};
.tg  {border-collapse:collapse;border-spacing:0;border-color:#bbb;}
.tg td{font-family:Arial, sans-serif;font-size:14px;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#bbb;color:#594F4F;background-color:#E0FFEB;}
.tg th{font-family:Arial, sans-serif;font-size:30px;font-weight:normal;padding:10px 5px;border-style:solid;border-width:1px;overflow:hidden;word-break:normal;border-color:#bbb;color:#493F3F;background-color:#9DE0AD;}
.tg .tg-ugh9{background-color:#C2FFD6; width:300px;}
.tg .tg-031e .e12{background-color:#C2FFD6; width:300px;}
.he{ font-weight: bold;}
p{width:100%;
height: 5px;}
</style>


';


        $css.='</head><body>';
        $css.='<p><center><< <a href="' . base_url() . 'request_management/assigned_samples' . '">Back</a>    <strong><strong><u>Samples Assigned to Reviewers</u></strong></center></p>';

        $query = $this->db->query("SELECT r.*, concat(u.title,' ',u.fname,' ',u.lname) as reviewer_name FROM reviewer_worksheets r, user u WHERE r.time_done BETWEEN '$start%' AND '$end%' AND r.reviewer_id = u.id GROUP BY reviewer_id ")->result();

        foreach ($query as $q):
            $css.='<p></p>';
            $css.='<center>';
            $css.= '<table class="tg"><tr><th class="tg-031e" colspan="4">' . $q->reviewer_name . '</th></tr>';
            $css.= '<tr>
    <td class="tg-031e he">No:</td><td class="tg-031e he">Labreference No:</td><td class="tg-ugh9 he">Product Name</td><td class="tg-ugh9 he">Date Issued</td></tr>';
            $query1 = $this->db->query("SELECT * FROM reviewer_worksheets r_w, request r

                        WHERE r_w.reviewer_id ='$q->reviewer_id'
					    AND r_w.folder = r.request_id
                        AND r_w.time_done BETWEEN '$start%'
                        AND '$end%'

			group by r_w.folder")->result();
            $i = 1;
            foreach ($query1 as $q1):
                $css.= ' <tr>
       <td class="tg-031e">' . $i . '</td>
    <td class="tg-031e">' . $q1->folder . '</td>
	<td class="tg-031e">' . $q1->product_name . '</td>'
                        . ' <td class="tg-031e e12">' . $q1->time_done . '</td></tr>';
                $i++;
            endforeach;

            $css.= '</table>';
            $css.='</center></body></html>';
        endforeach;
        echo $css;
        /* $this->load->helper('dompdf', 'file');
          $this->load->helper('file');

          //DOMpdf configuration
          $dompdf = new DOMPDF();
          $dompdf->load_html($css);
          $dompdf->render();
          file_put_contents('assigned_samples_report/Assigned_Sample_Report.pdf', $dompdf->output()); */
    }

    function getSampleActivity($start, $end) {
        $data['start'] = $start;
        $data['end'] = $end;
        $data['received'] = $this->received($start, $end);
        $data['all_assigned'] = $this->all_assigned($start, $end);
        $data['assigned_wet'] = $this->assigned_wet($start, $end);
        $data['assigned_mic'] = $this->assigned_mic($start, $end);
        $this->load->view('assigned_samples_report_to.php', $data);
    }

    function received($start, $end) {
        return $this->db->query("SELECT DISTINCT (
count( request_id )
) AS received
FROM `request`
WHERE designation_date
BETWEEN '$start'
AND '$end'")->result();
    }

    function all_assigned($start, $end) {
        return $this->db->query("SELECT DISTINCT (
count( labref )
) AS all_assigned
FROM `assigned_samples`
WHERE date_time_tracker
BETWEEN '$start'
AND '$end'")->result();
    }

    function assigned_wet($start, $end) {
        return $this->db->query("SELECT DISTINCT (
count( labref )
) AS assigned_wet
FROM `assigned_samples`
WHERE department_id = '1'
AND date_time_tracker
BETWEEN '$start'
AND '$end'")->result();
    }

    function assigned_mic($start, $end) {
        return $this->db->query("SELECT DISTINCT (
count( labref )
) AS assigned_mic
FROM `assigned_samples`
WHERE department_id = '2'
AND date_time_tracker
BETWEEN '$start'
AND '$end'")->result();
    }

    function generateReport($labref) {

        $data['labref'] = $this->uri->segment(3);
        $data['tracking_one'] = $this->tracking1($labref);
        $data['tracking_two'] = $this->tracking2($labref);
        $data['title'] = 'Reviewer page';
        $data['settings_view'] = 'tracking_report_v';
        $this->base_params($data);
    }

    function tracking1($labref) {
        return $this->db->where('labref', $labref)->get('sample_details')->result_array();
    }

    function tracking2($labref) {
        return $this->db->where('labref', $labref)->get('sample_details')->result_array();
    }

    function getMerged($labref) {
        $arr1 = $this->tracking2($labref);
        $new = array_splice($arr1, 1);

        print "<pre>";
        print_r($new);
        print "</pre>";
    }

    public function base_params($data) {
        $labref = $this->uri->segment(3);
        $data['title'] = "ACTIVITY LOG - " . $labref;
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
