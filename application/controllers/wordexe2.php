<?php
require_once APPPATH.'third_party/PhpWord/Autoloader.php';
\PhpOffice\PhpWord\Autoloader::register();
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Wordexe2 extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->library('Word');
    }

    function generate($labref) {
        

        
        
        $tests_requested = $this->getRequestedTests($labref);
        $information = $this->getRequestInformation($labref);
        $trd = $this->getRequestedTestsDisplay2($labref);
        $coa_details = $this->getAssayDissSummary($labref);
        $signatories = $this->getSignatories($labref);
        //create a new word document
        $word = new \PhpOffice\PhpWord\PhpWord();
        $word->setDefaultFontName('Book Antiqua');
        //$word->setDefaultParagraphStyle(
             // array('alignment' => 'center','valignment' => 'center')
              //  );
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
        $section_styling->setGutter(array('position'=>'left'));
        
        
       //Title Area
        $title=$section->addTextRun(array('alignment'=>'center'));
        $styleTop = array('bold' => true, 'size' => 18);
        $styleTop2= array('alignment' => 'center');       
        $title->addText(htmlspecialchars('CERTIFICATE OF ANALYSIS',ENT_COMPAT,'UTF-8'), $styleTop,$styleTop2);
       // $section->addTextBreak(1);
     //Certificate Number Area
        $certificate_no=$section->addTextRun(array('alignment'=>'center'));
        $styleTop1 = array('bold' => true, 'size' => 13, 'align'=>'center');
        $styleTop21 = array( 'size' => 13,'underline'=>\PhpOffice\PhpWord\Style\Font::UNDERLINE_SINGLE);      
        $certificate_no->addText(htmlspecialchars('CERTIFICATE No: ',ENT_COMPAT,'UTF-8'),$styleTop1);
        $certificate_no->addText(htmlspecialchars(@$information[0]->CAN,ENT_COMPAT,'UTF-8'),$styleTop21);

        
          //Styling
        $styleTable = array('borderSize' => 6, 'borderColor' => '999999');
        $cellRowSpan = array('vMerge' => 'restart', 'valign' => 'center', 'bgColor' => 'FFFF00');
        $cellRowContinue = array('vMerge' => 'continue');
        $cellColSpan = array('gridSpan' => 2, 'valign' => 'center');
        $gridspan = array('gridSpan' => 2);
        $Centered = array('alignment' => 'center','valignment' => 'center');
        $cellVCentered = array('valign' => 'center');
       
        

          //Main Table Area
       // $section->addTextBreak(1);
        

        $border = array('width' => 81.5 * 81.5, 'unit' => 'pct', 'align' => 'center','valign'=>'center','borderColor' => '000000');

        $table = $section->addTable($border);     
        $style_top_mid = array('bold' => true, 'size' => 11,'alignment'=>'left','valigment'=>'top');
        $style = array('bold' => true, 'size' => 11);
        $style1 = array('bold' => true, 'size' => 11);
        //header row
        $table->addRow();
        $table->addCell(2100, array('bgColor' => 'D9D9D9','alignment' => 'center','valignment' => 'center'))->addText(htmlspecialchars('PRODUCT',ENT_COMPAT,'UTF-8'), $style);
        $table->addCell(6000, array('bgColor' => 'D9D9D9','gridspan'=>2))->addText(htmlspecialchars($information[0]->product_name,ENT_COMPAT,'UTF-8'),$cellVCentered);
        $table->addCell(3000, array('bgColor' => 'D9D9D9'))->addText(htmlspecialchars('REF. NO: '.$information[0]->request_id,ENT_COMPAT,'UTF-8'),$cellVCentered);
        //Row 1
        $table->addRow();
        $cell_c1=$table->addCell(2100, array('bgColor' => 'C0C0C0'));
        $run1=$cell_c1->addTextRun($Centered);
        $run1->addText(htmlspecialchars('DATE RECEIVED:',ENT_COMPAT,'UTF-8'),$style);
        $run1->addTextBreak(1);
        $run1->addText(htmlspecialchars($information[0]->designation_date,ENT_COMPAT,'UTF-8'));
        $table->addCell(2500)->addText(htmlspecialchars('LABEL CLAIM:  ',ENT_COMPAT,'UTF-8'),$style_top_mid);
        $cell1= $table->addCell(5000,$gridspan);
        $cell1->addText(htmlspecialchars($information[0]->label_claim,ENT_COMPAT,'UTF-8'));
        //Row 2
        $table->addRow();
        $cell_c2=$table->addCell(2100, array('bgColor' => 'C0C0C0'));
        $run2=$cell_c2->addTextRun($Centered);
        $run2->addText(htmlspecialchars('BATCH NO.:',ENT_COMPAT,'UTF-8'),$style);
        $run2->addTextBreak(1);
        $run2->addText(htmlspecialchars($information[0]->batch_no,ENT_COMPAT,'UTF-8'));
        $table->addCell(2500)->addText(htmlspecialchars('PRESENTATION:  ',ENT_COMPAT,'UTF-8'),$style_top_mid);
        $cell2= $table->addCell(5000,$gridspan);
        $cell2->addText(htmlspecialchars($information[0]->presentation,ENT_COMPAT,'UTF-8'));

        //Row 3
        $table->addRow();
        $cell_c3=$table->addCell(2100, array('bgColor' => 'C0C0C0'));
        $run3=$cell_c3->addTextRun($Centered);
        $run3->addText(htmlspecialchars('MGF. DATE:',ENT_COMPAT,'UTF-8'),$style);
        $run3->addTextBreak(1);
        $run3->addText(htmlspecialchars($information[0]->manufacture_date,ENT_COMPAT,'UTF-8'));
        $table->addCell(2500)->addText(htmlspecialchars('MANUFACTURER:  ',ENT_COMPAT,'UTF-8'),$style_top_mid);
        $cell3= $table->addCell(5000,$gridspan);
        $cell3->addText(htmlspecialchars($information[0]->manufacturer_name,ENT_COMPAT,'UTF-8'));

        //Row 4
        $table->addRow();
        $cell_c4=$table->addCell(2100, array('bgColor' => 'C0C0C0'));
        $run4=$cell_c4->addTextRun($Centered);
        $run4->addText(htmlspecialchars('EXP. DATE:',ENT_COMPAT,'UTF-8'),$style);
        $run4->addTextBreak(1);
        $run4->addText(htmlspecialchars($information[0]->exp_date,ENT_COMPAT,'UTF-8'));
        $table->addCell(2500)->addText(htmlspecialchars('ADDRESS:  ',ENT_COMPAT,'UTF-8'),$style_top_mid);        
        $cell4= $table->addCell(5000,$gridspan);
        $cell4->addText(htmlspecialchars($information[0]->manufacturer_add,ENT_COMPAT,'UTF-8'));
       

        //Row 5
        $table->addRow();        
        $cell_c5=$table->addCell(2100, array('bgColor' => 'C0C0C0'));
        $run5=$cell_c5->addTextRun($Centered);
        $run5->addText(htmlspecialchars('CLIENT REF NO:',ENT_COMPAT,'UTF-8'),$style);       
        $table->addCell(2500)->addText(htmlspecialchars('CLIENT:  ',ENT_COMPAT,'UTF-8'),$style_top_mid);       
        $cell5= $table->addCell(5000,$gridspan);
        $cell5->addText(htmlspecialchars($information[0]->name . " " . $information[0]->address,ENT_COMPAT,'UTF-8'));
     


        //Row 6
        $table->addRow();        
        $cell_c6=$table->addCell(2100, array('bgColor' => 'C0C0C0'));
        $run6=$cell_c6->addTextRun($Centered);
        $run6->addText(htmlspecialchars($information[0]->clientsampleref));        
        $table->addCell(2100)->addText(htmlspecialchars('TEST(S) REQUESTED:  ',ENT_COMPAT,'UTF-8'),$style_top_mid);     
        $cell6= $table->addCell(5000,$gridspan);
        $cell6->addText(htmlspecialchars($tests_requested,ENT_COMPAT,'UTF-8'));
      

        $section->addTextBreak(1);
        $paragraphStyle = array('alignment' => 'center','halignment'=>'center');
        $word->addParagraphStyle('pStyle', $paragraphStyle);
		
		$title1=$section->addTextRun(array('alignment'=>'center'));
        $styleTop1 = array('bold' => true, 'size' => 10);
        $styleTop21= array('alignment' => 'center');       
        $title1->addText(htmlspecialchars('RESULTS',ENT_COMPAT,'UTF-8'), $styleTop1,$styleTop21);
		
		$section->addTextBreak(1);
        $paragraphStyle = array('alignment' => 'center','halignment'=>'center');
        $word->addParagraphStyle('pStyle', $paragraphStyle);
        

        $style3 = array('bold' => true, 'size' => 9, 'name' => 'Book Antiqua','alignment'=>'center','valignment'=>'center');
        $table3 = $section->addTable(array('width' => 80 * 80, 'unit' => 'pct', 'align' => 'center','borderColor' =>'000000','borderSize'=>1),'pStyle');
        
        $table3->addRow();
        $table3->addCell(1200, array('bgColor' => 'CCCCCC'),'PStyle')->addText(htmlspecialchars('TEST',ENT_COMPAT,'UTF-8'), $style3,'pStyle');
        $table3->addCell(1200)->addText(htmlspecialchars('METHOD',ENT_COMPAT,'UTF-8'), $style3,'pStyle');
        $table3->addCell(1400)->addText(htmlspecialchars('COMPEDIA',ENT_COMPAT,'UTF-8'), $style3,'pStyle');
        $table3->addCell(2600)->addText(htmlspecialchars('SPECIFICATION',ENT_COMPAT,'UTF-8'), $style3,'pStyle');
        $table3->addCell(2000)->addText(htmlspecialchars('DETERMINED',ENT_COMPAT,'UTF-8'), $style3,'pStyle');
        $table3->addCell(800, array('bgColor' => 'D9D9D9'))->addText(htmlspecialchars('REMARKS',ENT_COMPAT,'UTF-8'), $style3,'pStyle');

        for ($i = 0; $i < count($trd); $i++) {

            foreach ($coa_details as $coa) {

                if ($coa->test_id == $trd[$i]->test_id) {
                    $determined = $coa->determined;
                    $remarks = $coa->verdict;
                }
            }               
            $determine = explode(":", $trd[$i]->determined);
            for($d=0;$d<count($determine);$d++):    
            $table3->addRow();
            $table3->addCell(1200, array('bgColor' => 'dbdbdb'),'pStyle')->addText(htmlspecialchars($trd[$i]->name,ENT_COMPAT,'UTF-8'),array('bold'=>true),'pStyle');
            $table3->addCell(1200)->addText(htmlspecialchars($trd[$i]->methods,ENT_COMPAT,'UTF-8'),null,'pStyle');
            $table3->addCell(1400)->addText(htmlspecialchars($trd[$i]->compedia,ENT_COMPAT,'UTF-8'),null,'pStyle');
            $table3->addCell(2600)->addText(htmlspecialchars($trd[$i]->specification,ENT_COMPAT,'UTF-8'),null,'pStyle');           
            $table3->addCell(2000)->addText(htmlspecialchars($determine[$d],ENT_COMPAT,'UTF-8'),null,'pStyle');
            $table3->addCell(800, array('bgColor' => 'dbdbdb'))->addText(htmlspecialchars($trd[$i]->complies,ENT_COMPAT,'UTF-8'),array('bold'=>true),'pStyle');

            endfor;
        }

        $section->addTextBreak(1);
        
        $conclusion=$section->addTextRun(array('alignment'=>'left'));     
        $conclusion->addText(htmlspecialchars('CONCLUSION: ',ENT_COMPAT,'UTF-8'),array('bold'=>true));
        $conclusion->addText(htmlspecialchars('The product complies with the specifications for the tests performed.',ENT_COMPAT,'UTF-8'),array('bgColor'=>'D9D9D9'));
       

        $table4 = $section->addTable();
        foreach ($signatories as $signatures):
            $table4->addRow(100);
            $table4->addCell(1500)->addText(htmlspecialchars(strtoupper($signatures->designation),ENT_COMPAT,'UTF-8'));
            $table4->addCell(3000)->addText(htmlspecialchars(strtoupper($signatures->signature_name),ENT_COMPAT,'UTF-8'));
            $table4->addCell(2500,array('borderBottomSize'=>1,'borderColor'=>'000000'));
            $table4->addCell(2500)->addText(htmlspecialchars('DATE:' . $signatures->date_signed),ENT_COMPAT,'UTF-8');
        endforeach;


        // Save File
        unlink('printed_coa/'.$labref . '.docx');
        $objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($word, 'Word2007');
$objWriter->save('printed_coa/'.$labref . '.docx'); // so far so good
 
//        header('Content-Description: File Transfer');
//header('Content-type: application/force-download');
//header('Content-Disposition: attachment; filename='.basename('Text.docx'));
//header('Content-Transfer-Encoding: binary');
//header('Content-Length: '.filesize('Text.docx'));
//readfile('Text.docx');
        echo 'Text.docx created successfully';
    }
    
    function example($labref){
       $trd = $this->getRequestedTestsDisplay2($labref);
      for($i=0;$i<count($trd);$i++):
          echo '<pre>';
         print_r( explode(":",$trd[$i]->determined));   
         echo '</pre>';
        endfor;
       
       $arra=array(
           'determined'=>'Lamivudine 95.7% (n=6; RSD=2.9%) :'
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
        $query = $this->db->query("SELECT  t.id as test_id, cb.method AS methods,`name` , `compedia`,`determined` , `specification`,complies
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

}

?>
