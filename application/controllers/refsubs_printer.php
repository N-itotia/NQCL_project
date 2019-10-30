<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Refsubs_printer extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('excel');
    }

    function generate($status) {

        $objReader = PHPExcel_IOFactory::createReader('Excel2007');
        $objPHPExcel = $objReader->load("refsubs_template/template.xlsx");
        $objPHPExcel->getActiveSheet(0);
        $signatories = $this->getSignatories($status);

        $worksheet = $objPHPExcel->getActiveSheet();
        $styleArray = array(
            'borders' => array(
                'outline' => array(
                    'style' => PHPExcel_Style_Border::BORDER_THICK,
                    'color' => array('argb' => 'FFFF0000'),
                ),
            ),
        );
        $worksheet->setCellValue('A2', 'NQCL ' . $status . ' STANDARDS');
        $row2 = 4;

        foreach ($signatories as $signatures):
            $col = 0;
            $worksheet
                    ->setCellValueByColumnAndRow($col++, $row2, $signatures->name)
                    ->setCellValueByColumnAndRow($col++, $row2, $signatures->standard_type)
                    ->setCellValueByColumnAndRow($col++, $row2, $signatures->source)
                    ->setCellValueByColumnAndRow($col++, $row2, $signatures->batch_no)
                    ->setCellValueByColumnAndRow($col++, $row2, $signatures->rs_code)
					->setCellValueByColumnAndRow($col++, $row2, $signatures->rs_code_prefix)
					->setCellValueByColumnAndRow($col++, $row2, $signatures->serial_no)
                    ->setCellValueByColumnAndRow($col++, $row2, $signatures->date_received)
                    ->setCellValueByColumnAndRow($col++, $row2, $signatures->date_of_expiry)
                    ->setCellValueByColumnAndRow($col++, $row2, $signatures->potency)
					->setCellValueByColumnAndRow($col++, $row2, $signatures->potency_unit)
                    ->setCellValueByColumnAndRow($col++, $row2, $signatures->quantity)
                    ->setCellValueByColumnAndRow($col++, $row2, $signatures->init_mass)
					->setCellValueByColumnAndRow($col++, $row2, $signatures->init_mass_unit);

            $row2++;
        endforeach;


        $objPHPExcel->getActiveSheet()->setTitle(date('d-m-Y'));
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        unlink('refsubs_template/'.$status . "_standards.xlsx");
        $objWriter->save("refsubs_template/" . $status . "_standards.xlsx");


        echo 'Data exported';
    }

    function getSignatories($status) {
        if ($status == 'Expired') {
            return $this->db->where('status', $status)->get('refsubs')->result();
        } else if ($status == 'Primary') {
            return $this->db->where('standard_type', $status)->get('refsubs')->result();
        }else if ($status == 'Working') {
            return $this->db->where('standard_type', $status)->get('refsubs')->result();
        }
		else if ($status == 'Effective'){
		  return $this->db->query("SELECT * FROM refsubs WHERE date_of_expiry > curdate() AND standard_type ='Working' ")->result();
		}
		else if($status == 'Duplicated'){
			return $this -> db -> query("SELECT * FROM refsubs WHERE date_of_expiry > curdate() AND standard_type ='Working' AND rs_code in (select rs_code from refsubs group by rs_code having count(*) >= 2) ") -> result();
		}
		else if($status == 'Duplicated-Expired'){
			return $this -> db -> query("SELECT * FROM refsubs WHERE date_of_expiry < curdate() AND standard_type ='Working' AND rs_code in (select rs_code from refsubs group by rs_code having count(*) >= 2) ") -> result();
		}
		else if($status == 'USP'){
			return $this -> db -> query("SELECT * FROM refsubs WHERE source ='USP'") -> result();
		}
		else if($status == 'New'){
			return $this -> db -> query("SELECT * FROM refsubs WHERE rs_code IN (
'NQCL-WRS-A26-2',
'NQCL-WRS-A15',
'NQCL-WRS-A4-1',
'NQCL-WRS-A4-1',
'NQCL-WRS-B12-1',
'NQCL-WRS-B12-1',
'NQCL-WRS-C8-1',
'NQCL-WRS-C2-6',
'NQCL-WRS-C2-1',
'NQCL-WRS-C3-1',
'NQCL-WRS-C28-1',
'NQCL-WRS-C28-1',
'NQCL-WRS-C30',
'NQCL-WRS-C4-1',
'NQCL-WRS-C32-1',
'NQCL-WRS-D6-1',
'NQCL-WRS-D6-1',
'NQCL-WRS-D6-1',
'NQCL-WRS-D12-1',
'NQCL-WRS-D16-1',
'NQCL-WRS-F3-1',
'NQCL-WRS-F3-1',
'NQCL-WRS-G2-1',
'NQCL-WRS-G2-1',
'NQCL-WRS-G11-1',
'NQCL-WRS-H1-1',
'NQCL-WRS-I2-1',
'NQCL-WRS-I2',
'NQCL-WRS-I2',
'NQCL-WRS-L3-1',
'NQCL-WRS-B12-1',
'NQCL-WRS-L19-1',
'NQCL-WRS-L9-1',
'NQCL-WRS-L8-1',
'NQCL-WRS-L10-1',
'NQCL-WRS-L1-1',
'NQCL-WRS-M21',
'NQCL-WRS-M19-1',
'NQCL-WRS-M4-1',
'NQCL-WRS-M20',
'NQCL-WRS-M11-1',
'NQCL-WRS-M9-1',
'NQCL-WRS-M6',
'NQCL-WRS-N9-1',
'NQCL-WRS-N9-1',
'NQCL-WRS-O11',
'NQCL-WRS-O2-1',
'NQCL-WRS-O2-1',
'NQCL-WRS-O14-1',
'NQCL-WRS-B12-1',
'NQCL-WRS-P24-1',
'NQCL-WRS-P24',
'NQCL-WRS-P32-1',
'NQCL-WRS-P33-1',
'NQCL-WRS-P10-1',
'NQCL-WRS-S39-1',
'NQCL-WRS-Z1-1')
") -> result();
		}
				else if($status == 'New_Batch'){
			return $this -> db -> query("SELECT * FROM refsubs WHERE batch_no IN (
				'WS/14/004',
'SEP/13037',
'AZ159A13',
'AZ159A13',
'WS255NO',
'WS255C0',
'66020200061',
'WS-MU09-066',
'WS/13(2)/048',
'BCFANG002714',
'GW/CPM20113',
'GW/CPM20113',
'WC/004',
'P-06-WS20131203',
'WS-13/13',
'131229-5W',
'WS/T-008/13/A',
'WSN-558',
'WS14034',
'2139vMOC0051222',
'WS/FAL/18',
'1310003',
'WRS-GO512',
'3003GP4J11',
'C009',
'HYDWS1301',
'100977-201101',
'100977-201101',
'100977-201101',
'03WS1400052',
'07WS13000057',
'KY-LFA-M20140419E',
'KY-LFA-M20130612',
'001052012LCH',
'LNZ0871113',
'070-WS-130006',
'BA23913',
'METWS1401',
'MP-200/11-12',
'F-3846',
'MBO112080431',
'WSI/016/14',
'WS062C0',
'QC/WS/NEBI-01/14',
'NEBWS1301',
'RS1308036700',
'WS/13(2)/132',
'WS/OH-U/001',
'WS069P0',
'07ws13000037',
'PEO/11/1212/103/106',
'PHEN/001/12',
'WS/14/2014',
'WS050D0',
'1416/WS/004',
'03WS14000067',
'03WS1400044')") -> result();
		}
    }

}
