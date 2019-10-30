<?php

require_once APPPATH . 'third_party/PhpWord/Autoloader.php';
\PhpOffice\PhpWord\Autoloader::register();
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Wordexe extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('Word');
    }

    function generate($labref) {
        //Initialize Settings
        $linespacing = $this->input->post('coa_line_spacing');

        if ($linespacing === '0'):
            $theight = '';
            $rtrheight = '';
        else:
            $theight = $this->input->post('theight');
            $rtrheight = $this->input->post('rtrheight');
        endif;

        $label_size = $this->input->post('label_size');
        $sublabel_size = $this->input->post('sublabel_size');

        $coa_size_top = $this->input->post('coa_size');
        $coa_size_rsize = $this->input->post('coa_size_rsize');

        $fcfont = $this->input->post('fcfont');
        $fmfont = $this->input->post('fmfont');
        $flfont = $this->input->post('flfont');

        $rtfont = $this->input->post('rtfont');
        $rtconclusion = $this->input->post('rtconclusion');

        $sdes = $this->input->post('sdes');
        $sname = $this->input->post('sname');
        $sdate = $this->input->post('sdate');




        $tests_requested = $this->getRequestedTests($labref);
        $information = $this->getRequestInformation($labref);
        $trd = $this->getRequestedTestsDisplay2($labref);
        $coa_details = $this->getAssayDissSummary($labref);
        $signatories = $this->getSignatories($labref);
        //create a new word document
        $word = new \PhpOffice\PhpWord\PhpWord();
        $word->setDefaultFontName('Book Antiqua');
        $word->setDefaultParagraphStyle(
                array(
                    'spaceAfter' => \PhpOffice\PhpWord\Shared\Converter::pointToTwip(0),
                    'spacing' => 0,
                )
        );
        //create potrait orientation
        $section = $word->createSection();
        $section_styling = $section->getStyle();
        $section_styling->setPaperSize('A4');
        $section_styling->setPageSizeW(\PhpOffice\PhpWord\Shared\Converter::inchToTwip(8.27));
        $section_styling->setPageSizeH(\PhpOffice\PhpWord\Shared\Converter::inchToTwip(11.69));
        $section_styling->setMarginLeft(\PhpOffice\PhpWord\Shared\Converter::inchToTwip(1.25));
        $section_styling->setMarginRight(\PhpOffice\PhpWord\Shared\Converter::inchToTwip(1.25));
        $section_styling->setMarginTop(\PhpOffice\PhpWord\Shared\Converter::inchToTwip(1.63));
        $section_styling->setMarginBottom(\PhpOffice\PhpWord\Shared\Converter::inchToTwip(.2));
        $section_styling->setGutter(\PhpOffice\PhpWord\Shared\Converter::inchToTwip(0));
        $section_styling->setGutter(array('position' => 'left'));







        $title = $section->addTextRun(array('alignment' => 'center'));
        $styleTop = array('bold' => true, 'size' => $label_size);
        $title->addText(htmlspecialchars('CERTIFICATE OF ANALYSIS', ENT_COMPAT, 'UTF-8'), $styleTop, array('space' => array('before' => 0, 'after' => 0)));
   
        //Certificate Number Area
        $certificate_no = $section->addTextRun(array('alignment' => 'center'));
        $styleTop1 = array('bold' => true, 'size' => $sublabel_size, 'align' => 'center');
        $styleTop21 = array('size' => $sublabel_size, 'underline' => \PhpOffice\PhpWord\Style\Font::UNDERLINE_SINGLE);
        $certificate_no->addText(htmlspecialchars('CERTIFICATE No: ', ENT_COMPAT, 'UTF-8'), $styleTop1, array('space' => array('before' => 0, 'after' => 0)));
        $certificate_no->addText(htmlspecialchars(@$information[0]->CAN, ENT_COMPAT, 'UTF-8'), $styleTop21, array('space' => array('before' => 0, 'after' => 0)));


        //Styling
        $gridspan = array('gridSpan' => 2);
        $Centered = array('alignment' => 'center', 'valignment' => 'center');
        $cellVCentered = array('valign' => 'center');



        //Main Table Area
       

        $fancyTableCellStyle = array('valign' => 'center','cellMargin'=>4);


        $border = array('width' => $coa_size_top * $coa_size_top, 'unit' => 'pct', 'align' => 'center', 'valign' => 'middle', 'borderColor' => '000000');

        $table = $section->addTable($border);
        $style_top_mid = array('bold' => true, 'size' => 8, 'alignment' => 'left', 'valigment' => 'middle');
        $style = array('bold' => true, 'size' => $fcfont);
        $style1 = array('size' =>$rtfont );
        //header row
        $table->addRow(400);
        $table->addCell(2100, array('bgColor' => 'D9D9D9', 'valign' => 'center', 'align' => 'center'))->addText(htmlspecialchars('PRODUCT', ENT_COMPAT, 'UTF-8'), $style, array('alignment' => 'center'));
        $table->addCell(6200, array('bgColor' => 'D9D9D9', 'gridspan' => 2))->addText(htmlspecialchars($information[0]->product_name, ENT_COMPAT, 'UTF-8'), $cellVCentered);
        $table->addCell(3500, array('bgColor' => 'D9D9D9', 'valign' => 'center', 'alignment' => 'right'))->addText(htmlspecialchars('REF. NO: ' . $information[0]->request_id, ENT_COMPAT, 'UTF-8'), array('bold' => true, 'size' => 8));
        //Row 1
        $table->addRow($theight);
        $cell_c1 = $table->addCell(1500, array('bgColor' => 'C0C0C0'));
        $run1 = $cell_c1->addTextRun($Centered);
        $run1->addText(htmlspecialchars('DATE RECEIVED:', ENT_COMPAT, 'UTF-8'), $style);
        $run1->addTextBreak(1);
        $run1->addText(htmlspecialchars($information[0]->designation_date, ENT_COMPAT, 'UTF-8'), array('size' => $fmfont));
        $table->addCell(2000)->addText(htmlspecialchars('LABEL CLAIM:  ', ENT_COMPAT, 'UTF-8'), $style_top_mid);
        $cell1 = $table->addCell(5000, $gridspan);
        $cell1->addText(htmlspecialchars($information[0]->label_claim, ENT_COMPAT, 'UTF-8'), array('size' => $flfont));
        //Row 2
        $table->addRow($theight);
        $cell_c2 = $table->addCell(1500, array('bgColor' => 'C0C0C0'));
        $run2 = $cell_c2->addTextRun($Centered);
        $run2->addText(htmlspecialchars('BATCH NO.:', ENT_COMPAT, 'UTF-8'), $style);
        $run2->addTextBreak(1);
        $run2->addText(htmlspecialchars($information[0]->batch_no, ENT_COMPAT, 'UTF-8'), array('size' => $fmfont));
        $table->addCell(2000)->addText(htmlspecialchars('PRESENTATION:  ', ENT_COMPAT, 'UTF-8'), $style_top_mid);
        $cell2 = $table->addCell(5000, $gridspan);
        $cell2->addText(htmlspecialchars($information[0]->presentation, ENT_COMPAT, 'UTF-8'), array('size' => $flfont));

        //Row 3
        $table->addRow($theight);
        $cell_c3 = $table->addCell(1500, array('bgColor' => 'C0C0C0'));
        $run3 = $cell_c3->addTextRun($Centered);
        $run3->addText(htmlspecialchars('MFG. DATE:', ENT_COMPAT, 'UTF-8'), $style);
        $run3->addTextBreak(1);
        $run3->addText(htmlspecialchars($information[0]->manufacture_date, ENT_COMPAT, 'UTF-8'), array('size' => $fmfont));
        $table->addCell(2000)->addText(htmlspecialchars('MANUFACTURER:  ', ENT_COMPAT, 'UTF-8'), $style_top_mid);
        $cell3 = $table->addCell(5000, $gridspan);
        $cell3->addText(htmlspecialchars($information[0]->manufacturer_name, ENT_COMPAT, 'UTF-8'), array('size' => $flfont));

        //Row 4
        $table->addRow($theight);
        $cell_c4 = $table->addCell(1500, array('bgColor' => 'C0C0C0'));
        $run4 = $cell_c4->addTextRun($Centered);
        $run4->addText(htmlspecialchars('EXP. DATE:', ENT_COMPAT, 'UTF-8'), $style);
        $run4->addTextBreak(1);
        $run4->addText(htmlspecialchars($information[0]->exp_date, ENT_COMPAT, 'UTF-8'), array('size' => $fmfont));
        $table->addCell(2000)->addText(htmlspecialchars('ADDRESS:  ', ENT_COMPAT, 'UTF-8'), $style_top_mid);
        $cell4 = $table->addCell(5000, $gridspan);
        $cell4->addText(htmlspecialchars($information[0]->manufacturer_add, ENT_COMPAT, 'UTF-8'), array('size' => $flfont));


        //Row 5
        $table->addRow($theight);
        $cell_c5 = $table->addCell(1500, array('bgColor' => 'C0C0C0'));
        $run5 = $cell_c5->addTextRun($Centered);
        $run5->addText(htmlspecialchars('CLIENT REF NO:', ENT_COMPAT, 'UTF-8'), $style);
        $table->addCell(2000)->addText(htmlspecialchars('CLIENT:  ', ENT_COMPAT, 'UTF-8'), $style_top_mid);
        $cell5 = $table->addCell(5000, $gridspan);
        $cell5->addText(htmlspecialchars($information[0]->name . " " . $information[0]->address, ENT_COMPAT, 'UTF-8'), array('size' => 8));



        //Row 6
        $table->addRow();
        $cell_c6 = $table->addCell(1500, array('bgColor' => 'C0C0C0'));
        $run6 = $cell_c6->addTextRun($Centered);
        $run6->addText(htmlspecialchars($information[0]->clientsampleref), array('size' => $fmfont));
        $table->addCell(2100)->addText(htmlspecialchars('TEST(S) REQUESTED:  ', ENT_COMPAT, 'UTF-8'), $style_top_mid);
        $cell6 = $table->addCell(5000, $gridspan);
        $cell6->addText(htmlspecialchars($tests_requested, ENT_COMPAT, 'UTF-8'), array('size' => $flfont));


        $section->addTextBreak(1);


        $title1 = $section->addTextRun(array('alignment' => 'center'));
        $title1->addText(htmlspecialchars('RESULTS', ENT_COMPAT, 'UTF-8'), array('bold'=>true,'size'=>8));

        $section->addTextBreak(1);
        $paragraphStyle = array('alignment' => 'center', 'halignment' => 'center', 'spaceBefore' => 0, 'spaceAfter' => 0);
        $word->addParagraphStyle('pStyle', $paragraphStyle);

        $style3 = array('bold' => true, 'size' =>$rtfont , 'name' => 'Book Antiqua', 'alignment' => 'center', 'valignment' => 'middle');
        $table3 = $section->addTable(array('width' => $coa_size_rsize * $coa_size_rsize, 'unit' => 'pct', 'align' => 'center', 'borderColor' => '000000', 'borderSize' => 1), 'pStyle');

        $table3->addRow($rtrheight, $fancyTableCellStyle);
        $table3->addCell(1200, array('bgColor' => 'CCCCCC', 'cellMargin'=>4,'valign' => 'center'), 'PStyle')->addText(htmlspecialchars('TEST', ENT_COMPAT, 'UTF-8'), $style3, 'pStyle');
        $table3->addCell(1200, $fancyTableCellStyle)->addText(htmlspecialchars('METHOD', ENT_COMPAT, 'UTF-8'), $style3, 'pStyle');
        $table3->addCell(1400, $fancyTableCellStyle)->addText(htmlspecialchars('COMPENDIA', ENT_COMPAT, 'UTF-8'), $style3, 'pStyle');
        $table3->addCell(2600, $fancyTableCellStyle)->addText(htmlspecialchars('SPECIFICATION', ENT_COMPAT, 'UTF-8'), $style3, 'pStyle');
        $table3->addCell(2000, $fancyTableCellStyle)->addText(htmlspecialchars('DETERMINED', ENT_COMPAT, 'UTF-8'), $style3, 'pStyle');
        $table3->addCell(800, array('bgColor' => 'D9D9D9', 'valign' => 'center','cellMargin'=>4))->addText(htmlspecialchars('REMARKS', ENT_COMPAT, 'UTF-8'), $style3, 'pStyle');

        for ($i = 0; $i < count($trd); $i++) {

            foreach ($coa_details as $coa) {

                if ($coa->test_id == $trd[$i]->test_id) {
                }
            }
            $determine = explode(":", $trd[$i]->determined);
            $methods = explode(":", $trd[$i]->method);
            $compedia = explode(":", $trd[$i]->compedia);
            $specification = explode(":", $trd[$i]->specification);
            $complies = explode(":", $trd[$i]->complies);
            for ($d = 0; $d < count($determine); $d++):


                $table3->addRow($rtrheight);
                $table3->addCell(1200, array('bgColor' => 'dbdbdb', 'valign' => 'center'), 'pStyle')->addText(htmlspecialchars($trd[$i]->name, ENT_COMPAT, 'UTF-8'), array('bold' => true), 'pStyle');
                $table3->addCell(1200, $fancyTableCellStyle)->addText(htmlspecialchars($methods[$d], ENT_COMPAT, 'UTF-8'), $style1, 'pStyle');
                $table3->addCell(1400, $fancyTableCellStyle)->addText(htmlspecialchars($compedia[$d], ENT_COMPAT, 'UTF-8'), $style1, 'pStyle');
                $table3->addCell(2600, $fancyTableCellStyle)->addText(htmlspecialchars($specification[$d], ENT_COMPAT, 'UTF-8'), $style1, 'pStyle');
                $table3->addCell(2000, $fancyTableCellStyle)->addText(htmlspecialchars($determine[$d], ENT_COMPAT, 'UTF-8'), $style1, 'pStyle');

                $table3->addCell(800, array('bgColor' => 'dbdbdb', 'valign' => 'center'))->addText(htmlspecialchars($complies[$d], ENT_COMPAT, 'UTF-8'), array('bold' => true, 'size' => 8), 'pStyle');

            endfor;
        }

        $section->addTextBreak(1);
        $conc = array('bgColor' => 'D9D9D9', 'size' => $rtconclusion);
        $conclusion = $section->addTextRun(array('alignment' => 'left'));
        $conclusion->addText(htmlspecialchars('CONCLUSION: ', ENT_COMPAT, 'UTF-8'), array('bold' => true));
        $conclusion->addText(htmlspecialchars($coa->conclusion, ENT_COMPAT, 'UTF-8'), $conc);
        $section->addTextBreak(1);

        $table4 = $section->addTable();
        $new_stlye = array('valign' => 'bottom');
        $_1 = array('size' => $sname, 'bold' => TRUE);
        $_2 = array('size' => $sdes);
        $_3 = array('size' => $sdate);

        foreach ($signatories as $signatures):
            $table4->addRow(400);
            $table4->addCell(1500, $new_stlye)->addText(htmlspecialchars(strtoupper($signatures->designation), ENT_COMPAT, 'UTF-8'), $_1);
            $table4->addCell(2100, $new_stlye)->addText(htmlspecialchars(strtoupper($signatures->signature_name), ENT_COMPAT, 'UTF-8'), $_2);
            $table4->addCell(2000, $new_stlye)->addText(htmlspecialchars('..........................................................'));
            $table4->addCell(2000, $new_stlye)->addText(htmlspecialchars('DATE: ' . $signatures->date_signed), ENT_COMPAT, 'UTF-8', $_3);
        endforeach;


        // Save File
        unlink('printed_coa/' . $labref . '.docx');

        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($word, 'Word2007');
        $objWriter->save('printed_coa/' . $labref . '.docx'); // so far so good

        echo 'Text.docx created successfully';
    }

    function example($labref) {
        $trd = $this->getRequestedTestsDisplay2($labref);
        for ($i = 0; $i < count($trd); $i++):
            echo '<pre>';
            print_r(explode(":", $trd[$i]->determined));
            echo '</pre>';
        endfor;

        $arra = array(
            'determined' => 'Lamivudine 95.7% (n=6; RSD=2.9%) :'
            . ' Tenofovir disoproxil Fumarate  90.7% (n=6; RSD=4.8%):'
            . ' Efavirenz   92.7%  (n=6; RSD=1.1%)'
        );

        print_r($arra);
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
        return $tests = implode(', ', $output);
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

    function getRequestedTestsDisplay2($labref) {
        $query = $this->db->query("SELECT rd.index_id, rd.test_id,t.name, c.* FROM coa_body c JOIN request_details rd ON c.labref = rd.request_id JOIN tests t ON c.test_id = t.id AND rd.test_id = c.test_id WHERE c.labref='$labref' ORDER BY rd.index_id ");
        $result = $query->result();
        // print_r($result);

        return $result;
        // print_r($result);
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
        $query = $this->db->get('signature_table');
        return $result = $query->result();
        // print_r($result);
    }

    function loadFindReplace($current, $proposed) {



        $phpWord = new \PhpOffice\PhpWord\PhpWord();



        $document = $phpWord->loadTemplate('printed_coa/' . $current . '.docx');
        $document->saveAs('printed_coa/' . $proposed . '.docx');



        echo 'Replicating template was a success';
    }

}

?>
